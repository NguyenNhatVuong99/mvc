
<nav class="navbar navbar-expand navbar-light bg-white topbar static-top shadow m-b-10" >

    <!-- Sidebar Toggle (Topbar) -->
    <a class="navbar-brand" href="https://front.codes/" target="_blank"><img src="{{ asset('photos/logo.png') }}" alt=""></a>	


    <!-- Topbar Search -->
    
    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto py-4 py-md-0">
      <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
        <a class="nav-link" href="#">Tổng quan</a>
    </li>
        <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4 ">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Người dùng 
              <i class="fas fa-sort-down m-l-5" ></i>
            </a>
            <div class="dropdown-menu">
               <a class="dropdown-item font-size-15" href="{{route('admin.user.index')}}">Tài khoản</a>
               <a class="dropdown-item font-size-15" href="{{route('admin.role.index')}}">Quyền truy cập</a>
            </div>
        </li>
        <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4 ">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Cửa hàng
              <i class="fas fa-sort-down m-l-5" ></i>
            </a>
            <div class="dropdown-menu">
             <a class="dropdown-item font-size-15" href="{{route('admin.personel.index')}}">Nhân viên</a>
             <a class="dropdown-item font-size-15" href="{{route('admin.salary.index')}}">Bảng lương</a>
            </div>
        </li>
        <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4 ">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-tshirt m-r-5"></i>
              Sản phẩm
              <i class="fas fa-sort-down m-l-5" ></i>
            </a>
            <div class="dropdown-menu">
              <a class="dropdown-item font-size-15" href="{{route('admin.product.index')}}">
                <i class="fas fa-tshirt fa-sm fa-fw mr-2 "></i>
                  Sản phẩm
              </a>
             <a class="dropdown-item font-size-15" href="{{route('admin.priceList.index')}}">
                <i class="fas fa-calculator fa-sm fa-fw mr-2 "></i>
                  Bảng giá
              </a>

              {{--  <a class="dropdown-item font-size-15" href="{{route('admin.priceList.index')}}">
                <i class="fas fa-calculator m-r-5"></i>
                Bảng giá</a>  --}}
            </div>
        </li>
        <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4 ">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-users m-r-5" ></i>

              Đối tác
              <i class="fas fa-sort-down" ></i>
            </a>
            <div class="dropdown-menu">
             <a class="dropdown-item font-size-15" href="{{route('admin.supplier.index')}}"><i class="fas fa-industry"></i>&ensp;Nhà cung cấp</a>
            </div>
        </li>
        <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4 ">

            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-exchange-alt m-r-5" ></i>
              Giao dịch
              <i class="fas fa-sort-down " ></i>
            </a>
            <div class="dropdown-menu">
             <a class="dropdown-item font-size-15" href="{{route('admin.productImport.index')}}"><i class="fas fa-truck-moving"></i>&ensp;Nhập hàng</a>
            </div>
        </li>
        <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
          <a class="nav-link" href="{{route('admin.cashflow.index')}}">              
            <i class="fas fa-money-bill-alt m-r-5" ></i>
            Thu & chi</a>
      </li>
        <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4 ">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
              <i class=" fas fa-"></i>
              Thiết lập
              <i class="fas fa-sort-down m-l-5" ></i>
            </a>
            <div class="dropdown-menu">
             <a class="dropdown-item font-size-15" href="{{route('admin.banner.index')}}">Ảnh bìa</a>
             <a class="dropdown-item font-size-15" href="{{route('admin.banner.index')}}">Ảnh bìa</a>
            </div>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">

      <!-- Nav Item - Search Dropdown (Visible Only XS) -->
      <li class="nav-item dropdown no-arrow d-sm-none">
        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-search fa-fw"></i>
        </a>
        <!-- Dropdown - Messages -->
        <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
          <form class="form-inline mr-auto w-100 navbar-search">
            <div class="input-group">
              <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

      {{-- Home page --}}
      
      <li class="nav-item dropdown no-arrow  mx-1">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-desktop" ></i>
        </a>
        <!-- Dropdown - User Information -->
        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
         
         <a class="dropdown-item font-size-15" href="{{route('home')}}">
            <i class="fas fa-globe fa-sm fa-fw mr-2 "></i>
              Website
          </a>
         <a class="dropdown-item font-size-15" href="{{route('sell.index')}}">
            <i class="fas fa-tablet-alt fa-sm fa-fw mr-2 "></i>
            Màn hình thu ngân
          </a>
        
      </li>
      <li class="nav-item dropdown no-arrow  mx-1">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-cog" ></i>
        </a>
        <!-- Dropdown - User Information -->
        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
         
         <a class="dropdown-item font-size-15" href="{{route('admin.change.password.form')}}">
            <i class="fas fa-globe fa-sm fa-fw mr-2 "></i>
            Change Password
          </a>
         <a class="dropdown-item font-size-15" href="{{route('admin.settings')}}">
            <i class="fas fa-cogs fa-sm fa-fw mr-2 "></i>
            Settings
          </a>
          <div class="dropdown-divider"></div>
        
      </li>
      <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="{{route('home')}}" target="_blank" data-toggle="tooltip" data-placement="bottom" title="home"  role="button">
          <i class="fas fa-home fa-fw"></i>
        </a>
      </li>

      <!-- Nav Item - Alerts -->
      <li class="nav-item dropdown no-arrow mx-1">
       @include('backend.notification.show')
      </li>

      <!-- Nav Item - Messages -->
      
      <div class="topbar-divider d-none d-sm-block"></div>

      <!-- Nav Item - User Information -->
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
         <a class="dropdown-item font-size-15" href= "#" data-code="{{ $user->code }}" onclick="showUser(this)">
            <i class="fas fa-user fa-sm fa-fw mr-2 "></i>
            Thông tin cá nhân
          </a>
         <a class="dropdown-item font-size-15" href="{{route('admin.change.password.form')}}">
            <i class="fas fa-key fa-sm fa-fw mr-2 "></i>
            Change Password
          </a>
         <a class="dropdown-item font-size-15" href="{{route('admin.settings')}}">
            <i class="fas fa-cogs fa-sm fa-fw mr-2 "></i>
            Settings
          </a>
          <div class="dropdown-divider"></div>
         <a class="dropdown-item font-size-15" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                 <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 "></i> {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            <div class="dropdown-divider"></div>
            <div class="content-switch">
                <div id="switch">
                    <div id="circle"></div>
                </div>
            </div>
        </div>
      </li>

    </ul>

  </nav>
  