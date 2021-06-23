
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
        <a class="btn btn-primary  " data-toggle="collapse" href="#PC" data-href="PC" role="button" onclick="collapseStock(this)"  aria-controls="multiCollapseExample1">Phiếu chi</a>
        <button class="btn btn-primary " type="button"  data-toggle="collapse" data-href="PT"  onclick="collapseStock(this)"  data-target="#collapseStock2" aria-expanded="false" aria-controls="multiCollapseExample2">Phiếu thu</button>
      </h4>
    </div>
    <!-- Button trigger modal -->

<!-- Modal -->

    <div class="card-body">
      <div class="table-responsive">
        
          <div class="row">
            <div class="col">
              <div class="collapse panel-collapse show collapse-stock" id="PC">
                <div class="card">
                  <div class="card-header">
                    <h4 class="m-0 font-weight-bold text-primary float-left"> Phiếu chi</h4>
                    <div id="reportrange-PC" data-cat="PC" class="float-left datetimepicker datetime-PC" onapply="changeDateTimePC(e)" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 24%; margin-left:20px">
                      <i class="fa fa-calendar" style="color: #007DFF"></i>&nbsp;
                      <span id="date-PC"></span> <i class="fa fa-caret-down" style="color: #007DFF"></i>
                    </div>
                    <button class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#modalCreatePC" data-placement="bottom" title="Add User"><i class="fas fa-plus"></i> Tạo phiếu chi</button>

                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <input class="auto-numeric" type="hidden">
                        <table style="color: #333" class="table table-bordered display" id="table-PC"  width="100%" cellspacing="0">
                          <thead>
                            <tr>

                              <th rowspan="2" style=" text-align: center;vertical-align: middle;">STT</th>
                              <th rowspan="2" style=" text-align: center;vertical-align: middle;">Mã phiếu</th>
                              <th colspan="2"  style=" text-align: center;vertical-align: middle;">Chứng từ</th>
                              <th rowspan="2" style=" text-align: center;vertical-align: middle;">Loại</th>
                              <th rowspan="2" style=" text-align: center;vertical-align: middle;">Người nhận</th>
                              <th rowspan="2" style=" text-align: center;vertical-align: middle;">Tổng tiền</th>
                          
                              <th rowspan="2" style=" text-align: center;vertical-align: middle;">Ghi chú</th>
                              <th rowspan="2" style=" text-align: center;vertical-align: middle;">Trạng thái</th>
                              <th rowspan="2" style=" text-align: center;vertical-align: middle;">Thời gian</th>  
                            </tr>
                            <tr>
                              <th style=" text-align: center;vertical-align: middle;">Số hiệu</th>
                              <th style=" text-align: center;vertical-align: middle;">Ngày tháng</th>
                            </tr>
                          </thead>
                        </table>
                      </div>
                  <div>
                
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="collapse panel-collapse collapse-stock" id="PT">
                <div class="card">
                  <div class="card-header">
                    <h4 class="m-0 font-weight-bold text-primary float-left"> Phiếu thu</h4>
                    <div id="reportrange-PT" data-cat="PT" class="float-left datetimepicker datetime-PT" onapply="changeDateTimePC(e)" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 24%; margin-left:20px">
                      <i class="fa fa-calendar" style="color: #007DFF"></i>&nbsp;
                      <span id="date-PC"></span> <i class="fa fa-caret-down" style="color: #007DFF"></i>
                    </div>
                    <button class="btn btn-primary btn-sm float-right" data-target="#modalCreatePT" data-toggle="modal"  data-placement="bottom" title="Add User"><i class="fas fa-plus"></i> Thêm phiếu thu</button>

                  </div>
                  <div class="card-body">
                    <div class="table-responsive">

                      <table style="color: #333" class="table table-bordered" id="table-PT"  width="100%" cellspacing="0">
                        <thead>
                          <tr>
                            <th rowspan="2" style=" text-align: center;vertical-align: middle;">Mã phiếu chi</th>
                            <th colspan="2"  style=" text-align: center;vertical-align: middle;">Chứng từ</th>
                            <th rowspan="2" style=" text-align: center;vertical-align: middle;">Loại</th>
                            <th rowspan="2" style=" text-align: center;vertical-align: middle;">Khách hàng</th>
                            <th rowspan="2" style=" text-align: center;vertical-align: middle;">Tổng tiền</th>
                            <th rowspan="2" style=" text-align: center;vertical-align: middle;">Ghi chú</th>
                            <th rowspan="2" style=" text-align: center;vertical-align: middle;">Trạng thái</th>
                            <th rowspan="2" style=" text-align: center;vertical-align: middle;">Thời gian</th>
                          </tr>
                          <tr>
                            <th style=" text-align: center;vertical-align: middle;">Số hiệu</th>
                            <th style=" text-align: center;vertical-align: middle;">Ngày tháng</th>
                          </tr>
                        </thead>
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
<div class="modal fade" id="modalCreatePC" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tạo phiếu chi</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="form-PC-store">
  
        <div class="modal-body">
            <div class="form-group">
              <label for="inputAddress">Số tiền:</label>
              <input type="hidden" name="category" value="PC">
              <input   onkeyup="costPC(this)" required  class="form-control" id="PC-total" placeholder="">
              <input  name="total" id="total-PC" type="hidden">
            </div>
            <div class="form-group">
              <label for="inputAddress">Ngày chi:</label>
              <div class="form-group pmd-textfield pmd-textfield-floating-label">
                <input type="text" required placeholder="" value="{{ old('date') }}" name="date" id="datetime" class="datetime form-control" />
              </div>
            </div>
            <div class="form-group">
              <label for="inputAddress">Loại phiếu chi:</label>
              <select name="child_cat" onchange="chooseCatPC()" id='PC-select' data-size="5" data-actions-box="true" data-live-search="true" required class="form-control">
                {{-- @foreach ($PC_category as $item)
                  <option value="{{ $item->name }}" data-content="{{ $item->name }}">{{ $item->name }}</option>
  
                @endforeach --}}
              </select>
            </div>
            <div class="form-group" id="form-PC-debt">
              </div>
            <div class="form-group">
              <label for="inputAddress">Ghi chú:</label>
              <textarea required name="note" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="float-left btn btn-secondary" data-dismiss="modal">Đóng</button>
          <button type="button" class="float-right btn btn-primary" data-type="store"data-cat='PC' onclick="store(this)">Lưu</button>
          <button type="button" class="float-right btn btn-primary" data-type="print"data-cat='PC' onclick="store(this)">Lưu và in</button>
        </div>
      </form>
  
      </div>
    </div>
  </div>
<div class="modal fade" id="modalCreatePT" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tạo phiếu thu</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="form-PT-store">
  
        <div class="modal-body">
            <div class="form-group">
              <label for="inputAddress">Số tiền:</label>
              <input type="hidden" name="category" value="PT">
              <input name="total"  onkeyup="costPC(this)" required  class="form-control" id="PT-total" placeholder="">
              <input   id="total-PT" type="hidden">
            </div>
            <div class="form-group">
              <label for="inputAddress">Ngày chi:</label>
              <div class="form-group pmd-textfield pmd-textfield-floating-label">
                <input type="text" required placeholder="" value="{{ old('date') }}" name="date" id="datetime" class="datetime form-control" />
              </div>
            </div>
            <div class="form-group">
              <label for="inputAddress">Loại phiếu chi:</label>
              <select name="child_cat" onchange="chooseCatPC()" id='PT-select' data-size="5" data-actions-box="true" data-live-search="true" required class="form-control">
                {{-- @foreach ($PT_category as $item)
                  <option value="{{ $item->name }}" data-content="{{ $item->name }}">{{ $item->name }}</option>
  
                @endforeach --}}
              </select>
            </div>
            <div class="form-group" id="form-PC-debt">
              </div>
            <div class="form-group">
              <label for="inputAddress">Ghi chú:</label>
              <textarea required name="note" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="float-left btn btn-secondary" data-dismiss="modal">Đóng</button>
          <button type="button" class="float-right btn btn-primary" data-type="store" data-cat='PT' onclick="store(this)">Lưu</button>
          <button type="button" class="float-right btn btn-primary" data-type="print" data-cat='PT' onclick="store(this)">Lưu và in</button>
        </div>
      </form>
  
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
    <script src="{{ asset('backend/js/receipt.js') }}"></script>

    {{-- <script>
      chooseCatPC();
      function chooseCatPC(){
        var name = $('#PC-select').val();
        if(name=="Chi nợ nhập hàng"){
          var debt= <?php echo $debt?>;
          var content='<label for="inputAddress">Mã chứng từ kèm theo:</label>'
          +'<select name="code" id="debt-PC-select" data-size="5" data-actions-box="true" data-live-search="true" required class="form-control">';
          for(var item of debt ){
            $(".auto-numeric").val(item.debt);
            new AutoNumeric(".auto-numeric", {
              decimalPlaces: '0',
          });
          var debt= $(".auto-numeric").val();
          $("#PC-total").val(debt);
              content+=  '<option data-debt='+item.debt+' value="'+item.code+'">'+item.code+ ' - Nợ: '+debt+' vnđ</option>';
    
          }
          content+='</select>';
          $("#form-PC-debt").append(content);
    
        }
        else{
          $("#form-PC-debt").empty();
        }
      }

    </script> --}}
@endpush
