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
      <h4 m-0 font-weight-bold text-primary float-left>
        <a class="btn btn-primary  " data-toggle="collapse" href="#collapseDebt1" data-href="collapseDebt1" role="button" onclick="collapseDebt(this)"  aria-controls="multiCollapseExample1">CÔNG NỢ PHẢI THU</a>
        <button class="btn btn-primary " type="button" data-toggle="collapse" data-href="collapseDebt2"  onclick="collapseDebt(this)"  data-target="#collapseDebt2" aria-expanded="false" aria-controls="multiCollapseExample2">CÔNG NỢ PHẢI CHI</button>
      </h4>
    </div>
    <!-- Button trigger modal -->

<!-- Modal -->

    <div class="card-body">
      <div class="table-responsive">
        
          <div class="row">
            <div class="col">
              <div class="collapse panel-collapse show collapse-debt" id="collapseDebt1">
                <div class="card">
                  <div class="card-header">
                    <h4 class="m-0 font-weight-bold text-primary float-left"> Công nợ phải thu</h4>
                    <div id="reportrange" class="float-left" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 24%; margin-left:20px">
                      <i class="fa fa-calendar" style="color: #007DFF"></i>&nbsp;
                      <span id="date"></span> <i class="fa fa-caret-down" style="color: #007DFF"></i>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      {{--  @if(count($CNPT)>0)  --}}
                      <table style="color: #333" class="table table-bordered" id="myTable"  width="100%" cellspacing="0">
                        <thead>
                          <tr>
                            <th rowspan="2" style=" text-align: center;vertical-align: middle;">Mã khách hàng</th>
                            <th rowspan="2" style=" text-align: center;vertical-align: middle;">Tên khách hàng</th>
                            <th rowspan="2" style=" text-align: center;vertical-align: middle;">Địa chỉ </th>
                            <th colspan="2" style=" text-align: center;vertical-align: middle;">Đầu kỳ</th>
                            <th colspan="2" style=" text-align: center;vertical-align: middle;">Phát sinh</th>
                            <th colspan="2" style=" text-align: center;vertical-align: middle;">Cuối kỳ</th>
                          </tr>
                          <tr>
                            <th style=" text-align: center;vertical-align: middle;">Nợ</th>
                            <th style=" text-align: center;vertical-align: middle;">Có</th>
                            <th style=" text-align: center;vertical-align: middle;">Nợ</th>
                            <th style=" text-align: center;vertical-align: middle;">Có</th>
                            <th style=" text-align: center;vertical-align: middle;">Nợ</th>
                            <th style=" text-align: center;vertical-align: middle;">Có</th>
                            
                          </tr>
                        </thead>
                        <tfoot>
                          <tr>
                            <td colspan="3" class="font-weight-bold text-align-center">TỔNG CỘNG</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                          </tr>
                        </tfoot>
                        {{--  <tbody>
                          @php
                            $STT=1;
                          @endphp
                          @foreach($PC as $item)   
                            @php 
                            $category=DB::table('category_receipts')->where('id',$item->child_cat_id)->first();
                            $user=DB::table('users')->where('id',$item->user_id)->first();
                            @endphp
                              <tr>
                                  <td>{{$STT}}</td>
                                  <td>{{$item->code}}</td>
                                  <td>{{$item->date}}
                                  </td>
                                  <td>{{ $user->name }}</td>
                                  <td>@php
                                    echo number_format($item->total);
                                @endphp vnđ
                              </td>
                                  <td>{{ $category->name }}</td>
                                  
                                  <td>{{ $item->note }}</td>
                                  
                                </td>
                                  
                                  <td>
                                    
                                      <a data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="Chi tiết" data-placement="bottom"><i class="fas fa-eye"></i></a>
                                  <form method="POST" action="{{route('PC.destroy',[$item->id])}}">
                                    @csrf 
                                    @method('delete')
                                        <button class="btn btn-danger  dltBtn" data-id={{$item->id}} style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fas fa-trash-alt"></i></button>
                                      </form>
                                  </td>
                                
                              </tr>
                              <tr>
                                <td class="zeroPadding">
                                  <div class="collapse out" id="collapseExample">Should be collapsed</div>
                                </td>
                              </tr>
                             
                              
                              @php
                                $STT++;
                              @endphp
                          @endforeach
                        </tbody>  --}}
                      </table>
                      {{--  @else
                        <h6 class="text-center">Dữ liệu trống</h6>
              
                      @endif  --}}
                    </div>
                  <div>
                
                </div>
              </div>
            </div>
          </div>
            <div class="row">
            <div class="col">
              <div class="collapse panel-collapse collapse-debt" id="collapseDebt2">
                <div class="card">
                  <div class="card-header">
                    <h4 class="m-0 font-weight-bold text-primary float-left"> Công nợ phải chi</h4>
                    <div id="reportrange" class="float-left" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 24%; margin-left:20px">
                      <i class="fa fa-calendar" style="color: #007DFF"></i>&nbsp;
                      <span id="date"></span> <i class="fa fa-caret-down" style="color: #007DFF"></i>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      {{--  @if(count($CNPC)>0)  --}}
                      <table style="color: #333" class="table table-bordered" id="myTable"  width="100%" cellspacing="0">
                        <thead>
                          <tr>
                            <th rowspan="2" style=" text-align: center;vertical-align: middle;">Mã khách hàng</th>
                            <th rowspan="2" style=" text-align: center;vertical-align: middle;">Tên khách hàng</th>
                            <th rowspan="2" style=" text-align: center;vertical-align: middle;">Địa chỉ </th>
                            <th colspan="2" style=" text-align: center;vertical-align: middle;">Đầu kỳ</th>
                            <th colspan="2" style=" text-align: center;vertical-align: middle;">Phát sinh</th>
                            <th colspan="2" style=" text-align: center;vertical-align: middle;">Cuối kỳ</th>
                          </tr>
                          <tr>
                            <th style=" text-align: center;vertical-align: middle;">Nợ</th>
                            <th style=" text-align: center;vertical-align: middle;">Có</th>
                            <th style=" text-align: center;vertical-align: middle;">Nợ</th>
                            <th style=" text-align: center;vertical-align: middle;">Có</th>
                            <th style=" text-align: center;vertical-align: middle;">Nợ</th>
                            <th style=" text-align: center;vertical-align: middle;">Có</th>
                            
                          </tr>
                        </thead>
                        <tbody id="tbody-CNPC">

                        </tbody>
                        <tfoot>
                          <tr>
                            <td colspan="3" class="font-weight-bold text-align-center">TỔNG CỘNG</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                          </tr>
                        </tfoot>
                        {{--  <tbody>
                          @php
                            $STT=1;
                          @endphp
                          @foreach($PC as $item)   
                            @php 
                            $category=DB::table('category_receipts')->where('id',$item->child_cat_id)->first();
                            $user=DB::table('users')->where('id',$item->user_id)->first();
                            @endphp
                              <tr>
                                  <td>{{$STT}}</td>
                                  <td>{{$item->code}}</td>
                                  <td>{{$item->date}}
                                  </td>
                                  <td>{{ $user->name }}</td>
                                  <td>@php
                                    echo number_format($item->total);
                                @endphp vnđ
                              </td>
                                  <td>{{ $category->name }}</td>
                                  
                                  <td>{{ $item->note }}</td>
                                  
                                </td>
                                  
                                  <td>
                                    
                                      <a data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="Chi tiết" data-placement="bottom"><i class="fas fa-eye"></i></a>
                                  <form method="POST" action="{{route('PC.destroy',[$item->id])}}">
                                    @csrf 
                                    @method('delete')
                                        <button class="btn btn-danger  dltBtn" data-id={{$item->id}} style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fas fa-trash-alt"></i></button>
                                      </form>
                                  </td>
                                
                              </tr>
                              <tr>
                                <td class="zeroPadding">
                                  <div class="collapse out" id="collapseExample">Should be collapsed</div>
                                </td>
                              </tr>
                             
                              
                              @php
                                $STT++;
                              @endphp
                          @endforeach
                        </tbody>  --}}
                      </table>
                      {{--  @else
                        <h6 class="text-center">Dữ liệu trống</h6>
              
                      @endif  --}}
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
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
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
  </style>
@endpush

@push('scripts')

  <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
  <script>
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
  
    function collapseDebt(e){
      var id=$(e).data('href');
      $('.collapse').slideUp(400);
      $("#"+id).slideDown(400);
    }
    var CNPC=<?php echo $CNPC ?>;
    getTableCNPC(CNPC);
    function getTableCNPC(CNPC){
      var content="";
      for(var item of CNPC){
        console.log(item.category);
      }
    }
    var start = moment().format('L');
      var end = moment().format('L');
      timeFilter(start,end);
      function timeFilter(start,end){
        $.ajax({
          type: 'post',
          dataType: 'json',
          url: '/admin/debt/time-filter',
          data: {
              start: start,
              end: end,
          },
          success: function(result) {
            console.log(result);
          }
          {{--  success: function(result) {
  
              var receipts = result.receipt;
              var content = "";
              console.log(receipts);
              if(receipts.length==0){
                  content+='<tr><td colspan="8"><h6 class="text-center">Dữ liệu trống</h6><td></tr>';
              }
              else{
                  for (var item of receipts) {
                      var receipt_date = moment(item.receipt_date).format('DD/MM/YYYY');
                      var created_at = moment(item.created_at).format('DD/MM/YYYY, h:mm:ss ');
                      if (item.note != null) {
                          var note = item.note;
                      }else{
                          var note='';
                      }
                      content += '<tr>' +
                          '<td>' +
                          '<a href="{{route("admin.receipt-stock.show",' + item.code + ')}}" >' +
                          item.code +
                          '</td>' +
                          '<td>' +
                          '<a href="{{route("admin.order.show",' + item.receipt + ')}}" >' +
                          item.receipt +
                          '</td>' +
                          '<td>' +
                          receipt_date +
                          '</td>' +
                          '<td>' +
                          item.child_cat.name +
                          '</td>' +
                          '<td>';
                      if (item.user_id != null) {
                          content += item.user.name;
      
                      } else {
                          content += item.supplier.name
      
                      }
                      content += '</td>' +
                          '<td>' +
                          item.total +
                          '</td>' +
                          '<td>'+
                          note +
                          '</td>' +
                          '<td>' +
                          created_at +
                          '</td>' +
                          '</tr>';
                  }
              }
              
              $("#tbody-PC").html(content);
  
          }  --}}
      });
      }
  </script>
@endpush