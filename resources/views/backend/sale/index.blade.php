@section('title', 'Bán hàng')

@extends('backend.layouts.master') @section('main-content')
    {{--  <div class="row">
        <div class="col-md-12 col-2" >
            <button id="btn-add-tab" type="button" class="btn btn-light pull-right"><i class="fas fa-plus"></i></button>

        </div>  --}}
            {{--  <ul id="tab-list" class="nav nav-tabs" role="tablist">
                <li class="active"><a href="#tab1" role="tab" data-toggle="tab"><span>Tab 1 </span><span class="glyphicon glyphicon-pencil text-muted edit"></span></a></li>
            </ul>  --}}
            <div class="card">
                {{--  <div class="card-body">
                    <ul class="nav nav-tabs" role="tablist" id="tab-list">
                        <li class="nav-item" >
                            <button id="btn-add-tab" type="button" onclick="addTab()" class="btn btn-primary"><i class="fas fa-plus"></i></button>
                          </li>
                        <li class="nav-item " >
                            <a class="nav-link" href="#order1" role="tab" data-toggle="tab">
                                <span>Đơn hàng 1 </span>
                              </a>
                          </li>
                         
                  </ul>
                  <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="order1">
                        order1
                    </div>
                  </div>
                </div>  --}}
                <div class="card-body">
                        <ul class="nav nav-tabs" role="tablist" id="tab-list">

                        <li class="nav-item" >
                            <button id="btn-add-tab" type="button" onclick="addTab()" class="btn btn-primary"><i class="fas fa-plus"></i></button>
                          </li>
                        <li class="nav-item " >
                            <a class="nav-link" href="#order1" role="tab" data-toggle="tab">
                                <span>Đơn hàng 1 </span>
                              </a>
                          </li>
                    
                  </ul>
                  <div id="tab-content" class="tab-content" >
                    <div class="tab-pane fade show active" id="order1" role="tabpanel" aria-labelledby="home-tab">
                                   
<div class="card">
    
    <div class="card-header py-3">
      <h4 class="m-0 font-weight-bold text-primary float-left"> Bán hàng</h4>
      <a onclick="store()" href="#"  id="btn-save" class="disabled btn btn-primary float-right" data-toggle="tooltip" data-placement="bottom" style="margin-left: 20px;" title="Lưu"><i class="fas fa-save"></i>Lưu</a>
      <a onclick="store()" href="#" id="btn-savePrint"class="disabled btn btn-primary  float-right" data-toggle="tooltip" data-placement="bottom" title="Lưu và in"><i class="fas fa-print"></i> Lưu và in</a>
    </div>
      <div class="card-body row">
          <div class="col-md-8 col-12">
              <div class="card m-b-10">
                  <div class="card-body">
                      
                      <div class="form-group">
                          <select id="product-select" class="show-tick  form-control" title="Chọn sản phấm" data-size="5" data-actions-box="true" multiple data-live-search="true">
                              @foreach ($products as $product)
                                  <option data-type="PX"  value="{{ $product->id }}"> {{ $product->name }} - Mã: {{ $product->code }} - Số lượng: {{ $product->quantity }} </option>
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
                                      <th class="w-20 text-align-center vertical-align-middle">Số lượng</th>
                                      <th class="text-align-center vertical-align-middle">Giá gốc</th>
                                      <th class="text-align-center vertical-align-middle">Giá bán</th>
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
                      Thông tin khách hàng
                  </div>
                  <div class="card-body">
                      <div class="form-group">
                          <label for="inputTitle" class="col-form-label">Khách hàng<span class="text-danger">*</span></label>
                              <div class="d-flex justify-content-between">
                                  <div class="flex-item flex-basis-80">
                                      <select id="user-select" class="selectpicker form-control" title="Chọn khách hàng" data-live-search="true" placeholder="Chọn khách hàng" data-size="5" data-actions-box="true">
                                          @foreach ($users as $item)
                                              <option  value="{{ $item->code }}">{{ $item->name }} - {{ $item->code }}</option>
                                          @endforeach
                                      </select>
                                  </div>
                                  <div class="flex-item ">
                                      <button class="btn btn-light"   onclick="showModalCreateUser()"><i class="fas fa-plus"></i></button>
                                  </div>
                                  <div class="flex-item ">
                                      <button class="d-none btn btn-light"  data-toggle="tooltip" data-placement="top" title="Thông tin khách hàng" id="btnShowInfoUser" onclick="showInfoUser()"><i class="fas fa-angle-down "></i></button>
                                  </div>
                              </div>
                      </div>
                      <div class="collapse form-group" id="formInfoUser">
                          <div class="card ">
                              <div class="card-header">
                                  Thông tin khách hàng
                              </div>
                              <div class="card-body" style="padding: 0.25rem">
                                  <ul class="list-group list-group-flush">
                                      <li class="list-group-item" id="nameUser"></li>
                                      <li class="list-group-item" id="phoneUser"></li>
                                      <li class="list-group-item" id="addressUser"></li>
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
                  <input type="text" id="name-create" required autofocus placeholder="Họ và tên" value="" name="name"   class="form-control" />
              </div>
              <div class="form-group">
                  <div class="alert alert-danger d-none " id="error-name">
                  </div>
              </div>
              <div class="form-group">
                  <label for="regular1" class="control-label">Email</label>
                  <input type="text" id="email-create" required  placeholder="Email" value="" name="email" id="title"  class="form-control" />
              </div>
              <div class="form-group">
                  <label for="regular1" class="control-label">Số điện thoại <span class="color-red">*</span></label>
                  <input type="text"  id="phone-create"required placeholder="Số điện thoại" value="" name="phone" id="title"  class="form-control" />
              </div>
              <div class="form-group">
                  <div class="alert alert-danger d-none " id="error-phone">
                  </div>
              </div>
              <div class="form-group">
                  <label for="inputAddress">Tỉnh - Thành phố</label>
                  <select name="" required data-live-search="true" data-size="5" title="Vui lòng chọn tỉnh-thành phố" class="selectpicker province form-control" id="province-create" data-type="create" >
                  </select>
                  <div class="dis-none alert m-t-5 alert-danger" id="error-create-province">
                  </div>
               </div>
               <div class="form-group dis-none form-district-create" >
                  <label for="inputAddress">Quận - Huyện</label>
                  <select name="" required data-live-search="true" data-size="5" title="Vui lòng chọn quận-huyện" class="selectpicker district form-control" id="district-create" data-type="create" >
                  </select>
                  <div class="dis-none alert m-t-5 alert-danger" id="error-create-district">
                  </div>
               </div>
               <div class="form-group dis-none form-ward-create">
                  <label for="inputAddress">Xã, phường</label>
                  <select name="" required data-live-search="true" data-size="5" title="Vui lòng chọn xã-phường" class="selectpicker ward ward-create form-control" id="ward-create" data-type="create">
                  </select>
                  <div class="dis-none alert m-t-5 alert-danger" id="error-create-ward">
                  </div>
               </div>
               <div class="form-group">
                  <label for="inputAddress">Địa chỉ</label>
                  <input type="text"  name="address" required  class="form-control" id="address-create" placeholder="Số nhà, khu, thôn">
                  <div class="dis-none alert m-t-5 alert-danger" id="error-create-address">
                  </div>
               </div>
              
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Thoát</button>
            <button type="button" class="btn btn-primary" onclick="storeProfile(this)">Lưu</button>
          </div>
        </div>
      </div>
    </div>
                    </div>
                  </div>
                </div>
                
            </div>
    


  
  <!-- Tab panes -->
  

            <!-- Tab panes -->


@endsection 
@push('styles')

  <style>
    [contenteditable] {
        border: solid 1px lightgreen;
        padding: 5px;
        border-radius: 3px;
      }
      
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
  <script src="{{ asset('js/sale.js') }}"></script>
  <script src="{{ asset('js/address.js') }}"></script>
  <script>
    $('#user-select').on('change', function() {
        code = $(this).val();
        $.ajax({
            type: "post",
            dataType: "json",
            url: "{{ route('admin.user.show') }}",
            data:{
                code:code
            },
            success: function(response) {
                
                showInfoUser(response);
            },
            error: function(json) {
                
            },
        });
    });
    function storeProfile(e){
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
        // var arr=['name','phone','province','district','ward','address'];
        //         for(var i of arr){
        //         $("#" + "error-create-"+i).addClass('dis-none');
        //         $("#" + i+"-create").removeClass('input-validation-error');
        //         }
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
                alertify.set('notifier', 'position', 'bottom-right');
                    alertify.success('Cập nhật thành công');
                $("#modalCreateUser .close").click();
            }
        });
    }
    var tabID = 1;

{{-- var view=<?php @include('backend.sale.content') ;?>; --}}
{{-- console.log(view); --}}
var arrTabID=[];
    function addTab(){

        tabID++;
        console.log(tabID);
        arrTabID.push(tabID);
        content='<li class="nav-item nav-tab" id="nav-'+tabID+'">'+
            '<a class="nav-link" href="#order-'+tabID+'" role="tab" data-toggle="tab">'+
            '<span>Đơn hàng '+tabID+' </span>'+
            '<span class="badge badge-light" onclick="removeTab('+tabID+')"  title="Hủy đơn hàng"><i class="fas fa-times"></i></span>'+
        '</li>';
        $('#tab-list').append(content);
        content='<div class="tab-pane fade" id="order-'+tabID+'" role="tabpanel" aria-labelledby="profile-tab">';
        content+=<?php @include('backend.sale.content');?>
        content+='</div>';
        console.log(content);
        {{--  $('#tab-content').append('<div class="tab-pane fade" id="order-'+tabID+'" role="tabpanel" aria-labelledby="profile-tab">'+tabID+'</div>');  --}}
        $('#tab-content').append(content);
    }
    function removeTab(id){
        var tabs=$("#nav-tab");
        $('#nav-'+id).remove();
        $('#order-'+id).remove();

        var k=id;
        const index = arrTabID.indexOf(id);
        if (index > -1) {
            arrTabID.splice(index, 1);
          }
        var newArr=[];
        for(var i of arrTabID){
            if(i>k){
                j=i-1;
            }
            newArr.push(j);
            $("#nav-"+i).attr('id','nav-'+j);
            $("#order-"+i).attr('id','order-'+j);
            $("#nav-"+j).find("a").attr('href','#order-'+j);
            var content='<span>Đơn hàng '+j+' </span><span class="badge badge-light" onclick="removeTab('+j+')"  title="Hủy đơn hàng"><i class="fas fa-times"></i></span>'
            $("#nav-"+j).find("a").html(content);

        }
        arrTabID=newArr;
        tabID--;
        {{--  tabID=arrTabID.length++;  --}}
        //display first tab
        {{--  resetTab();  --}}
        {{--  tabFirst.tab('show');  --}}
    }
    $('#tab-list').on('click', '.close', function() {
        var tabID = $(this).parents('a').attr('href');
        console.log(tabID);
        $('#nav-'+tabID).remove();
        {{--  $(tabID).remove();  --}}

        //display first tab
        var tabFirst = $('#tab-list a:first');
        resetTab();
        tabFirst.tab('show');
    });

    var list = document.getElementById("tab-list");

var editHandler = function() {
  var t = $(this);
  t.css("visibility", "hidden");
  $(this).prev().attr("contenteditable", "true").focusout(function() {
    $(this).removeAttr("contenteditable").off("focusout");
    t.css("visibility", "visible");
  });
};

$(".edit").click(editHandler);

  </script>
@endpush

