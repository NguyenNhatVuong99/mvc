

@section('title', 'MVC Shop - Ảnh bìa')
@extends('layouts.admin.master')
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
    <div class="card">
      <div class="card-header">
           <div class="d-flex justify-content-between">
               <h4  id="table-name" class="m-0 font-weight-bold float-left">Ảnh bìa</h4>
          </div>
      </div>
      <div class="card-body">
         <div class="table-responsive">
            <input class="auto-numeric" type="hidden">
            <table style="color: #333" cellspacing="0" class="table table-bordered" id="table"  width="100%" cellspacing="0">
               <thead>
                  <tr>
                   <th class="text-center align-middle w-5">STT</th>
                    <th class="text-center align-middle">Tiêu đề</th>
                    <th class="text-center align-middle">Mô tả</th>
                    <th class="text-center align-middle w-25">Hình ảnh</th>
                    <th data-orderable="false" class="text-center align-middle w-10">Hiển thị</th>
                    <th data-orderable="false" class="text-center align-middle w-10"><i class="fas fa-cog"></i></th>
                  </tr>
                  
                </thead>
                 
            </table>
            <table style="color: #333" cellspacing="0" class="table table-bordered d-none" id="table-trash"  width="100%" cellspacing="0">
               <thead>
                  <tr>
                   <th class="text-center align-middle w-5">STT</th>
                    <th class="text-center align-middle">Tiêu đề</th>
                    <th class="text-center align-middle">Mô tả</th>
                    <th class="text-center align-middle w-25">Hình ảnh</th>
                    <th data-orderable="false" class="text-center align-middle w-20">Thời gian xóa</th>
                    <th data-orderable="false" class="text-center align-middle w-10"><i class="fas fa-cog"></i></th>
                  </tr>
                  
                </thead>
                 
            </table>
         </div>
         <div>
         </div>
      </div>
   </div>
</div>
<div class="modal fade" id="modalCreate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
          <div class="modal-header">
             <h5 class="modal-title" id="exampleModalLabel">Thêm ảnh bìa</h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
             </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Tiêu đề</label>
            <input type="text" class="form-control" id="title" placeholder="Tiêu đề">
            </div>
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Mô tả</label>
              <textarea id="description-create" rows="1" name="description-create" class="form-control">{!! old('content', '') !!}</textarea>
            </div>
            <div class="form-group">
                <label for="recipient-name" class="col-form-label">Hình ảnh</label>

              <div class="input-group">
                <input class="btn btn-primary" type="button" id="lfm" data-input="thumbnail" data-preview="holder" value="Cập nhật">
                <input id="thumbnail" class="form-control" type="text"  name="filepath">
                </div>
            <img id="holder" onclick="showModalImage(this)" style="margin-top:15px;max-height:100px;">
            </div>
            <div class="form-group ">
                <label for="recipient-name" class="col-form-label">Trạng thái</label>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="radio" value="1" class="status" name="status" id="status_1" />
                            <label for="status_1">Hiển thị</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input type="radio" class="status" value="0" checked name="status" id="status_0" />
                            <label for="status_0">Ẩn</label>
                        </div>
                    </div>
                </div>
              
            </div>
          </div>
          <div class="modal-footer">
             <button type="button" class="btn btn-danger mr-auto" data-dismiss="modal">Thoát</button>
             <button type="button" class="btn btn-primary" onclick="store()">Lưu</button>
          </div>
       </div>
    </div>
 </div>
 <div id="modal-image" class="modal d-none">

  <!-- The Close Button -->
  <span onclick="hidelModalImage()" class="close">&times;</span>

  <!-- Modal Content (The Image) -->
  <img class="modal-content" id="">

  <!-- Modal Caption (Image Text) -->
  <div id="caption"></div>
</div>
<div class="modal fade" id="modalUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
          <div class="modal-header">
             <h5 class="modal-title" id="exampleModalLabel">Chỉnh sửa ảnh bìa</h5>
             <input type="hidden" id="id-update">
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
             </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Tiêu đề</label>
            <input type="text" class="form-control" id="title-update" placeholder="Tiêu đề">
            </div>
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Mô tả</label>
              <textarea id="description-update" rows="1" name="description-update" class="form-control">{!! old('content', '') !!}</textarea>
            </div>
            <div class="form-group">
                <label for="recipient-name" class="col-form-label">Hình ảnh</label>

              <div class="input-group">
                <input class="btn btn-primary" type="button" id="lfm-update" data-input="thumbnail-update" data-preview="holder-update" value="Cập nhật">
                <input id="thumbnail-update" class="form-control" type="text"  name="filepath">
                </div>
            <img id="holder-update" onclick="showModalImage(this)" style="margin-top:15px;max-height:100px;">
            </div>
            
          </div>
          <div class="modal-footer">
             <button type="button" class="btn btn-danger mr-auto" data-dismiss="modal">Thoát</button>
             <button type="button" class="btn btn-primary" onclick="update()">Lưu</button>
          </div>
       </div>
    </div>
 </div>
 <div id="modal-image" class="modal d-none">

  <!-- The Close Button -->
  <span onclick="hidelModalImage()" class="close">&times;</span>

  <!-- Modal Content (The Image) -->
  <img class="modal-content" id="">

  <!-- Modal Caption (Image Text) -->
  <div id="caption"></div>
</div>
 
@endsection
@push('styles')
<link href="{{ asset('css/modal-image.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/checkbox.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/toggle-radio.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/toggle-menu.css') }}" rel="stylesheet" type="text/css" />
@endpush
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="{{asset('js/modal-image.js')}}"></script>
    <script src="{{asset('js/toggle-menu.js')}}"></script>

    <script>
        getDataMain();
        CKEDITOR.replace('description-create', options);
        CKEDITOR.replace('description-update', options);
        $('#lfm').filemanager('image');
        $('#lfm-update').filemanager('image');


        function getDataMain() {
            var table = $('#table').DataTable();

            table.destroy();
            var table = $('#table').DataTable({
                scrollY: "500px",
                scrollCollapse: true,
                responsive: true,
                processing: true,
                select: {
                    style: 'multi'
                },
                dom: "<'d-flex justify-content-between'<l><'content-table-menu'><f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
                language: {
                    processing: '<svg class="spinner" width="65px" height="65px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">' +
                        '<circle class="path" fill="none" stroke-width="6" stroke-linecap="round" cx="33" cy="33" r="30"></circle>' +
                        '</svg>',

                    paginate: {
                        first: "Đầu tiên",
                        previous: "Trước",
                        next: "Tiếp theo",
                        last: "Cuối cùng"
                    },

                    'select': {
                        'style': 'multi'
                    },
                    emptyTable: "Dữ liệu trống",
                    search: "Tìm kiếm",
                    lengthMenu: "Hiển thị  _MENU_ dòng",
                    info: "Đang hiển thị _START_ đến _END_ của _TOTAL_ dòng",
                    infoEmpty: "Đang hiển thị 0 đến 0 của 0 dòng",
                    infoFiltered: "(được chọn lọc từ _MAX_ dòng )",
                    infoPostFix: "",
                    loadingRecords: "Chargement en cours.banner.banner.",
                    zeroRecords: "Aucun &eacute;l&eacute;ment &agrave; afficher",
                    aria: {
                        sortAscending: ": Message khi đang sắp xếp theo column",
                        sortDescending: ": Message khi đang sắp xếp theo column",
                    }
                },
                info: false,

                buttons: [

                    'copy',
                    'csv',
                    'excel',
                    'pdf',
                    {
                        extend: 'print',
                        text: 'Print all ',
                        exportOptions: {
                            modifier: {
                                selected: null
                            }
                        }
                    }
                ],
                initComplete: function() {
                    var btns = $('.dt-button');
                    btns.addClass('btn btn-primary');
                    btns.removeClass('dt-button');

                },

                ajax: {
                    dataType: 'json',
                    type: 'get',
                    url: '{{  route("admin.banner.index")}}',
                },

                columns: [{

                        data: null,
                        defaultContent: '',
                    },

                    {

                        data: 'title',
                        name: 'data.title'
                    },
                    {

                        render: function(data, type, row) {
                            var text = decodeEntities(row.description);
                            return text; 
                        }
                    },


                    {

                        data: 'photo',
                        name: 'data.photo',
                        render: function(data, type, row) {
                            content = '<img id="myImg"  onclick="showModalImage(this)" src="' + data + '" alt="Snow" style="width:25%">';
                            return content;
                        }
                    },
                    {

                        data: 'status',
                        name: 'data.status',
                        render: function(data, type, row) {
                            if (data == 1) {
                                content = '<div data-status=' + data + ' data-id=' + row.id + ' onclick="toggleStatus(this)" class="toggle toggle-on" id="switch-radio">';
                            } else {
                                content = '<div data-status=' + data + ' data-id=' + row.id + ' onclick="toggleStatus(this)" class="toggle" id="switch-radio">';
                            }
                            content += '<div class="toggle-text-off">Ẩn</div>' +
                                '<div class="glow-comp"></div>' +
                                '<div class="toggle-button"></div>' +
                                '<div class="toggle-text-on">Hiển thị</div>' +
                                '</div>';
                            return content;
                        }
                    },
                    {
                        render: function(data, type, row) {
                            content = '<a onclick="toggleMenuTd(this); return false;" data-id=' + row.id + ' class="toggle-menu toggle-menu-td" href="#" id="toggle-crud-' + row.id + '"><span></span></a>' +
                                '<div id="menu-td-' + row.id + '" class="toggle-menu-list">' +
                                '<ul>' +
                                '<li><a href="#" onclick="showModalUpdate(' + row.id + ')"><i class="fas fa-pen"></i>&emsp;Chỉnh sửa</a></li>' +
                                '<li><a href="#" data-id=' + row.id + ' data-type="delete" onclick="destroy(this)"><i class="fas fa-trash"></i>&emsp;Xóa</a></li>' +
                                '</ul>' +
                                '</div>';

                            return content;
                        }
                    }
                ],
            });



            table.on('order.dt search.dt', function() {
                table.column(0, {
                    search: 'applied',
                    order: 'applied'
                }).nodes().each(function(cell, i) {
                    cell.innerHTML = i + 1;
                });
            }).draw();
            tableMenu();
        }

        function tableMenu() {
            content = '<a onclick="toggleMenuTable(this); return false;"   class="toggle-menu " href="#" id="toggle-menu-table"><span></span></a>' +
                '<div  class="toggle-menu-list" class="menu-table" style="top:50%">' +
                '<ul>' +
                '<li><a onclick="showModalCreate();" href="#"><i class="fas fa-plus"></i>&emsp;Thêm ảnh bìa</a></li>' +
                '<li><a href="#" data-type="multiple" onclick="destroy(this)"><i class="fas fa-trash"></i>&emsp;Xóa</a></li>' +
                '<li><a href="#" onclick="showTableTrashed()"><i class="fas fa-trash-alt"></i>&emsp;Thùng rác</a></li>' +
                '</ul>' +
                '</div>';
            $(".content-table-menu").html(content);
        }

        function showModalCreate() {
            $("#modalCreate").modal('show');
        }

        function showModalUpdate(id) {
            console.log(id);
            $.ajax({
                type: 'get',
                dataType: 'json',
                url:"{{route('admin.banner.show', '')}}"+"/"+id,
                success: function(result) {
                    $("#modalUpdate").modal('show');
                    $("#title-update").val(result['title']);
                    $("#id-update").val(id);
                    $("#thumbnail-update").val(result['photo']);
                    $("#holder-update").attr('src',result['photo']);
                    CKEDITOR.instances['description-update'].setData(result['description']);
                   
                    
                },
                error: function(response) {
                    var errors = response.responseJSON.errors;
                    showError(errors);                
                },
            });
        }
        $('input').keypress(function(e) {
            if (e.which == 13) {
                store();
                return false;
            }
        });

        function store() {
            var title = $('#title').val();
            var photo = $('#thumbnail').val();
            var description = CKEDITOR.instances['description'].getData();
            var status = $('input[name=status]:checked').val();

            $.ajax({
                type: 'post',
                dataType: 'json',
                url: '{{route("admin.banner.store")}}',
                data: {
                    title: title,
                    description: description,
                    photo: photo,
                    status: status,
                },
                success: function(result) {
                    $("#modalCreate").modal('hide');
                    toastr.success('Cập nhật thành công');
                    getDataMain();
                },
                error: function(response) {
                    var errors = response.responseJSON.errors;
                    showError(errors);
                },
            });

        }
        function update() {
            var title = $('#title-update').val();
            var photo = $('#thumbnail-update').val();
            var id = $('#id-update').val();
            var description = CKEDITOR.instances['description-update'].getData();

            $.ajax({
                type: 'put',
                dataType: 'json',
                url: '{{route("admin.banner.update")}}',
                data: {
                    title: title,
                    description: description,
                    photo: photo,
                    id: id,
                },
                success: function(result) {
                    $("#modalUpdate").modal('hide');
                    toastr.success('Cập nhật thành công');
                    getDataMain();
                },
                error: function(response) {
                    var errors = response.responseJSON.errors;
                    showError(errors);
                },
            });

        }

        function toggleStatus(e) {
            $(e).toggleClass('toggle-on');
            var id = $(e).data('id');
            var status = $(e).data('status');
            if (status == 1) {
                title = 'Bạn muốn ẩn ảnh bìa?';
                status = 0;
            } else {
                title = 'Bạn muốn hiển thị ảnh bìa?';
                status = 1;
            }

            swal.fire({
                title: title,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Xác nhận',
                cancelButtonText: 'Thoát',
                reverseButtons: true

            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'post',
                        dataType: 'json',
                        url: '{{route("admin.banner.updateStatus")}}',
                        data: {
                            id: id,
                            status: status,
                        },
                        success: function(result) {
                            Swal.fire({
                                title: "Cập nhật thành công",
                                type: "success",
                                icon: 'success',
                                timer: 1000,
                                showCancelButton: false,
                                showConfirmButton: false
                            }).then(() => {
                                getDataMain();
                            })


                        },
                        error: function(response) {
                            Swal.fire({
                                title: "Cập nhật thất bại",
                                type: "error",
                                icon: 'error',
                                timer: 1000,
                                showCancelButton: false,
                                showConfirmButton: false
                            }).then(() => {
                                $(e).toggleClass('toggle-on');
                            })
                        },
                    });
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    $(e).toggleClass('toggle-on');

                }
            })
        }

        function destroy(e) {
            var type = $(e).data('type');
            var id = $(e).data('id');
            if (type == 'multiple') {
                var selectedRows = $('#table').DataTable().rows('.selected').data();
                var array = [];
                for (var i = 0; i < selectedRows.length; i++) {
                    array.push(selectedRows[i]['id']);
                }
                data = {
                    type: type,
                    array: array
                };

            } else {
                data = {
                    type: type,
                    id: id
                };
            }
            swal.fire({
                title: 'Bạn muốn xóa ảnh bìa',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Xác nhận',
                cancelButtonText: 'Thoát',
                reverseButtons: true

            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: '{{route("admin.banner.destroy")}}',
                        data: data,
                        success: function(result) {
                            Swal.fire({
                                title: "Cập nhật thành công",
                                type: "success",
                                icon: 'success',
                                timer: 1000,
                                showCancelButton: false,
                                showConfirmButton: false
                            }).then(() => {
                                if (type == 'forceDelete') {
                                    getDataTrash();
                                } else {
                                    getDataMain();
                                }
                            })


                        },
                        error: function(response) {
                            Swal.fire({
                                title: "Cập nhật thất bại",
                                type: "error",
                                icon: 'error',
                                timer: 1000,
                                showCancelButton: false,
                                showConfirmButton: false
                            }).then(() => {
                                $(e).toggleClass('toggle-on');
                            })
                        },
                    });
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    $(e).toggleClass('toggle-on');

                }
            })
        }

        function showTableMain() {
            $("#table").removeClass('d-none');
            $("#table-name").text('Ảnh bìa');
            $("#table-trash").addClass('d-none');
            $('#table-trash').DataTable().destroy();
            getDataMain();
        }

        function showTableTrashed() {
            $("#table").addClass('d-none');
            $('#table').DataTable().destroy();
            $("#table-name").text('Ảnh bìa - Thùng rác');
            $("#table-trash").removeClass('d-none');
            getDataTrash();
        }

        function getDataTrash() {
            var table = $('#table-trash').DataTable();
            table.destroy();
            var table = $('#table-trash').DataTable({
                scrollY: "500px",
                scrollCollapse: true,
                responsive: true,
                processing: true,
                select: {
                    style: 'multi'
                },
                dom: "<'d-flex justify-content-between'<l><'content-table-menu'><f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
                language: {
                    processing: '<svg class="spinner" width="65px" height="65px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">' +
                        '<circle class="path" fill="none" stroke-width="6" stroke-linecap="round" cx="33" cy="33" r="30"></circle>' +
                        '</svg>',

                    paginate: {
                        first: "Đầu tiên",
                        previous: "Trước",
                        next: "Tiếp theo",
                        last: "Cuối cùng"
                    },

                    'select': {
                        'style': 'multi'
                    },
                    emptyTable: "Dữ liệu trống",
                    search: "Tìm kiếm",
                    lengthMenu: "Hiển thị  _MENU_ dòng",
                    info: "Đang hiển thị _START_ đến _END_ của _TOTAL_ dòng",
                    infoEmpty: "Đang hiển thị 0 đến 0 của 0 dòng",
                    infoFiltered: "(được chọn lọc từ _MAX_ dòng )",
                    infoPostFix: "",
                    loadingRecords: "Chargement en cours.banner.banner.",
                    zeroRecords: "Aucun &eacute;l&eacute;ment &agrave; afficher",
                    aria: {
                        sortAscending: ": Message khi đang sắp xếp theo column",
                        sortDescending: ": Message khi đang sắp xếp theo column",
                    }
                },
                info: false,

                buttons: [

                    'copy',
                    'csv',
                    'excel',
                    'pdf',
                    {
                        extend: 'print',
                        text: 'Print all ',
                        exportOptions: {
                            modifier: {
                                selected: null
                            }
                        }
                    }
                ],
                initComplete: function() {
                    var btns = $('.dt-button');
                    btns.addClass('btn btn-primary');
                    btns.removeClass('dt-button');

                },

                ajax: {
                    dataType: 'json',
                    type: 'get',
                    url: '{{  route("admin.banner.onlyTrashed")}}',
                },

                columns: [

                    {

                        data: null,
                        defaultContent: '',
                    },

                    {

                        data: 'title',
                        name: 'data.title'
                    },
                    {

                        render: function(data, type, row) {
                            var text = decodeEntities(row.description);
                            return text; 
                        }
                    },


                    {

                        data: 'photo',
                        name: 'data.photo',
                        render: function(data, type, row) {
                            content = '<img id="myImg"  onclick="showModalImage(this)" src="' + data + '" alt="Snow" style="width:25%">';
                            return content;
                        }
                    },
                    {

                        data: 'deleted_at',
                        name: 'data.deleted_at',
                        render: function(data, type, row) {
                            return moment(data).format("MM-DD-YYYY HH:mm");
                        }
                    },
                    {

                        render: function(data, type, row) {
                            content = '<a onclick="toggleMenuTd(this); return false;" data-id=' + row.id + ' class="toggle-menu toggle-menu-td" href="#" id="toggle-crud-' + row.id + '"><span></span></a>' +
                                '<div id="menu-td-' + row.id + '" class="toggle-menu-list">' +
                                '<ul>' +
                                '<li><a href="#" onclick="restoreItem(' + row.id + ')"><i class="fas fa-trash-restore"></i>&emsp;Khôi phục</a></li>' +
                                '<li><a href="#" data-type="forceDelete" data-id=' + row.id + ' onclick="destroy(this)"><i class="fas fa-trash"></i>&emsp;Xóa hoàn toàn</a></li>' +
                                '</ul>' +
                                '</div>';

                            return content;
                        }
                    }
                ],
            });



            table.on('order.dt search.dt', function() {
                table.column(1, {
                    search: 'applied',
                    order: 'applied'
                }).nodes().each(function(cell, i) {
                    cell.innerHTML = i + 1;
                });
            }).draw();
            tableMenuTrash();
        }

        function restoreItem(id) {
            swal.fire({
                title: 'Bạn muốn khôi phục ảnh bìa',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Xác nhận',
                cancelButtonText: 'Thoát',
                reverseButtons: true

            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: '{{route("admin.banner.restore")}}',
                        data: {
                            id: id
                        },
                        success: function(result) {
                            Swal.fire({
                                title: "Cập nhật thành công",
                                type: "success",
                                icon: 'success',
                                timer: 1000,
                                showCancelButton: false,
                                showConfirmButton: false
                            }).then(() => {
                                getDataTrash();
                            })


                        },
                        error: function(response) {
                            Swal.fire({
                                title: "Cập nhật thất bại",
                                type: "error",
                                icon: 'error',
                                timer: 1000,
                                showCancelButton: false,
                                showConfirmButton: false
                            }).then(() => {
                                $(e).toggleClass('toggle-on');
                            })
                        },
                    });
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    $(e).toggleClass('toggle-on');

                }
            })
        }

        function tableMenuTrash() {
            content = '<a onclick="toggleMenuTable(this); return false;"   class="toggle-menu " href="#" id="toggle-menu-table"><span></span></a>' +
                '<div  class="toggle-menu-list" >' +
                '<ul>' +
                '<li><a href="#" onclick="showTableMain()"><i class="fas fa-home"></i>&emsp;Trang chính</a></li>' +
                '<li><a href="#"><i class="fas fa-trash"></i>&emsp;Xóa</a></li>' +
                '</ul>' +
                '</div>';
            $(".content-table-menu").html(content);
        }
    </script>
@endpush

