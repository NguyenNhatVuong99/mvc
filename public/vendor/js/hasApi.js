
var itemCart = [];
var arr_service = [];
var ObjectInfoUser={
    user_id:'',
    name:'',
    address:'',
    phone:'',
}
var Cart={
    sub_price:'',
    coupon:'',
    fee_ship:'',
    total_price:'',
    quantity:'',
}
function addToCart(e) {
    var slug = $(e).data('slug');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'post',
        dataType: 'json',
        url: '/add-to-cart',
        data: {
            slug: slug,
        },
        success: function(result) {
            {

                alertify.set('notifier', 'position', 'bottom-right');
                alertify.success('Thêm sản phẩm thành công');
                // console.log(result);
                renderCart(result);

            }
        }
    });
}

function deleteCart(e) {
    var slug = $(e).data('slug');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'post',
        dataType: 'json',
        url: '/delete-cart',
        data: {
            slug: slug,
        },
        success: function(result) {
            {
                alertify.set('notifier', 'position', 'bottom-right');
                alertify.success('Cập nhật thành công');
                // console.log(result);
                renderCart(result);
            }
        }
    });
}

function plusQuantity(id) {
    var number = $("#quantity_" + id).val();
    if (number < 7) {
        number++;
        $('#quantity_' + id).attr("value", parseInt(number));
        updateCart(id);
    }



}

function minusQuantity(id) {
    var number = $("#quantity_" + id).val();
    if (number > 1) {
        number--;
        $('#quantity_' + id).attr("value", parseInt(number));
        updateCart(id);
    }
}
$(".quantity_cart").on('change keypress', function() {
    var id = $(this).attr('data-id');
    var number = parseInt($(this).val());
    console.log(number);
    if (!Number.isInteger(number) || number < 1) {
        number = 1;
    }
    $(this).val(parseInt(number));
});


function updateCart(id) {
    var quantity = $('#quantity_' + id).val();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'post',
        dataType: 'json',
        url: '/update-cart',
        data: {
            id: id,
            quantity: quantity
        },
        success: function(result) {
            {
                alertify.set('notifier', 'position', 'bottom-right');
                alertify.success('Thay đổi thành công');
                renderCart(result);

            }
        }
    });
}

function renderCart(result) {
    if (result == false) {

        window.location.href = '/product-grids';
    }
    var products = result.products;

    var sub_price = result.sub_price;
    var total_price = result.total_price;
    var count = result.count;
    $(".total-count").text(count);
    $(".order_subtotal span").text(parseInt(result.sub_price).toLocaleString() + " VNĐ");
    $("#order_total_price span").text(parseInt(result.total_price).toLocaleString() + " VNĐ");
    // COUNT
    var content = " ";
    content += '<a href="/cart" class="single-icon"><i class="ti-bag"></i>' +
        '<span class="total-count">' + count + '</span>' +
        '</a>' +
        '<div class="shopping-item">' +
        '<div class="dropdown-cart-header">' +
        '<span>' + count + 'Items</span>' +
        '<a href="/cart">View Cart</a>' +
        '</div>' +
        '<ul class="shopping-list">';
    for (var item in products) {

        var product = products[item];
        object = {
            'name': product['productInfo']['name'],
            'code': product['productInfo']['code'],
            'quantity': product['quantity'],
        };
        itemCart.push(object);
        var photo = product['productInfo']['photo'].split(',');
        content += '<li>' +
            '<a class="cart-img" href="#"><img src="' + photo[0] + '" alt="' + photo[0] + '"></a>' +
            '<h4><a href="/product-detail/' + product["productInfo"]["slug"] + ' target="_blank">' + product["productInfo"]["name"] + '</a></h4>' +
            '<p class="quantity">' + product["quantity"] + ' - <span class="amount">' + formatNumber(product["productInfo"]["price"]) + 'vnđ</span></p>' +
            '</li>';

    };
    content += '</ul>' +
        '<div class="bottom">' +
        '<div class="total">' +
        '<span>Total</span>' +
        '<span class="total-amount">' + formatNumber(total_price) + 'vnd</span>' +
        '</div>' +
        '<a href="/checkout" class="btn animate">Checkout</a>' +
        '</div>' +
        '</div>';
    $(".shopping-count").html(content);
    var content = "";
    for (var item in products) {
        var product = products[item];
        var photo = product['productInfo']['photo'].split(',');
        content += '<tr><td class="image" data-title="No"><img src="' + photo[0] + '" alt="' + photo[0] + '"></td>' +
            '<td class="product-des" data-title="Description">' +
            '<p class="product-name"><a href="/product-detail/' + product["productInfo"]["slug"] + ' target="_blank">' + product["productInfo"]["name"] + '</a></p>' +
            '</td>' +
            '<td class="price" data-title="Price"><span>' + formatNumber(product["productInfo"]["price"]) + 'vnd</span></td>' +
            '<td class="qty" data-title="Qty">' +
            '<div class="input-group">' +
            '<div class="button minus">' +
            '<button type="button" class="btn btn-primary btn-number" data-type="minus" onclick="minusQuantity(' + product["productInfo"]["id"] + ')">' +
            '<i class="ti-minus"></i>' +
            '</button>' +
            '</div>' +
            '<input type="text"  class="input-number" id="quantity_' + product["productInfo"]["id"] + '" data-min="1" data-max="100" value="' + product["quantity"] + '">' +
            '<div class="button plus">' +
            '<button type="button" class="btn btn-primary btn-number" onclick="plusQuantity(' + product["productInfo"]["id"] + ')" >' +
            '<i class="ti-plus"></i>' +
            '</button>' +
            '</div>' +
            '</div>' +
            '</td>' +
            '<td class="total-amount cart_single_price" data-title="Total"><span class="money">' + formatNumber(product["price"]) + 'vnd</span></td>' +
            '<td class="action" data-title="Remove"><a href="#" onclick="deleteCart(this)" data-slug="' + product["productInfo"]["slug"] + '"><i class="ti-trash remove-icon"></i></a></td>' +
            '</tr>';
    }
    $("#cart_item_list").html(content);
    console.log(itemCart);
}

function coupon() {
    var code = $("#coupon").val();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'post',
        dataType: 'json',
        url: 'coupon',
        data: {
            code: code,
        },
        success: function(result) {
            console.log(result);
            alertify.success('Mã khuyến mãi chính xác');
            renderCart(result);
        },
        error: function(json) {
            if (json.status === 404) {
                var errors = json.responseJSON;
                $(".error_coupon").text(errors['message']);
            }
        }
    });
}


$.ajaxSetup({
    headers: {
        "token": "c43d29e2-4407-11eb-b7e7-eeaa791b204b",
    }
});
// var province_user = $("#province_user").val();
// if (province_user == "") {
//     console.log('ok');
//     province();
// } else {
//     provinceUser();
// }

// function provinceUser() {
//     var province_user = $("#province_user").val();
//     var district_user = $("#district_user").val();
//     var ward_user = $("#ward_user").val();
//     $.ajax({
//         type: 'post',
//         dataType: 'json',
//         url: 'https://online-gateway.ghn.vn/shiip/public-api/master-data/province',
//         success: function(data) {
//             if (data.code == 200) {
//                 var data = data.data;
//                 var content = "";
//                 for (const item of data) {
//                     if (item.ProvinceID == province_user) {
//                         var province_name = item.ProvinceName;
//                         content += '<option selected value="' + item.ProvinceID + '">' + item.ProvinceName + '</option>';
//                     } else {
//                         content += '<option value="' + item.ProvinceID + '">' + item.ProvinceName + '</option>';
//                     }
//                 }
//                 $(".province").append(content);
//                 $('.province').niceSelect('update');
//                 $.ajax({
//                     type: 'get',
//                     dataType: 'json',
//                     url: 'https://online-gateway.ghn.vn/shiip/public-api/master-data/district',
//                     data: {
//                         "province_id": province_user,
//                     },
//                     success: function(data) {
//                         if (data.code == 200) {
//                             var data = data.data;
//                             var content = "<option data-display='Chọn quận,huyện'></option>";
//                             for (const item of data) {
//                                 if (item.DistrictID == district_user) {
//                                     var district_name = item.DistrictName;
//                                     content += '<option selected value="' + item.DistrictID + '">' + item.DistrictName + '</option>';
//                                 } else {
//                                     content += '<option value="' + item.DistrictID + '">' + item.DistrictName + '</option>';
//                                 }
//                             }
//                             $(".district").html(content);
//                             $('.district').niceSelect('update');
//                             $('.form-district').removeClass('d-none');
//                             $.ajax({
//                                 type: 'post',
//                                 dataType: 'json',
//                                 url: 'https://online-gateway.ghn.vn/shiip/public-api/master-data/ward?district_id',
//                                 data: {
//                                     "district_id": district_user,
//                                 },
//                                 success: function(data) {
//                                     if (data.code == 200) {
//                                         var data = data.data;
//                                         var content = "<option data-display='Chọn xã, phường'></option>";
//                                         for (const item of data) {
//                                             if (item.DistrictID == district_user) {
//                                                 if (item.WardCode == ward_user) {
//                                                     var ward_name = item.WardName;
//                                                     content += '<option selected value="' + item.WardCode + '">' + item.WardName + '</option>';
//                                                 } else {
//                                                     content += '<option value="' + item.WardCode + '">' + item.WardName + '</option>';
//                                                 }
//                                             }
//                                         }
//                                         $(".ward").html(content);
//                                         $('.ward').niceSelect('update');
//                                         $('.form-ward').removeClass('d-none');
//                                         InfoUserCheckout(province_name, district_name, ward_name);
//                                     }
//                                 },
//                                 error: function(errors) {
//                                     console.log(errors);
//                                 }
//                             });
//                         }
//                     },
//                     error: function(errors) {
//                         console.log(errors);
//                     }
//                 });
//             }
//         },
//         error: function(errors) {
//             console.log(errors);
//         }
//     });


// }

// function province() {
//     $.ajax({
//         type: 'post',
//         dataType: 'json',
//         url: 'https://online-gateway.ghn.vn/shiip/public-api/master-data/province',
//         success: function(data) {
//             if (data.code == 200) {
//                 var province_user = $("#province_user").val();
//                 var ward_user = $("#ward_user").val();
//                 var data = data.data;
//                 var content = "";
//                 for (const item of data) {
//                     if (item.ProvinceID == province_user) {
//                         content += '<option selected value="' + item.ProvinceID + '">' + item.ProvinceName + '</option>';
//                     } else {
//                         content += '<option value="' + item.ProvinceID + '">' + item.ProvinceName + '</option>';
//                     }
//                 }
//                 $(".province").append(content);
//                 $('.province').niceSelect('update');
//                 getDistrict();

//             }
//         },
//         error: function(errors) {
//             console.log(errors);
//         }
//     });
// }

// function getDistrict() {

//     var province_id = $('#province_receiver').val();

//     $.ajax({
//         type: 'get',
//         dataType: 'json',
//         url: 'https://online-gateway.ghn.vn/shiip/public-api/master-data/district',
//         data: {
//             "province_id": province_id,
//         },
//         success: function(data) {
//             if (data.code == 200) {
//                 var data = data.data;
//                 var content = "<option data-display='Chọn quận,huyện'></option>";

//                 for (const item of data) {
//                     content += '<option value="' + item.DistrictID + '">' + item.DistrictName + '</option>';
//                 }
//                 $(".district").html(content);
//                 $('.district').niceSelect('update');
//                 $('.form-district').removeClass('d-none');
//             }
//         },
//         error: function(errors) {
//             console.log(errors);
//         }
//     });
// }

// function getWard() {
//     var district_id = $('#district_receiver').val();
//     $.ajax({
//         type: 'post',
//         dataType: 'json',
//         url: 'https://online-gateway.ghn.vn/shiip/public-api/master-data/ward?district_id',
//         data: {
//             "district_id": district_id,
//         },
//         success: function(data) {
//             if (data.code == 200) {
//                 var data = data.data;
//                 var content = "<option data-display='Chọn xã, phường'></option>";
//                 for (const item of data) {
//                     if (item.DistrictID == district_id) {
//                         content += '<option value="' + item.WardCode + '">' + item.WardName + '</option>';

//                     }
//                 }
//                 $(".ward").html(content);
//                 $('.ward').niceSelect('update');
//                 $('.form-ward').removeClass('d-none');
//                 // InfoUserCheckout(province_name, district_name, ward_name);
//             }
//         },
//         error: function(errors) {
//             console.log(errors);
//         }
//     });
// }

var InfoShop = {
    ShopID: '1397614',
    ProvinceID: '243',
    DistrictID: '1917',
    WardID: '340501',
}

$(function() {
    $("#form-total").steps({
        headerTag: "h2",
        bodyTag: "section",
        transitionEffect: "fade",
        enableAllSteps: true,
        autoFocus: true,
        transitionEffectSpeed: 500,
        titleTemplate: '<div class="title">#title#</div>',
        labels: {
            previous: 'Trở lại',
            next: 'Tiếp tục',
            finish: 'Hoàn tất',
            current: ''
        },
        onStepChanged: function(event, currentIndex, priorIndex) {
            switch (currentIndex) {
                case 1:
                    informationService(InfoCheckout);
                    return true;
                case 2:
                    checked_shipping();
                default:
                    break;
            }
        },
        onFinished: function(event, currentIndex) {
            createShipping();
        }
    });
    $("#date").datepicker({
        dateFormat: "MM - DD - yy",
        showOn: "both",
        buttonText: '<i class="zmdi zmdi-chevron-down"></i>',
    });
});
var InfoCheckout = {
    ProvinceID: '',
    ToDistrictID: '',
    ToWardCode: '',
};
address();
function address(){
    var id=$('input[name=address]:checked').data('id');
    console.log(id);
    InfoUserCheckout(id);
}
function changeAddress(){
    var id=$('input[name=address]:checked').data('id');
    InfoUserCheckout(id);
}
function InfoUserCheckout(id) {
    var name = $("#name_receiver_"+id).val();
    var phone = $("#phone_receiver_"+id).val();
    var phone = $("#phone_receiver_"+id).val();
    var phone = $("#phone_receiver_"+id).val();
    var address = $("#address_receiver_"+id).val() ;
    InfoCheckout = {
        ProvinceID: $("#province_receiver_"+id).val(),
        ToDistrictID: $("#district_receiver_"+id).val(),
        ToWardCode: $("#ward_receiver_"+id).val(),
    };
    $("#name_final").text(name + ' | ' + phone);
    $("#address_final").text(address);
    ObjectInfoUser={
        name:name,
        address:address,
        phone:phone,
    }   
}

function informationService(InfoCheckout) {
    // console.log(InfoShop['ShopID']);
    arr_service = [];
    $.ajax({
        type: 'post',
        dataType: 'json',
        url: 'https://online-gateway.ghn.vn/shiip/public-api/v2/shipping-order/available-services',

        data: {
            "ShopID": InfoShop['ShopID'],
            "FromDistrictID": InfoShop['DistrictID'],
            "ToDistrictID": InfoCheckout['ToDistrictID']
        },
        success: function(data) {
            if (data.code == 200) {
                var data = data.data;
                for (var item of data) {
                    if (item['short_name'] == "Đi bộ") {
                        var object = {
                            'service_name': 'Đường bộ',
                            'service_id': item['service_id'],
                            'fee': '',
                            'leadtime': ''
                        }
                    } else {
                        var object = {
                            'service_name': 'Hàng không',
                            'service_id': item['service_id'],
                            'fee': '',
                            'leadtime': ''
                        }
                    }

                    FeeShip(object, InfoCheckout);
                }

            }
        },
        error: function(errors) {
            console.log(errors);
        }
    });
}

function FeeShip(object, InfoCheckout) {
    $.ajax({
        type: 'post',
        dataType: 'json',
        url: 'https://online-gateway.ghn.vn/shiip/public-api/v2/shipping-order/fee',
        headers: {
            ShopId: InfoShop['ShopID'],
        },
        data: {
            "serviceID": object['service_id'],
            "FromDistrictID": InfoShop['DistrictID'],
            "ToDistrictID": InfoCheckout['ToDistrictID'],
            "ToWardCode": InfoCheckout['ToWardCode'],
            "height": 0,
            "length": 0,
            "weight": $("#weight").val(),
            "width": 0,
            "insurance_value": 0,
            "coupon": null
        },
        success: function(data) {
            if (data.code == 200) {
                var data = data.data;
                object['fee'] = data['total'],
                    TimeShip(InfoCheckout, object)
            }
        },
        error: function(errors) {
            console.log(errors);
        }
    });
}

function TimeShip(InfoCheckout, object) {
    $.ajax({
        type: 'post',
        dataType: 'json',
        url: 'https://online-gateway.ghn.vn/shiip/public-api/v2/shipping-order/leadtime',
        headers: {
            ShopId: InfoShop['ShopID'],

        },
        data: {
            "FromDistrictID": InfoShop['DistrictID'],
            "ToDistrictID": InfoCheckout['ToDistrictID'],
            "ToWardCode": InfoCheckout['ToWardCode'],
            "FromWardCode": InfoShop['WardID'],
            "serviceID": object['service_id'],
        },
        success: function(data) {
            if (data.code == 200) {
                var data = data.data;
                var leadtime = moment(data['leadtime'] * 1000).locale("vi").format('llll');
                object['leadtime'] = leadtime.slice(0,17);

                arr_service.push(object);
                cardShip(arr_service);
            }
        },
        error: function(errors) {}
    });
}

function cardShip(arr_service) {
    content = '';
    minFee = Math.min.apply(null, arr_service.map(function(item) {
            return item.fee;
        })),
        console.log(minFee);
    for (item of arr_service) {
        if (item['fee'] == minFee) {
            content += '<div>' +
                '<input type="radio" class="checked_shipping" data-name="' + item['service_name'] + '" data-service_id="' + item['service_id'] + '" data-leadtime="' + item['leadtime'] + '" checked="checked" id="service_' + item['service_id'] + '" name="select" value="' + item['fee'] + '">';
            var fee = formatNumber(item['fee']);
            content += '<label for="service_' + item['service_id'] + '">' +
                '<ul class="list-group list-group-flush">' +
                '<li class="list-group-item">Hình thức: ' + item['service_name'] + '</li>' +
                '<li class="list-group-item">Giá vận chuyển: ' + fee + ' vnđ</li>' +
                '<li class="list-group-item">Thời gian dự kiến: ' + item['leadtime'] + '</li>' +
                '</ul>' +
                '</label>' +
                '</div>';
        } else {

            content += '<div>' +
                '<input type="radio" class="checked_shipping" data-service_id="' + item['service_id'] + '"  data-type="' + item['service_name'] + '" data-leadtime="' + item['leadtime'] + '" id="service_' + item['service_id'] + '" name="select" value="' + item['fee'] + '">';
            var fee = formatNumber(item['fee']);
            content += '<label for="service_' + item['service_id'] + '">' +
                '<ul class="list-group list-group-flush">' +
                '<li class="list-group-item">Hình thức: ' + item['service_name'] + '</li>' +
                '<li class="list-group-item">Giá vận chuyển: ' + fee + ' vnđ</li>' +
                '<li class="list-group-item">Thời gian dự kiến: ' + item['leadtime'] + '</li>' +
                '</ul>' +
                '</label>' +
                '</div>';
        }

    }

    $("#card-shipping").html(content);

}

function checked_shipping() {
    var shipping = $("input[type='radio'].checked_shipping:checked");
    var fee = shipping.val();
    objectService = {
        'service_name': shipping.data('name'),
        'service_id': shipping.data('service_id'),
        'fee': fee,
        'leadtime': shipping.data('leadtime')
    }
    console.log(objectService);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'post',
        dataType: 'json',
        url: 'add-shipping',
        data: {
            fee: fee,
        },
        success: function(result) {
            console.log(result);
            $("#cart_fee_ship").text(formatNumber(result.fee_ship) + " vnđ");
            $("#cart_total_price").text(formatNumber(result.total_price) + " vnđ");
            var products = result.products;
            Cart={
                sub_price:result.sub_price,
                coupon:result.coupon,
                fee_ship:result.fee_ship,
                total_price:result.total_price,
                quantity:result.quantity,
            }
            for (var item in products) {

                var product = products[item];
                object = {
                    'name': product['productInfo']['name'],
                    'code': product['productInfo']['code'],
                    'quantity': product['quantity'],
                };
                itemCart.push(object);
            }
        },
        error: function(json) {
            if (json.status === 404) {
                var errors = json.responseJSON;
            }
        }
    });

}
var objectService = {
    'service_name': '',
    'service_id': '',
    'fee': '',
    'leadtime': ''
}
// font stuff
$(function() {

    $('input[name=plan]').on('change', function() {
        let $this = $(this);
        let $label = $this.parent('label');

        if (!($label.hasClass('label-checked'))) {
            $('label').removeClass('label-checked');
            $('label').find('.radio-check').hide();
            $label.addClass('label-checked');
            $label.find('.radio-check').show();
        }

    });

});

function formatNumber(nStr) {
    nStr += '';
    x = nStr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }
    return x1 + x2;
}

// function createShipping() {
//     var name = $("#name_receiver").val();
//     var phone = $("#phone_receiver").val();
//     var address = $("#address_final").text();
//     $.ajaxSetup({
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         }
//     });
//     $.ajax({
//         type: 'post',
//         dataType: 'json',
//         url: 'https://online-gateway.ghn.vn/shiip/public-api/v2/shipping-order/create',
//         headers: {
//             ShopId: InfoShop['ShopID'],
//         },
//         data: {
//             "ToName":ObjectInfoUser['name'] ,
//             "ToPhone": ObjectInfoUser['phone'],
//             "ToAddress": ObjectInfoUser['address'],
//             "serviceID": objectService['service_id'],
//             'content':'đơn hàng',
//             "ToDistrictID": InfoCheckout['ToDistrictID'],
//             "ToWardCode": InfoCheckout['ToWardCode'],
//             'PaymentTypeID': 2,
//             'RequiredNote': 'CHOTHUHANG',
//             "height": 0,
//             "length": 0,
//             "weight": $("#weight").val(),
//             "width": 0,
//             "insurance_value": 0,
//             "coupon": null,
//             "items": itemCart,
//         },
//         success: function(data) {
//             if (data.code == 200) {
//                 var shipping = data.data;
//                 order(shipping);
//             }
//         },
//         error: function(errors) {
//             console.log(errors);
//         }
//     });
// }
function order(shipping){
    
    if($("#giveFriend").prop('checked') == true){
        var giveFriend=true;
    }
    else{
        var giveFriend=false;
    }
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'post',
        dataType: 'json',
        url: '/cart/order',
        data: {
            order_code:shipping['order_code'],
            shipping_id:1,
            name:ObjectInfoUser['name'],
            address:ObjectInfoUser['address'],
            phone:ObjectInfoUser['phone'],
            giveFriend:giveFriend,
            payments:$(".payment:checked").val(),
            trans_type:shipping['trans_type'],
            delivery_time:objectService['leadtime'],
        },
        success: function(response) {
            if (response == true) {
                document.location.href = '/';
                alertify.set('notifier', 'delay', 10);
                alertify.set('notifier', 'position', 'bottom-right');
                alertify.success('Đặt hàng thành công');
            }
        },
        error: function(errors) {
        }
    });
}