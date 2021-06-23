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
        <span>Nhân viên</span>
      </a>
      <div id="collapse-1" class="collapse" aria-labelledby="headingFive" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item" href="{{route('manager.user.index')}}">Tài khoản</a>
          <a class="collapse-item" href="{{route('manager.personel.index')}}">Nhân viên</a>
          <a class="collapse-item" href="{{route('manager.salary.index')}}">Bảng lương</a>
        </div>
      </div>
    </li>
</ul>