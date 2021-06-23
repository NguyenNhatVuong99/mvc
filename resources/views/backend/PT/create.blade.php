@extends('backend.layouts.master') @section('main-content')

<div class="card">
  <div class="card-header py-3">
    <h4 class="m-0 font-weight-bold text-primary float-left"> Phiếu nhập</h4>
    <a onclick="store()" href="#"  id="btn-save" class="disabled btn btn-primary float-right" data-toggle="tooltip" data-placement="bottom" style="margin-left: 20px;" title="Lưu"><i class="fas fa-save"></i>Lưu</a>
    <a onclick="store()" href="#" id="btn-savePrint"class="disabled btn btn-primary  float-right" data-toggle="tooltip" data-placement="bottom" title="Lưu và in"><i class="fas fa-print"></i> Lưu và in</a>
  </div>
    <div class="card-body row">
        <div class="col-md-8 col-12">
            <div class="card m-b-10">
                <div class="card-body">
                    <div class="form-group">
                        <select id="select-product" placeholder="Nhập tên hoặc mã sản phẩm">
                            <option value="">Chọn nhà cung cấp</option>
                            @foreach ($products as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>

                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table style="color: #333;" class="table table-bordered" id="myTable" width="100%" cellspacing="0">
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
                        <select id="select-supplier" placeholder="Chọn nhà cung cấp">
                            <option value="">Chọn nhà cung cấp</option>
                            @foreach ($suppliers as $item)
                            <option style="cursor: pointer;" value="{{ $item->id }}">{{ $item->name }}</option>

                            @endforeach
                        </select>
                    </div>
                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                        <label for="regular1" class="control-label">Ngày tạo phiếu</label>
                        <input type="text" id="datetimepicker-default" class="form-control" />
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
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-6">
                                    Thanh toán:
                                </div>
                                <div class="col-6">
                                    <input type="text" class="form-control" onkeyup="updatePayment()" value="0" id="payment" />
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
                    </ul>
                    <div class="form-group">
                        <label for="inputTitle" class="col-form-label">Chi chú<span class="text-danger">*</span></label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" style="height: 80px;"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection @push('styles')
  <style>
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
  <link href="http://propeller.in/docs/css/example-docs.css" type="text/css" rel="stylesheet" />

  <!-- Propeller card (CSS for helping component example file)-->
  {{-- <link href="http://propeller.in/components/card/css/card.css" type="text/css" rel="stylesheet" /> --}}

  <!-- Propeller typography -->
  {{-- <link href="http://propeller.in/components/typography/css/typography.css" type="text/css" rel="stylesheet" /> --}}

  <!-- Google Icon Font -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
  <link href="http://propeller.in/components/icon/css/google-icons.css" type="text/css" rel="stylesheet" />

  <!-- Propeller textbox -->
  <link href="http://propeller.in/components/textfield/css/textfield.css" type="text/css" rel="stylesheet" />

  <!-- Propeller bootstrap datetimepicker -->
  <link href="{{ asset('propeller/css/bootstrap-datetimepicker.css') }}" type="text/css" rel="stylesheet" />
  <link href="{{ asset('propeller/css/pmd-datetimepicker.css') }}" type="text/css" rel="stylesheet" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
@endpush 
@push('scripts')
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

  <!-- Bootstrap js -->
  <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

  <!-- Propeller Global js -->
  <script src="http://propeller.in/components/global/js/global.js"></script>

  <!-- Textfield js -->
  <script type="text/javascript" src="http://propeller.in/components/textfield/js/textfield.js"></script>

  <!-- Datepicker moment with locales -->

  <!-- Propeller Bootstrap datetimepicker -->
  <script type="text/javascript" src="http://propeller.in/components/textfield/js/textfield.js"></script>
  <!-- Datepicker moment with locales -->
  <script type="text/javascript" language="javascript" src="{{ asset('propeller/js/moment-with-locales.js') }}"></script>
  <script type="text/javascript" language="javascript" src="{{ asset('propeller/js/bootstrap-datetimepicker.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
  <script>
      $(document).ready(function () {
          $("#select-supplier").selectize({});

          $("#select-product").selectize({
              onChange: function (val) {
                  addProduct(val);
              },
          });
      });
      var array_product = [];
      var total_quantity=0;
      function addProduct(id) {
          $.ajaxSetup({
              headers: {
                  "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
              },
          });
          $.ajax({
              type: "get",
              dataType: "json",
              url: "/admin/product/" + id,

              success: function (result) {
                  content = "";
                  content +=
                      '<tr id="tr_' +
                      result.id +
                      '">' +
                      "<td>" +
                      result.name +
                      "</td>" +
                      '<td class="qty" data-title="Qty">' +
                      '<div class="input-group">' +
                      '<div class="button minus">' +
                      '<button type="button" class="btn btn-primary btn-number" data-type="minus" onclick="minusQuantity(' +
                      result.id +
                      ')">' +
                      '<i class="fas fa-minus"></i>' +
                      "</button>" +
                      "</div>" +
                      '<input type="text"  class="input-number" id="quantity_' +
                      result.id +
                      '" data-min="1" data-max="100" value="1">' +
                      '<div class="button plus">' +
                      '<button type="button" class="btn btn-primary btn-number" onclick="plusQuantity(' +
                      result.id +
                      ')" >' +
                      '<i class="fas fa-plus"></i>' +
                      "</button>" +
                      "</div>" +
                      "</div>" +
                      "</td>" +
                      '<td><input type="text" class="form-control" data-default=' +
                      result.cost_price +
                      ' data-type="cost_price" data-id=' +
                      result.id +
                      ' onkeyup="updatePrice(this)" id="cost_price_' +
                      result.id +
                      '" value="' +
                      result.cost_price +
                      '"></td>' +
                      '<td id="amount_' +
                      result.id +
                      '">' +
                      result.cost_price +
                      "</td>" +
                      '<td><input type="text" class="form-control" data-default=' +
                      result.price +
                      ' data-type="price" data-id=' +
                      result.id +
                      ' onkeyup="updatePrice(this)" id="price_' +
                      result.id +
                      '" value="' +
                      result.price +
                      '"></td>' +
                      '<td><button class="btn btn-danger btn-sm "  onclick=removeTr(' +
                      result.id +
                      ') data-id= style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fas fa-trash-alt"></i></button></td>';
                  ("</tr>");
                  $("#table-product").append(content);
                  var object = {
                      id: result.id,
                      quantity: 1,
                      cost_price: result.cost_price,
                      amount: result.cost_price,
                      price: result.price,
                  };
                  array_product.push(object);
                  $("#btn-save").removeClass('disabled');
                  $("#btn-savePrint").removeClass('disabled');
                  totalPrice();
              },
              error: function (json) {
                  if (json.status === 404) {
                      var errors = json.responseJSON;
                      $(".error_coupon").text(errors["message"]);
                  }
              },
          });
      }

      function plusQuantity(id) {
          var number = $("#quantity_" + id).val();
          number++;
          $("#quantity_" + id).attr("value", parseInt(number));
          updateAmount(id);
      }

      function minusQuantity(id) {
          var number = $("#quantity_" + id).val();
          if (number > 1) {
              number--;
              $("#quantity_" + id).attr("value", parseInt(number));
              updateAmount(id);
          }
      }
      
      function updateAmount(id) {
          var quantity = $("#quantity_" + id).val();
          var cost_price = $("#cost_price_" + id).val();
          var amount = quantity * cost_price;
          $("#amount_" + id).text(amount);
          let product = array_product.find((i) => {
              return i.id === id;
          });

          product.quantity = quantity;
          product.amount = amount;
          console.log(array_product);
          totalPrice();
      }
      function totalPrice() {
          var sum = 0;
          array_product.forEach(function (item) {
              sum += item.amount;
              total_quantity+=item.quantity;
          });
        
          if(sum==0){
            $("#debt").text(sum);
            $("#btn-save").addClass('disabled');
            $("#btn-savePrint").addClass('disabled');

          }
          $("#total_price").text(sum);
          if($("#debt").text()!=0){
            updatePayment();
          }else{
            $("#payment").val(sum);

          }

      }
      function removeTr(id) {
          $("#tr_" + id).remove();
          $.each(array_product, function (i, el) {
              if (this.id == id) {
                  array_product.splice(i, 1);
              }
          });
          totalPrice();
      }
      function updatePrice(e) {
          var type = $(e).data("type");
          var id = $(e).data("id");
          var price_default = $(e).data("default");
          var value = $(e).val();
          if (!isNaN(value)) {
              console.log(value);
              let product = array_product.find((i) => {
                  return i.id === id;
              });
              if (type == "cost_price") {
                  product.cost_price = value;
                  updateAmount(id);
              } else {
                  product.price = value;
              }
          } else {
              $(e).val(price_default);
          }
      }
      function updatePayment() {
          var payment = $('#payment').val();
          var total = $("#total_price").text();
          if (!isNaN(payment) && payment < total && payment % 1000 == 0) {
              $('#payment').val(payment);
              $("#debt").text(total - payment);
          } else {
              $('#payment').val(total);
              $("#debt").text(0);
          }
      }
      var dateNow = new Date();

      $("#datetimepicker-default").datetimepicker({
          defaultDate: dateNow,
      });
      
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      function store(){
        $.ajax({
          type: 'post',
          dataType: 'json',
          url: '/admin/receipt-stock',
          data: {
              supplier:$("#select-supplier").val(),
              date:$("#datetimepicker-default").val(),
              note:$("#note").val(),
              total:$("#total_price").text(),
              quantity:total_quantity,
              payment:$("#payment").val(),
              debt:$("#debt").text(),
              category:"Phiếu nhập",
              array:array_product,
          },
          success: function(result) {
              {
                  alertify.set('notifier', 'position', 'bottom-right');
                  alertify.success('Cập nhật thành công');
                  // console.log(result);
                  
              }
          }
        });
      }
  </script>

@endpush
