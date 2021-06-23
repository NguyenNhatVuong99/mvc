var start = moment().format('L');
var end = moment().format('L');
getDataPC(start, end, 'PC');
//  getDataPT(start, end, 'PT'); 
$('#reportrange-PC').on('apply.daterangepicker', (e, picker) => {
    var cat = "PC";
    var item = $('#reportrange-PC span').text();
    var arr = item.split(' - ');
    var start = arr[0];
    var end = arr[1];
    $('#table-PC').DataTable().destroy();
    getDataPC(start, end, cat);
});


function changeDateTimePC() {
    console.log('ok');
}
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


$('#debt-PC-select').on('change', function() {
    var debt = $(this).attr('data-debt');
    console.log(debt);

});

function getDataPC(start, end, cat) {
    var tablePC = $('#table-PC').DataTable({
        responsive: true,

        dom: 'Blfrtip',
        processing: true,
        // serverSide: true,
        // language: {
            
        //     url: 'https://cdn.datatables.net/plug-ins/1.10.24/i18n/Vietnamese.json'
        // },
        
        language: {
            processing: "<div class='loader'>Loading...</div>",
            paginate: {
                first: "Đầu tiên",
                previous: "Trước",
                next: "Tiếp theo",
                last: "Cuối cùng"
            },
            emptyTable: "Dữ liệu trống",
            search: "Tìm kiếm",
            lengthMenu: "Hiển thị  _MENU_ dòng",
            info: "Đang hiển thị _START_ đến _END_ của _TOTAL_ dòng",
            infoEmpty: "Đang hiển thị 0 đến 0 của 0 dòng",
            infoFiltered: "(được chọn lọc từ _MAX_ dòng )",
            infoPostFix: "",
            loadingRecords: "Chargement en cours...",
            zeroRecords: "Aucun &eacute;l&eacute;ment &agrave; afficher",
            aria: {
                sortAscending: ": Message khi đang sắp xếp theo column",
                sortDescending: ": Message khi đang sắp xếp theo column",
            }
        },
        scrollY: 500,
        info: false,
        // serverSide: true,
        ordering: true,
        "order": [
            [1, "desc"]
        ],
        buttons: [
            
            'copy',
            'csv',
            'excel',
            'pdf',
            {
                extend: 'print',
                text: 'Print all (not just selected)',
                exportOptions: {
                    modifier: {
                        selected: null
                    }
                }
            }
        ],
        initComplete: function () {
            var btns = $('.dt-button');
            btns.addClass('btn btn-primary');
            btns.removeClass('dt-button');

        },
        select: true,
        ajax: {
            url: route("admin.receipt.index"),
            data: {
                start: start,
                end: end,
                cat: cat,
            },
        },

        columns: [
            {
                data: 'id', 
                defaultContent: '' 
            },
            {
                data: 'code',
                name: 'receipts.code'
            },
            {
                data: 'receipt',
                name: 'receipts.receipt',
            },
            {
                data: 'receipt_date',
                name: 'receipts.receipt_date',
                render: function(data, type, row) {
                    return moment(data).format("DD/MM/YYYY");
                }

            },
            {
                data: 'child_cat',
                name: 'child_cat.name',

            },
            {
                data: 'supplier',
                name: 'supplier.name',

            },

            {
                data: 'total',
                name: 'receipts.total',
                render: $.fn.dataTable.render.number(',', '.')

            },
            {
                data: 'note',
                name: 'receipts.note',

            },
            {
                data: 'status',
                name: 'receipts.status',
                render: function(data) {
                    if (data == 'Hoàn thành') {
                        return '<span class="badge badge-success">' + data + '</span>';
                    } else {
                        return '<span class="badge badge-danger">' + data + '</span>';

                    }
                }
            },
            {
                data: 'created_at',
                name: 'receipts.created_at',
                render: function(data, type, row) {
                    return moment(data).format("DD/MM/YYYY");
                }
            },
        ],




    });
    tablePC.on('order.dt search.dt', function() {
        tablePC.column(0, {
            search: 'applied',
            order: 'applied'
        }).nodes().each(function(cell, i) {
            cell.innerHTML = i + 1;
        });
    }).draw();
}

function getDataPT(start, end, cat) {
    console.log(cat);
    var PT = $('#table-PT').DataTable({
        responsive: true,

        dom: 'lifrtp',
        processing: true,
        // serverSide: true,
        // language: {
        //     url: 'https://cdn.datatables.net/plug-ins/1.10.22/i18n/Vietnamese.json'
        // },
        language: {
            processing: "<div class='loader'>Loading...</div>",
            paginate: {
                first: "Đầu tiên",
                previous: "Trước",
                next: "Tiếp theo",
                last: "Cuối cùng"
            },
            emptyTable: "Dữ liệu trống",
            search: "Tìm kiếm",
            lengthMenu: "Hiển thị  _MENU_ dòng",
            info: "Đang hiển thị _START_ đến _END_ của _TOTAL_ dòng",
            infoEmpty: "Đang hiển thị 0 đến 0 của 0 dòng",
            infoFiltered: "(được chọn lọc từ _MAX_ dòng )",
            infoPostFix: "",
            loadingRecords: "Chargement en cours...",
            zeroRecords: "Aucun &eacute;l&eacute;ment &agrave; afficher",
            aria: {
                sortAscending: ": Message khi đang sắp xếp theo column",
                sortDescending: ": Message khi đang sắp xếp theo column",
            }
        },
        scrollY: 500,
        info: false,
        // serverSide: true,
        ordering: true,
        "order": [
            [1, "desc"]
        ],
        ajax: {
            url: route("admin.receipt.index"),
            data: {
                start: start,
                end: end,
                cat: cat,
            },
        },

        columns: [{
                data: null
            },
            {
                data: 'code',
                name: 'receipts.code'
            },
            {
                data: 'receipt',
                name: 'receipts.receipt',
            },
            {
                data: 'receipt_date',
                name: 'receipts.receipt_date',
                render: function(data, type, row) {
                    return moment(data).format("DD/MM/YYYY");
                }

            },
            {
                data: 'child_cat',
                name: 'child_cat.name',

            },
            {
                data: 'user',
                name: 'user.name',

            },

            {
                data: 'total',
                name: 'receipts.total',
                render: $.fn.dataTable.render.number(',', '.')

            },
            {
                data: 'note',
                name: 'receipts.note',

            },
            {
                data: 'status',
                name: 'receipts.status',
                render: function(data) {
                    if (data == 'Hoàn thành') {
                        return '<span class="badge badge-success">' + data + '</span>';
                    } else {
                        return '<span class="badge badge-danger">' + data + '</span>';

                    }
                }
            },
            {
                data: 'created_at',
                name: 'receipts.created_at',
                render: function(data, type, row) {
                    return moment(data).format("DD/MM/YYYY");
                }
            },
        ],




    });
    PT.on('order.dt search.dt', function() {
        PT.column(0, {
            search: 'applied',
            order: 'applied'
        }).nodes().each(function(cell, i) {
            cell.innerHTML = i + 1;
        });
    }).draw();
}

function store(e) {
    var cat = $(e).data('cat');

    var data = $("#form-" + cat + "-store").serialize();
    $.ajax({
        type: 'post',
        dataType: 'json',
        url: '/admin/receipt',
        data: data,
        success: function(result) {
            {
                alertify.set('notifier', 'position', 'bottom-right');
                alertify.success('Cập nhật thành công');
                $("#modalCreatePC .close").click();

                setTimeout(function() {
                    location.reload();
                }, 1000);

            }
        }
    });
}

function outOfStock(id) {
    $.ajax({
        type: 'post',
        dataType: 'json',
        url: 'receipt-stock/out-of-stock',
        data: {
            id: id,
        },
        success: function(result) {
            alertify.set('notifier', 'delay', 10);
            alertify.set('notifier', 'position', 'bottom-right');
            alertify.success('Cập nhật thành công');
            setTimeout(function() { // wait for 5 secs(2)
                location.reload(); // then reload the page.(3)
            }, 1000);
        },
        error: function(json) {
            if (json.status === 404) {
                var errors = json.responseJSON;
            }
        }
    });
}


$('#PC-select').selectpicker('refresh');
$('#PT-select').selectpicker('refresh');
$('#debt-select').selectpicker('refresh');



function collapseStock(e) {
    var href = $(e).data('href');
    $('.collapse').slideUp(400);
    $("#" + href).slideDown(400);
    if (href == 'PC') {
        $('#table-PC').DataTable().destroy();
        $('#table-PT').DataTable().destroy();
        getDataPC(start, end, href);
    } else {
        $('#table-PC').DataTable().destroy();
        $('#table-PT').DataTable().destroy();
        getDataPT(start, end, href);
    }
}
$('a[data-toggle="collapse"]').on('shown.bs.tab', function(e){
    $($.fn.dataTable.tables(true)).DataTable()
       .columns.adjust()
       .responsive.recalc();
 });   