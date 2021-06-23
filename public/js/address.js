// $.ajaxSetup({
//     headers: {
//         "token": "c43d29e2-4407-11eb-b7e7-eeaa791b204b",
//     }
// });
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
            province();
        function province() {
        $.ajax({
            type: 'get',
            dataType: 'json',
            url: 'https://vapi.vnappmob.com/api/province/',
            success: function(response) {
                    var data=response.results;
                    var content="";
                    for (var item of data) {
                        content += '<option value="' + item.province_id + '">' + item.province_name + '</option>';
                    }
                    $("#province-create").html(content);
                    $("#province-create").selectpicker('refresh');
                    // getDistrict(); 
    
            },
            error: function(errors) {
                console.log(errors);
            }
        });
    }
    // $(function () {
    //     $('.ward-create').selectpicker();  --}}
    //     $('#province-create').selectpicker();
    //     {{--  $('.district-create').selectpicker();  --}}
    //     $('.selectpicker').selectpicker();
    //         });
    $("#province-create").on("change", function () {
        var type=$(this).data('type');
    var province_id = $(this).val();
    $(".form-ward-create").addClass('dis-none');

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
            url: 'https://vapi.vnappmob.com/api/province/district/'+province_id,
            
            success: function(response) {
                    var data = response.results;
                    var content="";
                    for (var item of data) {
                        content += '<option value="' + item.district_id + '">' + item.district_name + '</option>';
                    }
                    $("#district-create").html(content).selectpicker('refresh');;
            },
            error: function(errors) {
                console.log(errors);
            }
        });
    }
    
    function getWard(district_id,type) {
            $(".form-ward-create").removeClass('dis-none');
        $.ajax({
            type: 'get',
            dataType: 'json',
            url: 'https://vapi.vnappmob.com/api/province/ward/'+district_id,
            success: function(response) {
                    var data = response.results;
                    var content="";
                    for (var item of data) {
                            content += '<option value="' + item.ward_id + '">' + item.ward_name + '</option>';
    
                    }
                    $("#ward-create").html(content).selectpicker('refresh');;

            },
            error: function(errors) {
                console.log(errors);
            }
        });
    }
    function wordInString(string, keywords) {
        return string.split(/\b/).some(Array.prototype.includes.bind(keywords));
    }
    function splitProvince(province){
        console.log(province);
        var prefix_province=['Thành phố','Tỉnh'];
        for(var item of prefix_province){
            console.log(province.indexOf(item)); 
        }
    }
    function convertAddress(province,district,ward,address){
        province=province.split(',');
        district=district.split(',');
        ward=ward.split(',');
        address+=", "+ward[1]+", "+district[1]+", "+province[1];
        return address;
    }
    function store(e){
    var name=$("#name-create").val();
    var phone=$("#phone-create").val();
    var email=$("#email-create").val();
    var address=$("#address-create").val();
    var str_province=prefixProvince($("#province-create option:selected").val());

    var province=[str_province,$("#province-create option:selected").text()];
    var district=[$("#district-create option:selected").val(),$("#district-create option:selected").text()];
    var ward=[$("#ward-create option:selected").val(),$("#ward-create option:selected").text()];

    var region=getRegion(province);
    var urban=getUrban(region,district[1]);
    // var arr=['name','phone','province','district','ward','address'];
    //         for(var i of arr){
    //         $("#" + "error-create-"+i).addClass('dis-none');
    //         $("#" + i+"-create").removeClass('input-validation-error');
    //         }
            
    
    $.ajax({
        type: 'post',
        dataType: 'json',
        url: '{{route("admin.user.store)}}',
        data: {
            name:name,
            email:email,
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
    // function modalUpdate(id){
    // $.ajax({
    //     type: 'get',
    //     dataType: 'json',
    //     url: '/user/address/'+id+'/edit',
        
    //     success: function(result) {
    //         $("#modal-update").modal("toggle");
    //         $("#name-update").val(result['name']);
    //         $("#profile-id").val(result['id']);
    //         $("#phone-update").val(result['phone']);
    //         $("#address-update").val(result['address']);
    //         var province=result['province'].split(',')[0];
    //         var district=result['district'].split(',')[0];
    //         var ward=result['ward'].split(',')[0];
    //         provinceModalUpdate(province,district,ward)
            
    //     }
    // })
    // }
    // function provinceModalUpdate(province,district,ward){
    //     $.ajax({
    //         type: 'post',
    //         dataType: 'json',
    //         url: 'https://online-gateway.ghn.vn/shiip/public-api/master-data/province',
    //         success: function(data) {
    //             if (data.code == 200) {
    //                 var data = data.data;
    //                 console.log(province); 
    //                 var content = "";
    //                 for (var item of data) {
    //                     {{--  if (item.ProvinceID == province) {
    //                         var province_name = item.ProvinceName;
    //                         content += '<option selected value="' + item.ProvinceID + '">' + item.ProvinceName + '</option>';
    //                     } else {    --}}
    //                         content += '<option value="' + item.ProvinceID + '">' + item.ProvinceName + '</option>';
    //                     {{--  }  --}}
    //                 };
    //                 $('#province-update').html(content).val(item.ProvinceID);
    //                 $('#province-update').selectpicker('refresh');
                
    //             }
    //         }
    //     })
    // }
    function prefixProvince(province){
        var prefix_province=['Thành phố','Tỉnh'];
        for(var item of prefix_province){
            if(province.indexOf(item)>=0){
                var length=item.length+1;
                return province.slice(length);
            }
        }
    }
    function getRegion(province){
        region_1=['Bắc Ninh', 'Tỉnh Hà Nam', 'Hà Nội', 'Hải Dương', 'Hưng Yên', 'Hải Phòng', 'Nam Định', 'Ninh Bình', 'Thái Bình', 'Vĩnh Phúc','Hà Giang', 'Cao Bằng', 'Bắc Kạn', 'Lạng Sơn', 'Tuyên Quang', 'Thái Nguyên', 'Phú Thọ', 'Bắc Giang', 'Quảng Ninh'];
        region_2=['Thanh Hoá', 'Nghệ An', 'Hà Tĩnh', 'Quảng Bình', 'Quảng Trị','Thừa Thiên-Huế','Đà Nẵng', 'Quảng Nam','Quảng Ngãi', 'Bình Định', 'Phú Yên', 'Khánh Hòa', 'Ninh Thuận','Bình Thuận'];
        region_3=['Bình Phước', 'Bình Dương', 'Đồng Nai', 'Tây Ninh', 'Bà Rịa-Vũng Tàu', 'Thành phố Hồ Chí Minh','Long An', 'Đồng Tháp', 'Tiền Giang', 'An Giang. Bến Tre', 'Vĩnh Long', 'Trà Vinh', 'Hậu Giang', 'Kiên Giang. Sóc Trăng', 'Bạc Liêu', 'Cà Mau', 'Cần Thơ'];
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
    