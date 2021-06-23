@extends('frontend.auth.master')

@section('title','MVC Shop || Đăng nhập')

@section('content')
    <div class="col-md-4 login-sec">
        <h2 class="text-center">Đăng nhập</h2>
            <div class="form-group">
                <input type="text" class="form-control input" id="user_name" placeholder="Email hoặc số điện thoại" type="email" name="email" placeholder="" value="{{old('email')}}">
            </div>
            <div class="form-group">
                <div class="alert alert-danger d-none " id="error-user_name">
                </div>
            </div>
            <div class="form-group">
                <input type="password" class="form-control input" id="password" name="password" placeholder="Mật khẩu" required="required" value="{{old('password')}}">
            </div>
            <div class="form-group">
                <div class="alert alert-danger d-none " id="error-password">
                </div>
            </div>
            <div class="form-group">
                @if (Route::has('password.request'))
                            <a class="lost-pass" href="#">
                                Quên mật khẩu
                            </a>
                        @endif
                <button onclick="login()" class="btn btn-login float-right">Đăng nhập</button>
            </div>
        <div class="social-container">
                <ul class="social-icons">
                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="#"><i class="fa fa-google"></i></a></li>
                    <li><a href="#"><i class="fa fa-github"></i></a></li>
                </ul>
        </div>
    </div>
    
@endsection
@push('styles')
    <link rel="stylesheet" href="{{ asset('/css/login.css') }}">
@endpush
@push('script')
    <script>
        
        $('.input').keypress(function (e) {
        if (e.which == 13) {
            login();
            return false;    //<---- Add this line
        }
        });

        function login(){
            
            var name=$("#user_name").val();
            var password=$("#password").val();
            var arr=['name','phone','province','district','ward','address'];
                 for(var i of arr){
                 $("#" + "error-"+i).addClass('dis-none');
                 $("#" + i+"-create").removeClass('input-validation-error');
                 }
            $.ajax({
                type: 'post',
                dataType: 'json',
                url: "{{ route('login.post') }}",
                data: {
                    name:name,
                    password:password,
                    "_token": "{{ csrf_token() }}"
                },
                success: function(result) {
                    {
                        toastr.success('Đăng nhập thành công');  
                        window.location.href=result[0];
                        
                    }
                },
                error: function(response) {
                    var errors = response.responseJSON.errors;
                    $.each(errors,function(field_name,error){
                        if(field_name==Object.keys(errors)[0]){
                            toastr.error(error);
                        }
                    });
                },
            });
        }
    </script>
@endpush