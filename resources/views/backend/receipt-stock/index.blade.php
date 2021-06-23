
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
        <a class="btn btn-primary  " data-toggle="collapse" href="#collapseStock1" data-href="collapseStock1" role="button" onclick="collapseStock(this)"  aria-controls="multiCollapseExample1">Phiếu xuất kho</a>
        <button class="btn btn-primary " type="button" data-toggle="collapse" data-href="collapseStock2"  onclick="collapseStock(this)"  data-target="#collapseStock2" aria-expanded="false" aria-controls="multiCollapseExample2">Phiếu nhập kho</button>
      </h4>
    </div>
    <!-- Button trigger modal -->

<!-- Modal -->

    <div class="card-body">
      <div class="table-responsive">
        
          <div class="row">
            <div class="col">
              <div class="collapse panel-collapse show collapse-stock" id="collapseStock1">
                <div class="card">
                  <div class="card-header">
                    <h4 class="m-0 font-weight-bold text-primary float-left"> Phiếu xuất kho</h4>
                    <a href="{{route('admin.receipt-stock.create')}}" class="btn btn-primary btn-sm float-right " data-toggle="tooltip" data-placement="bottom" title="Tạo phiếu xuất"><i class="fas fa-plus"></i> Tạo phiếu xuất</a>

                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      @if(count($PX)>0)
                      <table style="color: #333" class="table table-bordered" id="myTable1"  width="100%" cellspacing="0">
                        <thead>
                          <tr>
                            <th rowspan="2" style=" text-align: center;vertical-align: middle;">Mã phiếu xuất</th>
                            <th colspan="3"  style=" text-align: center;vertical-align: middle;">Chứng từ</th>
                            <th rowspan="2" style=" text-align: center;vertical-align: middle;">Khách hàng</th>
                            <th rowspan="2" style=" text-align: center;vertical-align: middle;">Tổng tiền</th>
                            <th rowspan="2" style=" text-align: center;vertical-align: middle;">Đã trả</th>
                            <th rowspan="2" style=" text-align: center;vertical-align: middle;">Nợ</th>
                            <th rowspan="2" style=" text-align: center;vertical-align: middle;">Trạng thái</th>
                            <th rowspan="2" style=" text-align: center;vertical-align: middle;">Ghi chú</th>
                            <th rowspan="2" style=" text-align: center;vertical-align: middle;"></th>
                          </tr>
                          <tr>
                            <th style=" text-align: center;vertical-align: middle;">Loại</th>
                            <th style=" text-align: center;vertical-align: middle;">Số hiệu</th>
                            <th style=" text-align: center;vertical-align: middle;">Ngày tháng</th>
                          </tr>
                        </thead>
                       
                        <tbody>
                          @php
                            $STT=1;
                          @endphp
                          @foreach($PX as $item)   
                              <tr>
                                  <td>
                                    <a href="{{route('admin.receipt-stock.show',$item->code)}}" >
                                      {{$item->code}}
                                  </td>
                                  <td>{{ $item->category->name }}</td>
                                  <td>
                                      <a href="{{route('admin.order.show',$item->document)}}" >
                                        {{$item->document}}
                                  </td>
                                  <td>
                                    @if($item->document_date!=null)
                                      echo  date(" H:i:s d-m-Y", strtotime($item->document_date));
                                    @endif
                                    {{--  @php
                                      echo  date(" H:i:s d-m-Y", strtotime($item->receipt_date));
                                    @endphp  --}}
                                  </td>
                                  <td>
                                    {{--  <a href="{{route('admin.user.show',$item->user->code)}}" >  --}}
                                      {{$item->user->code}}
                                  </td>
                                  <td>
                                    @php
                                      echo number_format($item->total);
                                    @endphp vnđ
                                  </td>
                                  <td>
                                    @php
                                      echo number_format($item->payment);
                                    @endphp vnđ
                                  </td>
                                  <td>
                                    @php
                                      echo number_format($item->debt);
                                    @endphp vnđ
                                  </td>
                                  <td>
                                    @if($item->status=="Nợ")
                                        <button type="button" class="btn btn-warning">
                                          {{ $item->status }} 
                                        </button>
                                    @else
                                      <button type="button" class="btn btn-success">
                                        {{ $item->status }} 
                                      </button>
                                    @endif
                                  </td>
                                  
                                  <td>{{ $item->note }}</td>
                                  <td>
                                    @if($item->status=="Chờ xuất kho")
                                        <button type="button" class="btn btn-primary" onclick="outOfStock({{ $item->id }})">
                                          Xuất kho
                                        </button>
                                    @endif
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
                        </tbody>
                      </table>
                      @else
                        <h6 class="text-center">Dữ liệu trống</h6>
              
                      @endif
                    </div>
                  <div>
                
                </div>
              </div>
            </div>
          </div>
            <div class="row">
            <div class="col">
              <div class="collapse panel-collapse collapse-stock" id="collapseStock2">
                <div class="card">
                  <div class="card-header">
                    <h4 class="m-0 font-weight-bold text-primary float-left"> Phiếu nhập kho</h4>
                    <a href="{{route('admin.receipt-stock.create')}}" class="btn btn-primary btn-sm float-right " data-toggle="tooltip" data-placement="bottom" title="Tạo phiếu xuất"><i class="fas fa-plus"></i> Tạo phiếu nhập</a>

                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      @if(count($PN)>0)
                     
                      <table style="color: #333" id="myTable" class="table table-bordered">
                        <th>STT</th>
                        <th>Mã phiếu</th>
                        <th>Ngày nhập</th>
                        <th>Nhà cung cấp</th>
                        <th>Số lượng</th>
                        <th>Tổng tiền</th>
                        <th>Đã trả</th>
                        <th>Nợ</th>
                        <th>Trạng thái</th>
                        <th>Ghi chú</th>
                        
                        <tbody>
                          @php
                            $STT=1;
                          @endphp
                          @foreach($PN as $item)   
                              <tr>
                                  <td>{{$STT}}</td>
                                  <td>{{$item->code}}</td>
                                  <td>
                                    @php
                                      echo  date("d-m-Y", strtotime($item->created_at));
                                    @endphp
                                  </td>
                                  <td>{{ $item->supplier->name }}</td>
                                  <td>{{ $item->quantity }}</td>
                                  <td>
                                    @php
                                      echo number_format($item->total);
                                    @endphp vnđ
                                  </td>
                                  <td>
                                    @php
                                      echo number_format($item->payment);
                                    @endphp vnđ
                                  </td>
                                  <td>
                                    @php
                                      echo number_format($item->debt);
                                    @endphp vnđ
                                  </td>
                                  <td>
                                    @if($item->status=="Nợ")
                                        <button type="button" class="btn btn-warning">
                                          {{ $item->status }} 
                                        </button>
                                    @else
                                      <button type="button" class="btn btn-success">
                                        {{ $item->status }} 
                                      </button>
                                    @endif
                                  </td>
                                  
                                  <td>{{ $item->note }}</td>
                                  
                                
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
                        </tbody>
                      </table>
                      @else
                        <h6 class="text-center">Dữ liệu trống</h6>
              
                      @endif
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
{{--  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">  --}}

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
  {{--  <script src="//cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>  --}}
  {{--  <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>  --}}
  <script>
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
    function outOfStock(id){
      $.ajax({
        type: 'post',
        dataType: 'json',
        url: 'receipt-stock/out-of-stock',
        data: {
            id: id,
      },
        success: function(result) {
          alertify.set('notifier', 'delay', 10);
          alertify.set('notifier', 'position', 'bottom-right');
          alertify.success('Cập nhật thành công');
            setTimeout(function(){// wait for 5 secs(2)
              location.reload(); // then reload the page.(3)
        }, 1000); 
        },
        error: function(json) {
            if (json.status === 404) {
                var errors = json.responseJSON;
            }
        }
    });
    }
    $(document).ready(function () {
      $('#myTable').DataTable();
      $('#myTable1').DataTable();
      
  });
  </script>
  <script>
   
    function collapseStock(e){
      var id=$(e).data('href');
      $('.collapse').slideUp(400);
      $("#"+id).slideDown(400);
    }
  </script>
@endpush
