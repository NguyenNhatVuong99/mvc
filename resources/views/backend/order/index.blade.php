@extends('backend.layouts.master')

@section('main-content')
 <!-- DataTales Example -->
 <div class="card shadow mb-4">
     <div class="row">
         <div class="col-md-12">
            @include('backend.layouts.notification')
         </div>
     </div>
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary float-left">Đơn hàng</h6>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-xl-12 col-lg-12">
          
          <div class="card">
            <div class="card-header">
         
              <div class="btn-group " role="group" aria-label="Basic outlined example">
                @foreach ($statuses as $item)
                <button type="button"  class="btn btn-collapse btn-primary m-r-3" data-toggle="collapse" data-target="#collapse_{{ $item->status_id }}" style="border-radius:10px">{{ $item->status->name }}
                  <span class="badge badge-light">{{ $item->count }}</span>
                </button>	
                @endforeach   
                                
                </div>
            </div>
            <div class="card-body">
              <div class="bs-example">
                <div class="accordion" id="accordionExample">
                  @foreach ($statuses as $item)
                  <div class="card">
                      @php
                        $orders=DB::table('orders')->where('status_id',$item->status_id)->get();
                      @endphp
                    <div id="collapse_{{ $item->status_id }}" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                      <div class="card-body">
                        <table class="table table-bordered myTable"  width="100%" cellspacing="0">
                        <thead>
                            <tr>
                              <th>STT</th>
                              <th>Mã đơn hàng</th>
                              <th>Số lượng</th>
                              <th>Thành tiền</th>
                              <th>Thời gian giao</th>
                              <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($orders)>0) @php $arr=array(); $STT=1 @endphp 
                            @foreach($orders as $order) 
                            <tr>
                              <td>{{$STT}}</td>
                              <td><a href="{{route('user.order.show',$order->order_code)}}" >
                                {{$order->order_code}}</td>
                              <td>{{$order->quantity}}</td>
                              <td>{{number_format($order->total_price)}}</td>
                              <td>{{ $order->delivery_time }}</td>
                              
                              {{--  <td class="status_{{ $order->order_code }}" id="status_{{$status[0]}}">{{ $status[1] }}</td>  --}}
                              <td class="action_{{ $order->order_code }}">
                                  <a href="{{route('user.order.show',$order->order_code)}}" class="btn btn-warning btn-sm float-left mr-1" style="height: 30px; width: 30px; border-radius: 50%;" data-toggle="tooltip" title="view" data-placement="bottom">
                                  <i class="fas fa-eye"></i>
                                </a>
                               

                              </td>
                            </tr>
                            @endforeach @else
                            <td colspan="8" class="text-center">
                              <h4 class="my-4">You have no order yet!! Please order some products</h4>
                            </td>
                            @endif
                        </tbody>
                        </table>
                      </div>
                  </div>
                  @endforeach
                    
                    </div>
                   
                </div>
            </div>
              
            </div>
          </div>
  


    
        </div>
     </div>
      {{--  <div class="table-responsive">
        @if(count($orders)>0)
        <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>STT</th>
              <th>Order </th>
              <th>Name</th>
              <th>Email</th>
              <th>Quantity</th>
              <th>Total Amount</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
         
          <tbody>
            @foreach($orders as $order)  
            
                <tr>
                    <td>{{$order->id}}</td>
                    <td>{{$order->order_number}}</td>
                    <td>{{$order->name}}</td>
                    <td>{{$order->email}}</td>
                    <td>{{$order->quantity}}</td>
                    <td>{{number_format($order->total_amount)}} vnđ</td>
                    <td>
                        @if($order->status=='new')
                          <span class="badge badge-primary">{{$order->status}}</span>
                        @elseif($order->status=='process')
                          <span class="badge badge-warning">{{$order->status}}</span>
                        @elseif($order->status=='delivered')
                          <span class="badge badge-success">{{$order->status}}</span>
                        @else
                          <span class="badge badge-danger">{{$order->status}}</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{route('order.show',$order->id)}}" class="btn btn-warning btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="view" data-placement="bottom"><i class="fas fa-eye"></i></a>
                        <a href="{{route('order.edit',$order->id)}}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="edit" data-placement="bottom"><i class="fas fa-edit"></i></a>
                        <form method="POST" action="{{route('order.destroy',[$order->id])}}">
                          @csrf 
                          @method('delete')
                              <button class="btn btn-danger btn-sm dltBtn" data-id={{$order->id}} style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </td>
                </tr>  
            @endforeach
          </tbody>
        </table>
        @else
          <h6 class="text-center">No orders found!!! Please order some products</h6>
        @endif
      </div>  --}}
    </div>
</div>
@endsection

@push('styles')
  <link href="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
  <style>
      div.dataTables_wrapper div.dataTables_paginate{
          display: none;
      }
      .btn:last-child{
        margin-right:0;
      }
      .active:active {
        color: red;
      }
      
  </style>
@endpush

@push('scripts')

  <!-- Page level plugins -->
  <script src="{{asset('backend/vendor/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="{{asset('backend/js/demo/datatables-demo.js')}}"></script>
  <script>
    
  </script>
  <script>
    $(document).ready(function () {
      $('.myTable').DataTable();
  });
    $("#collapse_1").addClass('show');
    
    $('.btn-collapse').on('change', function () {
      console.log('ok');
  });

  $('.collapse').on('hidden.bs.collapse', function () {
      $(this).prev().removeClass('active-acc');
  });
  </script>
@endpush