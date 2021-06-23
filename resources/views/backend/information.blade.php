@extends('backend.layouts.master')
@section('main-content')
<!-- DataTales Example -->
<div class="card shadow mb-4">
   <div class="row">
      <div class="col-md-12">
         @include('backend.layouts.notification')
      </div>
   </div>
   <div class="card-header py-3">
      <h4 class="m-0 font-weight-bold text-primary float-left"> Địa chỉ</h4>
      <button class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#modal" data-placement="bottom" title="Add User"><i class="fas fa-plus"></i> Thêm địa chỉ mới</button>
   </div>
   <div class="card-body">
      <div class="table-responsive">
        @if($informations>0)

         <table class="table table-bordered" id="order-dataTable" width="100%" cellspacing="0">
            <thead>
               <tr>
                  <th>STT</th>
                  <th>Họ và tên</th>
                  <th>Số điện thoại</th>
                  <th>Địa chỉ</th>
                  <th>Trạng thái</th>
                  <th></th>
               </tr>
            </thead>
            <tbody>
               @php
               $STT=1;
               @endphp
               @foreach($profiles as $item)  
               <tr>
                  <td>{{$STT}}</td>
                  @php
                  $STT++;
                  @endphp
                  <td>{{$item->name}}</td>
                  <td>{{$item->phone}}</td>
                  @php
                  $province=explode(',', $item->province);
                  $district=explode(',', $item->district);
                  $ward=explode(',', $item->ward);
                  $address=$item->address.", ". $ward[1].", ".$district[1].", ".$province[1];
                  @endphp
                  <td>{{$address}}</td>
                  <td>
                     @if($item->default=='1')
                     <span class="badge badge-primary">Mặc định</span>
                     @endif
                  </td>
                  <td>
                     <a href="#" onclick="modalUpdate({{$item->id}})" class="btn btn-warning btn-sm float-left mr-1 color-white" style="color:white;height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="Chỉnh sửa" data-placement="bottom"><i class="fas fa-pen"></i></a>
                     <a href="#" onclick="del({{$item->id}})" class="btn btn-danger btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="Xóa" data-placement="bottom"><i class="fas fa-trash"></i></a>
                     @if ($item->default!='1')
                     <a href="#" onclick="setDefault({{$item->id}})" class="btn btn-success btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="Đặt làm mặc định" data-placement="bottom"><i class="fas fa-lock"></i></a>

                     @endif
                 
                  </td>
               </tr>
               @endforeach
            </tbody>
         </table>

         @else
          <h6 class="text-center">Dữ liệu trống</h6>

        @endif
      </div>
   </div>
</div>
{{--  MODAL CREATE  --}}
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Thêm địa chỉ mới</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <div class="form-row">
               <div class="form-group col-md-6">
                  <label for="inputAddress">Họ & tên</label>
                  <input type="text" autofocus name="name" required  class="form-control" id="name-create" placeholder="Họ & tên">
                  <input type="hidden" value="{{Auth::id()}}" autofocus name="name" required  class="form-control" id="id-create" placeholder="Họ & tên">
                  <div class="dis-none alert m-t-5 alert-danger" id="error-create-name">
                </div>
                </div>
               <div class="form-group col-md-6">
                  <label for="inputAddress">Số điện thoại</label>
                  <input type="text"  name="phone" required  class="form-control" id="phone-create" placeholder="Số điện thoại">
                  <div class="dis-none alert m-t-5 alert-danger" id="error-create-phone">
                </div>
                </div>
            </div>
            <div class="form-group">
                <label for="inputAddress">Tỉnh - Thành phố</label>
                <select name="" required data-live-search="true" data-size="5" class="selectpicker province form-control" id="province-create" data-type="create" >
                </select>
                <div class="dis-none alert m-t-5 alert-danger" id="error-create-province">
                </div>
            </div>
            <div class="form-group dis-none form-district-create" >
                <label for="inputAddress">Quận - Huyện</label>
                <select name="" required data-live-search="true" data-size="5" class="selectpicker district form-control" id="district-create" data-type="create" >
                </select>
                <div class="dis-none alert m-t-5 alert-danger" id="error-create-district">
                </div>
            </div>
            <div class="form-group dis-none form-ward-create">
               <label for="inputAddress">Xã, phường</label>
               <select name="" required data-live-search="true" data-size="5" class="selectpicker ward ward-create form-control" id="ward-create" data-type="create">
               </select>
               <div class="dis-none alert m-t-5 alert-danger" id="error-create-ward">
            </div>
            </div>
            <div class="form-group">
               <label for="inputAddress">Địa chỉ</label>
               <input type="text"  name="address" required  class="form-control" id="address-create" placeholder="Số nhà, khu, thôn">
               <div class="dis-none alert m-t-5 alert-danger" id="error-create-address">
            </div>
            </div>
         </div>
         <div class="modal-footer">
            <button type="button" disabled  class="float-right btn btn-primary btn-store dis-none" onclick="store()" style="display:none">Lưu</button>
         </div>
      </div>
   </div>
</div>
{{--  MODAL UPDATE  --}}
<div class="modal fade" id="modal-update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Thay đổi địa chỉ</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <div class="form-row">
               <div class="form-group col-md-6">
                  <label for="inputAddress">Họ & tên</label>
                  <input type="hidden" id="profile-id">
                  <input type="text" autofocus name="name" required  class="form-control" id="name-update" placeholder="Họ & tên">
                  <input type="hidden" value="{{Auth::id()}}" autofocus name="name" required  class="form-control" id="id-update" placeholder="Họ & tên">
                  <div class="dis-none alert m-t-5 alert-danger" id="error-update-name">
                    </div>
                </div>
               <div class="form-group col-md-6">
                  <label for="inputAddress">Số điện thoại</label>
                  <input type="text"  name="phone" required  class="form-control" id="phone-update" placeholder="Số điện thoại">
                  <div class="dis-none alert m-t-5 alert-danger" id="error-update-phone">
                </div>
                </div>
            </div>
            <div class="form-group ">
               <label for="province_update">Tỉnh, thành phố</label>
                <select name="" required data-live-search="true" data-size="5" class="selectpicker  form-control" id="province-update" data-type="update" >

               </select>
               <div class="dis-none alert m-t-5 alert-danger" id="error-update-province">
            </div>
            </div>
            <div class="form-group  form-district-update" >
                <label for="province_update">Quận, huyện</label>

                <select name="" required data-live-search="true" data-size="5" class="selectpicker  form-control" id="district-update" data-type="update" >

               </select>
               <div class="dis-none alert m-t-5 alert-danger" id="error-update-district">
            </div>
            </div>
            <div class="form-group  form-ward-update">
               <label for="inputAddress">Xã, phường</label>
               <select name="" required data-live-search="true" data-size="5" class="selectpicker  form-control" id="ward-update" data-type="update" >
                  
               </select>
               <div class="dis-none alert m-t-5 alert-danger" id="error-update-ward">
            </div>
            </div>
            <div class="form-group">
               <label for="inputAddress">Địa chỉ</label>
               <input type="text"  name="address" required  class="form-control" id="address-update" placeholder="Số nhà, khu, thôn">
               <div class="dis-none alert m-t-5 alert-danger" id="error-update-address">
            </div>
            </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="float-left btn btn-secondary dis-none" data-dismiss="modal">Đóng</button>
            <button type="button"  class="float-right btn btn-primary btn-store " style="display:none"  onclick="update()">Lưu</button>
         </div>
      </div>
   </div>
</div>
@endsection
@push('styles')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
{{--  <link href="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">  --}}
<link href="{{asset('css/bootstrap-select.css')}}" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />

@endpush
@push('scripts')
<script src="{{asset('js/bootstrap-select.js')}}"></script>

<!-- Page level plugins -->
<script src="{{asset('backend/vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<!-- Page level custom scripts -->
<script src="{{asset('backend/js/demo/datatables-demo.js')}}"></script>
  <script>
    
      
$.ajaxSetup({
  headers: {
      "token": "c43d29e2-4407-11eb-b7e7-eeaa791b204b",
  }
});
    $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      
          province();
      function province() {
      $.ajax({
          type: 'post',
          dataType: 'json',
          url: 'https://online-gateway.ghn.vn/shiip/public-api/master-data/province',
          success: function(result) {
              if (result.code == 200) {
                  var data=result.data;
                    for (var item of data) {
                        content += '<option value="' + item.ProvinceID + '">' + item.ProvinceName + '</option>';
                    }
                  $("#province-create").html(content).selectpicker('refresh');;
                  {{--  getDistrict();  --}}
    
              }
          },
          error: function(errors) {
              console.log(errors);
          }
      });
    }
    $(function () {
        $('.selectpicker').selectpicker();
          });
    $(".province").on("change", function () {
      var type=$(this).data('type');
    var province_id = $(this).val();
    $(".form-ward-create").addClass('dis-none');
    $(".btn-store").css('display', 'none');

    getDistrict(province_id,type) ;
    
    });
    $(".district").on("change", function () {
      var type=$(this).data('type');
    var district_id = $(this).val();
    getWard(district_id,type) ;
    });
    function getDistrict(province_id,type) {
      $(".form-district-create").removeClass('dis-none');
      $.ajax({
          type: 'get',
          dataType: 'json',
          url: 'https://online-gateway.ghn.vn/shiip/public-api/master-data/district',
          data: {
              "province_id": province_id,
          },
          success: function(result) {
              if (result.code == 200) {
                  var data = result.data;
                  var content="";
                  for (var item of data) {
                      content += '<option value="' + item.DistrictID + '">' + item.DistrictName + '</option>';
                  }
                  $("#district-create").html(content).selectpicker('refresh');;
              }
          },
          error: function(errors) {
              console.log(errors);
          }
      });
    }
    
    function getWard(district_id,type) {
          $(".form-ward-create").removeClass('dis-none');
          $(".btn-store").css("display","block");
    
      $.ajax({
          type: 'post',
          dataType: 'json',
          url: 'https://online-gateway.ghn.vn/shiip/public-api/master-data/ward?district_id',
          data: {
              "district_id": district_id,
          },
          success: function(data) {
              if (data.code == 200) {
                  var data = data.data;
                  var content="";
                  for (var item of data) {
                      if (item.DistrictID == district_id) {
                          content += '<option value="' + item.WardCode + '">' + item.WardName + '</option>';
    
                      }
                  }
                  $("#ward-create").html(content).selectpicker('refresh');;

              }
          },
          error: function(errors) {
              console.log(errors);
          }
      });
    }
    function store(e){
    var name=$("#name-create").val();
    var phone=$("#phone-create").val();
    var address=$("#address-create").val();
    var province=[$("#informations option:selected").val(),$("#province-create option:selected").text()];
    var district=[$("#district-create option:selected").val(),$("#district-create option:selected").text()];
    var ward=[$("#ward-create option:selected").val(),$("#ward-create option:selected").text()];
    var region=getRegion(province);
    var urban=getUrban(province[1],district[1]);
    var arr=['name','phone','phone','province','district','ward','address'];
          for(var i of arr){
            $("#" + "error-create-"+i).addClass('dis-none');
            $("#" + i+"-create").removeClass('input-validation-error');
          }
          
    $.ajaxSetup({
      headers: {
          "token": "c43d29e2-4407-11eb-b7e7-eeaa791b204b",
      }
    });
    $.ajax({
        type: 'post',
        dataType: 'json',
        url: '/user/address',
        data: {
            name:name,
            phone:phone,
            province:province,
            district:district,
            ward:ward,
            address:address,
            urban:urban,
            region:region,

        },
        success: function(result) {
            {
                alertify.set('notifier', 'position', 'bottom-right');
                alertify.success('Thay đổi thành công');
                  location.reload(); 
            }
        },
        error: function(errors) {
            if( errors.status === 422 ) {
              var errors = $.parseJSON(errors.responseText).errors;
              console.log(errors);
              $.each(errors, function (key, val) {
                  $("#" + key+"-create").addClass('input-validation-error');
                  $("#" + "error-create-"+key).removeClass('dis-none');
                  $("#" + "error-create-"+key).text(val[0]);
              });
            }
          }
    });
    }
    function modalUpdate(id){
    $.ajax({
      type: 'get',
      dataType: 'json',
      url: '/user/address/'+id+'/edit',
      
      success: function(result) {
          $("#modal-update").modal("toggle");
          $("#name-update").val(result['name']);
          $("#profile-id").val(result['id']);
          $("#phone-update").val(result['phone']);
          $("#address-update").val(result['address']);
          var province=result['province'].split(',')[0];
          var district=result['district'].split(',')[0];
          var ward=result['ward'].split(',')[0];
          provinceModalUpdate(province,district,ward)
          
      }
    })
    }
    function provinceModalUpdate(province,district,ward){
      $.ajax({
        type: 'post',
        dataType: 'json',
        url: 'https://online-gateway.ghn.vn/shiip/public-api/master-data/province',
        success: function(data) {
            if (data.code == 200) {
                var data = data.data;
                var content = "";
                for (var item of data) {
                    {{--  if (item.ProvinceID == province) {
                        var province_name = item.ProvinceName;
                        content += '<option selected value="' + item.ProvinceID + '">' + item.ProvinceName + '</option>';
                    } else {  --}}
                        content += '<option value="' + item.ProvinceID + '">' + item.ProvinceName + '</option>';
                    {{--  }  --}}
                };
                console.log(content);
                {{--  $('#province-update').html(content).val(item.ProvinceID).selectpicker('render');  --}}
                $('#province-update').html(content).val(item.ProvinceID).selectpicker('refresh');
                $.ajax({
                    type: 'get',
                    dataType: 'json',
                    url: 'https://online-gateway.ghn.vn/shiip/public-api/master-data/district',
                    data: {
                        "province_id": province,
                    },
                    success: function(data) {
                        if (data.code == 200) {
                            var data = data.data;
                            var content = "";
                            for (var item of data) {
                                if (item.DistrictID == district) {
                                    var district_name = item.DistrictName;
                                    content += '<option selected value="' + item.DistrictID + '">' + item.DistrictName + '</option>';
                                } else {
                                    content += '<option value="' + item.DistrictID + '">' + item.DistrictName + '</option>';
                                }
                            }
                            $("#district-update").html(content).selectpicker('refresh');;

                            $('.form-district').removeClass('dis-none');
                            $.ajax({
                                type: 'post',
                                dataType: 'json',
                                url: 'https://online-gateway.ghn.vn/shiip/public-api/master-data/ward?district_id',
                                data: {
                                    "district_id": district,
                                },
                                success: function(data) {
                                    if (data.code == 200) {
                                        var data = data.data;
                                        var content = "";
                                        for (var item of data) {
                                            if (item.DistrictID == district) {
                                                if (item.WardCode == ward) {
                                                    var ward_name = item.WardName;
                                                    content += '<option selected value="' + item.WardCode + '">' + item.WardName + '</option>';
                                                } else {
                                                    content += '<option value="' + item.WardCode + '">' + item.WardName + '</option>';
                                                }
                                            }
                                        }
                                        $("#ward-update").html(content).selectpicker('refresh');;
                                        $('.form-ward').removeClass('dis-none');
                                    }
                                },
                                error: function(errors) {
                                    console.log(errors);
                                }
                            });
                        }
                    },
                    error: function(errors) {
                        console.log(errors);
                    }
                });
            }
        },
        error: function(errors) {
            console.log(errors);
        }
    });  
    }
    function update(){
      var id=$("#profile-id").val();
      var name=$("#name-update").val();
    var phone=$("#phone-update").val();
    var address=$("#address-update").val();
    var province=[$(".province-update option:selected").val(),$(".province-update option:selected").text()];
    var district=[$(".district-update option:selected").val(),$(".district-update option:selected").text()];
    var ward=[$(".ward-update option:selected").val(),$(".ward-update option:selected").text()];
    $.ajaxSetup({
      headers: {
          "token": "c43d29e2-4407-11eb-b7e7-eeaa791b204b",
      }
    });
    $.ajax({
        type: 'put',
        dataType: 'json',
        url: '/user/address/'+id,
        data: {
            name:name,
            phone:phone,
            province:province,
            district:district,
            ward:ward,
            address:address,
        },
        success: function(result) {
            {
                alertify.set('notifier', 'position', 'bottom-right');
                alertify.success('Thay đổi thành công');
                  $("#modal-update .close").click();
                  location.reload(); 
            }
        }
    });
    }
    function setDefault(id){
      $.ajaxSetup({
        headers: {
            "token": "c43d29e2-4407-11eb-b7e7-eeaa791b204b",
        }
      });
      $.ajax({
          type: 'post',
          dataType: 'json',
          url: '/user/address/default',
          data: {
              id:id
          },
          success: function(result) {
              {
                  alertify.set('notifier', 'position', 'bottom-right');
                    location.reload(); 
                    alertify.success('Thay đổi thành công');

              }
          }
      });
    }
    function del(id){
      console.log('ok');
      Swal.fire({
        title: 'Bạn có muốn xóa địa chỉ này',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Xóa',
        cancelButtonText: 'Trở lại',
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajaxSetup({
            headers: {
                "token": "c43d29e2-4407-11eb-b7e7-eeaa791b204b",
            }
          });
          $.ajax({
              type: 'delete',
              dataType: 'json',
              url: '/user/address/'+id,
              
              success: function(result) {
                  {
                    Swal.fire(
                      'Deleted!',
                      'Cập nhật thành công',
                      'success'
                    )
                    location.reload(); 
                  }
              },
              error: function(xhr, status, error) {
                Swal.fire(
                      'Deleted!',
                      'Địa chỉ không thể xóa',
                      'error'
                    )
            }
          });
          
        }
      })
      
    }
    function getRegion(province){
        var province=province[1];
        region_1=['Bắc Ninh', 'Hà Nam', 'Hà Nội', 'Hải Dương', 'Hưng Yên', 'Hải Phòng', 'Nam Định', 'Ninh Bình', 'Thái Bình', 'Vĩnh Phúc','Hà Giang', 'Cao Bằng', 'Bắc Kạn', 'Lạng Sơn', 'Tuyên Quang', 'Thái Nguyên', 'Phú Thọ', 'Bắc Giang', 'Quảng Ninh'];
        region_2=['Thanh Hoá', 'Nghệ An', 'Hà Tĩnh', 'Quảng Bình', 'Quảng Trị','Thừa Thiên-Huế','Đà Nẵng', 'Quảng Nam','Quảng Ngãi', 'Bình Định', 'Phú Yên', 'Khánh Hòa', 'Ninh Thuận','Bình Thuận'];
        region_3=['Bình Phước', 'Bình Dương', 'Đồng Nai', 'Tây Ninh', 'Bà Rịa-Vũng Tàu', 'Hồ Chí Minh','Long An', 'Đồng Tháp', 'Tiền Giang', 'An Giang. Bến Tre', 'Vĩnh Long', 'Trà Vinh', 'Hậu Giang', 'Kiên Giang. Sóc Trăng', 'Bạc Liêu', 'Cà Mau', 'Cần Thơ'];
        var region;
        for(var i of region_1){
          if(province==i){
            return region=1;
          }
        }
        for(var i of region_2){
          if(province==i){
            return region=2;
          }
        }
        for(var i of region_3){
          if(province==i){
            return region=3;
          }
        }
    }
    function getUrban(province,district){
        switch(province) {
            case 'Hà Nội':
                arr=['Quận Ba Đình','Quận Hoàn Kiếm','Quận Đống Đa','Quận Thanh Xuân','Quận Cầu Giấy','Quận Hoàng Mai','Quận Hai Bà Trưng','Quận Tây Hồ'];
                for(var item of arr){
                if(item==district){
                    return 1;
                }
                else{
                    return 0;
                }
            }
            
                break;
            case 'Hồ Chí Minh':
              // code block
              arr=['Quận 1', 'Quận 2', 'Quận 3', 'Quận 4' ,'Quận 5' ,'Quận 6' ,'Quận 7' ,'Quận 8' ,'Quận 10', 'Quận 11', 'Quận Bình Thạnh', 'Quận Gò Vấp', 'Quận Phú Nhuận', 'Quận Tân Bình', 'Quận Tân Phú'];
              for(var item of arr){
                if(item==district){ 
                    return 1;
                }
                else{
                    return 0;
                }
            }

              break;
            case 'Đà Nẵng':
                arr=[ 'Quận Hải Châu', 'Quận Thanh Khê', 'Quận Liên Chiểu', 'Quận Cẩm Lệ'];
                for(var item of arr){
                    if(item==district){
                        return 1;
                    }
                    else{
                        return 0;
                    }
                }

            break;
            default:
                var arr=district.split(' ');
                var prefix=arr[0];
                switch(prefix) {
                    case 'Huyện':
                      return 0;
                      break;
                    default:
                        return 1;
                  }
          }
    }
  </script>
@endpush
