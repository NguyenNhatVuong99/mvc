@extends('backend.layouts.master')
@section('main-content')
    <div class="container">
        <select class="selectpicker">
            <option>Mustard</option>
            <option>Ketchup</option>
            <option>Relish</option>
          </select>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('.selectpicker').selectpicker('val', 'Mustard');     
        });
    </script>
@endpush