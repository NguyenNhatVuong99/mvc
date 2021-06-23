@role('Admin')
  @include('backend.layouts.sidebar.admin')
@endrole
@role('Quản lý')
  @include('backend.layouts.sidebar.manager')
@endrole
@role('Thu ngân')
  @include('backend.layouts.sidebar.cashier')
@endrole
@role('Nhân viên bán hàng')
  @include('backend.layouts.sidebar.nhanVien')
@endrole
@role('Nhân viên giữ xe')
  @include('backend.layouts.sidebar.nhanVien')
@endrole
@role('Khách hàng')
  @include('backend.layouts.sidebar.khachHang')
@endrole
@role('Nhân viên giao hàng')
  @include('backend.layouts.sidebar.giaoHang')
@endrole
