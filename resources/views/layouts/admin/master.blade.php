
<!DOCTYPE html>
<html lang="en">

@include('layouts.admin.head')
<body id="page-top" class="hero-anime">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper " class="grid-12 d-flex flex-column" style="width:100%">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        @include('layouts.admin.header')
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        @yield('main-content')
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
      @include('layouts.admin.footer')
      @include('layouts.admin.script')

</body>

</html>
