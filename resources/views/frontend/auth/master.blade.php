@extends('frontend.layouts.master')

@section('title','MVC Shop || Đăng nhập')

@section('main-content')
    <!-- Breadcrumbs -->
    
    <!-- End Breadcrumbs -->
            
    <!-- Shop Login -->
    <section class="login-block">
        <div class="container">
            <div class="row">
               @yield('content')
                <div class="col-md-8 banner-sec">
                    @if(count($banners)>0)

                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        
                        <ol class="carousel-indicators">
                            @foreach($banners as $key=>$banner)
                        <li data-target="#Gslider" data-slide-to="{{$key}}" class="{{(($key==0)? 'active' : '')}}"></li>
                            @endforeach
                
                        </ol>
                        <div class="carousel-inner" role="listbox">
                            @foreach($banners as $key=>$banner)
                            <div class="carousel-item {{(($key==0)? 'active' : '')}}">
                                <img class="first-slide" src="{{$banner->photo}}" alt="First slide">
                                <div class="carousel-caption d-none d-md-block text-left">
                                    {{--  <a class="btn btn-lg ws-btn wow fadeInUpBig" href="{{route('product-grids')}}" role="button">Shop Now<i class="far fa-arrow-alt-circle-right"></i></i></a>  --}}
                                </div>
                            </div>  
                        @endforeach   
                        </div>
                    </div>
                    @endif
                    {{--  @end  --}}

                </div>
            </div>
        </div>
    </section>
   
@endsection
