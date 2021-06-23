

@section('title', 'MVC Shop || Chi nhánh')
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
                        <h4 class="m-0 font-weight-bold text-primary float-left">Chi nhánh</h4>
                         <div class="text-center">
                            <button onclick="showModalCreateBranch()" class=" mr-2 btn btn-success btn-sm float-right " data-toggle="tooltip" data-placement="bottom" title="Thêm cơ sở"><i class="fas fa-plus"></i> Thêm chi nhánh</button>
                         </div>
                         
                   </div>
               </div>
               <div class="card-body">
                  <div class="table-responsive">
                     <input class="auto-numeric" type="hidden">
                     <table style="color: #333" class="table table-bordered display" id="table"  width="100%" cellspacing="0">
                        <thead>
                           <tr>
                            <th  class="text-center align-middle">STT</th>
                             <th class="text-center align-middle">Mã</th>
                             <th class="text-center align-middle">Tên</th>
                             <th class="text-center align-middle">Số điện thoại</th>
                             <th class="text-center align-middle">Email</th>
                             <th class="text-center align-middle">Địa chỉ</th>
                             <th class="text-center align-middle">Cơ sở chính</th>
                             <th class="text-center align-middle">Trạng thái</th>
                             <th class="text-center align-middle"></th>
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
<div class="modal fade " id="modalCreateBranch" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
          <div class="modal-header">
             <h5 class="modal-title" id="exampleModalLabel">Thêm chi nhánh</h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
             </button>
          </div>
          <div class="modal-body">
             <div class="form-group">
                <label for="regular1" class="control-label">Tên cơ sở<span class="color-red" > *</span></label>
                <input type="text" id="name-create" required autofocus placeholder="Chi nhánh + tên địa chỉ" value="" name="name"   class="form-control" />
             </div>
             <div class="form-group">
                <div class="alert alert-danger d-none " id="error-create-branch-name">
                </div>
             </div>
             <div class="form-group">
                <label for="regular1" class="control-label">Email<span class="color-red" > *</span></label>
                <input type="email" id="email-create" required autofocus placeholder="Email" value="" name="name"   class="form-control" />
             </div>
             <div class="form-group">
                <div class="alert alert-danger d-none " id="error-create-branch-email">
                </div>
             </div>
             
             <div class="form-group">
                <label for="regular1" class="control-label">Số điện thoại <span class="color-red">  *</span></label>
                <input type="text"  id="phone-create"required placeholder="Số điện thoại" value="" name="phone" id="title"  class="form-control" />
             </div>
             <div class="form-group">
                <div class="alert alert-danger d-none" id="error-create-branch-phone">
                </div>
             </div>
             <div class="form-group">
                <label for="inputAddress">Tỉnh - Thành phố</label>
                <select name="" required data-live-search="true" data-size="5" title="Vui lòng chọn tỉnh-thành phố" class="selectpicker province form-control" id="province-create" data-type="create" >
                </select>
             </div>
             <div class="form-group">
                <div class="alert alert-danger d-none" id="error-create-branch-province">
                </div>
             </div>
             <div class="form-group dis-none form-district-create" >
                <label for="inputAddress">Quận - Huyện</label>
                <select name="" required data-live-search="true" data-size="5" title="Vui lòng chọn quận-huyện" class="selectpicker district form-control" id="district-create" data-type="create" >
                </select>
             </div>
             <div class="form-group">
                <div class="alert alert-danger d-none " id="error-create-branch-district">
                </div>
             </div>
             <div class="form-group dis-none form-ward-create">
                <label for="inputAddress">Xã, phường</label>
                <select name="" required data-live-search="true" data-size="5" title="Vui lòng chọn xã-phường" class="selectpicker ward ward-create form-control" id="ward-create" data-type="create">
                </select>
             </div>
             <div class="form-group">
                <div class="alert alert-danger d-none " id="error-create-branch-ward">
                </div>
             </div>
             <div class="form-group">
                <label for="inputAddress">Địa chỉ</label>
                <input type="text"  name="address" required  class="form-control" id="address-create" placeholder="Số nhà, khu, thôn">
             </div>
             <div class="form-group">
                <div class="alert alert-danger d-none " id="error-create-branch-address">
                </div>
             </div>
             <div class="form-group Checkbox justify-content-left">
                <input id="isMain"  type="checkbox" class="cursor-pointer Checkbox-input">
                <label for="isMain" class="Checkbox-label cursor-pointer m-b-0">Đây là cơ sở chính </label>
             </div>
          </div>
          <div class="modal-footer">
             <button type="button" class="btn btn-danger mr-auto" data-dismiss="modal">Thoát</button>
             <button type="button" class="btn btn-primary" onclick="store(this)">Lưu</button>
          </div>
       </div>
    </div>
 </div>
@endsection
@push('styles')
{{-- <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" /> --}}
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" /> --}}
    <style>

    </style>
    <link href="{{asset('css/checkbox.css')}}" rel="stylesheet">
    <link href="{{asset('vendor/css/util.css')}}" rel="stylesheet">

@endpush
@push('scripts')
    <script src="{{ asset('js/address.js') }}"></script>
    
    <script>
        getData();

        function showModalCreateBranch(){
            $("#modalCreateBranch").modal('show');
        }
        function store(e){
        
            var name=$("#name-create").val();
            var phone=$("#phone-create").val();
            var email=$("#email-create").val();
            var address=$("#address-create").val();
            var pre_province=prefixProvince($("#province-create option:selected").text());
            var province=[$("#province-create option:selected").val(),pre_province];
            var district=[$("#district-create option:selected").val(),$("#district-create option:selected").text()];
            var ward=[$("#ward-create option:selected").val(),$("#ward-create option:selected").text()];
            var region=getRegion(pre_province);
            var urban=getUrban(region,district[1]);
            var checkbox=$("#isMain").prop('checked');
            if(checkbox==true){
                isMain=1;
            }
            else{
                isMain=0;
            }
            if(province[1]!=''){
                province=province.toString();
            }
            else{
                province='';
            }
            if(district[0]!=''){
                district=district.toString();
            }
            else{
                district='';
            }
            if(ward[0]!=''){
                ward=ward.toString();
            }
            else{
                ward='';
            }
            var arr=['name','phone','province','district','ward','address','email'];
                        for(var i of arr){
                        $("#" + "error-create-branch-"+i).addClass('d-none');
                        $("#" + i+'-create').removeClass('border-error');
                        }
            $.ajax({
                type: 'post',
                dataType: 'json',
                url: '{{route("admin.branch.store")}}',
                data: {
                    name:name,
                    email:email,
                    phone:phone,
                    province:province,
                    district:district,
                    ward:ward,
                    address:address,
                    urban:urban,
                    region:region,  
                    isMain:isMain
                },
                 success: function(result) {
                    
                    $("#modalCreateBranch .close").click();
                    var notify = new PNotify({
                    title: "Cập nhật thành công",
                     type:'success'
                 });
                    getData();
                },
                error: function(response) {
                    var errors = response.responseJSON.errors;
                    
                    $.each(errors,function(field_name,error){
                        $("#error-create-branch-"+field_name).html('<span class="text-strong textdanger">' +error+ '</span>');
                        $("#error-create-branch-"+field_name).removeClass('d-none');
                                                $("#" + i+'-create').addClass('border-error');

                    })
                }, 
            }); 
        }
        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
          });
        function getData() {
            var numberFormat = $.fn.dataTable.render.number( '\,', '.', 0 ).display;
            var table = $('#table').DataTable({
                responsive: true,
                dom: "<'d-flex justify-content-between'<l><'text-center'B><f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
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
                "order": [
                    [1, "desc"]
                ],
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
                initComplete: function () {
                    var btns = $('.dt-button');
                    btns.addClass('btn btn-primary btn-sm');
                    btns.removeClass('dt-button');
        
                },
                select: true,
                ajax: {
                    url: '{{  route("admin.branch.index")}}',
                    data:{
                        datatable:1
                    }
                },
        
                columns: [
                    {
                        data: null, 
                        defaultContent: '',
                    },
                    {
                        data:'code',
                        name:'data.code'
                    },
                    {
                        data:'name',
                        name:'data.name'
                    },
                    
                    {
                        data:'email',
                        name:'data.email',                    

                    },
                    {
                        data:'phone',
                        name:'data.phone',                    

                    },
                    {
                        data:'address',
                        name:'data.address',  
                        render: function(data,type,row) {
                            var address=convertAddress(row.province,row.district,row.ward,row.address);
                            return address;
                        }                  

                    },
                    {
                        data:'isMain',
                        name:'data.isMain',
                        render: function(data,type,row) {
                            if (data == '1') {
                                return '<span class="badge badge-success">Cơ sở chính</span>';
                            }
                            else{
                                return '<span class="badge badge-success"></span>';
                            }
                        }
                    },
                    {
                        data:'status',
                        name:'data.status',
                        render: function(data,type,row) {
                            if (data == '0') {
                                return '<span class="badge badge-danger">Ngưng hoạt động</span>';
                            } else {
                                return '<span class="badge badge-success">Hoạt động</span>';

                            }
                        }
                    },
                   
                    {
                        render: function(data,type,row) {
                                    return '<div class="btn-group" role="group" aria-label="First group">'+
                                            '<button class="btn btn-sm btn-warning marg-1-right" onclick="showModalEdit('+row.id+')"><i class="fas fa-pen"></i></button>'+
                                            '<button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>'+
                                            '</div>';
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
        function outOfStock(id) {
            $.ajax({
                type: 'post',
                dataType: 'json',
                url: 'receipt-stock/out-of-stock',
                data: {
                    id: id,
                },
                success: function(result) {
                    alertify.set('notifier', 'delay', 10);
                    alertify.set('notifier', 'position', 'bottom-right');
                    alertify.success('Cập nhật thành công');
                    setTimeout(function() { // wait for 5 secs(2)
                        getData(start, end, 'PX');
                    }, 1000);
                },
                error: function(json) {
                    if (json.status === 404) {
                        var errors = json.responseJSON;
                    }
                }
            });
        }
        function showModalEdit(id){
            $.ajax({
                type: 'get',
                dataType: 'json',
                url: '{{ URL::to("admin/chi-nhanh/'+id+'/edit") }}',
                success: function(response) {
                    console.log(response)
                },
                error: function(json) {
                    if (json.status === 404) {
                        var errors = json.responseJSON;
                    }
                }
            });
        }
        </script>
@endpush

