@section('title', 'THÊM PHIẾU NHẬP KHO')
@extends('backend.layouts.master') 
@section('main-content')
<div class="card">
   
   <div class="card-header py-3 d-flex justify-content-between">
      <h5 class="m-0 font-weight-bold  float-left">Phiếu nhập</h5>
      <div class="text-center">
         <a onclick="processing()" href="#"  id="btn-save" class="  mr-2 btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="Lưu"><i class="fas fa-save"></i>&ensp;Lưu</a>
         <a onclick="complete()" href="#"  id="btn-save" class="  mr-2 btn btn-success btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="Hoàn thành"><i class="fas fa-check"></i>&ensp;Hoàn thành</a>
         <a  href="#"   class=" mr-2 btn btn-success btn-sm float-right" onclick="refresh()" data-toggle="tooltip" data-placement="bottom" title="Làm mới"><i class="fas fa-redo"></i>&ensp;Làm mới</a>
         <a  href="{{route('admin.productImport.index')}}"   class=" mr-2 btn btn-success btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="Quay lại "><i class="fas fa-undo"></i>&ensp;Quay lại</a>
      </div>
   </div>
   <div class="card-body row">
      <div class="col-md-8 col-12">
         <div class="card m-b-10">
            <div class="card-body">
                <div class="form-group" id="form-product-select">
                </div>
            </div>
         </div>
         <div class="card">
            <div class="card-body">
               <div class="table-responsive">
                  <table style="color: #333;" class="table table-bordered"  width="100%">
                     <thead>
                        <tr>
                           <th class="w-5">STT</th>

                           <th>Tên</th>
                           <th class="w-20">Số lượng</th>
                           <th class="w-15">Giá nhập</th>
                           <th class="w-15">Thành tiền</th>
                           <th class="w-5"></th>
                        </tr>
                     </thead>
                     <tbody id="table-product"></tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
      <div class="col-md-4 col-12">
       
            <div class="tab-container">

            <div class="card">
                <div class="card-body">
                    <div class="tab-container">
                        <input type="radio" name="tab" data-id="1" id="tab1" checked="checked">
                        <label for="tab1" class="tab-label w-32">Thông tin</label>
                        <input type="radio" data-id="2" name="tab" id="tab2">
                        <label for="tab2" class="tab-label w-32">Thanh toán</label>
                        <div class="tab-content-wrapper">
                            <div id="tab-content-1" class="tab-content">
                                
                                <div class="form-group">
                                    <label for="inputTitle" class="col-form-label">Nhà cung cấp<span class="text-danger">*</span></label>
                                    <div class="row">
                                       <div class="col-10" id="form-supplier-select">
                                          
                                       </div>
                                       <div class="col-2">
                                          <button class="form-control btn btn-light btn-sm" data-toggle="modal" data-target="#modalCreateSupplier"><i class="fas fa-plus"></i></button>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="form-group">
                                 </div>
                                 <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                    <label for="regular1" class="control-label">Ngày lập phiếu</label>
                                    <input type="text" required placeholder="" value="{{ old('date') }}" name="date" id="date-import" class="datetime form-control" />
                                 </div>
                                 <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                    <label for="regular1" class="control-label">Ngày giao hàng</label>
                                    <input type="text" required placeholder="" value="{{ old('date') }}" name="date" id="date-delivery" class="datetime form-control" />
                                 </div>
                                 <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Ghi chú</label>
                                    <textarea class="form-control" id="note" rows="3" val=""></textarea>
                                  </div>
                                 <input type="hidden" id="cat_receipt">
                                 <input type="hidden" id="child_cat_receipt">
                                 <input type="hidden" id="cat_receipt_stock">
                                 <input type="hidden" id="child_cat_receipt_stock">
                                 <input type="hidden" id="partner">
                            </div>
                            <div id="tab-content-2" class="tab-content">
                                <table class="table">
                                    
                                    <tr>
                                        <td class="font-weight-bold w-50">Tổng số lượng</td>
                                        <td class="p-r-24">
                                            <button class="btn btn-primary btn-sm float-right" id="total_quantity">0</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold w-50">Tổng thành tiền</td>
                                        <td id="total_price" class="float-right p-r-24">
                                            0
                                            {{--  <button class="btn btn-primary btn-sm float-right" id="total_price">0</button>

                                            <input type="hidden" name="" >  --}}
                                        </td>
                                    </tr>
                                    <tr id="tr-payment">
                                        <td class="font-weight-bold w-50">Thanh toán</td>
                                        <td>
                                            <input type="text" class="form-control" onkeyup="updatePayment(this)" value="0" id="payment" style="text-align: right" />
                                        </td>
                                    </tr>
                                    <tr id="tr-debt">
                                        <td class="font-weight-bold w-50">Nợ</td>
                                        <td id="debt" class="float-right p-r-24">
                                            0
                                        </td>
                                    </tr>
                                    <tr id="tr-acount">
                                        <td class="font-weight-bold w-50">Tài khoản</td>
                                        <td id="form-account-select" class="float-right p-r-24">
                                            
                                        </td>
                                    </tr>

                                </table>
                                
                            </div>
                            
                        </div>
                    </div>
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
    
    
    </style>
<!-- Example docs (CSS for helping component example file)-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css" integrity="sha512-ARJR74swou2y0Q2V9k0GbzQ/5vJ2RBSoCWokg4zkfM29Fb3vZEQyv0iWBMW/yvKgyHSR/7D64pFMmU8nYmbRkg==" crossorigin="anonymous" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
<link rel="stylesheet" href="{{ asset('css/tab.css') }}">
@endpush 
@push('scripts')
    <script>
        $('#date-import').datepicker({
            maxDate: '0',
            uiLibrary: 'bootstrap4',
            iconsLibrary: 'fontawesome',
            value: today,
            modal: true,
            footer: true,
        });
        $('#date-delivery').datepicker({
            maxDate: '0',
            uiLibrary: 'bootstrap4',
            iconsLibrary: 'fontawesome',
            value: today,
            modal: true,
            footer: true,
        });
        var listProduct = [];
        var total_quantity = 0;
        var arr_id=[];
        var selected = [];
        var suppliers=<?php echo $suppliers;?>;
        var products=<?php echo $products;?>;
        var accounts=<?php echo $accounts;?>;
        var cat_receipt=<?php echo $cat_receipt->id;?>;
        var child_cat_receipt=<?php echo $child_cat_receipt->id;?>;
        var cat_receipt_stock=<?php echo $cat_receipt_stock->id;?>;
        var child_cat_receipt_stock=<?php echo $child_cat_receipt_stock->id;?>;
        var partner=<?php echo $partner->id;?>;
        var supplier_id;
        getAccount(accounts);
        getProduct(products);
        getSupplier(suppliers);
        chuaBietDatTen()
        function chuaBietDatTen(){
            $("#cat_receipt").val(cat_receipt);
            $("#child_cat_receipt").val(child_cat_receipt);
            $("#cat_receipt_stock").val(cat_receipt_stock);
            $("#child_cat_receipt_stock").val(child_cat_receipt_stock);
            $("#partner").val(partner);
        }
        function getAccount(accounts){
            content='<select id="account-select" class="selectpicker form-control" title="Chọn chi nhánh" data-live-search="true" data-width="100%" placeholder="Chọn nhà cung cấp" data-size="5" data-actions-box="true">';
                for(var item of accounts){
                    content+='<option  value="'+item['id']+'">'+item['name']+'</option>';
                }
            content+='</select>';
            $("#form-account-select").html(content);
            $("#account-select").selectpicker('refresh');
            $("#account-select").selectpicker('val','1');
        }
        
        function getProduct(products){
            content='<select id="product-select" onChange="selectProduct(this)" class="show-tick  form-control" title="Chọn sản phấm" data-size="5" data-actions-box="true" multiple data-live-search="true">';
                for(var item of products){
                    if(item['quantity'] > item['min']){
                        content+='<option quantity='+item['quantity']+'  value="'+item['id']+'">' +item['code'] + ' - '+item['title'] +' - Số lượng: '+item['quantity']+'</option>';
 
                    }
                    else{ 
                        content+='<option quantity='+item['quantity']+' data-icon="fas fa-exclamation-circle"  value="'+item['id']+'">' +item['code'] + ' - '+item['title'] +' - Số lượng: '+item['quantity']+'</option>';
                    }
                }
                content+='</select>';
            $("#form-product-select").html(content);
            $("#product-select").selectpicker('refresh');
        }
        function getSupplier(suppliers){
            content='<select id="supplier-select" class="selectpicker form-control" title="Chọn nhà cung cấp" data-live-search="true" data-width="100%" placeholder="Chọn nhà cung cấp" data-size="5" data-actions-box="true">';
                for(var item of suppliers){
                content+='<option  value="'+item['code']+'">'+item['name']+'</option>';
                }
            content+='</select>';
            $("#form-supplier-select").html(content);
            $("#supplier-select").selectpicker('refresh');
        }
        function selectProduct(e){
            selected = $(e).val();
            
            addProduct(selected,arr_id);
        }
        function addProduct(selected, arr_id) {
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });
            var diff = arrayDiff(selected, arr_id);
            if (arr_id.length > selected.length) {
                for (var id of diff) {
                    arr_id.splice(arr_id.indexOf(id), 1);
                    $.each(listProduct, function(i, el) {
                        if (this.id == id) {
                            listProduct.splice(i, 1);
                        }
                    });
                    tableProduct();
        
                }
            } else {
                for (var id of diff) {
                    $.ajax({
                        type: "post",
                        dataType: "json",
                        url: "{{ route('admin.product.show') }}",
                        data:{
                            id:id,
                        },
                        success: function(result) {
                            product=result;
                            $.ajax({
                                type: "post",
                                dataType: "json",
                                url: "{{ route('admin.productImport.getCostPrice') }}",
                                data:{
                                    id:product['id'],
                                },
                                success: function(result) {
                                    
                                    var object = {
                                        id: product['id'],
                                        code: product['code'],
                                        title: product['title'],
                                        cost_price: result['cost_price'],
                                        amount: result['cost_price'],
                                        quantity: 1,
                                    };
                                    arr_id.push(id);
                                    listProduct.push(object);
                                    tableProduct();
                
                                },
                                
                            });
                        },
                     
                    });
                }
            }
        }
        function arrayDiff(arr1, arr2) {
            var diff = {};
        
            diff.arr1 = arr1.filter(function(value) {
                if (arr2.indexOf(value) === -1) {
                    return value;
                }
            });
        
            diff.arr2 = arr2.filter(function(value) {
                if (arr1.indexOf(value) === -1) {
                    return value;
                }
            });
        
            diff.concat = diff.arr1.concat(diff.arr2);
            return diff.concat;
        };
        function tableProduct() {
            content = "";
            var stt=1;
            for (var item of listProduct) {
                content +=
                    
                    '<tr id="tr_' +
                    item.id +
                    '">' +
                    '<td>'+stt+'</td>'+
                    "<td >" +
                    item.title +
                    '</td>'+
                    '<td class="qty" data-title="Qty">' +
                    '<div class="input-group">' +
                    '<div class="button minus">' +
                    '<button type="button" class="btn btn-primary btn-number" data-type="minus" style="border-radius: 10px 0 0 10px;" onclick="minusQuantity(' +
                    item.id +
                    ')">' +
                    '<i class="fas fa-minus"></i>' +
                    "</button>" +
                    "</div>" +
                    '<input type="text" onkeyup="changeQuantity('+item.id+ ')" class="input-number" id="quantity_' +
                    item.id +
                    '" data-min="1" data-max="100" value="' + item.quantity + '">' +
                    '<div class="button plus">' +
                    '<button type="button" class="btn btn-primary btn-number" style="border-radius: 0 10px 10px 0;" onclick="plusQuantity(' +
                    item.id +
                    ')" >' +
                    '<i class="fas fa-plus"></i>' +
                    "</button>" +
                    "</div>" +
                    "</div>" +
                    "</td>" +
                    '<td><input type="text" class="form-control" data-default=' +
                    item.cost_price +
                    ' data-type="cost_price" data-id=' +
                    item.id +
                    ' onkeyup="updatePrice('+item.id+')" id="cost_price_' +
                    item.id +
                    '" value="' + item.cost_price + '"></td>' +
                    '<td class="p-t-18" style="padding-top:18px" id="amount_' +
                    item.id +
                    '">' +
                    item.amount +
                    "</td>" +
                    '<td><button class="btn btn-danger btn-sm "  onclick=removeTr(' +
                    item.id +
                    ') data-id= style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fas fa-trash-alt"></i></button></td>' +
                    "</tr>";
                        stt++;
                totalPrice();
        
            }
            $("#table-product").html(content);
            numbericProduct();
        }
        function numbericProduct() {
            for (var id of arr_id) {
                new AutoNumeric("#cost_price_" + id, {
                    decimalPlaces: '0'
                });
                new AutoNumeric("#amount_" + id, {
                    decimalPlaces: '0'
                });
            }
        }
        
        
        function removeTr(id) {
        
            $("#tr_" + id).remove();
            $.each(listProduct, function(i, el) {
                if (this.id == id) {
                    listProduct.splice(i, 1);
                }
            });
            $('#product-select option').val(id).prop("selected", false);
            totalPrice();
        }
        totalPrice();

        function plusQuantity(id) {
            var number = $("#quantity_" + id).val();
            number++;
            console.log(number);

            $("#quantity_" + id).attr("value", parseInt(number));
            $("#quantity_" + id).text(number);
            objIndex = listProduct.findIndex((obj => obj.id == id));
            listProduct[objIndex].quantity=parseInt(number);
            updateAmount(id);
        }

        function minusQuantity(id) {
            var number = $("#quantity_" + id).val();
            if (number > 1) {
            
                number--;
                $("#quantity_" + id).attr("value", parseInt(number));
                objIndex = listProduct.findIndex((obj => obj.id == id));
                listProduct[objIndex].quantity = parseInt(number);
                updateAmount(id);
            }
            totalPrice();
        }
        function changeQuantity(id){
            var number=$("#quantity_"+id).val();
            $("#quantity_" + id).attr("value", parseInt(number));
            $("#quantity_" + id).text(number);

            objIndex = listProduct.findIndex((obj => obj.id == id));
                listProduct[objIndex].quantity = parseInt(number);
            updateAmount(id);



        }
        function updateAmount(id) {
            var quantity = $("#quantity_" + id).val();
            
            var cost_price = converValueNumber("#cost_price_" + id);
            //   {{--  var cost_price = $("#cost_price_" + id).val().replace(',', '');  --}}
            var amount = quantity * cost_price;
            $("#amount_" + id).text(amount);
            objIndex = listProduct.findIndex((obj => obj.id == id));
            listProduct[objIndex].amount = amount;
            new AutoNumeric("#amount_" + id, {
                decimalPlaces: '0'
            });

            let product = listProduct.find((i) => {
                return i.id === id;
            });
            product.quantity = quantity;
            product.amount = amount;
            totalPrice();
        }
        function updatePrice(id){
            var cost_price=$("#cost_price_"+id).val();

            console.log(cost_price);
            $("#cost_price_" + id).attr("value", parseInt(cost_price));
            {{--  $("#cost_price_" + id).text(number);  --}}

            objIndex = listProduct.findIndex((obj => obj.id == id));
                listProduct[objIndex].cost_price = parseInt(cost_price);
            updateAmount(id);
        }
        function totalPrice() {
            var total_quantity = 0;
            var sum = 0;
            listProduct.forEach(function(item) {
                item.quantity=parseInt(item.quantity);
                sum += item.amount;
                total_quantity += item.quantity;
            });
            $("#total_quantity").text(total_quantity);
        
            if (sum != 0) {
                $("#tr-payment").removeClass("d-none");
                $("#tr-debt").removeClass("d-none");
        
            }
            convertVnd(sum);
            $("#total_price").text(sum);
            
            
            if ($("#debt").text() != 0) {
                updatePayment();
            } else {
                var payment=formatNumber(sum);
                $("#payment").val(payment);
            }
            new AutoNumeric("#total_price", {
                decimalPlaces: '0'
            })
            var payment=$("#payment").val();
            
        
        }
        
        
        
        function updatePayment(e) {
            if(e.which >= 37 && e.which <= 40) return;
            $(e).val(function(index, value) {
              return value
              .replace(/\D/g, "")
              .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            });
            var payment = converValueNumber('#payment');
            console.log(payment);
            var total = converTextNumber('#total_price');
            var debt=total - payment;
            $("#debt").text(debt);
            new AutoNumeric("#debt", {
                decimalPlaces: '0'
            });
        }
            
        function formatDate(date) {
            var d = new Date(date);
            console.log(d);
                {{-- month = '' + (d.getMonth() + 1),
                day = '' + d.getDate(),
                year = d.getFullYear(); --}}
        
            if (month.length < 2) 
                month = '0' + month;
            if (day.length < 2) 
                day = '0' + day;
        
            return [year, month, day].join('-');
        }
        function processing(){
            status="Đang xử lý";
            store(status);
        }
        function complete(){
            status="Hoàn thành";
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
                store(status);
            }
            })

        }
        function store(status) {
          
            var payment=converValueNumber('#payment');
            if(payment==""){
                payment=0;
            }
            
            
            var debt=converTextNumber('#debt');
            var total_price=converTextNumber('#total_price');
            if(total_price==0){
                toastr.error('Vui lòng chọn sản phẩm');
                return false;
            }
            if(debt<0){
                toastr.error('Số tiền thanh toán không lớn hơn tổng tiền');
                $("#payment").addClass('box-shadow-error');
                setTimeout(function(){
                    $("#payment").removeClass('box-shadow-error');
                }, 5000);
            }
            else{
                $.ajax({
                    type: 'post',
                    dataType: 'json',
                    url: '{{ route("admin.productImport.store") }}',
                    data: {
                        partner_code:  $("#supplier-select").find("option:selected").val(),
                        partner_id: $("#partner").val(),
                        account_id:  $("#account-select").find("option:selected").val(),
                        date_import: $("#date-import").val(),
                        date_delivery: $("#date-delivery").val(),
                        cat_receipt: $("#cat_receipt").val(),
                        child_cat_receipt: $("#child_cat_receipt").val(),
                        cat_receipt_stock:  $("#cat_receipt_stock").val(),
                        child_cat_receipt_stock: $("#child_cat_receipt_stock").val(),
                        note: $("#note").val(),
                        total_price:total_price,
                        total_quantity: $("#total_quantity").text(),
                        payment:payment,
                        debt: debt,
                        status:status,
                        array: listProduct,
                    },
                    success: function(result) {
                        toastr.success('Cập nhật thành công');


                                setTimeout(function(){ 
                                window.location.href = "{{ route('admin.productImport.index')}}";
                                }, 1000);
                        
                    },
                    error: function(response) {
                        var errors = response.responseJSON.errors;
                        showError(errors);
                   }
                });
            }
               
        }
            
    </script>
@endpush