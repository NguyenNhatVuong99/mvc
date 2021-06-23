

@section('title', 'Tài khoản')
@extends('layouts.admin.master')
@section('main-content')
<div class="card shadow mb-4 ">
    <div class="card-body">
        
  
        <div class="wrapper">
           
      
                <div class="card w-100">
                    <div class="card-header ">
                        
                                <h5  id="table-name" class="m-0 font-weight-bold float-left"><a type="button" id="sidebarCollapse" >
                                    <i class="fas fa-filter"></i>
                                </a> Sản phẩm</h5>
    
                       
                    </div>
                    <div class="card-body">
                        <table style="color: #333" cellspacing="0" class="table table-bordered" id="table"  width="100%" cellspacing="0">
                            <thead>
                               <tr>
                                <th class="text-center align-middle w-5"></th>
                                <th class="text-center align-middle w-5">STT</th>
                                 <th class="text-center align-middle">Mã sản phẩm</th>
                                 <th class="text-center align-middle">Tên sản phẩm</th>
                                 <th class="text-center align-middle">Đơn vị</th>
                                 <th class="text-center align-middle">Giá vốn</th>
                                 <th class="text-center align-middle">Giá website</th>
                                 <th class="text-center align-middle">Giá cửa hàng</th>
                                 <th class="text-center align-middle">Tồn kho</th>
                                 {{--  <th data-orderable="false" class="text-center align-middle w-10">Hiển thị</th>  --}}
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
                                 <th data-orderable="false" class="text-center align-middle w-1"><i class="fas fa-cog"></i></th>
                               </tr>
                               
                             </thead>
                              
                         </table>
                    </div>
                </div>
    
                
        </div>
    </div>
</div>
<div class="modal fade" id="modalCreateProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
          <div class="modal-header">
             <h5 class="modal-title" id="exampleModalLabel">Thêm sản phẩm</h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
             </button>
          </div>
          <div class="modal-body">
             <div class="form-group">
                <label for="regular1" class="control-label">Tên sản phẩm<span class="color-red" > *</span></label>
                <input type="text" id="title"onkeyup="ChangeToSlug()" required autofocus placeholder="" value="" name="name"   class="form-control input-create-supplier" />
                <input type="text" id="slug" required autofocus value="" name="name"   class="form-control input-create-supplier" />

             </div>
             <div class="form-group">
                <div class="alert alert-danger d-none " id="error-create-name">
                </div>
             </div>
             <div class="form-group">
                <label for="regular1" class="control-label">Số điện thoại <span class="color-red"> *</span></label>
                <input type="text"  id="phone-create"required placeholder="Số điện thoại" value="" name="phone" id="title"  class="form-control input-create-supplier" />
             </div>
             <div class="form-group">
                <div class="alert alert-danger d-none" id="error-create-phone">
                </div>
             </div>
             <div class="form-group">
                <label for="inputAddress">Địa chỉ<span class="color-red"> *</span></label>
                <input type="text"  name="address" required  class="form-control input-create-supplier" id="address-create" placeholder="Địa chỉ">
             </div>
             <div class="form-group">
                <div class="alert alert-danger d-none fade show" id="error-create-address">
 
                </div>
             </div>
          </div>
          <div class="modal-footer">
             <button type="button" class="btn btn-danger mr-auto" data-dismiss="modal"><i class="fas fa-times"></i> Đóng</button>
             <button type="button" id="btn-create-supplier" onclick="storeSupplier()" class="btn btn-primary "><i class="fas fa-save"></i> Lưu</button>
          </div>
       </div>
    </div>
 </div>
@endsection
@push('styles')
    <style>
        
        
       
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/1.6.14/css/lightgallery.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/lightgallery@2.0.1/css/lg-zoom.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/lightgallery@2.0.1/css/lg-thumbnail.css">
    <link href="{{asset('css/gallery.css')}}" rel="stylesheet">
    <link href="{{asset('css/switch.css')}}" rel="stylesheet">
    <link href="{{asset('css/tooltip.css')}}" rel="stylesheet">

@endpush


    @push('scripts')
{{-- <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script> --}}

    <script src="{{asset('js/modal-image.js')}}"></script>
    <script src="{{asset('js/toggle-menu.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/1.6.14/js/lightgallery-all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-mousewheel/3.1.13/jquery.mousewheel.min.js"></script>
    <script src="https://cdn.jsdelivr.net/picturefill/2.3.1/picturefill.min.js"></script>
    <script>
        
        getDataMain();
        {{-- CKEDITOR.replace('description-create', options); --}}
        {{-- CKEDITOR.replace('description-update', options); --}}
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
                    url: '{{  route("admin.product.index")}}',
                },

                columns: [
                    {
                        "className":      'details-control',
                        "orderable":      false,
                        "data":           null,
                        "defaultContent": ''
                    },
                    {

                        data: null,
                        defaultContent: '',
                    },

                    {

                        data: 'code',
                        name: 'data.code'
                    },
                    {

                        data: 'title',
                        name: 'data.title'
                    },
                    
                    
                    {

                        render: function(data, type, row) {
                            return row['unit']['name'];
                        }
                    },
                    {

                        data: 'cost_price',
                        name: 'data.cost_price',
                        render: $.fn.dataTable.render.number(',', '.')
                    },{

                        data: 'on_price',
                        name: 'data.on_price',
                        render: $.fn.dataTable.render.number(',', '.')
                    },
                    {

                        data: 'off_price',
                        name: 'data.off_price',
                        render: $.fn.dataTable.render.number(',', '.')
                    },
                    {

                        data: 'quantity',
                        name: 'data.quantity',
                        render: $.fn.dataTable.render.number(',', '.')
                    },

                    
                    {{--  {
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
                    }  --}}
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
            tableMenu();
        }
        $(document).ready(function() {
            // Configure/customize these variables.
            
        });
        function detailRow ( d ) {
            var summary = $("<div/>").html(d.summary).text();
            var description = $("<div/>").html(d.description).text();
            var photos=d.photo.split(',');
            
           
            content='<div class="tab-container">'+
                '<input type="radio" name="tab" data-id="1" id="tab1" checked="checked">'+
                '<label class="tab-label" for="tab1">Chi tiết</label>'+
                '<input type="radio" data-id="2" name="tab" id="tab2">'+
                '<label class="tab-label" for="tab2">Thẻ kho</label>'+
                
                '<div class="tab-content-wrapper">'+
                  '<div id="tab-content-1" class="tab-content">'+
                    '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
                        '<tr>'+
                            '<td class="font-weight-bold w-12">Mã sản phẩm:</td>'+
                            '<td class="w-21">'+d.code+'</td>'+
                            '<td class="font-weight-bold w-12">Tên sản phẩm:</td>'+
                            '<td class="w-21">'+d.title+'</td>'+
                            '<td class="font-weight-bold w-12">Số lượng:</td>'+
                            '<td class="w-21">'+d.quantity+'</td>'+
                        '</tr>'+
                        '<tr>'+
                            '<td class="font-weight-bold w-12">Giá vốn:</td>'+
                            '<td id="detail-cost-price" class="w-21">'+d.cost_price+'</td>'+
                            '<td class="font-weight-bold w-12" >Giá online:</td>'+
                            '<td id="detail-on-price" class="w-21">'+d.on_price+'</td>'+
                            '<td class="font-weight-bold w-12">Giá cửa hàng:</td>'+
                            '<td id="detail-off-price" class="w-21">'+d.off_price+'</td>'+
                        '</tr>'+
                        '<tr>'+
                            '<td class="font-weight-bold w-12">Cân nặng:</td>'+
                            '<td class="w-21">'+d.weight+'</td>'+
                            '<td class="font-weight-bold w-12" >Đơn vị:</td>'+
                            '<td class="w-21">'+d.unit.name+'</td>'+
                            '<td class="font-weight-bold w-12">Hiển thị:</td>'+
                            '<td class="w-21">'+
                                '<label class="switch">';
                                    if (d.status == 1) {
                                        content += '<input type="checkbox" checked>';
                                    } else {
                                        content += '<input type="checkbox">';
                                    }  
                                    
                                    content+='<span class="slider round"></span>'+
                                  '</label>'+
                            '</td>'+
                        '</tr>'+
                        '<tr>'+
                            '<td class="font-weight-bold w-12">Hình ảnh:</td>'+
                            '<td class="w-25" colspan="5" >'+
                                '<div class="gallery">'+
                                    '<ul id="lightgallery-'+d.id+'" class="lightgallery">';
                                        for(var item of photos){
                                            content+='<li data-src="'+item+'">'+
                                                '<a href="'+item+'">'+
                                                    '<img class="img-responsive" src="'+item+'">'+
                                                    '<div class="gallery-poster">'+
                                                    '</div>'+
                                                '</a>'+
                                            '</li>';    
                                        }
                                    content+='</ul>'+
                                '</div>'+
                            '</td>'+
                        '</tr>'+
                        '<tr>'+
                            '<td class="font-weight-bold w-12">Tóm lược:</td>'+
                            '<td colspan=5>'+summary+'</td>'+
                            
                        '</tr>'+
                        '<tr>'+
                            '<td class="font-weight-bold w-12" >Mô tả:</td>'+
                            '<td colspan=5 class="more">'+description+'</td>'+
                        '</tr>'+
                        '<tr>'+
                            '<td colspan=6>'+
                                '<button class="btn btn-danger float-right"> <i class="fas fa-trash"></i> Xóa</button>'+
                                '<button class="btn btn-primary float-right m-r-10"> <i class="fas fa-pen"></i> Cập nhật</button>'+
                                '</td>'+
                        '</tr>'+
                    '</table>'+
                  '</div>'+
                  '<div id="tab-content-2" class="tab-content">'+
                    '<table class="w-100">'+
                        '<thead>'+
                            '<tr>'+
                                '<th class="text-center align-middle w-5">STT</th>'+
                                '<th class="text-center align-middle">Chi nhánh</th>'+
                                '<th class="text-center align-middle">Cảnh báo '+
                                    '<span class="tooltip-content" data-tooltip="Số lượng nhỏ hơn mức tồn nhỏ nhất.">'+
                                        '<i class="fas fa-info-circle"></i>'+
                                    '</span>'+
                                '</th>'+
                                '<th class="text-center align-middle">Số lượng</th>'+

                            '</tr>'+
                        '</thead>'+
                        '<tbody id="detail-stock-'+d.id+'">'+
                        '</tbody>'+

                    '</table>'+
                  '</div>'+
                  '<div id="tab-content-3" class="tab-content">'+
                    
                    '<p>tag3 Donec sollicitudin metus quis magna faucibus, vitae ultrices libero ultrices. Sed ut dui vitae velit laoreet commodo. Nam suscipit purus a ultricies auctor. </p>'+
                  '</div>'+
                  '<div id="tab-content-4" class="tab-content">'+
                    
                    '<p>tag4 </p>'+
                  '</div>'+
                '</div>'+
              '</div>';
              
                return content;
                               
    }
    
        function tableMenu() {
            content = '<a onclick="toggleMenuTable(this); return false;"   class="toggle-menu " href="#" id="toggle-menu-table"><span></span></a>' +
                '<div  class="toggle-menu-list" class="menu-table" style="top:50%">' +
                '<ul>' +
                '<li><a  href="{{ route("admin.product.create") }}"><i class="fas fa-plus"></i>&emsp;Thêm sản phẩm</a></li>' +
                '<li><a href="#" data-type="multiple" onclick="destroy(this)"><i class="fas fa-trash"></i>&emsp;Xóa</a></li>' +
                '<li><a href="#" onclick="showTableTrashed()"><i class="fas fa-trash-alt"></i>&emsp;Thùng rác</a></li>' +
                '</ul>' +
                '</div>';
            $(".content-table-menu").html(content);
        }
        $('#table tbody').on('click', 'td.details-control', function () {
            var table = $('#table').DataTable();

            var tr = $(this).closest('tr');
            var row = table.row( tr );
             var id=row.data()['id']; 
            $('#table tbody tr').removeClass('shown');
            if ( row.child.isShown() ) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
            }
            else {
                
                 row.child( detailRow(row.data()) ).show();
                tr.addClass('shown');
                new AutoNumeric("#detail-cost-price", {
                    decimalPlaces: '0'
                });
                new AutoNumeric("#detail-on-price", {
                    decimalPlaces: '0'
                });
                new AutoNumeric("#detail-off-price", {
                    decimalPlaces: '0'
                });
                $("#lightgallery-"+id).lightGallery({
                    pager: true
                  }); 
                  {{--  detailStock(id);  --}}
                  
            }
        } );
        {{--  function detailStock(id){
                $.ajax({
                    type: 'post',
                    dataType: 'json',
                    url:"{{route('admin.product.detailStock')}}",
                    data:{
                        id:id
                    },
                    success: function(result) {
                        console.log(result);
                        var stt=1;
                        var content;
                        for(var item of result){
                            content+='<tr>'+
                                        '<td>'+stt+'</td>'+
                                        '<td>'+item.branch.name+'</td>'+
                                        '<td>'+
                                            '<label class="switch">';
                                            if (item.isWarning == 1) {
                                                content += '<input type="checkbox" checked>';
                                            } else {
                                                content += '<input type="checkbox">';
                                            }  
                                        content+='<span class="slider round"></span>'+
                                            '</label>'+
                                        '</td>'+
                                        '<td class="detail-quantity-'+id+'">'+item.quantity+'</td>'+

                                    '</tr>';
                                    stt++;
                        }
                        content+='<tr>'+
                                    '<td colspan=3 class="font-weight-bold text-center">Tổng cộng</td>'+
                                    '<td class="font-weight-bold" id="sum-detail-quantity-'+id+'"></td>'+
                                '</tr>';
                                var sum = 0;
                                $(".detail-quantity-"+id).each(function(){
                                    sum += parseFloat($(this).text());
                                });
                                console.log(sum);
                        $("#detail-stock-"+id).html(content); 
                        $('#sum-detail-quantity-'+id).text(sum);

                    },
                    error: function(response) {
                        var errors = response.responseJSON.errors;
                        showError(errors);                
                    },
                });
            
        }
         --}}
        function showModalCreateProduct() {
            $("#modalCreateProduct").modal('show');
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
