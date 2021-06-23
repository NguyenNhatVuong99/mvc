

@section('title', 'Tài khoản')
@extends('layouts.admin.master')
@section('main-content')
    <div class="card shadow mb-4 ">
        <div class="card-body">
            <div class="wrapper">
                <nav id="sidebar">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-list "></i> Bảng giá
                            <button class="btn btn-primary btn-sm float-right"data-toggle="modal" data-target="#modalCreatePriceList" ><i class="fas fa-plus"></i></button>
                        </div>
                        <div class="list-group" id="price-list">
                        </div>
                    </div>
                </nav>
                <div class="content"style="width:100%">
                    <div class="card" >
                        <div class="card-header ">
                            <div class="row">
                                <div class="col-1">
                                    <button type="button" id="sidebarCollapse" class="btn btn-sm btn-primary float-left" > <i class="fa fa-filter"></i> </button>

                                </div>
                                <div class="col-11">
                                    <h5  id="table-name" style="padding-left: 20px; margin-top: 4px" class=" font-weight-bold">
                                    </h5>
                                    <input type="hidden" id="price-list-id">
                                </div>
                            </div>
                            
                        </div>
                        <div class="card-body">
                            <table style="color: #333" cellspacing="0" class="table table-bordered" id="table_default"  width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th class="text-center align-middle w-5"></th>
                                        <th class="text-center align-middle w-15">Mã sản phẩm</th>
                                        <th class="text-center align-middle w-35">Tên sản phẩm</th>
                                        <th class="text-center align-middle w-15">Giá vốn </th>
                                        <th class="text-center align-middle w-15">Giá website</th>
                                        <th class="text-center align-middle w-15">Giá cửa hàng</th>
                                    </tr>
                                </thead>
                            </table>
                            <table style="color: #333" cellspacing="0" class="d-none table table-bordered" id="table_promotion"  width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th class="text-center align-middle w-5"></th>
                                        <th class="text-center align-middle w-10">Mã SP</th>
                                        <th class="text-center align-middle w-20">Tên SP</th>
                                        <th class="text-center align-middle w-12" >Giá vốn </th>
                                        <th class="text-center align-middle w-12">Giá NY website</th>
                                        <th class="text-center align-middle w-12">Giá NY cửa hàng</th>
                                        <th class="text-center align-middle w-12">Giá website</th>
                                        <th class="text-center align-middle w-12">Giá cửa hàng</th>
                                        <th class="text-center align-middle w-5"></th>
                                    </tr>
                                </thead>
                                
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

<div class="modal" id="modalCreatePriceList" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width:50% !important" role="document">
       <div class="modal-content">
          <div class="modal-header">
             <h5 class="modal-title">Thêm bảng giá</h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
             </button>
          </div>
          <div class="modal-body">
              <div class="form-group row">
                <label for="regular1" class="col-md-3 col-form-label">Tên bảng giá:<span class="color-red"> *</span></label>
                <div class="col-md-9">
                    <input type="text"  id="title-create"  autocomplete="off"required placeholder="Tên bảng giá" value="" name="phone" class="form-control" />
                </div>
              </div>
             <div class="form-group row">
                <label class="col-md-3 col-form-label" for="inputEmail4">Hiệu lực từ: <span class="color-red"> *</span></label>
                <div class="col-md-4">
                    <input type="text" required placeholder="" value="{{ old('date') }}" name="date" id="start-date" class="datetime form-control" />
                </div>
                <label class="col-md-1 col-form-label" for="inputEmail4">đến</label>
                <div class="col-md-4">
                    <input type="text" required placeholder="" value="{{ old('date') }}" name="date" id="end-date" class="datetime form-control" />
                </div>

              
             </div>
          </div>
          <div class="modal-footer d-flex justify-content-between">
             <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> &ensp;Hủy</button>
             <button onclick="storePriceList()" type="button" class="btn btn-primary"><i class="fas fa-save"></i> &ensp;Lưu</button>
          </div>
       </div>
    </div>
 </div>
 <div class="modal" id="modalUpdatePriceList" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width:50% !important" role="document">
       <div class="modal-content">
          <div class="modal-header">
             <h5 class="modal-title">Cập nhật bảng giá</h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
             </button>
          </div>
          <div class="modal-body">
            <div class="form-group row">
                <label for="regular1" class="col-md-3 col-form-label">Tên bảng giá:<span class="color-red"> *</span></label>
                <div class="col-md-9">
                    <input type="text"  id="title-update"  autocomplete="off"required placeholder="Tên bảng giá" value="" name="phone" class="form-control" />
                </div>
            </div>
             <div class="form-group row">
                <label class="col-md-3 col-form-label" for="inputEmail4">Hiệu lực từ: </label>
                <div class="col-md-4">
                    <input type="text" required placeholder="" value="{{ old('date') }}" name="date" id="start-date-update" class="datetime form-control" />
                </div>
                <label class="col-md-1 col-form-label" for="inputEmail4">đến</label>
                <div class="col-md-4">
                    <input type="text" required placeholder="" value="{{ old('date') }}" name="date" id="end-date-update" class="datetime form-control" />
                </div>

              
             </div>
             <div class="form-group row">
                <div class="col-md-3">
                    <label for="inputEmail4">Áp dụng:</label>
                </div>
                <div class="col-md-9" id="form-status-update">
                </div>
             </div>
          </div>
          <div class="modal-footer d-flex justify-content-between">
             <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> &ensp;Hủy</button>
             <button onclick="updatePriceList()" type="button" class="btn btn-primary"><i class="fas fa-save"></i> &ensp;Lưu</button>
          </div>
       </div>
    </div>
 </div>
<div class="modal" id="modalCreateFormat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 50% !important;" role="document">
       <div class="modal-content">
          <div class="modal-header">
             <h5 class="modal-title" id="modal-format-title"></h5>
             <input type="hidden" name="" id="price-list-format-id">
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
             </button>
          </div>
          <div class="modal-body">
            <div class="form-row">
                <div class="form-group col-md-2">
                    <button class="btn btn-primary">Giá bán =</button>
                  </div>
                <div class="form-group col-md-4" id="form-parent-price-format-select">
                    
                  </div>
                <div class="form-group col-md-2" id="form-calculation-format-select">
                  </div>
                <div class="form-group col-md-2" id="">
                    <input type="text" class="form-control" id="value-format">
                  </div>
                <div class="form-group col-md-2" id="form-type-format-select">
                  </div>
                
              </div>
          </div>
          <div class="modal-footer d-flex justify-content-between">
             <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> &ensp;Hủy</button>
             <button onclick="updateFormat()" type="button" class="btn btn-primary"><i class="fas fa-save"></i> &ensp;Lưu</button>
          </div>
       </div>
    </div>
 </div>
<div class="modal" id="modalCreatePriceListCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 50% !important;" role="document">
       <div class="modal-content">
          <div class="modal-header">
             <h5 class="modal-title">Thêm theo nhóm</h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
             </button>
          </div>
          <div class="modal-body">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputEmail4">Danh mục sản phẩm<span class="color-red"> *</span>
                    </label>
                    <div class="row">
                        <div class="col-10" id="form-price-list-category-select">
                           
                        </div>
                        <div class="col-2">
                           <button class="form-control btn btn-primary btn-sm" data-toggle="modal" data-target="#modalCreateCategory"><i class="fas fa-plus"></i></button>
                        </div>
                     </div>
                  </div>
                <div class="form-group col-md-6">
                    <label for="inputEmail4">Danh mục phụ</label>
                    <div class="row">
                        <div class="col-12" id="form-price-list-child-category-select">
                           
                        </div>
                        
                     </div>
                  </div>
              </div>
          </div>
          <div class="modal-footer d-flex justify-content-between">
             <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> &ensp;Hủy</button>
             <button onclick="createPriceListCategory()" type="button" class="btn btn-primary"><i class="fas fa-save"></i> &ensp;Lưu</button>
          </div>
       </div>
    </div>
 </div>
<div class="modal" id="modalCreateProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog"  role="document">
       <div class="modal-content">
          <div class="modal-header">
             <h5 class="modal-title">Thêm theo sản phẩm</h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
             </button>
          </div>
          <div class="modal-body">
             <div class="form-row "id="form-product-select">
             </div>
          </div>
          <div class="modal-footer d-flex justify-content-between">
             <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> &ensp;Xóa</button>
             <button onclick="createProductDetail()" type="button" class="btn btn-primary"><i class="fas fa-save"></i> &ensp;Lưu</button>
          </div>
       </div>
    </div>
 </div>
 

@endsection
@push('styles')
    <link href="{{asset('css/switch.css')}}" rel="stylesheet">

@endpush
@push('scripts')
    <script src="{{asset('js/toggle-menu.js')}}"></script>
    <script src="{{asset('js/number.js')}}"></script>

    <script>
        
        $('#start-date').datetimepicker(optionsNowDateTimePicker);
        $('#end-date').datetimepicker(optionsNowDateTimePicker);
        $('#start-date-update').datetimepicker(optionsDateTimePicker);
        $('#end-date-update').datetimepicker(optionsDateTimePicker);
        
        {{--  var trigger = $('.hamburger'),
            overlay = $('.overlay'),
            isClosed = true;

        trigger.click(function() {
            hamburger_cross();
        });

        function hamburger_cross() {

            if (isClosed == true) {
                overlay.hide();
                trigger.removeClass('is-open');
                trigger.addClass('is-closed');
                isClosed = false;
            } else {
                overlay.show();
                trigger.removeClass('is-closed');
                trigger.addClass('is-open');
                isClosed = true;
            }
        }  --}}

        $('[data-toggle="offcanvas"]').click(function() {
            $('#wrapper').toggleClass('toggled');
        });
        getPriceList();
        function getPriceList() {
            $.ajax({
                type: 'get',
                dataType: 'json',
                url: "{{route('admin.priceList.index')}}",

                success: function(result) {
                    content = '';
                    for (var item of result) {
                        if (item.default == 1) {
                            content += '<a href="#" onclick="showPriceList(' + item.id + ');return false;" id="price-list-' + item.id + '" class="list-group-item  active">' + item.title + '</a>'

                        } else {
                            content += '<a href="#" onclick="showPriceList(' + item.id + ');return false;" id="price-list-' + item.id + '" class="list-group-item">' + item.title + '</a>';

                        }
                        
                    }
                    $("#price-list").html(content);
                    for (var item of result) {
                        if(item.status==1){
                            $("#price-list-"+item.id).append('<i class ="m-l-5 fas fa-check-circle"></i>');
                        }
                    }
                },
                error: function(response) {
                    var errors = response.responseJSON.errors;
                    showError(errors);
                },
            });
        }
        function storePriceList() {

            $.ajax({
                type: 'post',
                dataType: 'json',
                url: '{{ route("admin.priceList.store") }}',
                data: {
                    start_date: $("#start-date").val(),
                    end_date: $("#end-date").val(),
                    title: $("#title-create").val(),
                },
                success: function(result) {
                    toastr.success('Cập nhật thành công');
                    getPriceList();
                    $("#modalCreatePriceList").modal('hide');
                },
                error: function(response) {
                    var errors = response.responseJSON.errors;
                    showError(errors);
                }
            });
        }
        showPriceList(1);
        function showPriceList(id) {
            $.ajax({
                type: 'post',
                dataType: 'json',
                data: {
                    id: id
                },
                url: "{{route('admin.priceList.show')}}",
                success: function(result) {
                    $(".list-group-item").removeClass('active');
                    $("#price-list-" + result['id']).addClass('active');
                    $("#table-name").text(result['title']);
                    $("#price-list-id").val(result['id']);
                    if (result['default'] == 1) {
                        getPriceListDefault();
                    } else {
                        getPriceListPromotion(result['id']);
                    }
                },
                error: function(response) {
                    var errors = response.responseJSON.errors;
                    showError(errors);
                },
            });
        }
        function getPriceListDefault() {
            $("#table_default").removeClass('d-none');
            $('#table_promotion').DataTable().destroy();

            $("#table_promotion").addClass('d-none');
            var table = $('#table_default').DataTable();
            arr_id=[];
            table.destroy();
            var table = $('#table_default').DataTable({
                scrollY: "500px",
                scrollCollapse: true,
                responsive: true,
                processing: true,
                "columnDefs": [
                    { "orderable": false, "targets": [0] },
                ],
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
                    type: 'post',
                    data:{
                        id:1
                    },
                    url: '{{  route("admin.priceList.detail")}}',
                    
                },
        
                columns: [{
        
                        data: null,
                        defaultContent: '',
                        "orderable": "false"
                    },
        
        
                    {
        
                        render: function(data, type, row) {
                            return row['product']['code'];
                        }
                    },
        
                    {
        
                        render: function(data, type, row) {
                            return row['product']['title'];
        
                        }
                    },
                    {
                        data:'cost_price',
                        render: function(data, type, row) {
                            return "<i id='icon_cost_price_"+row.id+"' class='fas fa-edit m-r-5'></i><span ondblclick='changeToInput(this)' data-id='"+row.id+"' data-type='cost_price' id='on_price_"+row.id+"'>"+formatNumber(data)+"</span>";
                        }
                    },
                    {
        
                        data:'on_price',
                        render: function(data, type, row) {
                            return "<i id='icon_cost_price_"+row.id+"' class='fas fa-edit m-r-5'></i><span ondblclick='changeToInput(this)' data-id='"+row.id+"' data-type='on_price' id='on_price_"+row.id+"'>"+formatNumber(data);+"</span>";
                        }
                    },
                    {
        
                        data:'off_price',
                        render: function(data, type, row) {
                            return "<i id='icon_cost_price_"+row.id+"' class='fas fa-edit m-r-5'><span ondblclick='changeToInput(this)' data-id='"+row.id+"' data-type='off_price' id='off_price_"+row.id+"'></i>"+formatNumber(data);+"</span>";
                        }
                    },
        
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
        }
      
        
        function getPriceListPromotion(id) {
            $("#table_default").addClass('d-none');
            $('#table_default').DataTable().destroy();
            $("#table_promotion").removeClass('d-none');
            var table = $('#table_promotion').DataTable();
            table.destroy();
            var table = $('#table_promotion').DataTable({
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
        
                    "columnDefs": [
                    { "orderable": false, "targets": [0,8] },
                ],
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
                    type: 'post',
                    data:{
                        id:id

                    },
                    url: '{{  route("admin.priceList.detail")}}',
                },
        
                columns: [{
        
                        data: null,
                        defaultContent: '',
                    },
        
        
                    {
        
                        render: function(data, type, row) {
                            return row['product']['code'];
        
                        }
                    },
        
                    {
        
                        render: function(data, type, row) {
                            return row['product']['title'];
        
                        }
                    },
                    {
                        data:'cost_price',
                        render: function(data, type, row) {
                            return "<i id='icon_cost_price_"+row.id+"' class='fas fa-edit m-r-5'></i><span ondblclick='changeToInput(this)' data-id='"+row.id+"' data-type='cost_price' id='on_price_"+row.id+"'>"+formatNumber(data)+"</span>";
                        }
                    },
                    {
        
                        data:'on_price',
                        render: function(data, type, row) {
                            return "<i id='icon_cost_price_"+row.id+"' class='fas fa-edit m-r-5'></i><span ondblclick='changeToInput(this)' data-id='"+row.id+"' data-type='on_price' id='on_price_"+row.id+"'>"+formatNumber(data);+"</span>";
                        }
                    },
                    {
        
                        data:'off_price',
                        render: function(data, type, row) {
                            return "<i id='icon_cost_price_"+row.id+"' class='fas fa-edit m-r-5'><span ondblclick='changeToInput(this)' data-id='"+row.id+"' data-type='off_price' id='off_price_"+row.id+"'></i>"+formatNumber(data);+"</span>";
                        }
                    },
                    {
        
                        data:'promotion_on_price',
                        render: function(data, type, row) {
                            return "<i id='icon_promotion_on_price_"+row.id+"' class='fas fa-edit m-r-5'></i><span ondblclick='changeToInput(this)' data-id='"+row.id+"' data-type='promotion_on_price' id='promotion_on_price"+row.id+"'>"+formatNumber(data);+"</span>";
                        }
                    },
                    {
        
                        data:'off_price',
                        render: function(data, type, row) {
                            return "<i id='icon_promotion_off_price_"+row.id+"' class='fas fa-edit m-r-5'><span ondblclick='changeToInput(this)' data-id='"+row.id+"' data-type='promotion_off_price' id='promotion_off_price_"+row.id+"'></i>"+formatNumber(data);+"</span>";
                        }
                    },
                    {
        
                        render: function(data, type, row) {
                            return '<button class="btn btn-danger btn-sm" data-id='+row['id']+' data-name='+row['product']['title']+' onclick="deleteProduct(this)"><i class="fas fa-trash"></i></button>';
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
            tableMenuPromotion(id);
        }
        function tableMenuPromotion(id) {
            content = '<a onclick="toggleMenuTable(this); return false;"   class="toggle-menu " href="#" id="toggle-menu-table"><span></span></a>' +
                '<div  class="toggle-menu-list" class="menu-table" style="top:50%">' +
                '<ul>' +
                '<li><a  href="#" onclick="showModalCreatePriceListCategory('+id+'); return false;"  ><i class="fas fa-layer-group"></i>&emsp;Thêm nhóm</a></li>' +
                '<li><a  href="#" onclick="showModalCreateProduct('+id+'); return false;"><i class="fas fa-tshirt"></i>&emsp;Thêm sản phẩm</a></li>' +
                '<li><a href="#" onclick="getFormat('+id+')" ><i class="fas fa-calculator"></i>&emsp;Công thức</a></li>' +
                '<li><a href="#" onclick="showModalUpdatePriceList('+id+')" ><i class="fas fa-pen-alt"></i>&emsp;Cập nhật</a></li>' +
                '<li><a href="#" onclick="deletePriceList('+id+')" ><i class="fas fa-trash-alt"></i>&emsp;Xóa</a></li>' +
                {{--  '<li><a href="#" onclick="showTableTrashed()"><i class="fas fa-trash-alt"></i>&emsp;Thùng rác</a></li>' +  --}}
                '</ul>' +
                '</div>';
            $(".content-table-menu").html(content);
        }

        function showModalCreatePriceListCategory(id){
            $.ajax({
                type: 'get',
                dataType: 'json',
                url: '{{ route("admin.category.index") }}',
                success: function(result) {
                    content='<select id="price-list-category-select"  onChange="selectPriceListCategory(this)" class="selectpicker form-control" title="Chọn danh mục" data-live-search="true" data-width="100%" placeholder="Chọn nhà cung cấp" data-size="5" data-actions-box="true">';
                        for(var item of result){
                            content+='<option  value="'+item['id']+'">'+item['title']+'</option>';
                        }
                    content+='</select>';

                    $("#form-price-list-category-select").html(content);
                    $("#price-list-category-select").selectpicker('refresh');
                    $("#modalCreatePriceListCategory").modal('show');

                },
                error: function(response) {
                    var errors = response.responseJSON.errors; 
                    showError(errors);
               }
            });
        }
        function showModalCreateProduct(id){
            $.ajax({
                type: 'post',
                dataType: 'json',
                
                url: '{{ route("admin.priceList.getProduct") }}',
                data: {
                    id:id
                },
                success: function(result) {
                    content='<select id="product-select" class="show-tick  form-control" title="Chọn sản phấm" data-size="5" data-actions-box="true" multiple data-live-search="true">';
                        for(var item of result){
                                content+='<option value="'+item['product']['id']+'">' +item['product']['code'] + ' - '+item['product']['title'] +'</option>';
                        }
                        content+='</select>';
                    $("#form-product-select").html(content);
                    $("#product-select").selectpicker('refresh');
                    $("#modalCreateProduct").modal('show');

                },
                error: function(response) {
                    var errors = response.responseJSON.errors;
                    showError(errors);
                    
                }
            });
        }
        function selectPriceListCategory(e){
            id = $(e).val();
            $.ajax({
                type: 'get',
                dataType: 'json',
                url: '{{ route("admin.category.child") }}',
                data:{
                    id:id
                },
                success: function(result) {
                    content='<select id="price-list-child-category-select"  class="selectpicker form-control" title="Chọn danh mục phụ" data-live-search="true" data-width="100%" placeholder="Chọn nhà cung cấp" data-size="5" data-actions-box="true">';
                        for(var item of result){
                            content+='<option  value="'+item['id']+'">'+item['title']+'</option>';
                        }
                    content+='</select>';
                    $("#form-price-list-child-category-select").html(content);
                    $("#price-list-child-category-select").selectpicker('refresh');
                },
                error: function(response) {
                    var errors = response.responseJSON.errors;
                    showError(errors);
               }
            });
        }
        
        function getFormat(id){
            $.ajax({
                type: 'post',
                dataType: 'json',
                
                url: '{{ route("admin.priceList.getFormat") }}',
                data: {
                    id:id
                },
                success: function(result) {
                    getCalculationFormat(result);
                    getTypeFormat(result);
                    getParentPriceFormat(result);
                    $("#value-format").val(result['formats']['value']);
                    $("#price-list-format-id").val(result['formats']['id']);
                    $("#modalCreateFormat").modal('show');
                    $("#modal-format-title").text('Công thức '+result['formats']['price_list']['title']);
                    
                },
                error: function(response) {
                    var errors = response.responseJSON.errors;
                    showError(errors);
                }
            });
        }
        function getCalculationFormat(result){
            content='<select id="calculation-format-select" class="selectpicker form-control"  data-width="100%" data-actions-box="true">';
                for(var item of result['calculations']){
                    var name;
                    switch(item) {
                        case 'add':
                            name="+";
                          // code block
                          break;
                        case 'sub':
                            name="-";

                          // code block
                          break;
                        default:
                            name="*";

                          // code block
                      } 
                    content+='<option  value="'+item+'">'+name+'</option>';
                }
            content+='</select>';
            $("#form-calculation-format-select").html(content);
            $("#calculation-format-select").selectpicker('refresh');
            $("#calculation-format-select").selectpicker('val',result['formats']['calculation']);
        }
        function getTypeFormat(result){
            content='<select id="type-format-select" class="selectpicker form-control"  data-width="100%" data-actions-box="true">';
                for(var item of result['types']){
                    var name;
                    switch(item) {
                        case 'person':
                            name="%";
                          // code block
                          break;
                        default:
                            name="giá trị";

                          // code block
                      } 
                    content+='<option  value="'+item+'">'+name+'</option>';
                }
            content+='</select>';
            $("#form-type-format-select").html(content);
            $("#type-format-select").selectpicker('refresh');
            $("#type-format-select").selectpicker('val',result['formats']['type']);
        }
        function getParentPriceFormat(result){
            content='<select id="parent-price-format-select" class="selectpicker form-control"  data-width="100%" data-actions-box="true">';
                for(var item of result['parent_prices']){
                    var name;
                    switch(item) {
                        case 'cost_price':
                            name="giá vốn";
                          // code block
                          break;
                     
                        default:
                            name="giá niêm yết";

                          // code block
                      } 
                    content+='<option  value="'+item+'">'+name+'</option>';
                }
            content+='</select>';
            $("#form-parent-price-format-select").html(content);
            $("#parent-price-format-select").selectpicker('refresh');
            $("#parent-price-format-select").selectpicker('val',result['formats']['parent_prices']);
        }
        
        function storeFormat() {

            $.ajax({
                type: 'post',
                dataType: 'json',
                url: '{{ route("admin.priceList.store") }}',
                data: {
                    category_price: $("#category-price-select").find("option:selected").val(),
                    start_date: $("#startDate").val(),
                    end_date: $("#end-date").val(),
                    title: $("#title-create").val(),
                },
                success: function(result) {
                    toastr.success('Cập nhật thành công');
                    getPriceList();
                    $("#modalCreatePriceList").modal('hide');
                },
                error: function(response) {
                    var errors = response.responseJSON.errors;
                    showError(errors);
                }
            });
        }
        function updateFormat() {
            $.ajax({
                type: 'post',
                dataType: 'json',
                url: '{{ route("admin.priceList.updateFormat") }}',
                data: {
                    id: $("#price-list-format-id").val(),
                    value: $("#value-format").val(),
                    type:  $("#type-format-select").find("option:selected").val(),
                    parent_price:  $("#parent-price-format-select").find("option:selected").val(),
                    calculation:  $("#calculation-format-select").find("option:selected").val(),
                },
                success: function(result) {
                    toastr.success('Cập nhật thành công');
                    $("#modalCreateFormat").modal('hide');
                    var id=$("#price-list-id").val();
                            getPriceListPromotion(id);
                },
                error: function(response) {
                    var errors = response.responseJSON.errors;
                    showError(errors);
                }
            });
        }
        function createPriceListCategory () {
            var category = $('#price-list-category-select').find("option:selected").val();
            var child = $('#price-list-child-category-select').find("option:selected").val();
            if(!category){
                toastr.error('Vui lòng chọn danh mục');
                return;
            }
            $.ajax({
                type: 'post',
                dataType: 'json',
                url: '{{ route("admin.priceList.updateDetail") }}',
                data: {
                    type:'category',
                    id:$("#price-list-id").val(),
                    category:category,
                    child:child,
                },
                success: function(result) {
                    if(result['type']=='error'){
                        toastr.error(result['error']);
                    }
                    else{
                        toastr.success('Cập nhật thành công');
                        $("#modalCreatePriceListCategory").modal('hide');
                        getPriceListPromotion(result);
                    }
                    
                },
                error: function(response) {
                    var errors = response.responseJSON.errors;
                    showError(errors);
                }
            });
        }
        function createProductDetail() {
            var selected = $('#product-select').find("option:selected");
            var arrProduct = [];
            selected.each(function(){
                arrProduct.push($('#product-select').val());
            });
            if(arrProduct.length==0){
                toastr.error('Vui lòng chọn sản phẩm');
            }
            $.ajax({
                type: 'post',
                dataType: 'json',
                url: '{{ route("admin.priceList.updateDetail") }}',
                data: {
                    type:'product',

                    id:$("#price-list-id").val(),
                    arr:arrProduct[arrProduct.length-1],
                },
                success: function(result) {
                    toastr.success('Cập nhật thành công');
                    $("#modalCreateProduct").modal('hide');
                    getPriceListPromotion(result);
                },
                error: function(response) {
                    var errors = response.responseJSON.errors;
                    showError(errors);
                }
            });
        }
        function deleteProduct(e){
            id=$(e).attr('data-id');
            Swal.fire({
                text: "Bạn có chắc chắn muốn xóa sản phẩm",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Xác nhận',
                cancelButtonText: 'Thoát',
                reverseButtons: true
                }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'post',
                        dataType: 'json',
                        url: '{{ route("admin.priceList.deleteProduct") }}',
                        data: {
                            id:id,
                        },
                        success: function(result) {
                            toastr.success('Cập nhật thành công');
                            var id=$("#price-list-id").val();
                            getPriceListPromotion(id);
                        },
                        error: function(response) {
                            var errors = response.responseJSON.errors;
                            showError(errors);
                        }
                    });
                }
                })
        }
        function deletePriceList(id){
            Swal.fire({
                text: "Bạn có chắc chắn muốn xóa bảng giá",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Xác nhận',
                cancelButtonText: 'Thoát',
                reverseButtons: true
                }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'post',
                        dataType: 'json',
                        url: '{{ route("admin.priceList.destroy") }}',
                        data: {
                            id:id,
                        },
                        success: function(result) {
                            toastr.success('Cập nhật thành công');
                            getPriceListDefault();
                        },
                        error: function(response) {
                            var errors = response.responseJSON.errors;
                            showError(errors);
                        }
                    });
                }
                })
        }
        function showModalUpdatePriceList(id){
            $.ajax({
                type: 'post',
                dataType: 'json',
                url: '{{ route("admin.priceList.show") }}',
                data: {
                    id:id,
                },
                success: function(result) {
                    $("#modalUpdatePriceList").modal('show');
                    $("#title-update").val(result['title']);
                    $("#start-date-update").val(moment(result['start_date']).format("HH:MM DD-MM-YYYY"));
                    $("#end-date-update").val(moment(result['end_date']).format("HH:MM DD-MM-YYYY"));
                    
                   content= '<label onclick="updateStatus(this)" class="switch" id="status-update">';
                        if (result.status == 1) {
                            content += '<input type="checkbox" checked>';
                        } else {
                            content += '<input type="checkbox">';
                        }  
                        
                        content+='<span class="slider round"></span>'+
                      '</label>';
                    $("#form-status-update").html(content);  
                },
                error: function(response) {
                    var errors = response.responseJSON.errors;
                    showError(errors);
                }
            });
        }
        function changeToInput(e){
            
            id=$(e).attr('data-id');
            type=$(e).attr('data-type');
            $("#icon_"+type+"_"+id).addClass('d-none');

            var input = $('<input />', {
                'id':'input_'+type+'_'+id,
                'data-id':id,
                'data-type':type,
                'onkeydown':'updatePrice(event)',
                'class':'form-control',
                'value': $(e).html()
            });
            $(e).parent().append(input);
            $(e).remove();
            input.focus();
        }
        
        function updatePrice(e){
            if(e.keyCode==13){
                var value=converValueNumber(e.target);
                var id=$(e.target).attr('data-id');
                var type=$(e.target).attr('data-type');
                $.ajax({
                    type: 'post',
                    dataType: 'json',
                    url: '{{ route("admin.priceList.updatePrice") }}',
                    data: {
                        id:id,
                        value:value,
                        type:type,
                    },
                    success: function(result) {
                        toastr.success('Cập nhật thành công');
                        var span="<span ondblclick='changeToInput(this)' data-id='"+id+"' data-type='"+type+"'>"+formatNumber(value)+"</span> ";
                        $(e.target).parent().append(span);
                        $(e.target).remove();
                        $("#icon_"+type+"_"+id).removeClass('d-none');

                    },
                    error: function(response) {
                        var errors = response.responseJSON.errors;
                        showError(errors);
                    }
                });
                
                
            }
            else{
                $(e.target).number(true);
            }
        }
        function updatePriceList(){
            var id=$("#price-list-id").val();
            if($("#status-update input").is(':checked')){
                status=1;
            }
            else{
                status=0;
            }
            $.ajax({
                type: 'put',
                dataType: 'json',
                url:"{{ route('admin.priceList.update',"+id+") }}",
                data: {
                    id:id,
                    start_date: $("#start-date-update").val(),
                    end_date: $("#end-date-update").val(),
                    title: $("#title-update").val(),
                    status: status,
                },
                success: function(result) {
                    toastr.success('Cập nhật thành công');
                    $("#modalUpdatePriceList").modal('hide');
                },
                error: function(response) {
                    var errors = response.responseJSON.errors;
                    showError(errors);
                }
            });
        }
    </script>
@endpush