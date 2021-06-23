@section('title', 'Thêm phiếu xuất kho')
@extends('backend.layouts.master') @section('main-content')
<div class="card">
   <div class="card-header py-3 d-flex justify-content-between">
      <h4 class="m-0 font-weight-bold text-primary float-left">Phiếu xuất</h4>
      <div class="text-center">
         <a onclick="store()" href="#"  id="btn-save" class="disabled  mr-2 btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="Lưu"><i class="fas fa-save"></i> Lưu</a>
         <a onclick="store()" href="#" id="btn-savePrint"class="disabled  mr-2 btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="Lưu và in"><i class="fas fa-print"></i> Lưu và in</a>
         <a  href="{{route('admin.PX')}}"  id="btn-save" class=" mr-2 btn btn-success btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="Quay lại "><i class="fas fa-undo"></i> Quay lại</a>
      </div>
   </div>
   <div class="card-body row">
      <div class="col-md-8 col-12">
         <div class="card m-b-10">
            <div class="card-body">
               <div class="form-group">
                  <select id="product-select" class="show-tick  form-control" title="Chọn sản phấm" data-size="5" data-actions-box="true" multiple data-live-search="true">
                     @foreach ($products as $product)
                        
                     <option data-type="PX"  value="{{ $product->id }}"> {{ $product->name }} - Số lượng: {{ $product->quantity }}  - Mã SP: {{ $product->code }}  </option>
                     @endforeach
                  </select>
               </div>
            </div>
         </div>
         <div class="card">
            <div class="card-body">
               <div class="table-responsive">
                  <table style="color: #333;" class="table table-bordered"  width="100%" cellspacing="0">
                     <thead>
                        <tr>
                           <th class="text-align-center vertical-align-middle">STT</th>
                           <th class="text-align-center vertical-align-middle">Tên</th>
                           <th class="w-15 text-align-center vertical-align-middle">Số lượng</th>
                           <th class="text-align-center vertical-align-middle">Giá gốc</th>
                           <th class="text-align-center vertical-align-middle">Giá xuất </th>
                           <th class="text-align-center vertical-align-middle">Thành tiền</th>
                           <th></th>
                        </tr>
                     </thead>
                     <tbody id="table-product"></tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
      <div class="col-md-4 col-12">
         <div class="card">
            <div class="card-header">
               Thông tin phiếu xuất
            </div>
            <div class="card-body">
               <div class="form-group">
                  <label for="inputTitle" class="col-form-label">Loại phiếu xuất<span class="text-danger">*</span></label>
                  <div class="d-flex justify-content-between">
                     <div class="flex-item flex-basis-80">
                        <select id="category-select" class="selectpicker form-control" title="Chọn phiếu xuất" data-live-search="true" placeholder="Chọn phiếu xuất" data-size="5" data-actions-box="true">
                           @foreach ($category_receipts as $item)
                           <option  value="{{ $item->id }}">{{ $item->name }}</option>
                           @endforeach
                        </select>
                     </div>
                     <div class="flex-item ">
                        <button type="button" class="btn btn-light" data-toggle="modal" data-target="#modalCreateCategory">
                        <i class="fas fa-plus"></i>
                        </button>
                     </div>
                  </div>
               </div>
               <div class="form-group">
                  <label for="inputTitle" class="col-form-label">Đối tác<span class="text-danger">*</span></label>
                  <select id="partner-select" class="selectpicker form-control" title="Chọn đối tác" data-live-search="true" placeholder="Chọn nhà cung cấp" data-size="5" data-actions-box="true">
                     @foreach ($partners as $item)
                     <option  value="{{ $item->slug }}">{{ $item->name }}</option>
                     @endforeach
                  </select>
               </div>
               <div class="form-group" id="form-code-partner">
               </div>
               <div class="collapse form-group" id="form-info-partner" >
                  
               </div>
               <div class="collapse form-group" id="formInfoSupplier">
                  <div class="card ">
                     <div class="card-header">
                        Thông tin nhà cung cấp
                     </div>
                     <div class="card-body" style="padding: 0.25rem">
                        <ul class="list-group list-group-flush">
                           <li class="list-group-item" id="nameSupplier"></li>
                           <li class="list-group-item" id="phoneSupplier"></li>
                           <li class="list-group-item" id="addressSupplier"></li>
                        </ul>
                     </div>
                  </div>
               </div>
               <div class="form-group pmd-textfield pmd-textfield-floating-label">
                  <label for="regular1" class="control-label">Ngày tạo phiếu</label>
                  <input type="text" required placeholder="" value="{{ old('date') }}" name="date" id="datetime" class="form-control" />
               </div>
            </div>
         </div>
         <div class="card">
            <div class="card-header">
               Thông tin thanh toán
            </div>
            <div class="card-body">
               <ul class="list-group list-group-flush">
                  <li class="list-group-item">
                     <div class="row">
                        <div class="col-6">
                           Tổng cộng:
                        </div>
                        <div class="col-6" id="total_price"></div>
                        <div class="col-6" id="total_weight"></div>
                        <input type="hidden" name="" id="total_quantity">
                     </div>
                  </li>
                  <li class="list-group-item">
                     <div class="row">
                        <div class="col-6">
                           Thanh toán:
                        </div>
                        <div class="col-6">
                           <input type="text" disabled class="form-control" onkeyup="updatePayment()" value="0" id="payment" />
                        </div>
                     </div>
                  </li>
                  <li class="list-group-item">
                     <div class="row">
                        <div class="col-6">
                           Nợ:
                        </div>
                        <div class="col-6" id="debt">0</div>
                     </div>
                  </li>
                  <li class="list-group-item">
                     <div class="row">
                        <h5 class="d-none" id="nameMoney"></h5>
                     </div>
                  </li>
                  <li class="list-group-item">
                     <div class="row">
                        <label for="inputTitle" class="col-form-label">Chi chú<span class="text-danger">*</span></label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" style="height: 80px;"></textarea>
                     </div>
                  </li>
               </ul>
               <div class="form-group">
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="modal fade" id="modalCreateCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Thêm loại phiếu xuất</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <div class="form-group">
               <label for="regular1" class="control-label">Tên loại phiếu</label>
               <input type="text" required autofocus placeholder="Tên loại phiếu" value="" name="title" id="title"  class="input-create-category form-control" />
               <input type="hidden" id="slug">
            </div>
            <div class="form-group">
               <div class="alert alert-danger d-none " id="error-name">
               </div>
            </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-danger mr-auto" data-dismiss="modal">Đóng</button>
            <button type="button" class="btn btn-primary" onclick="storeCategory()">Lưu</button>
         </div>
      </div>
   </div>
</div>
<div class="modal fade" id="modalCreateUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Thêm khách hàng</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <div class="form-group">
               <label for="regular1" class="control-label">Họ và tên <span class="color-red" >*</span></label>
               <input type="text" id="name-create" required autofocus placeholder="Họ và tên" value="" name="name"   class="input-create-user form-control" />
            </div>
            <div class="form-group">
               <div class="alert alert-danger d-none " id="error-create-user-name">
               </div>
            </div>
            <div class="form-group">
               <label for="regular1" class="control-label">Email</label>
               <input type="email" id="email-create" required  placeholder="Email" value="" name="email" id="title"  class="input-create-user form-control" />
            </div>
            <div class="form-group">
               <div class="alert alert-danger d-none " id="error-create-user-email">
               </div>
            </div>
            <div class="form-group">
               <label for="regular1" class="control-label">Số điện thoại <span class="color-red">*</span></label>
               <input type="text"  id="phone-create"required placeholder="Số điện thoại" value="" name="phone" id="title"  class="input-create-user form-control" />
            </div>
            <div class="form-group">
               <div class="alert alert-danger d-none" id="error-create-user-phone">
               </div>
            </div>
            <div class="form-group">
               <label for="inputAddress">Tỉnh - Thành phố</label>
               <select name="" required data-live-search="true" data-size="5" title="Vui lòng chọn tỉnh-thành phố" class="selectpicker province input-create-user form-control" id="province-create" data-type="create" >
               </select>
            </div>
            <div class="form-group">
               <div class="alert alert-danger d-none" id="error-create-user-province">
               </div>
            </div>
            <div class="form-group dis-none form-district-create" >
               <label for="inputAddress">Quận - Huyện</label>
               <select name="" required data-live-search="true" data-size="5" title="Vui lòng chọn quận-huyện" class="selectpicker district input-create-user form-control" id="district-create" data-type="create" >
               </select>
            </div>
            <div class="form-group">
               <div class="alert alert-danger d-none " id="error-create-user-district">
               </div>
            </div>
            <div class="form-group dis-none form-ward-create">
               <label for="inputAddress">Xã, phường</label>
               <select name="" required data-live-search="true" data-size="5" title="Vui lòng chọn xã-phường" class="selectpicker ward ward-create input-create-user form-control" id="ward-create" data-type="create">
               </select>
            </div>
            <div class="form-group">
               <div class="alert alert-danger d-none " id="error-create-user-ward">
               </div>
            </div>
            <div class="form-group">
               <label for="inputAddress">Địa chỉ</label>
               <input type="text"  name="address" required  class="input-create-user form-control" id="address-create" placeholder="Số nhà, khu, thôn">
            </div>
            <div class="form-group">
               <div class="alert alert-danger d-none " id="error-create-user-address">
               </div>
            </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-danger mr-auto" data-dismiss="modal">Thoát</button>
            <button type="button" class="btn btn-primary" onclick="storeUser(this)">Lưu</button>
         </div>
      </div>
   </div>
</div>
<div class="modal fade" id="modalCreateSupplier" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Thêm nhà cung cấp</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <div class="form-group">
               <label for="regular1" class="control-label">Tên nhà cung cấp<span class="color-red" > *</span></label>
               <input type="text" id="create-supplier-name" required autofocus placeholder="Họ và tên" value="" name="name"   class="input-create-supplier form-control" />
            </div>
            <div class="form-group">
               <div class="alert alert-danger d-none " id="error-create-supplier-name">
               </div>
            </div>
            <div class="form-group">
               <label for="regular1" class="control-label">Số điện thoại <span class="color-red"> *</span></label>
               <input type="text"  id="create-supplier-phone"required placeholder="Số điện thoại" value="" name="phone" id="title"  class="input-create-supplier form-control" />
            </div>
            <div class="form-group">
               <div class="alert alert-danger d-none" id="error-create-supplier-phone">
               </div>
            </div>
            <div class="form-group">
               <label for="inputAddress">Địa chỉ<span class="color-red"> *</span></label>
               <input type="text"  name="address" required  class="input-create-supplier form-control" id="create-supplier-address" placeholder="Địa chỉ">
            </div>
            <div class="form-group">
               <div class="alert alert-danger d-none " id="error-create-supplier-address">
               </div>
            </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-danger mr-auto" data-dismiss="modal"><i class="fas fa-times"></i> Đóng</button>
            <button type="button" onclick="storeSupplier()" class="btn btn-primary "><i class="fas fa-save"></i> Lưu</button>
         </div>
      </div>
   </div>
</div>
<div class="modal fade" id="modalCreateAddress" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Thêm địa chỉ</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <div class="form-group">
               <label for="regular1" class="control-label">Họ và tên <span class="color-red" >*</span></label>
               <input type="text" id="name-create" required autofocus placeholder="Họ và tên" value="" name="name"   class="form-control" />
            </div>
            <div class="form-group">
               <div class="alert alert-danger d-none " id="error-create-profile-name">
               </div>
            </div>
            
            <div class="form-group">
               <label for="regular1" class="control-label">Số điện thoại <span class="color-red">*</span></label>
               <input type="text"  id="phone-create"required placeholder="Số điện thoại" value="" name="phone" id="title"  class="form-control" />
            </div>
            <div class="form-group">
               <div class="alert alert-danger d-none" id="error-create-profile-phone">
               </div>
            </div>
            <div class="form-group">
               <label for="inputAddress">Tỉnh - Thành phố</label>
               <select name="" required data-live-search="true" data-size="5" title="Vui lòng chọn tỉnh-thành phố" class="selectpicker province form-control" id="province-create" data-type="create" >
               </select>
            </div>
            <div class="form-group">
               <div class="alert alert-danger d-none" id="error-create-profile-province">
               </div>
            </div>
            <div class="form-group dis-none form-district-create" >
               <label for="inputAddress">Quận - Huyện</label>
               <select name="" required data-live-search="true" data-size="5" title="Vui lòng chọn quận-huyện" class="selectpicker district form-control" id="district-create" data-type="create" >
               </select>
            </div>
            <div class="form-group">
               <div class="alert alert-danger d-none " id="error-create-profile-district">
               </div>
            </div>
            <div class="form-group dis-none form-ward-create">
               <label for="inputAddress">Xã, phường</label>
               <select name="" required data-live-search="true" data-size="5" title="Vui lòng chọn xã-phường" class="selectpicker ward ward-create form-control" id="ward-create" data-type="create">
               </select>
            </div>
            <div class="form-group">
               <div class="alert alert-danger d-none " id="error-create-profile-ward">
               </div>
            </div>
            <div class="form-group">
               <label for="inputAddress">Địa chỉ</label>
               <input type="text"  name="address" required  class="form-control" id="address-create" placeholder="Số nhà, khu, thôn">
            </div>
            <div class="form-group">
               <div class="alert alert-danger d-none " id="error-create-profile-address">
               </div>
            </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary mr-auto" data-dismiss="modal">Thoát</button>
            <button type="button" class="btn btn-primary" onclick="storeProfile(this)">Lưu</button>
         </div>
      </div>
   </div>
</div>
@endsection 
@push('styles')
       <link href="{{asset('css/checkbox.css')}}" rel="stylesheet">

   <style>
      .fa-exclamation-triangle{
      color: #FD0000;
      }
      a.disabled {
      pointer-events: none;
      cursor: default;
      }
      table .qty .button {
      display: inline-block;
      position: absolute;
      top: 0;
      }
      table .qty .button.minus {
      left: 0;
      border-radius: 0;
      overflow: hidden;
      }
      table .qty .button.plus {
      right: 0;
      border-radius: 0;
      overflow: hidden;
      }
      table .qty .button .btn {
      padding: 0;
      width: 44px;
      height: 47px;
      line-height: 50px;
      border-radius: 0px;
      background: transparent;
      color: #282828;
      border: none;
      font-size: 12px;
      }
      table .qty .button .btn:hover {
      color: #189eff;
      }
      table .qty .input-number {
      border: 1px solid #eceded;
      width: 100%;
      text-align: center;
      height: 47px;
      border-radius: 0;
      overflow: hidden;
      padding: 0px 45px;
      }
      label {
         width: 100%;
         font-size: 1rem;
       }
       
       .card-input-element+.card {
         
         -webkit-box-shadow: none;
         box-shadow: none;
         border: 2px solid transparent;
         border-radius: 4px;
         border: solid 2px #AFB8EA;
       }
       
       .card-input-element+.card:hover {
         cursor: pointer;
       }
       
       .card-input-element:checked+.card {
         border: 2px solid var(--primary);
         -webkit-transition: border .3s;
         -o-transition: border .3s;
         transition: border .3s;
       }
       
       .card-input-element:checked+.card::after {
         content: '\2713';
         color: #189eff;
         font-family: 'Material Icons';
         font-size: 24px;
         font-weight: bolder;
         -webkit-animation-name: fadeInCheckbox;
         animation-name: fadeInCheckbox;
         -webkit-animation-duration: .5s;
         animation-duration: .5s;
         -webkit-animation-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
         animation-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
       }
       
       @-webkit-keyframes fadeInCheckbox {
         from {
           opacity: 0;
           -webkit-transform: rotateZ(-20deg);
         }
         to {
           opacity: 1;
           -webkit-transform: rotateZ(0deg);
         }
       }
       
       @keyframes fadeInCheckbox {
         from {
           opacity: 0;
           transform: rotateZ(-20deg);
         }
         to {
           opacity: 1;
           transform: rotateZ(0deg);
         }
       }
       
   </style>
<!-- Example docs (CSS for helping component example file)-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css" integrity="sha512-ARJR74swou2y0Q2V9k0GbzQ/5vJ2RBSoCWokg4zkfM29Fb3vZEQyv0iWBMW/yvKgyHSR/7D64pFMmU8nYmbRkg==" crossorigin="anonymous" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
@endpush 
@push('scripts')
<script src="{{ asset('js/address.js') }}"></script>
<script src="{{ asset('js/create-PX.js') }}"></script>
<script src="{{ asset('js/serviceShip.js') }}"></script>
<script src="{{ asset('vendor/js/slug.js') }}"></script>
    <script>
       var information = <?php echo $information ?>;
       console.log(information);
      
      $("#product-select").val('default').selectpicker("refresh");

    $('#partner-select').selectpicker('refresh');
    $('#category-select').selectpicker('refresh');
    $('#product-select').attr("selected",false);;
    $('#product-select').selectpicker('refresh');
    $('#partner-select').on('change', function() {
        var slug = $(this).val();
        getPartner(slug);
    });
    function showModalCreateCategory(){
        $("#modalCreateCategory").find("input,textarea,select")
            .val('')
            .end();
            $("#modalCreateCategory").show();
    }
    function getPartner(slug){
        $.ajax({
            dataType: "json",
            url: "{{ route('admin.PX.create') }}",
            data:{
                slug:slug,
            },
    
            success: function(result) {
                var type=result.type;
                var partners=result.partners;
                $("#code-partner-label").text(type);
                
                var content='<label for="inputTitle" class="col-form-label">'+type+'<span class="text-danger">*</span></label>'+
                            '<div class="d-flex justify-content-between ">'+
                            '<div class="flex-basis-75">'+
                                '<select id="code-partner-select" data-type="'+type+'" class="selectpicker form-control" title="Chọn '+type+'" data-live-search="true" placeholder="Chọn '+type+'" data-size="5" data-actions-box="true" onchange="changePartner()">';
                                    for(item of partners){
                                        content+='<option  value="'+item['code']+'">'+item['name']+' - '+item['phone']+'</option>';
                                    }
                    content+='</select>'+
                            '</div>'+
                            '<div>'+
                              '<button class="btn btn-light d-none" id="btn-info" onclick="showInfoPartner()"><i class="fas fa-chevron-up"></i></button>'+
                              '</div>';
                            if(type=='Khách hàng'){
                                content+='<div>'+
                                    '<button class="btn btn-light" data-toggle="modal" data-target="#modalCreateUser"><i class="fas fa-plus"></i></button>'+
                                    '</div>'+
                                '</div>';
                            }
                            else{
                              content+='<div>'+
                                 '<button class="btn btn-light" data-toggle="modal" data-target="#modalCreateSupplier"><i class="fas fa-plus"></i></button>'+
                                 '</div>'+
                             '</div>';
                            }
                            content+='<div>';
                $("#form-code-partner").html(content);  
                $('#code-partner-select').selectpicker('refresh');
                
            },
            error: function(json) {
                if (json.status === 404) {
                    var errors = json.responseJSON;
                    $(".error_coupon").text(errors["message"]);
                }
            },
        });
    }
    function storeCategory(){
        var parent_id=<?php echo $parent_id; ?>;
        var name=$("#title").val();
        slug=ChangeToSlug(name);
        $("#error-name").addClass('d-none');
        $.ajax({
            dataType: "json",
            type:"POST",
            url: "{{ route('admin.category-receipt.store') }}",
            data:{
                name:name,
                slug:slug,
                parent_id:parent_id,
            },
    
            success: function(response) {
                $("#modalCreateCategory .close").click();
                var notify = new PNotify({
                title: "Cập nhật thành công",
                 type:'success'
             });
             $('#category-select').val(response).selectpicker('render');
             $('#category-select').selectpicker('refresh');

            },
            error: function(response) {
                var errors = response.responseJSON.errors;
                $.each(errors,function(field_name,error){
                    $("#error-"+field_name).html('<span class="text-strong textdanger">' +error+ '</span>');
                    $("#error-"+field_name).removeClass('d-none');
                })
            },
        });
    }
    function storeUser(e){
        
        var name=$("#name-create").val();
        var phone=$("#phone-create").val();
        var email=$("#email-create").val();
        var address=$("#address-create").val();
        var province=[$("#province-create option:selected").val(),$("#province-create option:selected").text()];
        var district=[$("#district-create option:selected").val(),$("#district-create option:selected").text()];
        var ward=[$("#ward-create option:selected").val(),$("#ward-create option:selected").text()];
        
        
        var pre_province=prefixProvince(province[1]);
        var region=getRegion(pre_province);
        var urban=getUrban(region,district[1]);
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
                    $("#" + "error-create-user-"+i).addClass('d-none');
                    }
        $.ajax({
            type: 'post',
            dataType: 'json',
            url: '{{route("admin.user.store")}}',
            data: {
                name:name,
                email:email,
                phone:phone,
                province:province,
                district:district,
                ward:ward,
                address:address,
                urban:urban,
                region:region
            },
            success: function(result) {
                
                $("#modalCreateUser .close").click();
                var notify = new PNotify({
                title: "Cập nhật thành công",
                 type:'success'
             });
                getPartner('khach-hang');
            },
            error: function(response) {
                var errors = response.responseJSON.errors;
                
                $.each(errors,function(field_name,error){
                    $("#error-create-user-"+field_name).html('<span class="text-strong textdanger">' +error+ '</span>');
                    $("#error-create-user-"+field_name).removeClass('d-none');
                })
            },
        }); 
    }
    function store() {
    var payment=converValueNumber('#payment');
    if(payment==""){
        payment=0;
    }
    
    var total_price=converTextNumber('#total_price');
    var debt=converTextNumber('#debt');
        $.ajax({
            type: 'post',
            dataType: 'json',
            url: '{{route("admin.receipt-stock.store")}}',
            data: {
                category:'PX',
                receipt:'PT',
                child_category:$("#category-select").val(),
                partner_id:$("#partner-select").val(),
                partner_code: $("#code-partner-select").val(),
                date: $("#datetime").val(),
                note: $("#note").val(),
                total:total_price,
                quantity: $("#total_quantity").val(),
                payment:payment,
                debt: debt,
                array: listProduct,
            },
            success: function(result) {
                {
                    var notify = new PNotify({
                title: "Cập nhật thành công",
                 type:'success'
             });
                    window.history.back();
                    
                }
            }
        });
    }
    function storeSupplier(e){
      
      var name=$("#create-supplier-name").val();
      var phone=$("#create-supplier-phone").val();
      var address=$("#create-supplier-address").val();
      var arr=['name','phone','address'];
          for(var i of arr){
              $("#" + "error-create-supplier-"+i).addClass('d-none');
              }
      $.ajax({
          type: 'post',
          dataType: 'json',
          url: '{{route("admin.supplier.store")}}',
          data: {
              name:name,
              phone:phone,
              address:address,
          },
          success: function(result) {
             
              $("#modalCreateSupplier .close").click();
              getPartner('nha-cung-cap');
              var notify = new PNotify({
                title: "Cập nhật thành công",
                 type:'success'
             });
  
          },
          error: function(response) {
              var errors = response.responseJSON.errors;
              
              $.each(errors,function(field_name,error){
                  $("#error-create-supplier-"+field_name).html('<span class="text-strong textdanger">' +error+ '</span>');
                  $("#error-create-supplier-"+field_name).removeClass('d-none');
              })
          },
      }); 
  }
  function showInfoPartner(){
   
   $("#btn-info").find($(".fas")).toggleClass('fa-chevron-up fa-chevron-down');
   $("#form-info-partner").toggle('1000');

   var selectedText = $("#code-partner-select").find("option:selected").text();

  }

function changePartner(){
   var code=$('#code-partner-select').val();
   var type=$('#code-partner-select').data('type');
   $.ajax({
      dataType: "json",
      type:"post",
      url: "{{ route('admin.partner.show') }}",
      data:{
          code:code,
          type:type
      },

      success: function(response) {
         content='<div class="card border-primary">'+
            '<div class="card-header text-center">Thông tin chi tiết</div>'  +
            '<div class="card-body" style="padding:0.25rem">';
          switch(response.type) {
            case 'Khách hàng':
               var user=response.user;
               var profiles=response.profiles;
              // code block
              content+='<ul class="list-group list-group-flush">'+
                           '<li class="list-group-item">Mã khách hàng: '+user['code']+'</li>'+
                           '<li class="list-group-item">Email: '+user['email']+'</li>'+
                        '</ul>';
                        for(var profile of profiles){
                           var province=profile['province'].split(","); 
                           var district=profile['district'].split(","); 
                           var ward=profile['ward'].split(","); 
                           var address=profile['address']+", "+ ward[1] + ", " + district[1] + ", " + province[1];
                           content+='<label>'+
                              '<input type="radio" checked  onchange="changeAddress()" name="address" class="card-input-element d-none" data-id='+profile['id']+' id="profile-'+profile['id']+'">'+
                              '<div class="card card-body d-flex flex-row justify-content-between align-items-center" style="margin:0.5rem">'+
                              '<ul class="list-group list-group-flush">'+
                              '<li id="name_receiver_"'+profile['id']+' class="list-group-item">Tên: '+profile['name']+'</li>'+
                              '<li class="list-group-item" id="phone_receiver_"'+profile['id']+'>Số điện thoại: '+profile['phone']+'</li>'+
                              '<li class="list-group-item" id="addreewss_receiver_"'+profile['id']+'>Địa chỉ: '+address+'</li>'+
                              '<input type="hidden" id="name_receiver_'+profile['id']+'" value="'+profile['name']+'">'+
                              '<input type="hidden" id="phone_receiver_'+profile['id']+'" value="'+profile['phone']+'">'+
                              '<input type="hidden" id="address_receiver_'+profile['id']+'" value="'+profile['address']+'">'+
                              '<input type="hidden" id="urban_receiver_'+profile['id']+'" value="'+profile['urban']+'">'+
                              '<input type="hidden" data-name="'+province[1]+'" id="province_receiver_'+profile['id']+'" value="'+province[0]+'">'+
                              '<input type="hidden" id="district_receiver_'+profile['id']+'" value="'+district[0]+'">'+
                              '<input type="hidden" id="ward_receiver_'+profile['id']+'" value="'+ward[1]+'">'+
                              '</ul>'+
                              '</div>'+
                           '</label>';
                           if(profile['default']==1){
                              $('#profile-'+profile['id']).prop('checked',true);
                           }
                        }
                        content+='<ul class="list-group list-group-flush">'+
                           '<li class="list-group-item" >'+
                              '<div class="Checkbox">'+
                                 '<input id="usingShipper" onclick="usingShipper(this)" type="checkbox" class="cursor-pointer Checkbox-input">'+
                                 '<label for="usingShipper" class="Checkbox-label cursor-pointer m-b-0">Sử dụng dịch vụ shipper</label>'+
                               '</div>'+
                           '</li>'+
                              '</ul>'+
                              '<ul class="list-group list-group-flush">'+
                           '<li class="list-group-item" >'+
                              '<div class="collapse form-group" id="form-service-ship" >'+
                                 '<p>ok</p>'+
                              '</div>'+
                           '</li>'+
                        '</ul>';
                        content+='</div>';
                        
              break;
            case 'Nhà cung cấp':
            var supplier=response.supplier;
           // code block
           content+='<ul class="list-group list-group-flush">'+
                        '<li class="list-group-item">Tên: '+supplier['name']+'</li>'+
                        '<li class="list-group-item">Số điện thoại: '+supplier['phone']+'</li>'+
                        '<li class="list-group-item">Địa chỉ: '+supplier['address']+'</li>'+
                     '</ul>';
              // code block
              break;
            default:
              // code block
          } 
          content+='</div>';

          $("#btn-info").removeClass('d-none');
          $("#form-info-partner").html(content);
          $("#form-info-partner").toggle('1000');
          $("#btn-info").find($(".fas")).toggleClass('fa-chevron-up fa-chevron-down');

      },
      error: function(json) {
          if (json.status === 404) {
              var errors = json.responseJSON;
              $(".error_coupon").text(errors["message"]);
          }
      },
  });

}
function showModalCreateAddress(id){
   $('#modalCreateAddress').modal({
      onOpen: function (dialog) {
         dialog.data.show();
         dialog.container.show();
         dialog.overlay.fadeIn('slow');
      }
  }); 
}
   $(".input-create-category").keypress(function(e){
      if(e.which==13){
         storeCategory();
      };
   });
   $(".input-create-user").keypress(function(e){
      if(e.which==13){
         storeUser();
      };
   });
   $(".input-create-supplier").keypress(function(e){
      if(e.which==13){
         storeSupplier();
      };
   });
   $("#usingShipper")
   function usingShipper(e){
      if($(e).prop('checked')){
         if(listProduct.length==0){
         
            $("html, body").animate({ scrollTop: 0 }, 600);
            var notify = new PNotify({
               title: "Vui lòng chọn sản phẩm",
                type:'error'
            });
            $(e).prop('checked', false);
            return false;
            
         }
         else{
            $('#form-service-ship').show(500);
            changeAddress();         
         }
         
      }
      else{
         $('#form-service-ship').hide(500);
      }
     
   }
   
   function changeAddress(){
      var id=$('input[name=address]:checked').data('id');
      InfoUserCheckout(id);
      getRouteShip();
  }
    </script>
@endpush