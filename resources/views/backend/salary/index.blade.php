

@section('title', 'Tài khoản')
@extends('backend.layouts.master')
@section('main-content')
<!-- DataTales Example -->
<div class="card shadow mb-4">
<div class="row">
   <div class="col-md-12">
      @include('backend.layouts.notification')
   </div>
</div>
<!-- Button trigger modal -->
<!-- Modal -->
<div class="card-body">
<div class="table-responsive">
   <div class="row">
      <div class="col">
         <div class="collapse panel-collapse show collapse-stock" id="CNPC">
            <div class="card">
               <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="m-0 font-weight-bold text-primary float-left">Bảng lương</h4>
                   </div>
               </div>
               <div class="card-body">
                  <div class="table-responsive">
                     <input class="auto-numeric" type="hidden">
                     <table style="color: #333" class="table table-bordered display" id="table"  width="100%" cellspacing="0">
                        <thead>
                           <tr>
                            <th  class="text-center align-middle w-10">STT</th>
                             <th class="text-center align-middle w-20">Tên</th>
                             <th class="text-center align-middle">Mô tả</th>
                             <th class="text-center align-middle w-10">Nhân viên</th>
                             <th class="text-center align-middle w-20"></th>
                           </tr>
                         </thead>
                     </table>
                  </div>
                  <div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="modal fade" id="modalShowPermission" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modal-title-permission"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <input type="hidden" value="" id="role_id">
            <ul class="ks-cboxtags" id="list-permission">
                
            </ul>
            
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-danger " data-dismiss="modal">Đóng</button>
          <button type="button" class="btn btn-primary" onclick="updatePermission()">Chỉnh sửa</button>
        </div>
      </div>
    </div>
  </div>
<div class="modal fade" id="modalShowRole" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modal-title-role"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <input type="hidden" value="" id="role_id">

                <label for="exampleInputEmail1">Mô tả</label>
                <textarea class="form-control" id="description-role" rows="3" style="height: 80px;"></textarea>

              </div>
            
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-danger " data-dismiss="modal">Đóng</button>
          <button type="button" class="btn btn-primary" onclick="updateRole()">Chỉnh sửa</button>
        </div>
      </div>
    </div>
  </div>
@endsection
@push('styles')
    <link href="{{asset('css/list-checkbox.css')}}" rel="stylesheet">
    <link href="{{asset('vendor/css/util.css')}}" rel="stylesheet">

@endpush
@push('scripts')
    <script>
        getData();
        function getData() {
            var numberFormat = $.fn.dataTable.render.number( '\,', '.', 0 ).display;
            $('#table').DataTable().destroy();
            var table = $('#table').DataTable({
                responsive: true,
                dom: "<'d-flex justify-content-right'<f>>" +
                "<'row'<'col-sm-12'tr>>" ,
                processing: true,
                language: {
                    processing: "<div class='loader'>Loading...</div>",
                    paginate: {
                        first: "Đầu tiên",
                        previous: "Trước",
                        next: "Tiếp theo",
                        last: "Cuối cùng"
                    },
                    emptyTable: "Dữ liệu trống",
                    search: "Tìm kiếm",
                    lengthMenu: "Hiển thị  _MENU_ dòng",
                    info: "Đang hiển thị _START_ đến _END_ của _TOTAL_ dòng",
                    infoEmpty: "Đang hiển thị 0 đến 0 của 0 dòng",
                    infoFiltered: "(được chọn lọc từ _MAX_ dòng )",
                    infoPostFix: "",
                    loadingRecords: "Chargement en cours...",
                    zeroRecords: "Aucun &eacute;l&eacute;ment &agrave; afficher",
                    aria: {
                        sortAscending: ": Message khi đang sắp xếp theo column",
                        sortDescending: ": Message khi đang sắp xếp theo column",
                    }
                },
                info: false,
                ordering: true,
                {{--  "order": [
                    [1, "asc"]
                ],  --}}
                ajax: {
                    dataType: 'json',
                    type: 'get',
                    url: '{{  route("admin.role.index")}}',
                },
        
                columns: [
                    {
                        data: null, 
                        defaultContent: '',
                    },
                    {
                        data:'name',
                        name:'data.name'
                    },
                    {
                        data:'description',
                        name:'data.description'
                    },
                    {
                        render: function(data,type,row) {
                            var content='';
                            if(row.isPersonel=='1'){
                                content+='<button class="btn btn-danger"  ><i class="fas fa-user"></i> Nhân viên</button>';
                            }
                            return content;
                        }
                    },
                    {
                        render: function(data,type,row) {
                            var content='';
                            content+='<div class="btn-group" role="group" aria-label="First group">'+
                                    '<button class="btn btn-success marg-1-right" onclick="showEditRole('+row.id+')"><i class="fas fa-pen"></i></button>';
                                if(row.name!='Admin'){
                                    content+='<button class="btn btn-primary" onclick="showEditPermission( '+row.id+')"><i class="fas fa-pen-alt"></i> Chỉnh sửa quyền</button>';
                                }
                            content+'</div>';
                            return content;
                            
                                           
                        }
                    }
                ],  
            });


            table.on('order.dt search.dt', function() {
                table.column(0, {
                    search: 'applied',
                    order: 'applied'
                }).nodes().each(function(cell, i)   {
                    cell.innerHTML = i + 1;
                });
            }).draw();

        }
        function showEditRole(id){
            $.ajax({
                type: 'get',
                dataType: 'json',
                url: '/quan-ly/quyen-truy-cap/'+id,
                success: function(response) {
                    var role=response.role;
                    $("#description-role").val(role['description']);
                    $("#role_id").val(role['id']);
                    $("#modal-title-role").text('Vai trò - '+role['name']);
                    $("#modalShowRole").modal('toggle');
                },
                error: function(json) {
                    if (json.status === 404) {
                        var errors = json.responseJSON;
                    }
                }
            });
        }
        function showEditPermission(id){
            $.ajax({
                type: 'get',
                dataType: 'json',
                url: '/quan-ly/quyen-truy-cap/'+id,
                success: function(response) {
                    var all=response.all;
                    var role=response.role;
                    var permissions=response.permissions;
                    var content='';
                    if(permissions.length>0){
                        for(item of all){
                            for(per of permissions){
                                if(item['id']==per['permission_id']){
                                    content+='<li><input checked  type="checkbox" id="check_'+item['id']+'" value="'+item['id']+'">'+
                                        '<label for="check_'+item['id']+'">'+item['name']+'</label>'+
                                        '</li>';
                                    var index = permissions.indexOf(per);
                                    if (index !== -1) {
                                        permissions.splice(index, 1);
                                    }
                                }
                                else{
                                    content+='<li><input   type="checkbox" id="check_'+item['id']+'" value="'+item['id']+'">'+
                                        '<label for="check_'+item['id']+'">'+item['name']+'</label>'+
                                        '</li>';
                                }
                                break;
                            }
                        }
                    }
                    else{
                        for(item of all){
                            content+='<li><input   type="checkbox" id="check_'+item['id']+'" value="'+item['id']+'">'+
                                '<label for="check_'+item['id']+'">'+item['name']+'</label>'+
                                '</li>';
                        }
                    }
                    
                    $("#list-permission").html(content);
                    $("#role_id").val(role['id']);
                    $("#modal-title-permission").text('Chỉnh sửa quyền truy cập - '+role['name']);
                    $("#modalShowPermission").modal('toggle');
                },
                error: function(json) {
                    if (json.status === 404) {
                        var errors = json.responseJSON;
                    }
                }
            });
        }
        function updatePermission(){
            var arr = [];
            $('#list-permission input:checked').each(function() {
                arr.push($(this).val());
            });
            var role_id=$("#role_id").val();
            $.ajax({
                type: 'post',
                dataType: 'json',
                data:{
                    role_id:role_id,
                    arr:arr
                },
                url: '{{route("admin.role.updatePermission")}}',
                success: function(response) {
                    $("#modalShowPermission").modal('toggle');
                    toastr.success('Cập nhật thành công');
                    getData();
                },
                error: function(json) {
                    if (json.status === 404) {
                        var errors = json.responseJSON;
                    }
                }
            }); 
        }
        function updateRole(){
            var id=$("#role_id").val();
            var description=$("#description-role").val();
            $.ajax({
                type: 'put',
                dataType: 'json',
                data:{
                    id:id,
                    description:description
                },
                url: '{{route("admin.role.update")}}',
                success: function(response) {
                    $("#modalShowRole").modal('toggle');

                    toastr.success('Cập nhật thành công');
                    getData();
                },
                error: function(response) {
                    var errors = response.responseJSON.errors;
                    $.each(errors,function(field_name,error){
                        toastr.error(error);
                    });
                }
            }); 
        }
        
    </script>
@endpush

