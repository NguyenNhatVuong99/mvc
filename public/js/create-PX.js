
$('#partner-select').selectpicker('refresh');
$('#category-select').selectpicker('refresh');
$('#partner-select').on('change', function() {
    var slug = $(this).val();
    getPartner(slug);
});
function getPartner(slug){
    $.ajax({
        dataType: "json",
        url: "{{ route('admin.PX.create') }}",
        data:{
            slug:slug,
        },

        success: function(result) {
            var type=result.type;
            var partners=result.partners;
            $("#code-partner-label").text(type);
            var content='<label for="inputTitle" class="col-form-label">'+type+'<span class="text-danger">*</span></label>'+
                        '<div class="row">'+
                        '<div class="col-9">'+
                            '<select id="code-partner-select" class="selectpicker form-control" title="Chọn '+type+'" data-live-search="true" placeholder="Chọn '+type+'" data-size="5" data-width="100%" data-actions-box="true">';
                                for(item of partners){
                                    content+='<option  value="'+item['code']+'">'+item['name']+'</option>';
                                }
                content+='</select>'+
                        '</div>'+
                        '<div class="col-3">'+
                            '<button class="btn btn-light"><i class="fas fa-plus"></i></button>'+
                        '</div>'+
                    '</div>';
                    

            $("#form-code-partner").html(content);  
            $('#code-partner-select').selectpicker('refresh');
          
        },
        error: function(json) {
            if (json.status === 404) {
                var errors = json.responseJSON;
                $(".error_coupon").text(errors["message"]);
            }
        },
    });
}

$('#product-select').selectpicker('refresh');
$('#partner-select').selectpicker('refresh');
$('#code-partner-select').selectpicker('refresh');
var selected = [];

$('#product-select').on('change', function() {
    selected = $(this).val();
    addProduct(selected, arr_id);
});
var listProduct = [];
var total_quantity = 0;
var arr_id=[];
function tableProduct() {
    content = "";
    STT=1;
    for (var item of listProduct) {
        content +=
            '<tr id="tr_' +
            item.id +
            '">' +
            "<td>" +
            STT +
            "</td>" +
            "<td>" +
            item.name +
            "</td>" +
            '<td class="qty" data-title="Qty">' +
            '<div class="input-group">' +
            '<div class="button minus">' +
            '<button type="button" class="btn btn-primary btn-number" data-type="minus" onclick="minusQuantity(' +
            item.id +
            ')">' +
            '<i class="fas fa-minus"></i>' +
            "</button>" +
            "</div>" +
            '<input type="text" onkeyup="changeQuantity('+item.id+ ')" class="
            " id="quantity_' +
            item.id +
            '" data-min="1" data-max="'+item.max+'" value="' + item.quantity + '">' +
            '<div class="button plus">' +
            '<button type="button" class="btn btn-primary btn-number" onclick="plusQuantity(' +
            item.id +
            ')" >' +
            '<i class="fas fa-plus"></i>' +
            "</button>" +
            "</div>" +
            "</div>" +
            "</td>" +
            '<td class="p-t-18" style="padding-top:18px" id="cost_price_' +
            item.id +
            '">' +
            item.cost_price +
            "</td>" +
            '<td>'+
            '<input type="text" class="form-control" data-default=' +
            item.price +
            ' data-type="price" data-id=' +
            item.id +
            ' onkeyup="updatePrice(this)" id="price_' +
            item.id +
            '" value="' + item.price + '">'+
            '<input type="text" class="form-control" data-default=' +
            item.weight +
            ' data-type="weight" id="weight_' +
            item.id +
            '" value="' + item.weight + '">'+
            '<input type="text" class="form-control" data-default=' +
            item.weight +
            ' data-type="weight" id="sub_weight_' +
            item.id +
            '" value="' + item.weight + '">'+
            '</td>' +
            '<td class="p-t-18" style="padding-top:18px" id="amount_' +
            item.id +
            '">' +
            item.amount +
            "</td>" +
            '<td><button class="btn btn-danger btn-sm "  onclick=removeTr(' +
            item.id +
            ') data-id= style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fas fa-trash-alt"></i></button></td>' +
            "</tr>";
        STT++;
        $("#btn-save").removeClass('disabled');
        $("#btn-savePrint").removeClass('disabled');
        totalPrice();

    }
    $("#table-product").html(content);
    numbericProduct();
}
function changeQuantity(id){
    var number = $("#quantity_" + id).val();
    var max = $("#quantity_" + id).data('max');
    if(number % 1 ==0){
        if(number<=max){
            $("#quantity_" + id).attr("value", parseInt(number));
            objIndex = listProduct.findIndex((obj => obj.id == id));
            listProduct[objIndex].quantity=parseInt(number);
            updateAmount(id);
        }
        else{
            $("#quantity_"+id).val(1);

        }
        
    }
    else{
        $("#quantity_"+id).val(1);

    }
}
function numbericProduct() {
    for (var id of arr_id) {
        new AutoNumeric("#cost_price_" + id, {
            decimalPlaces: '0'
        });
        new AutoNumeric("#amount_" + id, {
            decimalPlaces: '0'
        });
        new AutoNumeric("#price_" + id, {
            decimalPlaces: '0'
        });
    }
}

function arrayDiff(arr1, arr2) {
    var diff = {};

    diff.arr1 = arr1.filter(function(value) {
        if (arr2.indexOf(value) === -1) {
            return value;
        }
    });

    diff.arr2 = arr2.filter(function(value) {
        if (arr1.indexOf(value) === -1) {
            return value;
        }
    });

    diff.concat = diff.arr1.concat(diff.arr2);
    return diff.concat;
};

function addProduct(selected, arr_id) {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    var diff = arrayDiff(selected, arr_id);
    if (arr_id.length > selected.length) {
        for (var id of diff) {
            arr_id.splice(arr_id.indexOf(id), 1);
            $.each(listProduct, function(i, el) {
                if (this.id == id) {
                    listProduct.splice(i, 1);
                }
            });
            tableProduct();

        }
    } else {
        for (var id of diff) {
            $.ajax({
                type: "get",
                dataType: "json",
                url: "/admin/product/" + id,

                success: function(result) {
                    var object = {
                        id: result.id,
                        name: result.name,
                        quantity: 1,
                        cost_price: result.cost_price,
                        amount: result.price,
                        price: result.price,
                        max:result.quantity,
                        weight:result.weight,
                    };
                    arr_id.push(id);
                    listProduct.push(object);
                    tableProduct();


                },
                error: function(json) {
                    if (json.status === 404) {
                        var errors = json.responseJSON;
                        $(".error_coupon").text(errors["message"]);
                    }
                },
            });
        }
    }



}
totalPrice();

function plusQuantity(id) {
    var max = $("#quantity_" + id).data('max');
    
    var number = $("#quantity_" + id).val();
    if(number<max){
        number++;
        $("#quantity_" + id).attr("value", parseInt(number));
        $("#quantity_" + id).text(number);
        objIndex = listProduct.findIndex((obj => obj.id == id));
        listProduct[objIndex].quantity=parseInt(number);
        updateAmount(id);
    }
    
}

function minusQuantity(id) {
    var number = $("#quantity_" + id).val();
    if (number > 1) {
     
        number--;
        $("#quantity_" + id).attr("value", parseInt(number));
        objIndex = listProduct.findIndex((obj => obj.id == id));
        listProduct[objIndex].quantity = parseInt(number);
        updateAmount(id);
    }
    totalPrice();
}

function updateAmount(id) {
    var quantity = $("#quantity_" + id).val();
    var price = converValueNumber("#price_" + id);
    var weight = converValueNumber("#weight_" + id);
    
    var amount = quantity * price;
    var sub_weight = quantity * weight;
    console.log(quantity);
    $("#amount_" + id).text(amount);
    $("#sub_weight_" + id).val(sub_weight);
    objIndex = listProduct.findIndex((obj => obj.id == id));
    listProduct[objIndex].amount = amount;
    listProduct[objIndex].weight = sub_weight;
    new AutoNumeric("#amount_" + id, {
        decimalPlaces: '0'
    });

    let product = listProduct.find((i) => {
        return i.id === id;
    });
    product.quantity = quantity;
    product.amount = amount;
    product.weight = sub_weight;
    totalPrice();
}
// totalPrice();

function totalPrice() {
    var total_quantity = 0;
    var sum = 0;
    var total_weight=0
    listProduct.forEach(function(item) {
        item.quantity=parseInt(item.quantity);
        sum += item.amount;
        total_quantity += item.quantity;
        total_weight += item.weight;
    });
    $("#total_quantity").val(total_quantity);
    $("#total_weight").text(total_weight);

    if (sum == 0) {
        $("#debt").text(sum);
        $("#payment").text(sum);
        $("#btn-save").addClass('disabled');
        $("#btn-savePrint").addClass('disabled');

    }
    convertVnd(sum);
    $("#total_price").text(sum);
    new AutoNumeric("#total_price", {
        decimalPlaces: '0'
    })
    if ($("#debt").text() != 0) {
        updatePayment();
    } else {
        $("#payment").val(sum);
        $("#payment").removeAttr("disabled");
        // {{--  new AutoNumeric("#payment",{decimalPlaces:'0'})  --}}

    }

}

function removeTr(id) {
    $("#tr_" + id).remove();
    $.each(listProduct, function(i, el) {
        if (this.id == id) {
            listProduct.splice(i, 1);
        }
    });
    totalPrice();
}

function updatePrice(e) {
    var type = $(e).data("type");
    var id = $(e).data("id");
    var price_default = $(e).data("default");
    var value = $(e).val();
    let product = listProduct.find((i) => {
        return i.id === id;
    });
    if (type == "price") {
        product.price = value;
        updateAmount(id);
    } else {
        product.price = value;
    }
    

}

function updatePayment() {

    var payment = converValueNumber('#payment');
    var total = converTextNumber('#total_price');
    console.log(total);
    $('#payment').val(payment);
    var debt=total - payment;
    $("#debt").text(debt);
    new AutoNumeric("#debt", {
        decimalPlaces: '0'
    });
}
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


var today = new Date();
var dd = String(today.getDate()).padStart(2, '0');
var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
var yyyy = today.getFullYear();

today = mm + '/' + dd + '/' + yyyy;

var total_price = new AutoNumeric("#total_price", {
    decimalPlaces: '0'
});
function showModalCreatePartner(){
    var value = $('#partner-select').text();
    console.log(value);

    $('#modalCreatePartner').modal('show'); 
}
