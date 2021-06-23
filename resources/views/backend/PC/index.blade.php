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
      <h4 class="m-0 font-weight-bold text-primary float-left"> Phiếu Chi</h4>
      <button class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#modal" data-placement="bottom" title="Add User"><i class="fas fa-plus"></i> Phiếu Chi</button>
    </div>
    <!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tạo phiếu chi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="form-store">

      <div class="modal-body">
          <div class="form-group">
            <label for="inputAddress">Số tiền</label>
            <input type="number" name="total" required  class="form-control" id="number" placeholder="">
          </div>
          <div class="form-group">
            <label for="inputAddress">Ngày chi</label>
            <div class="form-group pmd-textfield pmd-textfield-floating-label">
              <input type="text" required placeholder="" value="{{ old('date') }}" name="date" id="datetime" class="form-control" />
            </div>
          </div>
          <div class="form-group">
            <label for="inputAddress">Loại phiếu chi</label>
            <select name="child_cat_id" required class="form-control">
              @foreach ($categories as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>

              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="inputAddress">Ghi chú</label>
            <textarea required name="note" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="float-left btn btn-secondary" data-dismiss="modal">Đóng</button>
        <button type="button" class="float-right btn btn-primary" data-type="store" onclick="store(this)">Lưu</button>
        <button type="button" class="float-right btn btn-primary" data-type="print" onclick="store(this)">Lưu và in</button>
      </div>
    </form>

    </div>
  </div>
</div>
    <div class="card-body">
      <div class="table-responsive">
        @if(count($PC)>0)
        <table style="color: #333" class="table table-bordered" id="myTable"  width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>STT</th>
              <th>Mã phiếu</th>
              <th>Ngày chi</th>
              <th>Người chi</th>
              <th>Số tiền</th>
              <th>Hạng mục</th>
              <th>Ghi chú</th>
              <th></th>
            </tr>
          </thead>
         
          <tbody>
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
          </tbody>
        </table>
        @else
          <h6 class="text-center">Dữ liệu trống</h6>

        @endif
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
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js" integrity="sha512-GDey37RZAxFkpFeJorEUwNoIbkTwsyC736KNSYucu1WJWFK9qTdzYub8ATxktr6Dwke7nbFaioypzbDOQykoRg==" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

  <!-- Page level plugins -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

  <!-- Page level custom scripts -->
  {{--  <script src="{{asset('backend/js/demo/datatables-demo.js')}}"></script>  --}}
  <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script> --}}
  <script>
    $(document).ready(function () {
      $('#myTable').DataTable();
  });
    var today = new Date();
var dd = String(today.getDate()).padStart(2, '0');
var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
var yyyy = today.getFullYear();

today = mm + '/' + dd + '/' + yyyy;
    $('#datetime').datepicker({
      uiLibrary: 'bootstrap4',
       iconsLibrary: 'fontawesome',
      value:today,
      modal: true,
      footer: true
  });
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
function store(e){
  var data=$("#form-store").serialize();
  var type=$(e).data('type');
  $.ajax({
      type: 'post',
      dataType: 'json',
      url: '/admin/PC',
      data: $("#form-store").serialize(),
      success: function(result) {
          {
              alertify.set('notifier', 'position', 'bottom-right');
              alertify.success('Thay đổi thành công');
              if(type=="store"){
                $("#modal .close").click();
                location.reload(); 
              }
              else{
                print(result);
              }
          }
      }
  });
}
function print(id){
  console.log(id);
  window.location.href="PC/print/"+id;
}
 
  </script>
@endpush