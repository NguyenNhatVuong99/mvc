

@section('title', 'Tài khoản')
@extends('backend.layouts.master')
@section('main-content')
<!-- DataTales Example -->
<div class="card shadow mb-4">
<div class="row">
   <div class="col-md-12">
      @include('backend.layouts.notification')
   </div>
</div>
<!-- Button trigger modal -->
<!-- Modal -->
<div class="wrapper">
    <div class="profile-card js-profile-card">
      <div class="profile-card__img">
        @if($user->avatar)
        <img class="img-profile rounded-circle" src="{{$user->avatar}}">
      @else
        @php
        $avatar=Avatar::create($user->name)->setBackground('#446ad8')->toBase64();
        @endphp
        <img  class="img-profile rounded-circle" src="{{ $avatar }}" alt="">
      @endif
        {{--  <img src="https://res.cloudinary.com/muhammederdem/image/upload/v1537638518/Ba%C5%9Fl%C4%B1ks%C4%B1z-1.jpg" alt="profile card">  --}}
      </div>
  
      <div class="profile-card__cnt js-profile-cnt">
        <div class="profile-card__name">{{ $user->name }}</div>
        <div class="profile-card__txt">
          <strong>
          @foreach($user->roles as $key => $role)
            {{ $role->name }}
          @endforeach
          </strong>
        </div>
        <div class="profile-card-loc">
            <div class="leftbox">
              <nav>
                <a id="profile" class="active" style="color:#fff; font-size:1.5rem" ><i class="fa fa-user"></i></a>
                <a id="address"><i class="fa fa-map-marker-alt"></i></a>
                
                  @if($user->roles[0]['isPersonel']==1)
                    <a id="personel"><i class="fa fa-store"></i></a>
                  @endif
                {{--  <a id="payment"><i class="fa fa-credit-card"></i></a>
                <a id="subscription"><i class="fa fa-tv"></i></a>
                <a id="privacy"><i class="fa fa-tasks"></i></a>
                <a id="settings"><i class="fa fa-cog"></i></a>  --}}
              </nav>
            </div>
            <div class="rightbox">
              <div class="profile">
                <h1>Thông tin cá nhân</h1>
                <h2>Họ và tên</h2>
                <p>{{ $user->name }} 
                <h2>Email</h2>
                <p>{{ $user->email }}</p>
                <h2>Số điện thoại</h2>
                <p>{{ $user->phone }}</p>
                <h2>Vị trí</h2>
                <p>
                  @foreach($user->roles as $key => $role)
                  {{ $role->name }}
                @endforeach
              </p>
              </div>
              
              <div class="address noshow">
                <h1>Địa chỉ</h1>
              </div>
              
              <div class="personel noshow">
                <h1>Thông tin nhân viên</h1>
                <h2>Chi nhánh</h2>
                <p>
                    <a href="#">{{ $user->branch->name }}</a>
                </p>  
                <h2>Ngày bắt đầu làm việc</h2>
                <p>
                  {{ \Carbon\Carbon::parse($personel->start_date)->format('d/m/Y')}}
                </p>
                @if ($personel->end_date!=null)
                <h2>Ngày nghỉ việc</h2>
                <p>
                  {{ \Carbon\Carbon::parse($personel->end_date)->format('d/m/Y')}}
                </p>  
                @endif
                <h2>Hình thức làm việc</h2>
                <p>
                  {{ $personel->categoryWork->name }}
                </p>
                <h2>Hình thức lương</h2>
                <p>
                  {{ $personel->type_salary }}
                </p>
                
                <h2>Tiền lương</h2>
                <p>
                  @php
                    if($personel->type_salary=='Lương theo tháng'){
                      $str='/tháng';
                    }
                    else{
                      $str='/giờ';

                    }
                      echo number_format($personel->salary).$str;
                  @endphp
                </p>
              </div>
            </div>
        </div>
      </div>
      </div>
    </div>
  </div>
@endsection
@push('styles')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
  
@endpush
@push('scripts')
  <script src="{{ asset('js/address.js') }}"></script>
  <script>
    var profiles=<?php echo $user->profiles ?>;
    profile();
    function profile(){
      var content=''
      var index=1;
        for(item of profiles){

          var address=convertAddress(item['province'],item['district'],item['ward'],item['address']);
          content='<h2>Địa chỉ '+index+'</h2>'+
                '<p>'+item['name']+'</p>'+
                '<p>'+item['phone']+'</p>'+
                '<p>'+address+'</p>';
                index++;

        }
        $(".address").append(content);
    }
    $('.profile-card-loc nav a').click(function(e) {
      e.preventDefault();
      $('.profile-card-loc  nav a').css({'color':'#aec4dd','font-size':'1.1rem'});
      $(this).css({'color':'#fff','font-size':'1.5rem'});
      if(this.id === !'address'){
        $('.address').addClass('noshow');
      }
      else if(this.id === 'address') {
        $('.address').removeClass('noshow');
        $('.rightbox').children().not('.address').addClass('noshow');
      }
      else if (this.id === 'profile') {
        $('.profile').removeClass('noshow');
         $('.rightbox').children().not('.profile').addClass('noshow');
      }
      else if(this.id === 'personel') {
        $('.personel').removeClass('noshow');
        $('.rightbox').children().not('.personel').addClass('noshow');
      }
        else if(this.id === 'privacy') {
        $('.privacy').removeClass('noshow');
        $('.rightbox').children().not('.privacy').addClass('noshow');
      }
      else if(this.id === 'settings') {
        $('.settings').removeClass('noshow');
        $('.rightbox').children().not('.settings').addClass('noshow');
      }
    });
  </script>
@endpush
