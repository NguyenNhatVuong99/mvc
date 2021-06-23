<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('admin.index')}}">
      <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-laugh-wink"></i>
      </div>
      <div class="sidebar-brand-text mx-3">Admin</div>
    </a>

    <!-- Divider -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse-1" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-users"></i>
        <span>Người dùng</span>
      </a>
        <div id="collapse-1" class="collapse" aria-labelledby="headingFive" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{route('admin.user.index')}}">Tài khoản</a>
            <a class="collapse-item" href="{{route('admin.role.index')}}">Quyền truy cập</a>
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
          <a class="collapse-item" href="{{route('admin.branch.index')}}">Chi nhánh</a>
          <a class="collapse-item" href="{{route('admin.personel.index')}}">Nhân viên</a>
          <a class="collapse-item" href="{{route('admin.salary.index')}}">Bảng lương</a>

        </div>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse-3" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-tshirt "></i>
        <span>Sản phẩm</span>
      </a>
      <div id="collapse-3" class="collapse" aria-labelledby="headingFive" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item" href="{{route('admin.product.index')}}">Sản phẩm</a>

        </div>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse-4" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-users "></i>
        <span>Đối tác</span>
      </a>
      <div id="collapse-4" class="collapse" aria-labelledby="headingFive" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item" href="{{route('admin.product.index')}}">Sản phẩm</a>

        </div>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse-5" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-globe "></i>
        <span>Trang web</span>
      </a>
      <div id="collapse-5" class="collapse" aria-labelledby="headingFive" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item" href="{{route('admin.banner.index')}}">Ảnh bìa</a>

        </div>
      </div>
    </li>
</ul>