@extends('backend.layouts.master')

@section('title','Order Detail')

@section('main-content')
<div class="content">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-6">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header row">
                            <div class="col-sm-12 col-md-6">
                                <h5 class="card-title">Thông tin khách hàng</h5>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class=" col-sm-12 col-md-12">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item ">
                                        <div class="row">
                                            <div class="col-md-4">Khách hàng:</div>
                                        <div class="col-md-8">{{ $order->profile->name }}</div>
                                        </div>
                                    </li>
                                    
                                    <li class="list-group-item ">
                                        <div class="row">
                                            <div class="col-md-4">Số điện thoại:</div>
                                            <div class="col-md-8">{{ $order->profile->phone }}</div>
                                        </div>
                                    </li>
                                    
                                    <li class="list-group-item ">
                                        <div class="row">
                                            <div class="col-md-4">Địa chỉ:</div>
                                            <div class="col-md-8">
                                                @php
                                                    $info=$order->profile;
                                                    $ward = explode(',', $info->ward);
                                                    $district = explode(',', $info->district);
                                                    $province = explode(',', $info->province);
                                                    echo $info->address.", ".$ward[1].", ".$district[1].", ".$province[1]; 
                                                @endphp
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header row">
                            <div class="col-sm-12 col-md-6">
                                <h5 class="card-title">Thông tin hóa đơn</h5>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class=" col-sm-12 col-md-12">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item ">
                                        <div class="row">
                                            <div class="col-md-4">Mã hóa đơn:</div>
                                            <div class="col-md-8">{{ $order->order_code }}</div>
                                        </div>
                                    </li>
                                    <li class="list-group-item ">
                                        <div class="row">
                                            <div class="col-md-4">Thời gian giao:</div>
                                            <div class="col-md-8">
                                                {{ $order->delivery_time }}
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item ">
                                        <div class="row">
                                            <div class="col-md-4">Số lượng:</div>
                                            <div class="col-md-8">{{ $order->quantity }}</div>
                                        </div>
                                    </li>
                                    <li class="list-group-item ">
                                        <div class="row">
                                            <div class="col-md-4">Thành tiền:</div>
                                            <div class="col-md-8">
                                                @php
                                                    echo number_format($order->sub_price)." vnd";
                                                @endphp
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item ">
                                        <div class="row">
                                            <div class="col-md-4">Vận chuyển:</div>
                                            <div class="col-md-8">
                                                @php
                                                    echo number_format($order->fee_ship)." vnd";
                                                @endphp
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item ">
                                        <div class="row">
                                            <div class="col-md-4">Giảm giá:</div>
                                            <div class="col-md-8">
                                                @php
                                                    echo number_format($order->coupon)." vnd";
                                                @endphp
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item ">
                                        <div class="row">
                                            <div class="col-md-4">Tổng cộng:</div>
                                            <div class="col-md-8">
                                                @php
                                                    echo number_format($order->total_price)." vnd";
                                                @endphp
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item ">
                                        <div class="row">
                                            <div class="col-md-4">Tình trạng</div>
                                             <div class="col-md-8">
                                              <button type="button" class="btn btn-primary" >
                                                  {{ $order->statusOrder->name }}
                                                </button>
                                             </div>
                                        </div>
                                    </li>
                                  
                                  </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <table id="bootstrap-data-table" style="width:100% !important" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <td>STT</td>
                                    <th>Tên sản phẩm</th>
                                    <th>Hình ảnh</th>
                                    <th>Giá thành</th>
                                    <th>Số lượng</th>
                                    <th>Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                              @foreach ($details as $key=> $detail)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $detail->name }}</td>
                                    <td>
                                      @if($detail->photo)
                              @php 
                                $photo=explode(',',$detail->photo);
                                // dd($photo);
                              @endphp
                              <img src="{{$photo[0]}}" class="img-fluid zoom" style="max-width:80px" alt="{{$detail->photo}}">
                          @else
                              <img src="{{asset('backend/img/thumbnail-default.jpg')}}" class="img-fluid" style="max-width:80px" alt="avatar.png">
                          @endif
                                    </td>
                                    <td>
                                        @php
                                            echo number_format($detail->product_price)." vnd";
                                        @endphp
                                    </td>
                                    <td>
                                        {{ $order->quantity }}
                                    </td>
                                    <td>
                                        @php
                                            echo number_format($detail->price)." vnd";
                                        @endphp
                                    </td>
                                </tr>
                              @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
  
        </div>
    </div>
  </div>  
@endsection

@push('styles')
<style>
    .order-info,.shipping-info{
        background:#ECECEC;
        padding:20px;
    }
    .order-info h4,.shipping-info h4{
        text-decoration: underline;
    }

</style>
@endpush