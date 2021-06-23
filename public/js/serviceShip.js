var InfoCheckout = {
    ProvinceID: '',
    ProvinceName: '',
    ToDistrictID: '',
    ToWardCode: '',
    ToRegion: '',
    ToUrban: '',
};

function InfoUserCheckout(id) {
    var name = $("#name_receiver_" + id).val();
    var phone = $("#phone_receiver_" + id).val();
    var urban = $("#urban_receiver_" + id).val();
    var region = $("#region_receiver_" + id).val();
    var address = $("#address_receiver_" + id).val();
    InfoCheckout = {
        ProvinceID: $("#province_receiver_" + id).val(),
        ProvinceName: $("#province_receiver_" + id).data('name'),
        ToDistrictID: $("#district_receiver_" + id).val(),
        ToWardCode: $("#ward_receiver_" + id).val(),
        ToUrban: $("#urban_receiver_" + id).val(),
        ToRegion: $("#region_receiver_" + id).val(),
    };
    $("#name_final").text(name + ' | ' + phone);
    $("#address_final").text(address);
    ObjectInfoUser = {
        name: name,
        address: address,
        phone: phone,
    }
}
var InfoShop = {
    ShopID: '1397614',
    ProvinceID: '48',
    DistrictID: '1917',
    WardID: '340501',
    Region:'2',
    ProvinceName:'Đà Nẵng',
}
function getRouteShip() {
    var province_to = InfoCheckout['ProvinceName'];
    var province_from = InfoShop['ProvinceName'];
    var region_to = InfoCheckout['ToRegion'];
    var region_from = InfoShop['Region'];
    arr_special = [{
            province: 'Hà Nội',
            region: '1',
        },
        {
            province: 'Đà Nẵng',
            region: '2',
        },
        {
            province: 'Hồ Chí Minh',
            region: '3',
        }
    ];

    if (province_from == province_to && region_to == region_from) {
        return "Nội tỉnh";
    } else if (province_to != province_from && region_to == region_from) {
        var k = 0;
        for (var i of arr_special) {
            if (province_from == i['province']) {
                k++;
            }
            if (province_to == i['province']) {
                k++;
            }
        }
        switch (k) {
            case 0:
                //   $("#result").val('NỘI VÙNG TỈNH');
                return "Nội vùng tỉnh";
                break;
            case 1:
                //   $("#result").val('NỘI VÙNG ');
                return "Nội vùng";

                break;

            default:
        }

    } else {
        var k = 0;
        for (var i of arr_special) {
            if (province_from == i['province']) {
                k++;
            }
            if (province_to == i['province']) {
                k++;
            }
        }
        switch (k) {
            case 0:
                //   $("#result").val('LIÊN VÙNG TỈNH');
                return "Liên vùng tỉnh";

                break;
            case 1:
                //   $("#result").val('LIÊN VÙNG ');
                return "Liên vùng";

                break;
            case 2:
                // $("#result").val('LIÊN VÙNG ĐẶC BIỆT');
                return "Liên vùng đặc biệt";

                break;
            default:
        }

    }
}

function routeShip(InfoCheckout) {
    var route = getRouteShip(InfoCheckout, InfoShop);
    arr_service = [];
    $.ajax({
        type: 'post',
        dataType: 'json',
        url: 'route-ship',
        data: {
            route: route,
        },
        success: function(route_id) {
            serviceShip(route_id);

        },
        error: function(json) {
            if (json.status === 404) {
                var errors = json.responseJSON;
            }
        }
    });
}

function serviceShip(route_id) {
    $.ajax({
        type: 'post',
        dataType: 'json',
        url: 'service-ship',
        data: {
            route_id: route_id,
        },
        success: function(result) {
            var weight = parseInt($("#weight").val());
            var fee = 0;
            for (var item of result) {
                var time = moment().add(item['time'], 'd').locale("vi").format('llll');
                time = time.slice(0, 17);
                switch (InfoCheckout['ToUrban']) {
                    case 0:
                        fee = item['suburban'];
                        break;
                    default:
                        fee = item['urban'];
                }
                if (weight > item['weight']) {
                    var weight_more = weight - item['weight'];
                    fee += Math.ceil(weight_more / 500) * item['more_weight'];
                }
                var object = {
                    'service_id': item['id'],
                    'method': item['method'],
                    'fee': fee,
                    'time': time
                };
                arr_service.push(object);
            }
            cardShip(arr_service);

        },
        error: function(json) {
            if (json.status === 404) {
                var errors = json.responseJSON;
            }
        }
    });
}


function cardShip(arr_service) {
    content = '';
    minFee = Math.min.apply(null, arr_service.map(function(item) {
        return item.fee;
    }));
    console.log(arr_service);
    for (item of arr_service) {
        if (item['fee'] == minFee) {
            content += '<div>' +
                '<input type="radio" class="checked_shipping" data-service-name="' + item['method'] + '" data-id="' + item['service_id'] + '" data-time="' + item['time'] + '" checked="checked" id="service_' + item['service_id'] + '" name="select" value="' + item['fee'] + '">';
            var fee = formatNumber(item['fee']);
            content += '<label for="service_' + item['service_id'] + '">' +
                '<ul class="list-group list-group-flush">' +
                '<li class="list-group-item">Hình thức: ' + item['method'] + '</li>' +
                '<li class="list-group-item">Giá vận chuyển: ' + fee + ' vnđ</li>' +
                '<li class="list-group-item">Thời gian dự kiến: ' + item['time'] + '</li>' +
                '</ul>' +
                '</label>' +
                '</div>';
        } else {

            content += '<div>' +
                '<input type="radio" class="checked_shipping" data-id="' + item['service_id'] + '"  data-service-name="' + item['method'] + '" data-time="' + item['time'] + '" id="service_' + item['service_id'] + '" name="select" value="' + item['fee'] + '">';
            var fee = formatNumber(item['fee']);
            content += '<label for="service_' + item['service_id'] + '">' +
                '<ul class="list-group list-group-flush">' +
                '<li class="list-group-item">Hình thức: ' + item['method'] + '</li>' +
                '<li class="list-group-item">Giá vận chuyển: ' + fee + ' vnđ</li>' +
                '<li class="list-group-item">Thời gian dự kiến: ' + item['time'] + '</li>' +
                '</ul>' +
                '</label>' +
                '</div>';
        }

    }

    $("#card-shipping").html(content);

}