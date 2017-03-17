@extends('admin.home')
@section('css')
<link href="/webarch/webarch/HTML/assets/plugins/bootstrap-select2/select2.css" rel="stylesheet" type="text/css" media="screen"/>
<link href="/webarch/webarch/HTML/assets/plugins/jquery-datatable/css/jquery.dataTables.css" rel="stylesheet" type="text/css"/>
<link href="/webarch/webarch/HTML/assets/plugins/datatables-responsive/css/datatables.responsive.css" rel="stylesheet" type="text/css" media="screen"/>
<!-- END CORE CSS FRAMEWORK -->

<!-- BEGIN CSS TEMPLATE -->
<link href="assets/css/style.css" rel="stylesheet" type="text/css"/>
<link href="assets/css/responsive.css" rel="stylesheet" type="text/css"/>
<link href="assets/css/custom-icon-set.css" rel="stylesheet" type="text/css"/>
<!-- END CSS TEMPLATE -->
<link rel="stylesheet" type="text/css" href="/public/css/admin_chuyen_gia.css">
@endsection
@section('main')
  @if (session('status'))
      <div class="alert alert-success auto_disable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
          {{ session('status') }}
      </div>
  @endif


 <form action="{{URL::asset('quan-tri-vien/quan-ly-du-lieu/san-pham/tao-moi')}}">
  <div class="row-fluid">
    <div class="span12">
      <button class="add-btn btn btn-success" action><span class="fa fa-pencil"></span>&nbsp;&nbsp;Thêm sản phẩm </button>
    </div>
  </div>
 </form>

  <div class="row-fluid">
    <div class="span12">
        <div class="grid simple ">
            <div class="grid-title">
              <h4>Bảng <span class="semi-bold">Sản phẩm khoa học công nghệ</span></h4>
              <div class="tools"> <a href="javascript:;" class="collapse"></a> <a href="#grid-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
            </div>
            <div class="grid-body ">
              <table class="table table-hover" id="example" >
                <thead>
                  <tr>
                   <th>STT</th>
                    <th>Tên sản phẩm</th>
                    <th>Ảnh sản phẩm</th>
                    <th>Lĩnh vực</th>
                    <th>Các điểm nổi bật</th>   
                    <th>Quy trình chuyển giao</th>
                    <th>Khả năng ứng dụng</th>
                    <th>Xem</th>
                    <th>Sửa</th>
                    <th>Xóa</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($datas as $key=>$sp)
                  <tr class="odd gradeX">
                    <td>{{$sp->id}}</td>
                     <td>{{$sp->ten_san_pham}}</td>
                    <td>{{$sp->anh_san_pham}}</td>
                    
                    <td>{{$sp->linh_vuc}}</td>
                    <td>{{$sp->dac_diem_noi_bat}}</td>
                   
                    <td class="center">{{$sp->quy_trinh_chuyen_giao}}</td>
                    <td>{{$sp->kha_nang_ung_dung}}</td>
                    <td class="center"><a target="_blank" href="{{URL::asset('san-pham/'.$sp->link)}}"><span class="fa fa-eye"></span></a></td>
                    <td class="center"><a href="{{URL::asset('quan-tri-vien/quan-ly-du-lieu/san-pham/sua/'.$sp->id)}}"><span class="fa fa-pencil-square"></span></a></td>
                    <td class="center"><div delete-modal" data-toggle="modal" data-target="#delete-modal{{$sp->id}}"><span class="fa fa-trash-o"></span></a></div></td>

                   <!--  delete modal -->
                    <div id="delete-modal{{$sp->id}}" class="modal fade" role="dialog">
                      <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Xóa doanh nghiệp {{$sp->ten_san_pham}} đã chọn?</h4>
                          </div>
                          <div class="modal-footer">
                            <a href="{{URL::asset('quan-tri-vien/quan-ly-du-lieu/san-pham/xoa/'.$sp->id)}}" class="btn btn-primary" id="submit-delete">Xóa</a>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            {!! $datas->links() !!} <!-- phan cac tab khac nhau  -->

          </div>
        </div>
      </div>
@endsection

@section('script')
<script src="/webarch/webarch/HTML/assets/plugins/jquery-1.8.3.min.js" type="text/javascript"></script>
<script src="/webarch/webarch/HTML/assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
<script src="/webarch/webarch/HTML/assets/plugins/boostrapv3/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/webarch/webarch/HTML/assets/plugins/breakpoints.js" type="text/javascript"></script>
<script src="/webarch/webarch/HTML/assets/plugins/jquery-unveil/jquery.unveil.min.js" type="text/javascript"></script>
<script src="/webarch/webarch/HTML/assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js" type="text/javascript"></script>    
<script src="/webarch/webarch/HTML/assets/plugins/jquery-block-ui/jqueryblockui.js" type="text/javascript"></script>
<script src="/webarch/webarch/HTML/assets/plugins/jquery-numberAnimate/jquery.animateNumbers.js" type="text/javascript"></script>
<script src="/webarch/webarch/HTML/assets/plugins/bootstrap-select2/select2.min.js" type="text/javascript"></script>
<script src="/webarch/webarch/HTML/assets/plugins/jquery-datatable/js/jquery.dataTables.min.js" type="text/javascript" ></script>
<script src="/webarch/webarch/HTML/assets/plugins/jquery-datatable/extra/js/dataTables.tableTools.min.js" type="text/javascript" ></script>
<script type="text/javascript" src="/webarch/webarch/HTML/assets/plugins/datatables-responsive/js/datatables.responsive.js"></script>
<script type="text/javascript" src="/webarch/webarch/HTML/assets/plugins/datatables-responsive/js/lodash.min.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<script src="/webarch/webarch/HTML/assets/js/datatables.js" type="text/javascript"></script>
<!-- BEGIN CORE TEMPLATE JS -->
<script src="/webarch/webarch/HTML/assets/js/core.js" type="text/javascript"></script>
<script src="/webarch/webarch/HTML/assets/js/chat.js" type="text/javascript"></script>
<script src="/webarch/webarch/HTML/assets/js/demo.js" type="text/javascript"></script>
<script src="/public/js/admin/admin_database_manager.js" type="text/javascript"></script>
<script type="text/javascript">
  $(function () {
    $("#example").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
   $(window).load(function(){ 
    $(".alert-success").delay(3000).fadeOut();
  });
     $(window).load(function(){ 
    $(".alert-warning").delay(3000).fadeOut();
  });
    
</script>
@endsection