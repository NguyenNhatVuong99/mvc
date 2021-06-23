{{-- <!DOCTYPE html>
<html lang="en">

@include('backend.layouts.head')
  <body class="hero-anime">	
        @include('backend.layouts.header')
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
         <div class="main"> 
          <div class="section full-height" >
            <div class="section" style="margin-top: 1rem !important">
          @yield('main-content')
            </div>
          </div>
          <div class="button_scroll2top" onclick="page_scroll2top()"><i class="fa fa-chevron-up"/></div>
          
         </div> 
        
        <!-- /.container-fluid -->

      <!-- End of Main Content -->
       @include('backend.layouts.footer') 
      @include('backend.layouts.script')

</body>

</html> --}}
<!DOCTYPE html>
<html lang="en">

@include('backend.layouts.head')
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
        @include('backend.layouts.header')
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        @yield('main-content')
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
      @include('backend.layouts.footer')
      @include('backend.layouts.script')

</body>

</html>
