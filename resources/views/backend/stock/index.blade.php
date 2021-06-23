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
      <h6 class="m-0 font-weight-bold text-primary float-left">Coupon List</h6>
      {{--  <a href="{{route('coupon.create')}}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="Add User"><i class="fas fa-plus"></i> Add Coupon</a>  --}}
    </div>
    <div class="card-body">
      <div class="table-responsive">
        @if(count($stocks)>0)
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>STT</th>
              <th>Mã sản phẩm</th>
              <th>Sản phẩm</th>
              <th>Số lượng</th>
              <th>Vốn tồn kho</th>
              <th>Giá trị tồn</th>
            </tr>
          </thead>
          <tbody>
            @foreach($stocks as $key=> $item)   
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$item->product->code}}</td>
                    <td>{{$item->product->name}}</td>
                    <td>{{$item->quantity}}</td>
                    <td>@php
                      echo number_format($item->capital_inventory);
                  @endphp vnđ
                </td>
                    <td>@php
                      echo number_format($item->value_inventory);
                  @endphp vnđ
                </td>
               
                </tr>  
            @endforeach
          </tbody>
        </table>
        @else 
          <h6 class="text-center">No item found!!! Please create coupon</h6>
        @endif
      </div>
    </div>
</div>
@endsection

@push('styles')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
  <style>
      div.dataTables_wrapper div.dataTables_paginate{
          display: none;
      }
      .zoom {
        transition: transform .2s; /* Animation */
      }

      .zoom:hover {
        transform: scale(3.2);
      }
  </style>
@endpush

@push('scripts')

  <!-- Page level plugins -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

  <!-- Page level custom scripts -->
  
    <script>
          $('#myTable').DataTable();
     
    </script>
      
    
@endpush