@extends('backend.layouts.master')

@section('title','Order Detail')

@section('main-content')
<div class="card">
  <h5 class="card-header">Order Edit</h5>
  <div class="card-body">
    <div class="row">
      <div class="col-6">
        <div class="form-group">
          <label for="status">Status :</label>
          <select name="status" id="status_order" class="form-control">
            <option value="">--Select Status--</option>
            <option value="new" {{(($order->status=='new')? 'selected' : '')}}>New</option>
            <option value="process" {{(($order->status=='process')? 'selected' : '')}}>process</option>
            <option value="delivered" {{(($order->status=='delivered')? 'selected' : '')}}>Delivered</option>
            <option value="cancel" {{(($order->status=='cancel')? 'selected' : '')}}>Cancel</option>
          </select>
          
      </div>
      <div class="col-6">
        <div class="col-md-8"> 
          <input type="checkbox" class="form-check-input" id="sendMail">
          <label class="form-check-label" for="sendMail">Gửi mail xác nhận</label>
      </div>
    </div>
    <button onclick="updateStatusOrder({{ $order->id }})" type="submit" class="btn btn-primary">Update</button>

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
@push('scripts')
<script>
  function updateStatusOrder(id) {
    var status = $('#status_order option:selected').val();
    var check = $("#sendMail").is(":checked");
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'post',
        dataType: 'json',
        url: '/admin/updateStatusOrder',
        data: {
            status: status,
            id:id,
            check:check
        },
        success: function(response) {
            Swal.fire({
                text:response.message,
                icon:'success',
                timer: 1000,
            }).then(() => {
                window.location.href = "/admin/order";
            });
        },
    });
  }
  
</script>

@endpush