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
      <h4 class="m-0 font-weight-bold text-primary float-left">Sổ quỹ</h4>
     
    </div>
    <div class="card-body">
      <div id="reportrange" class="float-left" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 22%">
         <i class="fa fa-calendar"></i>&nbsp;
         <span id="date"></span> <i class="fa fa-caret-down"></i>
     </div>
    </div>
    <div class="card-body">
     
      <div class="row">
         
        
        <div class="col-xl-12 col-lg-12">
           <table class="table table-bordered"  id="myTable" width="100%" cellspacing="0">
              <thead>
                 <tr>
                    <th>STT</th>
                    <th>Mã phiếu</th>
                    <th>Ngày tạo</th>
                    <th>Người thu/nhận</th>
                    <th>Loại phiếu</th>
                    <th>Số tiền</th>
                    <th>Hình thức</th>
                    <th>Ghi chú</th>
                 </tr>
              </thead>
              <tbody>
                 @if(count($receipts)>0) 
                 @php  
                 $STT=1 
                 @endphp 
                 
                 @foreach($receipts as $item) 
                 @php
                 $category=DB::table('category_receipts')->where('id',$item->cat_id)->first();
              $user=DB::table('users')->where('id',$item->user_id)->first();
                 
                 @endphp
                 <tr>
                    <td>{{$STT}}</td>
                    <td>{{$item->code}}</td>
                    <td>{{$item->date}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $item->total }}</td>
                    <td>{{ $item->payments }}</td>
                    <td>{{ $item->note }}</td>
                    @php
                        $STT++;
                    @endphp
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
      
    </div>
</div>
@endsection

@push('styles')

   <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

  <link href="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
  <style>
      div.dataTables_wrapper div.dataTables_paginate{
          display: none;
      }
  </style>
@endpush

@push('scripts')
{{--  
<script src="{{asset('backend/js/website.js')}}"></script>
<script src="{{asset('backend/js/daterangepicker.js')}}"></script>  --}}

<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="{{ asset('backend/js/daterangepicker.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/js/website.js') }}"></script>
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
      $('#myTable').DataTable();
  });
  $(function() {
    
   var start = moment().subtract(29, 'days');
   var end = moment();

   function cb(start, end) {
       $('#reportrange span').html(start.format('L') + ' - ' + end.format('L'));
   }

   $('#reportrange').daterangepicker({
       startDate: start,
       endDate: end,
       ranges: {
          'Hôm nay': [moment(), moment()],
          'Hôm qua': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          '7 ngày trước': [moment().subtract(6, 'days'), moment()],
          '30 ngày trước': [moment().subtract(29, 'days'), moment()],
          'Tháng này': [moment().startOf('month'), moment().endOf('month')],
          'Tháng trước': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
       }
   }, cb);

   cb(start, end);

});
$('#reportrange').on('apply.daterangepicker', (e, picker) => {
   // var start=$('input[name=daterangepicker_start]').val();
   // var end=$('input[name=daterangepicker_end]').val();
   var item=$('#reportrange span').text();
   var arr=item.split(' - ');
   var start=arr[0];
   var end=arr[1];
   console.log(end);

});

   
  </script>
@endpush