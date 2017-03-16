<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Ip;

class LoginController extends Controller
{

    public function index(Request $request) 
    {
        $captcha = $this->check_captcha($request->ip());
        return view('login')->with(['check_captcha'=>$captcha]);
    }

    private function check_captcha($ip_address) 
    {
        $captcha = false;
        if(Ip::get_num_fails($ip_address)['num_fails'] >= 5){
            $captcha = true;
        }
        return $captcha;
    }

    public function login(Request $request)
    {
        $ip_address = $request->ip();   
        $check_captcha = $this->check_captcha($ip_address);
        if($check_captcha){
            // check captcha first
            $rules = [
                'captcha' => 'required|captcha',
            ];

            $messages = [
                'captcha.required' => 'bạn chưa nhập mã bảo vệ !',
                'captcha.captcha' => 'mã bảo vệ không chính xác !',
            ];

            $validate = Validator::make($request->all(),$rules,$messages);

            if($validate->fails()){
                return redirect()->route('login')->withErrors($validate)->withInput();
            }
        }
        
        $rules = [
            'username' => 'required|exists:users,username',
            'password' => 'required',
        ];

        $messages = [
            'username.required' => 'Bạn chưa nhập tên tài khoản !',
            'username.exists' => 'Tài khoản hoặc mật khẩu không đúng!',
            'password.required' => 'bạn chưa nhập mật khẩu !',
        ];

        $validate = Validator::make($request->all(),$rules,$messages);

        if($validate->fails()){
            Ip::new_ip($request);
            Ip::increment_num_fail($ip_address);
            return redirect()->route('login')->withErrors($validate)->withInput();
        }
        else {
            if(Auth::guard()->attempt([
                'username' => $request->username, 
                'password' => $request->password],
                $request->remember == 1 ? true : false)){
                    return redirect()->route('admin_dashboard');
            }
            else {
                Ip::new_ip($request);
                Ip::increment_num_fail($ip_address);
                return redirect()->route('login')
                ->withErrors(['username'=>'Tên đăng nhập hoặc mật khẩu không đúng'])
                ->withInput();
            }
        }
    }
}
