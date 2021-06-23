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
                        <select id="supplier-select" class="selectpicker form-control" title="Chọn nhà cung cấp" data-live-search="true" placeholder="Chọn nhà cung cấp" data-size="5" data-actions-box="true">
                            @foreach ($suppliers as $item)
                                <option  value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
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

@endsection @push('styles')
\
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
  <script src="{{ asset('backend/js/receipt-stock.js') }}"></script>
@endpush
