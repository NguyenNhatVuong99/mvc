@extends('backend.layouts.master')

@section('main-content')

<div class="card">
    <h5 class="card-header">Edit Coupon</h5>
    <div class="card-body">
      <form method="post" action="{{route('coupon.update',$coupon->id)}}">
        @csrf 
        @method('PATCH')
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Coupon Code <span class="text-danger">*</span></label>
          <input id="inputTitle" type="text" name="name" placeholder="Enter Coupon Code"  value="{{$coupon->name}}" class="form-control">
          @error('name')
          <span class="text-danger">{{$message}}</span>
          @enderror
          </div>
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Coupon Code <span class="text-danger">*</span></label>
          <input id="inputTitle" type="text" name="code" placeholder="Enter Coupon Code"  value="{{$coupon->code}}" class="form-control">
          @error('code')
          <span class="text-danger">{{$message}}</span>
          @enderror
          </div>
  
          <div class="form-group">
              <label for="type" class="col-form-label">Type <span class="text-danger">*</span></label>
              <select name="type" class="form-control">
                  <option value="fixed" {{(($coupon->type=='fixed') ? 'selected' : '')}}>Fixed</option>
                  <option value="percent" {{(($coupon->type=='percent') ? 'selected' : '')}}>Percent</option>
              </select>
              @error('type')
              <span class="text-danger">{{$message}}</span>
              @enderror
          </div>
  
          <div class="form-group">
              <label for="inputTitle" class="col-form-label">Value <span class="text-danger">*</span></label>
              <input id="inputTitle" type="number" name="value" placeholder="Enter Coupon value"  value="{{$coupon->value}}" class="form-control">
              @error('value')
              <span class="text-danger">{{$message}}</span>
              @enderror
          </div>
          
        <div class="form-group">
          <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
          <select name="status" class="form-control">
            <option value="active" {{(($coupon->status=='active') ? 'selected' : '')}}>Active</option>
            <option value="inactive" {{(($coupon->status=='inactive') ? 'selected' : '')}}>Inactive</option>
          </select>
          @error('status')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-sm-6"> 
              <label for="regular1" class="control-label">Start Date</label>

              <div class="form-group pmd-textfield pmd-textfield-floating-label">
                <input type="text" required placeholder="Start date" name="start_date" id="datepicker-start" class="form-control" />
              </div>
              @error('start_date')
          <span class="text-danger">{{$message}}</span>
          @enderror
            </div>
            <div class="col-sm-6">
              <label for="regular1" class="control-label">End Date</label>
              <div class="form-group pmd-textfield pmd-textfield-floating-label">
                <input type="text" required id="datepicker-end" placeholder="End date" name="end_date" class="form-control" />

              </div>
              @error('end_date')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>
          </div>
        </div>
        <div class="form-group mb-3">
           <button class="btn btn-success" type="submit">Update</button>
        </div>
      </form>
    </div>
</div>

@endsection

@push('styles')
<link rel="stylesheet" href="{{asset('backend/summernote/summernote.min.css')}}">
<link rel="icon" href="http://propeller.in/assets/images/favicon.ico" type="image/x-icon">
	
	<!-- Bootstrap --> 
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" type="text/css" rel="stylesheet" /> 
	
	<!-- Example docs (CSS for helping component example file)-->
	<link href="http://propeller.in/docs/css/example-docs.css" type="text/css" rel="stylesheet" />

	<!-- Propeller card (CSS for helping component example file)-->
	<link href="http://propeller.in/components/card/css/card.css" type="text/css" rel="stylesheet" />

	<!-- Propeller typography -->
	<link href="http://propeller.in/components/typography/css/typography.css" type="text/css" rel="stylesheet" />
	
	<!-- Google Icon Font -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link href="http://propeller.in/components/icon/css/google-icons.css" type="text/css" rel="stylesheet" />

	<!-- Propeller textbox -->
	<link href="http://propeller.in/components/textfield/css/textfield.css" type="text/css" rel="stylesheet"/>

	<!-- Propeller bootstrap datetimepicker -->
	<link href="{{ asset('propeller/css/bootstrap-datetimepicker.css') }}" type="text/css" rel="stylesheet" />
	<link href="{{ asset('propeller/css/pmd-datetimepicker.css') }}" type="text/css" rel="stylesheet" />
	
@endpush
@push('scripts')
<script type="text/javascript" src="http://propeller.in/components/textfield/js/textfield.js"></script>

  <!-- Datepicker moment with locales -->
  <script type="text/javascript" language="javascript" src="{{ asset('propeller/js/moment-with-locales.js') }}"></script>
  <script type="text/javascript" language="javascript" src="{{ asset('propeller/js/bootstrap-datetimepicker.js') }}"></script>

  <!-- Propeller Bootstrap datetimepicker -->
  <script type="text/javascript">
    setTime();
    function setTime(){
      $start_date=<?php echo $coupon->start_date ?>;
      $end_date=<?php echo $coupon->end_date ?>;
      $('#datepicker-start input').datepicker('setDate', $start_date);
      $('#datepicker-end input').datepicker('setDate', $end_date);
    }
    $(function () {
      
      
      
      /* Linked date and time picker */
      // start date date and time picker 
      var dateNow = new Date();
      $('#datepicker-start').datetimepicker({
        useCurrent: true ,

      });

      // End date date and time picker 
          $('#datepicker-end').datetimepicker({
              useCurrent: true ,
          });
      
      // start date picke on chagne event [select minimun date for end date datepicker]
          $("#datepicker-start").on("dp.change", function (e) {
              $('#datepicker-end').data("DateTimePicker").minDate(e.date);
          });
      // Start date picke on chagne event [select maxmimum date for start date datepicker]
          $("#datepicker-end").on("dp.change", function (e) {
              $('#datepicker-start').data("DateTimePicker").maxDate(e.date);
          });
    
    });
    
  </script>
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script src="{{asset('backend/summernote/summernote.min.js')}}"></script>
<script>
    $('#lfm').filemanager('image');

    $(document).ready(function() {
    $('#description').summernote({
      placeholder: "Write short description.....",
        tabsize: 2,
        height: 150
    });
    });
</script>
@endpush