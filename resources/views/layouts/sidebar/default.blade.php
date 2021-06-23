<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('admin.index')}}">
      <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-laugh-wink"></i>
      </div>
      <div class="sidebar-brand-text mx-3">Admin</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse-1" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-users"></i>
        <span>Người dùng</span>
      </a>
      <div id="collapse-1" class="collapse" aria-labelledby="headingFive" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item" href="{{route('admin.user.index')}}">Tài khoản</a>
          <a class="collapse-item" href="{{route('admin.role.index')}}">Quyền truy cập</a>
          <a class="collapse-item" href="{{route('admin.personel.index')}}">Nhân viên</a>
        </div>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse-2" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-store-alt"></i>
        <span>Cửa hàng</span>
      </a>
      <div id="collapse-2" class="collapse" aria-labelledby="headingFive" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item" href="{{route('admin.shift.index')}}">Ca làm việc</a>
          <a class="collapse-item" href="{{route('admin.holiday.index')}}">Ngày lễ</a>
          <a class="collapse-item" href="{{route('admin.branch.index')}}">Chi nhánh</a>
          <a class="collapse-item" href="{{route('admin.personel.index')}}">Nhân viên</a>
        </div>
      </div>
    </li>
    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
      <a class="nav-link" href="{{route('admin.sale.index')}}">
        <i class="fas fa-fw fa-shopping-cart"></i>
        <span>Bán hàng</span></a>
    </li>
   

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Banner
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <!-- Nav Item - Charts -->
  

    <li class="nav-item">
      <a class="nav-link collapsed" href="{{route('admin.banner.index')}}">
        <i class="fas fa-image"></i>
        <span>Ảnh bìa</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link collapsed" href="{{route('admin.ship.index')}}">
        <i class="fas fa-image"></i>
        <span>Giao hàng</span>
      </a>
    </li>
        <hr class="sidebar-divider">

    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse5" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-image"></i>
        <span>Quản lý đơn hàng</span>
      </a>
      <div id="collapse5" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item" href="{{route('admin.order.index')}}">Đơn hàng</a>
        </div>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse1" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-image"></i>
        <span>Quản lý sản phẩm</span>
      </a>
      <div id="collapse1" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Banner Options:</h6>
          <a class="collapse-item" href="{{route('admin.category.index')}}">Loại sản phẩm</a>
          <a class="collapse-item" href="{{route('admin.product.index')}}">Sản phẩm</a>
          <a class="collapse-item" href="{{route('admin.receipt-stock.index')}}">Xuất-nhập kho</a>
          <a class="collapse-item" href="{{route('admin.stock.index')}}">Kho sản phẩm</a>
          <a class="collapse-item" href="{{route('admin.coupon.index')}}">Khuyến mãi</a>
          <a class="collapse-item" href="{{route('admin.order.index')}}">Đơn hàng</a>
        </div>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse2" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-image"></i>
        <span>Ngân quỹ</span>
      </a>
      <div id="collapse2" class="collapse" aria-labelledby="headingThere" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item" href="{{route('admin.category.index')}}">Tổng quan</a>
          {{-- <a class="collapse-item" href="{{route('admin.receipt.PT')}}">Phiếu thu</a> --}}
          <a class="collapse-item" href="{{route('admin.PC')}}">Phiếu Chi</a>
          <a class="collapse-item" href="{{route('admin.PT')}}">Phiếu Thu</a>
          <a class="collapse-item" href="{{route('admin.cash-book')}}">Sổ quỹ</a>
        </div>
      </div>
    </li>
 
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse4" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-image"></i>
        <span>Kho</span>
      </a>
      <div id="collapse4" class="collapse" aria-labelledby="headingFive" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item" href="{{route('admin.PN')}}">Phiếu nhập kho</a>
          <a class="collapse-item" href="{{route('admin.PX')}}">Phiếu xuất kho</a>
          <a class="collapse-item" href="{{route('admin.stockBalance')}}">Cân đối kho</a>
        </div>
      </div>
    </li>
  <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse-debt" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-image"></i>
        <span>Công nợ</span>
      </a>
      <div id="collapse-debt" class="collapse" aria-labelledby="headingFive" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item" href="{{url('admin/CNPT')}}">Công nợ phải thu</a>
          <a class="collapse-item" href="{{url('admin/CNPC')}}">Công nợ phải chi</a>
          <a class="collapse-item" href="{{url('admin/stock')}}">Kho</a>
        </div>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse-debt" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-image"></i>
        <span>Công nợ</span>
      </a>
      <div id="collapse-debt" class="collapse" aria-labelledby="headingFive" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item" href="{{url('admin/CNPT')}}">Công nợ phải thu</a>
          <a class="collapse-item" href="{{url('admin/CNPC')}}">Công nợ phải chi</a>
          <a class="collapse-item" href="{{url('admin/stock')}}">Kho</a>
        </div>
      </div>
    </li>
 
    <!-- Divider -->
    
</ul>