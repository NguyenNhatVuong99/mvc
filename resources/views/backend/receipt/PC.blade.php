
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

    <div class="card-body">
      <div class="table-responsive">
        
          <div class="row">
            <div class="col">
              <div class="collapse panel-collapse show collapse-stock" id="PC">
                <div class="card">
                  <div class="card-header">
                    <h4 class="m-0 font-weight-bold text-primary float-left"> Phiếu chi</h4>
                    <div id="reportrange-PC" data-cat="PC" class="float-left datetimepicker datetime-PC" onapply="changeDateTimePC(e)" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 24%; margin-left:20px">
                      <i class="fa fa-calendar" style="color: #007DFF"></i>&nbsp;
                      <span id="date-PC"></span> <i class="fa fa-caret-down" style="color: #007DFF"></i>
                    </div>
                    <button class="btn btn-primary btn-sm float-right " data-toggle="modal" data-target="#modalCreatePC" data-placement="bottom" title="Add User"><i class="fas fa-plus"></i> Tạo phiếu chi</button>
                    <a class="btn btn-primary btn-sm float-right mr-2" href="{{route('admin.PT')}}"> Phiếu thu</a>

                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <input class="auto-numeric" type="hidden">
                        <table style="color: #333" class="table table-bordered display" id="table-PC"  width="100%" cellspacing="0">
                          <thead>
                            <tr>

                              <th rowspan="2" style=" text-align: center;vertical-align: middle;">STT</th>
                              <th rowspan="2" style=" text-align: center;vertical-align: middle;">Mã phiếu</th>
                              <th colspan="2"  style=" text-align: center;vertical-align: middle;">Chứng từ</th>
                              <th rowspan="2" style=" text-align: center;vertical-align: middle;">Loại</th>
                              <th rowspan="2" style=" text-align: center;vertical-align: middle;">Người nhận</th>
                              <th rowspan="2" style=" text-align: center;vertical-align: middle;">Tổng tiền</th>
                          
                              <th rowspan="2" style=" text-align: center;vertical-align: middle;">Ghi chú</th>
                              <th rowspan="2" style=" text-align: center;vertical-align: middle;">Trạng thái</th>
                              <th rowspan="2" style=" text-align: center;vertical-align: middle;">Thời gian</th>  
                            </tr>
                            <tr>
                              <th style=" text-align: center;vertical-align: middle;">Số hiệu</th>
                              <th style=" text-align: center;vertical-align: middle;">Ngày tháng</th>
                            </tr>
                          </thead>
                        </table>
                      </div>
                  <div>
                
                </div>
              </div>
            </div>
          </div>
        
          
      </div>
      
    </div>
   
</div>
<div class="modal fade" id="modalCreatePC" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tạo phiếu chi</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="form-store">
  
        <div class="modal-body">
            <div class="form-group">
              <label for="inputAddress">Số tiền:</label>
              <input type="hidden" name="category" value="PC">
              <input   onkeyup="getNumber(this)" required  class="form-control" id="total-PT" placeholder="">
              <input  name="total" id="input-number" type="hidden">
            </div>
            <div class="form-group">
              <label for="inputAddress">Ngày chi:</label>
              <div class="form-group pmd-textfield pmd-textfield-floating-label">
                <input type="text" required placeholder="" value="{{ old('date') }}" name="date" id="datetime" class="datetime form-control" />
              </div>
            </div>
            <div class="form-group">
              <label for="inputAddress">Loại phiếu chi:</label>
              <select name="child_cat" onchange="chooseCatPC()" id='PC-select' data-size="5" data-actions-box="true" data-live-search="true" required class="form-control">
                @foreach ($PC_category as $item)
                  <option value="{{ $item->name }}" data-content="{{ $item->name }}">{{ $item->name }}</option>
  
                @endforeach
              </select>
            </div>
            <div class="form-group" id="form-PC-debt">
              </div>
            <div class="form-group">
              <label for="inputAddress">Ghi chú:</label>
              <textarea required name="note" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="float-left btn btn-secondary" data-dismiss="modal">Đóng</button>
          <button type="button" class="float-right btn btn-primary" data-type="store"data-cat='PC' onclick="store(this)">Lưu</button>
          <button type="button" class="float-right btn btn-primary" data-type="print"data-cat='PC' onclick="store(this)">Lưu và in</button>
        </div>
      </form>
  
      </div>
    </div>
  </div>

@endsection

@push('styles')
{{--  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">  --}}

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
  <style>
    .zeroPadding {
      padding: 0 !important;
    }
      .zoom {
        transition: transform .2s; /* Animation */
      }

      .zoom:hover {
        transform: scale(5);
      }
  </style>
@endpush

@push('scripts')
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    {{-- <script src="{{ asset('backend/js/receipt.js') }}"></script> --}}

    {{-- <script>
      

    </script> --}}
    <script>
      
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
      });
      chooseCatPC();
      
      var start = moment().format('L');
    var end = moment().format('L');
    getDataPC(start, end, 'PC');
    //  getDataPC(start, end, 'PC'); 
    $('#reportrange-PC').on('apply.daterangepicker', (e, picker) => {
        var cat = "PC";
        var item = $('#reportrange-PC span').text();
        var arr = item.split(' - ');
        var start = arr[0];
        var end = arr[1];
        $('#table-PC').DataTable().destroy();
        getDataPC(start, end, cat);
    });
      function getDataPC(start, end, cat) {
        var table = $('#table-PC').DataTable({
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
            {{--  select: true,  --}}
            ajax: {
                url: route("admin.PC"),
                data: {
                    start: start,
                    end: end,
                    cat: 'PC',
                },
            },
    
            columns: [
          
                {
                    data: null, 
                    defaultContent: '',
                },
                {
                    data: 'code',
                    name: 'receipts.code',
                    render:function(data){
                        if ( data === null ) {
                            return '';
                          }
                          else {
                            return '<a href="order/show/'+data+'" target="_blank">'+data+'</a>';
                          }
                    }
                    
                },
                {
                    data: 'document',
                    name: 'receipts.document',
                    render:function(data){
                        if ( data === null ) {
                            return '';
                          }
                          else {
                            return '<a href="order/show/'+data+'" target="_blank">'+data+'</a>';
                          }
                    }
                },
                {
                    data: 'document_date',
                    name: 'receipts.document_date',
                    render: function(data, type, row) {
                        if ( data === null ) {
                            return '';
                          }
                          else {
                            return moment(data).format("DD/MM/YYYY");
                          }
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
                    data: 'status',
                    name: 'receipts.status',
                    render: function(data,type,row) {
                        if (data == 'Hoàn thành') {
                            return '<span class="badge badge-success">' + data + '</span>';
                        } else {
                            return '<span class="badge badge-danger">' + data + '</span><button class="btn btn-danger btn-sm" onclick="updateStatus('+row.id+')">Cập nhật</button>';
    
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
                {
                  data:'action',
                  name:'action'
                }
            ],
    
        });
        table.on('order.dt search.dt', function() {
            table.column(0, {
                search: 'applied',
                order: 'applied'
            }).nodes().each(function(cell, i) {
                cell.innerHTML = i + 1;
            });
        }).draw();
    }
    
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $('#PT-select').selectpicker('refresh');

    function updateStatus(id){
      Swal.fire({
        title: 'Hoàn thành phiếu thu?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Cập nhật',
        cancelButtonText:'Hủy'
      
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            type: "post",
            dataType: "json",
            url: "/admin/receipt/updateStatus",
            data:{
              id:id
            },
            success: function(result) {
                Swal.fire({
                  text: "Cập nhật thành công",
                  icon: 'success',

                  timer: 2000
                }).then((result) => {
                  var start = moment().format('L');
                    var end = moment().format('L');
                    $('#table-PT').DataTable().destroy();
                    getDataPT(start, end, 'PT');
                });
              }
      
            
        });
          
        }
      })
    
    }
    function getNumber(e){
        var number = converValueNumber('#total-PT');

        $("#input-number").val(number);
        formatNumberInput(e);
    }
function store(e) {

    var data = $("#form-store").serialize();
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
function chooseDebt(){
  var code=$('#debt-PC-select').val();
  $.ajax({
    type: 'post',
    dataType: 'json',
    url: '/admin/receipt-stock/getDebt',
    data: {
      code:code
    },
    success: function(result) {
        {
          var debt=result.debt;
            $("#input-number").val(debt);
            $("#total-PT").val(debt);
            new AutoNumeric("#total-PT", {
              decimalPlaces: '0'
          });
        }
    }
});
}
function chooseCatPC(){
  var name = $('#PC-select').val();
  if(name=="Chi nợ nhập hàng"){
    var debt= <?php echo $debt?>;
    var content='<label for="inputAddress">Mã chứng từ kèm theo:</label>'
    +'<select name="code" id="debt-PC-select" onchange=chooseDebt() data-size="5" data-actions-box="true" data-live-search="true" required class="form-control">';
    for(var item of debt ){
      $(".auto-numeric").val(item.debt);
      new AutoNumeric(".auto-numeric", {
        decimalPlaces: '0',
    });
    var debt= $(".auto-numeric").val();
    $("#PC-total").val(debt);
        content+=  '<option data_debt='+item.debt+' value="'+item.code+'">'+item.code+ ' - Nợ: '+debt+' vnđ</option>';
    }
    content+='</select>';
    $("#form-PC-debt").append(content);
    chooseDebt();

  }
  else{
    $("#form-PC-debt").empty();
  }
  
}


    </script>
    {{-- <script>
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
    </script> --}}
@endpush
