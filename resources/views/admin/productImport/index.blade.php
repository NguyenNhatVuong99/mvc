

@section('title', 'Tài khoản')
@extends('layouts.admin
.master')
@section('main-content')
<div class="card shadow mb-4 ">
    <div class="card-body">
        
  <div class="gallery">
    <ul id="lightgallery">
      

    </ul>
  </div>
        <div class="wrapper">
            <!-- Sidebar  -->
           
            <!-- Page Content  -->
            {{-- <div id="content"> --}}
                
                <div class="card w-100">
                    <div class="card-header ">
                        
                                <h5  id="table-name" class="m-0 font-weight-bold float-left">
                                     Phiếu nhập hàng</h5>
    
                       
                    </div>
                    <div class="card-body">
                        <table style="color: #333" cellspacing="0" class="table table-bordered" id="table"  width="100%" cellspacing="0">
                            <thead>
                               <tr>
                                <th class="text-center align-middle w-5"></th>
                                <th class="text-center align-middle w-5">STT</th>
                                 <th class="text-center align-middle">Mã chứng từ</th>
                                 <th class="text-center align-middle">Nhà cung cấp</th>
                                 <th class="text-center align-middle">Ngày nhập</th>
                                 <th class="text-center align-middle">Tổng cộng</th>
                                 <th class="text-center align-middle">Tổng thanh toán</th>
                                 <th class="text-center align-middle">Trạng thái</th>
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
<div class="modal fade" id="modalCreateCashflow" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Thêm phiếu chi</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label for="exampleInputEmail1">Hạng mục thu/chi</label>
                <input type="email" data-id="" class="form-control" id="child-cat-receipt" aria-describedby="emailHelp" disabled>
                <input type="hidden" data-id="" class="form-control" id="cat-receipt" aria-describedby="emailHelp" disabled>
                <input type="hidden"  class="form-control" data-date="" id="document-receipt" aria-describedby="emailHelp" disabled>
              </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Người nhận</label>
                <input type="email" data-code="" data-id="" class="form-control" id="partner-receipt" aria-describedby="emailHelp" disabled>
              </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Ngày giao dịch</label>
                <input type="text" required placeholder="" value="{{ old('date') }}" name="date" id="date" class="datetime form-control" />
              </div>
              <div class="row form-group">
                <div class="col">
                    <label for="exampleInputEmail1">Giá trị</label>
                <input type="email" class="form-control" onkeyup="keyUpNumber(this)" id="payment-receipt" aria-describedby="emailHelp" >
                <input type="hidden" class="form-control" onkeyup="keyUpNumber(this)" id="debt-receipt" aria-describedby="emailHelp" >
                </div>
                <div class="col">
                    <div id="form-account-select">
                        <label for="exampleInputEmail1">Tài khoản</label>

                    </div>

                </div>
              </div>
            
            <div class="form-group">
                <label for="exampleInputEmail1">Ghi chú</label>
                <input type="email" class="form-control" id="note-receipt" aria-describedby="emailHelp" disabled>
              </div>
              
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Thoát</button>
          <button type="button" class="btn btn-primary" onclick="storeCashflow()">Lưu</button>
        </div>
      </div>
    </div>
  </div>
@endsection
@push('styles')
    <style>
          .morecontent span {
            display: none;
        }
        .morelink {
            display: block;
        }
    </style>

@endpush


@push('scripts')
{{-- <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script> --}}

    <script src="{{asset('js/modal-image.js')}}"></script>
    <script src="{{asset('js/toggle-menu.js')}}"></script>
    {{--  <script src="{{asset('js/tab.js')}}"></script>  --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/1.6.14/js/lightgallery-all.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-mousewheel/3.1.13/jquery.mousewheel.min.js"></script>
      <script src="https://cdn.jsdelivr.net/picturefill/2.3.1/picturefill.min.js"></script>
    <script>
        
        getDataMain();
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
                    url: '{{  route("admin.productImport.index")}}',
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
                        
                        data: 'supplier_name',
                        name: 'data.supplier_name'
                    },
                    {

                        data: 'date_import',
                        name: 'data.date_import',
                        render: function(data, type, row) {
                            return moment(data).format("MM-DD-YYYY");
                        }


                    },
                    {

                        data: 'total',
                        name: 'data.total',
                        render: $.fn.dataTable.render.number( ',', '.',0) 

                    },
                    {

                        data: 'payment',
                        name: 'data.payment',
                        render: $.fn.dataTable.render.number( ',', '.',0) 


                    },
                    {

                        data: 'status',
                        name: 'data.status',
                        render: function(data, type, row) {
                            return '<button class="btn btn-sm btn-primary">'+data+'</button>';
                        }
                    },
                    
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
      
        function detailRow ( data ) {
            content='<div class="tab-container">'+
                '<input type="radio" name="tab" data-id="1" id="tab1" checked="checked">'+
                '<label class="tab-label" for="tab1">Chi tiết</label>'+
                '<input type="radio" data-id="2" name="tab" id="tab2">'+
                '<label class="tab-label" for="tab2">Phiếu chi</label>'+
                '<div class="tab-content-wrapper">'+
                  '<div id="tab-content-1" class="tab-content">'+
                    '<table class="table"  style="padding-left:50px;">'+
                        '<tr>'+
                            '<td class="font-weight-bold w-12">Mã chứng từ:</td>'+
                            '<td class="w-21">'+data.code+'</td>'+
                            '<td class="font-weight-bold w-12">Người tạo:</td>'+
                            '<td class="w-21">'+data.user_name+'</td>'+
                            '<td class="font-weight-bold w-12">Chi nhánh:</td>'+
                            '<td class="w-21">'+data.branch_name+'</td>'+
                        '</tr>'+
                        '<tr>'+
                            '<td class="font-weight-bold w-12">Nhà cung cấp:</td>'+
                            '<td class="w-21">'+data.supplier_name+'</td>'+
                            '<td class="font-weight-bold w-12">Ngày nhập:</td>'+
                            '<td class="w-21">'+moment(data.date_import).format('DD/MM/YYYY')+'</td>'+
                            '<td class="font-weight-bold w-12">Ngày giao hàng:</td>'+
                            '<td class="w-21">'+moment(data.date_delivery).format('DD/MM/YYYY')+'</td>'+
                        '</tr>'+
                        '<tr>'+
                            '<td class="font-weight-bold w-12">Trạng thái phiếu:</td>'+
                            '<td id="detail-cost-price" class="w-21">'+
                                '<button class="btn btn-primary">'+data.status+'</button>'+
                            '</td>'+
                            '<td class="font-weight-bold w-12">Trạng thái thanh toán:</td>'+
                            '<td id="detail-cost-price" class="w-21">'+
                                '<button class="btn btn-primary">'+data.isPayment+'</button>'+
                            '</td>'+
                            
                            '<td class="font-weight-bold w-12">Ghi chú:</td>'+
                            '<td id="detail-off-price" class="w-21">';
                                if(data.note==null){
                                    content+='';
                                }
                                else{
                                    content+=data.note;
                                }
                            content+='</td>'+
                        '</tr>'+
                    '</table>'+
                    '<hr>'+
                    '<table class="table" style="padding-left:50px; padding-top:50px">'+
                        '<thead>'+
                            '<tr>'+
                                '<th class="font-weight-bold">STT</th>'+
                                '<th class="font-weight-bold">Mã sản phẩm</th>'+
                                '<th class="font-weight-bold">Tên sản phẩm</th>'+
                                '<th class="font-weight-bold">Số lượng</th>'+
                                '<th class="font-weight-bold">Giá nhập</th>'+
                                '<th class="font-weight-bold">Thành tiền</th>'+
                            '</tr>'+
                        '</thead>'+
                        '<tbody id="detail-'+data.id+'">'+
                        '</tbody>'+
                    '</table>'+
                  '</div>'+
                  '<div id="tab-content-2" class="tab-content">'+
                    '<div class="card">';
                        if(data.isPayment=='Nợ'){
                            content+='<div class="card-header">'+
                                '<button onclick="showModalCreateCashflow('+data.id+')" class="btn btn-sm btn-primary float-right"> <i class="fas fa-plus"></i> Thêm phiếu chi</button>'+
                            '</div>';
                        }
                        content+='<div class="card-body">'+
                            '<table class="table" style="padding-left:50px; padding-top:50px">'+
                                '<thead>'+
                                    '<tr>'+
                                        '<th class="font-weight-bold">STT</th>'+
                                        '<th class="font-weight-bold">Mã chứng từ</th>'+
                                        '<th class="font-weight-bold">Ghi chú</th>'+
                                        '<th class="font-weight-bold">Ngày giao dịch</th>'+
                                        '<th class="font-weight-bold">Giá trị</th>'+
                                    '</tr>'+
                                '</thead>'+
                                '<tbody id="receipt-'+data.id+'">'+
                                '</tbody>'+
                            '</table>'+

                        '</div>'+
                    '</div>'+
                    
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
                '<li><a href="{{ route('admin.productImport.create') }}"><i class="fas fa-plus"></i>&emsp;Thêm phiếu nhập</a></li>' +
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
            var data=row.data();
            $('#table tbody tr').removeClass('shown');
            if ( row.child.isShown() ) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
            }
            else {
                // Open this row
                row.child( detailRow(data) ).show();
                tr.addClass('shown');
                detail(data);  
                receipt(data);  
            }
        } );
        function detail(data){
            var id=data['id'];
            $.ajax({
                type: 'post',
                dataType: 'json',
                url:"{{route('admin.productImport.show')}}",
                data:{
                    id:id
                },
                success: function(result) {
                    var stt=1;
                    var content;
                    for(var item of result){
                        product=item.product;
                        content+='<tr>'+
                                    '<td>'+stt+'</td>'+
                                    '<td>'+product.code+'</td>'+
                                    '<td>'+product.title+'</td>'+
                                    '<td>'+item.quantity+'</td>'+
                                    '<td>'+formatNumber(item.cost_price)+'</td>'+
                                    '<td>'+formatNumber(item.amount)+'</td>'+
                                '</tr>';
                                
                                stt++;
                    }
                        content+='<tr>'+
                                    '<td colspan=5 class="font-weight-bold text-center">Tổng cộng</td>'+
                                    '<td class="font-weight-bold">'+formatNumber(data.total)+'</td>'+
                                '</tr>'+
                                '<tr>'+
                                    '<td colspan=5 class="font-weight-bold text-center">Thanh toán</td>'+
                                    '<td class="font-weight-bold">'+formatNumber(data.payment)+'</td>'+
                                '</tr>';
                                if(data.debt>0){
                                    content+='<tr>'+
                                        '<td colspan=5 class="font-weight-bold text-center">Nợ</td>'+
                                        '<td class="font-weight-bold">'+formatNumber(data.debt)+'</td>'+
                                    '</tr>'
                                }
                                
                                content+='<tr>'+
                                    '<td colspan=6>'+
                                        
                                        '<button class="btn btn-primary float-right "> <i class="fas fa-pen"></i> Cập nhật</button>'+
                                        '<button onclick="print()" class="btn btn-primary float-right m-r-10 "> <i class="fas fa-print"></i> In</button>';
                                        if(data.status=='Đang xử lý'){
                                            content+='<button onclick="complete('+id+')" class="btn btn-primary float-right m-r-10 "> <i class="fas fa-check"></i> Hoàn thành</button>';
                                        }
                                    content+='</td>'+
                                '</tr>';
                    $("#detail-"+data['id']).html(content); 
                },
                error: function(response) {
                    var errors = response.responseJSON.errors;
                    showError(errors);                
                },
            });
            
        }
        function receipt(data){
            $.ajax({
                type: 'post',
                dataType: 'json',
                url:"{{route('admin.productImport.receipt')}}",
                data:{
                    code:data['code']
                },
                success: function(result) {
                    var stt=1;
                    var content;
                    for(var item of result){
                        content+='<tr>'+
                                    '<td>'+stt+'</td>'+
                                    '<td>'+item.code+'</td>'+
                                    '<td>'+item.note+'</td>'+
                                    '<td>'+moment(data.date).format('DD/MM/YYYY')+'</td>'+
                                    '<td>'+formatNumber(item.total)+'</td>'+
                                '</tr>';
                                
                                stt++;
                    }
                        
                    $("#receipt-"+data['id']).html(content); 
                },
                error: function(response) {
                    var errors = response.responseJSON.errors;
                    showError(errors);                
                },
            });
            
        }
        function showModalCreateCashflow(id) {
            $.ajax({
                type: 'post',
                dataType: 'json',
                url:"{{route('admin.productImport.createCashflow')}}",
                data:{
                    id:id
                },
                success: function(result) {
                     $("#document-receipt").val(result['receipt']['code']); 
                     $("#document-receipt").attr('data-date',result['receipt']['date_import']); 
                     $("#document-receipt").attr('data-branch',result['receipt']['branch_id']); 
                     $("#cat-receipt").val(result['cat']['id']); 
                     $("#child-cat-receipt").val(result['child_cat']['name']); 
                     $("#child-cat-receipt").attr('data-id',result['child_cat']['id']); 
                     $("#partner-receipt").val(result['partner']['supplier_name']); 
                     $("#partner-receipt").attr('data-code',result['partner']['supplier_code']); 
                     $("#partner-receipt").attr('data-id',result['receipt']['partner_id']); 
                     $("#payment-receipt").val(formatNumber(result['receipt']['debt'])); 
                     $("#debt-receipt").val(formatNumber(result['receipt']['debt'])); 
                    var note="Thanh toán cho chứng từ "+result['receipt']['code'];
                    $("#note-receipt").val(note); 
                    content='<select id="account-select" class="selectpicker form-control" title="Chọn chi nhánh" data-live-search="true" data-width="100%" placeholder="Chọn nhà cung cấp" data-size="5" data-actions-box="true">';
                        for(var item of result['accounts']){
                            content+='<option  value="'+item['id']+'">'+item['name']+'</option>';
                        }
                    content+='</select>';
                    $("#form-account-select").append(content);
                    $("#account-select").selectpicker('refresh');
                    $("#account-select").selectpicker('val','1');
                    $("#modalCreateCashflow").modal('show');

                        
                },
                error: function(response) {
                    var errors = response.responseJSON.errors;
                    showError(errors);                
                },
            });
        }

        function storeCashflow() {
            $.ajax({
                type: 'post',
                dataType: 'json',
                url: '{{route("admin.cashflow.store")}}',
                data: {
                    cat_receipt : $('#cat-receipt').val(),
                    document_code : $('#document-receipt').val(),
                    document_date : $('#document-receipt').attr('data-date'),
                    branch_id : $('#document-receipt').attr('data-branch'),
                    child_cat_receipt : $('#child-cat-receipt').attr('data-id'),
                    partner_code : $('#partner-receipt').attr('data-code'),
                    partner_id : $('#partner-receipt').attr('data-id'),
                    date : $('#date').val(),
                    payment :converValueNumber('#payment-receipt'), 
                    debt :converValueNumber('#debt-receipt'), 
                    account_id :  $("#account-select").find("option:selected").val(),
                },
                success: function(result) {
                    $("#modalCreateCashflow").modal('hide');
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
        function complete(id){
            Swal.fire({
                text: "Hệ thống sẽ cập nhật tồn kho ngay khi hoàn thành chứng từ. Bạn có chắc chắn muốn hoàn thành chứng từ này?",
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
                        type: "POST",
                        url: '{{route("admin.productImport.complete")}}',
                        data: {
                            id: id
                        },
                        success: function(result) {
                            toastr.success('Cập nhật thành công');
                            getData();
                        },
                        error: function(response) {
                            var errors = response.responseJSON.errors;
                            toastr.error(response);
                        },
                    });
                }
              })

        }
        function print(){

        }
        
    </script>
@endpush
