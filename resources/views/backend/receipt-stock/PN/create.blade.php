@section('title', 'THÊM PHIẾU NHẬP KHO')
@extends('backend.layouts.master') 
@section('main-content')
<div class="card">
   
   <div class="card-header py-3 d-flex justify-content-between">
      <h4 class="m-0 font-weight-bold text-primary float-left">Phiếu nhập</h4>
      <div class="text-center">
         <a onclick="store()" href="#"  id="btn-save" class="  mr-2 btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="Lưu"><i class="fas fa-save"></i> Lưu</a>
         <a onclick="store()" href="#" id="btn-savePrint"class="  mr-2 btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="Lưu và in"><i class="fas fa-print"></i> Lưu và in</a>
         <a  href="#"   class=" mr-2 btn btn-success btn-sm float-right" onclick="refresh()" data-toggle="tooltip" data-placement="bottom" title="Làm mới"><i class="fas fa-redo"></i> Làm mới</a>
         <a  href="{{route('admin.PN')}}"   class=" mr-2 btn btn-success btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="Quay lại "><i class="fas fa-undo"></i> Quay lại</a>
      </div>
   </div>
   <div class="card-body row">
      <div class="col-md-8 col-12">
         <div class="card m-b-10">
            <div class="card-body">
               <div class="form-group">
                  <select id="product-select" class="show-tick  form-control" title="Chọn sản phấm" data-size="5" data-actions-box="true" multiple data-live-search="true">
                     @foreach ($products as $product)
                     @php
                     $stock=$product->stock;
                     @endphp
                     @if ($stock->min > $stock->quantity)
                     <option data-icon="fa fa-exclamation-triangle" value="{{ $product->id }}"> {{ $product->name }} </option>
                     @else
                     <option  value="{{ $product->id }}"> {{ $product->name }} </option>
                     @endif
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
                           <th>Tên</th>
                           <th>Số lượng</th>
                           <th>Giá nhập</th>
                           <th>Thành tiền</th>
                           <th>Giá bán mới</th>
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
               Thông tin phiếu nhập
            </div>
            <div class="card-body">
               <div class="form-group">
                  <label for="inputTitle" class="col-form-label">Nhà cung cấp<span class="text-danger">*</span></label>
                  <div class="row">
                     <div class="col-9" id="form-supplier-select">
                        
                     </div>
                     <div class="col-3">
                        {{--  <button class="form-control btn btn-light btn-sm" onclick="test()"><i class="fas fa-plus"></i></button>  --}}
                        <button class="form-control btn btn-light btn-sm" data-toggle="modal" data-target="#modalCreateSupplier"><i class="fas fa-plus"></i></button>
                     </div>
                  </div>
               </div>
               <div class="form-group">
                  <div class="alert alert-danger d-none" id="error-partner_code">

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
                         <div class="alert alert-danger d-none" id="error-payment">

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
                        <h5 id="nameMoney">Nhất Vương</h5>
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
               <input type="text" id="name-create" required autofocus placeholder="Họ và tên" value="" name="name"   class="form-control input-create-supplier" />
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
    </style>
<!-- Example docs (CSS for helping component example file)-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css" integrity="sha512-ARJR74swou2y0Q2V9k0GbzQ/5vJ2RBSoCWokg4zkfM29Fb3vZEQyv0iWBMW/yvKgyHSR/7D64pFMmU8nYmbRkg==" crossorigin="anonymous" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
@endpush 
@push('scripts')
{{--  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js" integrity="sha512-yDlE7vpGDP7o2eftkCiPZ+yuUyEcaBwoJoIhdXv71KZWugFqEphIS3PU60lEkFaz8RxaVsMpSvQxMBaKVwA5xg==" crossorigin="anonymous"></script>  --}}  --}}
{{--  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>  --}}
{{--  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>  --}}
{{--  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>  --}}
{{--  <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>  --}}
    <script src="{{ asset('js/create-PN.js') }}"></script>
    <script>
      $(".alert").alert();
       function hoverCreateSupplier(){
         window.tooltip = PNotify.notice({
            title: 'Tooltip',
            text: "I'm not in a stack. I'm positioned like a tooltip with JavaScript.",
            hide: false,
            closer: false,
            sticker: false,
            animateSpeed: 'fast',
            icon: 'fas fa-comment',
            // Setting stack to null causes PNotify to ignore this notice when positioning.
            stack: null,
            autoOpen: false,
            destroy: false,
            modules: new Map([
              ...[...PNotify.defaultModules].filter(
                ([mod]) => mod !== PNotifyMobile
              )
            ])
          });
          // Close the notice if the user mouses over it.
          window.tooltip.on('mouseout', () => window.tooltip.close());
       }
      $("#product-select").val('default').selectpicker("refresh");

      
       function refresh(){
         location.reload(); 
       }
      $("#supplier-select").selectpicker('refresh');
      getSupplier();
       function getSupplier(){
         $.ajax({
            type: 'get',
            dataType: 'json',
            url: '{{ route("admin.supplier.index") }}',
            
            success: function(response) {
                {
                   content='<select id="supplier-select" class="selectpicker form-control" title="Chọn nhà cung cấp" data-live-search="true" data-width="100%" placeholder="Chọn nhà cung cấp" data-size="5" data-actions-box="true">';
                     for(var item of response){
                        content+='<option  value="'+item['code']+'">'+item['name']+'</option>';
                     }
                  content+='</select>';
                  $("#form-supplier-select").html(content);
                  $("#supplier-select").selectpicker('refresh');

                }
            }
        });
       }
       var child_cat_id=<?php echo $child_cat_id['id'];?>;

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
                url: '/admin/receipt-stock',
                data: {
                    child_cat_id:child_cat_id,
                    category:'PN',
                    receipt:'PC',
                    partner_slug:'nha-cung-cap',
                    partner_code: $("#supplier-select").val(),
                    date: $("#datetime").val(),
                    note: $("#note").val(),
                    total:total_price,
                    quantity: $("#total_quantity").val(),
                    payment:payment,
                    debt: debt,
                    array: listProduct,
                },
                success: function(result) {
                    
                     var notify = new PNotify({
                        title: "Cập nhật thành công",
                        type:'success'
                     });
                            setTimeout(function(){ 
                            window.location.href = "{{ route('admin.PN')}}";
                            }, 1000);
                    
                },
                error: function(response) {
                var errors = response.responseJSON.errors;
                console.log(errors);
                $.each(errors,function(field_name,error){
                    $("#error-"+field_name).html('<span class="text-strong textdanger">' +error+ '</span>');
                    $("#error-"+field_name).removeClass('d-none');
                    

                })
               }
            });
    }
    function storeSupplier(e){
      
        var name=$("#name-create").val();
        var phone=$("#phone-create").val();
        var email=$("#email-create").val();
        var address=$("#address-create").val();
        var arr=['name','phone','address'];
            for(var i of arr){
                $("#" + "error-create-"+i).addClass('d-none');
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
                getSupplier();
                var notify = new PNotify({
                  title: "Cập nhật thành công",
                   type:'success'
               });
    
            },
            error: function(response) {
                var errors = response.responseJSON.errors;
                
                $.each(errors,function(field_name,error){
                    $("#error-create-"+field_name).html('<span class="text-strong textdanger">' +error+ '</span>');
                    $("#error-create-"+field_name).removeClass('d-none');
                    {{--  $("#error-create-"+field_name).show(500);  --}}
                    {{--  $("#error-create-"+field_name).fadeIn(1000);  --}}
                    {{--  $("#error-create-"+field_name).fadeIn("fast");  --}}
                    {{--  $("#error-create-"+field_name).fadeIn(3000);  --}}


                })
            },
        }); 
    }
    $(".input-create-supplier").keypress(function(e){
         if(e.which==13){
            storeSupplier();
         }
    })
    </script>
@endpush