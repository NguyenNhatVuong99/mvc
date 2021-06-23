<header class="header shop">
    <!-- Topbar -->
    <div class="topbar">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-12">
                    <!-- Top Left -->
                    <div class="top-left">
                        <ul class="list-main">
                            @php
                                $information=DB::table('informations')->get();
                                
                            @endphp
                            <li><i class="ti-headphone-alt"></i>@foreach($information as $data) {{$data->phone}} @endforeach</li>
                            <li><i class="ti-email"></i> @foreach($information as $data) {{$data->email}} @endforeach</li>
                        </ul>
                    </div>
                    <!--/ End Top Left -->
                </div>
                <div class="col-lg-6 col-md-12 col-12">
                    <!-- Top Right -->
                    <div class="right-content">
                        <ul class="list-main">
                            {{-- <li><i class="ti-alarm-clock"></i> <a href="#">Daily deal</a></li> --}}
                            
                            @auth 
                            <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                @php
                                $user=Auth()->user();
                                @endphp
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{$user->name}}</span>
                                @if($user->avatar)
                                    <img class="img-profile rounded-circle" src="{{$user->avatar}}">
                                @else
                                    @php
                                    $avatar=Avatar::create($user->name)->toBase64();
                                    @endphp
                                    <img  class="img-profile rounded-circle" src="{{ $avatar }}" alt="">
                                @endif
                                </a>
                                <!-- Dropdown - User Information -->
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href= "#" data-code="{{ $user->code }}" onclick="showUser(this)">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Thông tin cá nhân
                                </a>
                                <a class="dropdown-item" href="{{route('admin.change.password.form')}}">
                                    <i class="fas fa-key fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Change Password
                                </a>
                                <a class="dropdown-item" href="{{route('admin.settings')}}">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                               

                            @else
                                <li><i class="ti-power-off"></i><a href="{{route('login.get')}}">Đăng nhập</a></li>
                            @endauth
                        </ul>
                    </div>
                    <!-- End Top Right -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Topbar -->
    {{--  <div class="middle-inner">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-md-2 col-12">
                    <!-- Logo -->
                    <div class="logo">
                        @php
                            $settings=DB::table('settings')->get();
                        @endphp                    
                        <a href="{{route('home')}}"><img style="width:60px" src="@foreach($settings as $data) {{$data->logo}} @endforeach" alt="logo"></a>
                    </div>
                    <!--/ End Logo -->
                    <!-- Search Form -->
                    <div class="search-top">
                        <div class="top-search"><a href="#0"><i class="ti-search"></i></a></div>
                        <!-- Search Form -->
                        <div class="search-top">
                            <form class="search-form">
                                <input type="text" placeholder="Search here..." name="search">
                                <button value="search" type="submit"><i class="ti-search"></i></button>
                            </form>
                        </div>
                        <!--/ End Search Form -->
                    </div>
                    <!--/ End Search Form -->
                    <div class="mobile-nav"></div>
                </div>
                <div class="col-lg-8 col-md-7 col-12">
                    <div class="search-bar-top">
                        <div class="search-bar">
                            <select>
                                <option >All Category</option>
                                @foreach(Helper::getAllCategory() as $cat)
                                    <option>{{$cat->title}}</option>
                                @endforeach
                            </select>
                            <form method="POST" action="{{route('product.search')}}">
                                @csrf
                                <input name="search" placeholder="Search Products Here....." type="search">
                                <button class="btnn" type="submit"><i class="ti-search"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-12">
                    <div class="right-bar">
                        <!-- Search Form -->
                        <div class="sinlge-bar shopping">
                            <a href="{{route('cart.index')}}" class="single-icon"><i class="ti-bag"></i> 
                                @if(session()->has('cart'))
                                    <span class="total-count">{{ Helper::cart()['count'] }}</span>
                                    @endif
                                </a>
                            <!-- Shopping Item -->
                                <div class="shopping-item">
                                    <div class="dropdown-cart-header">
                                        <span>{{Helper::countCart()}} Items</span>  
                                        <a href="{{route('cart.index')}}">View Cart</a>
                                    </div>
                                    <ul class="shopping-list">
                                        @if(session()->has('cart'))

                                            @foreach(Helper::cart()['products'] as $product)
                                                    @php
                                                        $photo=explode(',',$product['productInfo']['photo']);
                                                    @endphp
                                                    <li>
                                                        <a class="cart-img" href="#"><img src="{{$photo[0]}}" alt="{{$photo[0]}}"></a>
                                                        <h4><a href="{{route('product-detail',$product['productInfo']['slug'])}}" target="_blank">{{$product['productInfo']['name']}}</a></h4>
                                                        <p class="quantity">{{$product['quantity']}} - <span class="amount">{{number_format($product['price'])}}vnđ</span></p>
                                                    </li>
                                            @endforeach
                                            @endif

                                    </ul>
                                    <div class="bottom">
                                        <div class="total">
                                            <span>Total</span>
                                             <span class="total-amount">${{number_format(Helper::cart()['total_price'])}}vnd</span>
                                        </div>
                                        <a href="{{route('checkout')}}" class="btn animate">Checkout</a>
                                    </div>
                                </div>
                            <!--/ End Shopping Item -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  --}}
    <!-- Header Inner -->
    <div class="header-inner">
        <div class="container">
            <div class="cat-nav-head">
                <div class="row">
                    <div class="col-lg-10 col-12">
                        <div class="menu-area">
                            <!-- Main Menu -->
                            <nav class="navbar navbar-expand-lg">
                                <div class="navbar-collapse">	
                                    <div class="nav-inner">	
                                        <ul class="nav main-menu menu navbar-nav">
                                            <li class="{{Request::path()=='home' ? 'active' : ''}}"><a href="{{route('home')}}">Home</a></li>
                                            <li class="{{Request::path()=='about-us' ? 'active' : ''}}"><a href="{{route('about-us')}}">About Us</a></li>
                                            <li class="@if(Request::path()=='product-grids'||Request::path()=='product-lists')  active  @endif"><a href="{{route('product-grids')}}">Products</a><span class="new">New</span></li>												
                                                {{Helper::getHeaderCategory()}}
                                               
                                            <li class="{{Request::path()=='contact' ? 'active' : ''}}"><a href="{{route('contact')}}">Contact Us</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </nav>
                            <!--/ End Main Menu -->	
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3 col-12">
                        <div class="right-bar">
                            <!-- Search Form -->
                            <div class="sinlge-bar shopping shopping-count">
                                <a href="{{route('cart.index')}}" class="single-icon"><i class="ti-bag"></i> 
                                    @if(session()->has('cart'))
                                        <span class="total-count">{{ Helper::cart()['count'] }}</span>
                                        @endif
                                    </a>
                                <!-- Shopping Item -->
                                    <div class="shopping-item">
                                        <div class="dropdown-cart-header">
                                            <span>{{Helper::countCart()}} Items</span>  
                                            <a href="{{route('cart.index')}}">View Cart</a>
                                        </div>
                                        <ul class="shopping-list">
                                            @if(session()->has('cart'))
    
                                                @foreach(Helper::cart()['products'] as $product)
                                                        @php
                                                            $photo=explode(',',$product['productInfo']['photo']);
                                                        @endphp
                                                        <li>
                                                            <a class="cart-img" href="#"><img src="{{$photo[0]}}" alt="{{$photo[0]}}"></a>
                                                            <h4><a href="{{route('product-detail',$product['productInfo']['slug'])}}" target="_blank">{{$product['productInfo']['name']}}</a></h4>
                                                            <p class="quantity">{{$product['quantity']}} - <span class="amount">{{number_format($product['price'])}}vnđ</span></p>
                                                        </li>
                                                @endforeach
                                                @endif
    
                                        </ul>
                                        <div class="bottom">
                                            <div class="total">
                                                <span>Total</span>
                                                 <span class="total-amount">${{number_format(Helper::cart()['total_price'])}}vnd</span>
                                            </div>
                                            <a href="{{route('checkout')}}" class="btn animate">Checkout</a>
                                        </div>
                                    </div>
                                <!--/ End Shopping Item -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ End Header Inner -->
</header>