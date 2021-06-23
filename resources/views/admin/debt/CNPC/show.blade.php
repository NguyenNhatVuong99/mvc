

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
                  <div id="reportrange-PT" data-cat="PT" class="float-right datetimepicker datetime-PT" onapply="changeDateTimePT(e)" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 24%; margin-left:20px">
                     <i class="fa fa-calendar" style="color: #007DFF"></i>&nbsp;
                     <span id="date-PT"></span> <i class="fa fa-caret-down" style="color: #007DFF"></i>
                  </div>
                  <a class="btn btn-primary btn-sm float-right mr-2" href="{{ route('admin.CNPC') }}"> Quay lại</a>
               </div>
               <div class="card-body">
                  <h4 class="m-0 font-weight-bold text-primary " style="text-align: center">Chi tiết công nợ phải chi</h4>

                  <div class="table-responsive">
                     <input id="supplier_id" type="hidden" value="{{ $supplier->id }}">
                     <table style="color: #333" class="table  table-hover"   cellspacing="0">
                        <thead>
                            <tr>

                              <th rowspan="2" style=" text-align: center;vertical-align: middle;">STT</th>
                              <th colspan="2" style=" text-align: center;vertical-align: middle;">Chứng từ</th>
                              <th colspan="2" style=" text-align: center;vertical-align: middle;">Hóa đơn</th>
                              <th rowspan="2" style=" text-align: center;vertical-align: middle;">Diễn giải</th>
                              <th colspan="2" style=" text-align: center;vertical-align: middle;">Số phát sinh</th>
                              <th colspan="2" style=" text-align: center;vertical-align: middle;">Số dư</th>
                            </tr>
                            <tr>
                              <th style=" text-align: center;vertical-align: middle;">Số hiệu</th>
                              <th style=" text-align: center;vertical-align: middle;">Ngày tháng</th>
                              <th style=" text-align: center;vertical-align: middle;">Ký hiệu</th>
                              <th style=" text-align: center;vertical-align: middle;">Số</th>
                              <th style=" text-align: center;vertical-align: middle;">Nợ</th>
                              <th style=" text-align: center;vertical-align: middle;">Có</th>
                              <th style=" text-align: center;vertical-align: middle;">Nợ</th>
                              <th style=" text-align: center;vertical-align: middle;">Có</th>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td style="font-weight:bold">Mã số: {{ $supplier->code }}</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td style=" font-weight:bold">Số dư đầu kỳ:</td>
                                
                                <td></td>
                                <td></td>
                                <td style=" font-weight:bold" id="no_dau_ky"></td>
                                <td style=" font-weight:bold" id="co_dau_ky"></td>
                            </tr>
                          </thead>
                          <tbody id="tbody">
                          </tbody>
                          <tfoot>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th style="">Cộng</th>
                                <th style="" id="no_phat_sinh"></th>
                                <th style="" id="co_phat_sinh"></th>
                                <th style=""></th>
                                <th style=""></th>
                              </tr>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th style="">Số dư cuối kỳ</th>
                                <th style=""></th>
                                <th style=""></th>
                                <th style="" id="no_cuoi_ky"></th>
                                <th style="" id="co_cuoi_ky"></th>
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
{{--  
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">
--}}
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
{{--  <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />  --}}
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
    <script>
        function goBack() {
            window.history.back()
          }
        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
          });
          
          var start = moment().format('L');
        var end = moment().format('L');
        var supplier_id=$("#supplier_id").val();
        getDataCNPC(start, end, 'CNPC',supplier_id);
        //  getDataCNPC(start, end, 'CNPC'); 
        $('#reportrange-PT').on('apply.daterangepicker', (e, picker) => {
            var cat = "CNPC";
            var item = $('#reportrange-PT span').text();
            var arr = item.split(' - ');
            var start = arr[0];
            var end = arr[1];
            getDataCNPC(start, end, cat,supplier_id);
        });
          function getDataCNPC(start, end, cat,supplier_id) {
            $.ajax({
                type: 'post',
                dataType: 'json',
                url: route('admin.debt.show'),
                data: {
                    supplier_id: supplier_id,
                    start:start,
                    end:end,
                    cat:cat
                },
                success: function(result) {
                  $("#no_dau_ky").text(result.dauky['debit']);
                  $("#co_dau_ky").text(result.dauky['credit']);
                  $("#no_phat_sinh").text(result.phatsinh['debit']);
                  $("#co_phat_sinh").text(result.phatsinh['credit']);
                  $("#no_cuoi_ky").text(result.cuoiky['debit']);
                  $("#co_cuoi_ky").text(result.cuoiky['credit']);
                  new AutoNumeric("#no_dau_ky", {
                    decimalPlaces: '0'
                });
                  new AutoNumeric("#co_dau_ky", {
                    decimalPlaces: '0'
                });
                  new AutoNumeric("#no_cuoi_ky", {
                    decimalPlaces: '0'
                });
                  new AutoNumeric("#co_cuoi_ky", {
                    decimalPlaces: '0'
                });
                  new AutoNumeric("#no_phat_sinh", {
                    decimalPlaces: '0'
                });
                  new AutoNumeric("#co_phat_sinh", {
                    decimalPlaces: '0'
                });
                  detail_phatsinh=result.detail_phatsinh;
                  if(detail_phatsinh!=null){
                    var content="";
                    var stt=1;
                    for(var item of detail_phatsinh){
                      {{--  console.log(item['dat']);  --}}
                      var date =moment(item['date']).format("DD/MM/YYYY");
                      console.log(date);
                      content+='<tr>'+
                        '<td>'+stt+'</td>'+
                        '<td>'+item['document']+'</td>'+
                        '<td>'+date+'</td>'+
                        '<td></td>'+
                        '<td></td>';
                        if(item['debit']==null){
                          item['debit']='';
                        }
                        if(item['credit']==null){
                          item['credit']='';
                        }
                        if(item['note']==null){
                          item['note']='';
                        }
                        content+='<td>'+item['note']+'</td>'+
                        '<td id="debit_'+stt+'">'+item['debit']+'</td>'+
                        '<td id="credit_'+stt+'">'+item['credit']+'</td>'+
                        '<td></td>'+
                        '<td></td>'+
                        '</tr>';
                        stt++;
                    }
                    $("#tbody").html(content);
                    for(var i=1 ;i<=stt; i++){
                      new AutoNumeric("#debit_" + i, {
                        decimalPlaces: '0'
                      });
                        new AutoNumeric("#credit_" + i, {
                          decimalPlaces: '0'
                      });
                    }
                  }
                  
                },
                error: function(json) {
                    if (json.status === 404) {
                        var errors = json.responseJSON;
                    }
                }
            });
        }

        </script>
@endpush

