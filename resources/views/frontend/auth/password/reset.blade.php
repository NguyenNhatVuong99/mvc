@extends('frontend.auth.master')

@section('title','MVC Shop || Quên mật khẩu')

@section('content')
    <div class="col-md-4 login-sec">
        <h2 class="text-center">Quên mật khẩu</h2>
            <div class="form-group">
                <input type="text" class="form-control input" id="email" placeholder="Nhập email" type="email" name="email" placeholder="" value="{{old('email')}}">
            </div>
            <div class="form-group">
                @if (Route::has('password.request'))
                            <a class="lost-pass" href="{{ route('login.get') }}">
                                Đăng nhập
                            </a>
                        @endif
                <button onclick="sendMail()" class="btn btn-login float-right">Gửi mail</button>
            </div>
    </div>
@endsection
@push('styles')
    <link rel="stylesheet" href="{{ mix('/css/login.css') }}">
@endpush
@push('script')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.input').keypress(function (e) {
        if (e.which == 13) {
            sendMail();
            return false;    //<---- Add this line
        }
        });

        function sendMail(){
            var email=$(".input").val();
            console.log(email);
            $.ajax({
                type: 'post',
                dataType: 'json',
                url: "{{ route('password.reset.sendMail') }}",
                data: {
                    email:email,
                    "_token": "{{ csrf_token() }}"
                },
                success: function(result) {
                    {
                        toastr.success('Vui lòng kiểm tra email của bạn');
                    }
                },
                error: function(response) {
                    console.log(response.responseJSON);
                    var errors = response.responseJSON.errors;
                    $.each(errors,function(field_name,error){
                        toastr.error(error);
                    });
                },
            });
        }
    </script>
@endpush