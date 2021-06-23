@extends('backend.layouts.master')
@section('main-content')
<!-- DataTales Example -->
<div class="card shadow ">
   <div class="row">
      <div class="col-md-12">
         @include('backend.layouts.notification')
      </div>
   </div>
   <div class="card-body">
      <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
         <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
           <div class="input-group">
             <input type="text" class="form-control bg-light border-0 small" placeholder="Tìm mặt hàng" aria-label="Search" aria-describedby="basic-addon2">
             
           </div>
         </form>
     
         <!-- Topbar Navbar -->
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
           <li class="nav-item dropdown no-arrow mx-1" id="messageT" data-url="{{route('admin.messages.five')}}">
             @include('backend.message.message')
           </li>
     
           <div class="topbar-divider d-none d-sm-block"></div>
     
           <!-- Nav Item - User Information -->
           <li class="nav-item dropdown no-arrow">
             <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{Auth()->user()->name}}</span>
               @if(Auth()->user()->photo)
                 <img class="img-profile rounded-circle" src="{{Auth()->user()->photo}}">
               @else
                 <img class="img-profile rounded-circle" src="{{asset('backend/img/avatar.png')}}">
               @endif
             </a>
             <!-- Dropdown - User Information -->
             <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
               <a class="dropdown-item" href="{{route('admin.admin-profile')}}">
                 <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                 Profile
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
     
         </ul>
     
       </nav>
      <div class="col-8">
         <div class="card">
            <div class="card-body">
               <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">First</th>
                      <th scope="col">Last</th>
                      <th scope="col">Handle</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th scope="row">1</th>
                      <td>Mark</td>
                      <td>Otto</td>
                      <td>@mdo</td>
                    </tr>
                    <tr>
                      <th scope="row">2</th>
                      <td>Jacob</td>
                      <td>Thornton</td>
                      <td>@fat</td>
                    </tr>
                    <tr>
                      <th scope="row">3</th>
                      <td>Larry</td>
                      <td>the Bird</td>
                      <td>@twitter</td>
                    </tr>
                  </tbody>
                </table>
            </div>
         </div>
         <div class="card">
            <div class="card-body">
               <div id="resize" class="demodiv"></div>

            </div>
         </div>
      </div>
      <div class="col-4">

      </div>
   </div>
</div>
@endsection
@push('styles')
   <style>
      .ui-resizable-helper {
         border: 1px dotted #999;
      }
      #resize {
         background-color: #ccc;
      }
      .demodiv {
         height: 150px;
         width: 150px;
         float: left;
         margin-left: 5px;
      }
   </style>
@endpush
@push('scripts')
   <script src="{{asset('backend/js/jquery-resizable.min.js')}}"></script>
   <script src="{{asset('backend/js/jquery-resizableTableColumns.min.js')}}"></script>
   <script>
      
      $('#resize').resizable({
         helper: "ui-resizable-helper",
         resizeWidth: false,
         delay: 10000000000,
     });
   </script>
@endpush