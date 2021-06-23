

@section('title', 'CÂN ĐỐI KHOhbfsdbfbskj')
@extends('backend.layouts.master')
@section('main-content')
<!-- DataTales Example -->
<div class="card shadow mb-4">
<div class="row">
   <div class="col-md-12">
      @include('backend.layouts.notification')
   </div>
</div>
<!-- Button trigger modal -->
<!-- Modal -->
<div class="card-body">
<div class="table-responsive">
   <div class="row">
      <div class="col">
         <div class="collapse panel-collapse show collapse-stock" id="CNPC">
            <div class="card">
               <div class="card-header">
                  <h4 class="m-0 font-weight-bold text-primary float-left">Cân đối kho</h4>
                  {{--  <div id="reportrange-PN" data-cat="PN" class="float-right datetimepicker datetime-PN" onapply="changeDateTimePT(e)" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 24%; margin-left:20px">
                     <i class="fa fa-calendar" style="color: #007DFF"></i>&nbsp;
                     <span id="date-PT"></span> <i class="fa fa-caret-down" style="color: #007DFF"></i>
                  </div>  --}}
                  <div id="reportrange-PT" data-cat="PT" class="float-right datetimepicker datetime-PT" onapply="changeDateTimePT(e)" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 24%; margin-left:20px">
                    <i class="fa fa-calendar" style="color: #007DFF"></i>&nbsp;
                    <span id="date-PT"></span> <i class="fa fa-caret-down" style="color: #007DFF"></i>
                 </div>
                  <a class="btn btn-primary btn-sm float-right mr-2" href="{{route('admin.PN')}}"> Phiếu nhập kho</a>
                  <a class="btn btn-primary btn-sm float-right mr-2" href="{{route('admin.PX')}}">Cân đối kho</a>
               </div>
               <div class="card-body">
                  <div class="table-responsive">
                     <input class="auto-numeric" type="hidden">
                     <table style="color: #333" class="table table-bordered display" id="table"  width="100%" cellspacing="0">
                        <thead>
                           <tr>
                              <th  rowspan="2" class="text-center align-middle">STT</th>
                              <th rowspan="2" class="text-center align-middle">Sản phẩm</th>
                              <th rowspan="2" class="text-center align-middle">Đơn vị</th>
                              <th colspan="2" class="text-center align-middle">Đầu kỳ</th>
                              <th colspan="2" class="text-center align-middle">Nhập kho</th>
                              <th colspan="2" class="text-center align-middle">Xuất kho</th>
                              <th colspan="2" class="text-center align-middle">Cuối kỳ</th>
                           </tr>
                           <tr>
                                <th class="border-bottom text-center align-middle">Số lượng</th>
                                <th class="border-bottom text-center align-middle">Giá trị</th>
                                <th class="border-bottom text-center align-middle">Số lượng</th>
                                <th class="border-bottom text-center align-middle">Giá trị</th>
                                <th class="border-bottom text-center align-middle">Số lượng</th>
                                <th class="border-bottom text-center align-middle">Giá trị</th>
                                <th class="border-bottom text-center align-middle">Số lượng</th>
                                <th class="border-bottom text-center align-middle">Giá trị</th>
                           </tr>
                         </thead>
                          <tfoot>
                            <tr>
                                <th colspan="3" class="text-center align-middle">Tổng cộng</th>
                                <th class="text-center align-middle"></th>
                                <th class="text-center align-middle"></th>
                                <th class="text-center align-middle"></th>
                                <th class="text-center align-middle"></th>
                                <th class="text-center align-middle"></th>
                                <th class="text-center align-middle"></th>
                                <th class="text-center align-middle"></th>
                                <th class="text-center align-middle"></th>
                              </tr>
                          </tfoot>
                     </table>
                  </div>   
                  <div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

@endsection
@push('styles')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
    <style>
    .zeroPadding {
    padding: 0 !important;
    }
    .zoom {
    transition: transform .2s; /* Animation */
    }
    .zoom:hover {
    transform: scale(5);
    }
    @media print
    {
    html, body { height: auto; }
    .dt-print-table, .dt-print-table thead, .dt-print-table th, .dt-print-table tr {border: 0 none !important;}
    }
    </style>
@endpush