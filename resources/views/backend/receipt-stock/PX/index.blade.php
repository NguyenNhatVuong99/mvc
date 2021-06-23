

@section('title', 'PHIẾU XUẤT KHO')
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
         <div class="collapse panel-collapse show collapse-stock" id="CNPC">
            <div class="card">
               <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="m-0 font-weight-bold text-primary float-left">Phiếu xuất kho</h4>
                         <div class="text-center">
                            <a href="{{route('admin.PX.create')}}" class=" mr-2 btn btn-success btn-sm float-right " data-toggle="tooltip" data-placement="bottom" title="Tạo phiếu xuất"><i class="fas fa-plus"></i> Tạo phiếu xuất</a>
                            <a class="btn btn-primary btn-sm float-right mr-2" href="{{route('admin.PN')}}"><i class="fas fa-file"></i> Phiếu nhập kho</a>
                            <a class="btn btn-primary btn-sm float-right mr-2" href="{{route('admin.stockBalance')}}"><i class="fas fa-balance-scale"></i> Cân đối kho</a>
                         </div>
                         <div id="reportrange-PT" data-cat="PT" class="float-right datetimepicker datetime-PT" onapply="changeDateTimePT(e)" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 24%; margin-left:20px">
                            <i class="fa fa-calendar" style="color: #007DFF"></i>&nbsp;
                            <span id="date-PT"></span> <i class="fa fa-caret-down" style="color: #007DFF"></i>
                         </div>
                   </div>
               </div>
               <div class="card-body">
                  <div class="table-responsive">
                     <input class="auto-numeric" type="hidden">
                     <table style="color: #333" class="table table-bordered display" id="table"  width="100%" cellspacing="0">
                        <thead>
                           <tr>
                            <th  class="text-center align-middle" rowspan="2">STT</th>
                             <th rowspan="2" class="text-center align-middle">Mã phiếu</th>
                             <th colspan="2" class="text-center align-middle">Chứng từ</th>
                             <th rowspan="2" class="text-center align-middle">Khách hàng</th>
                             <th rowspan="2" class="text-center align-middle">Tổng tiền</th>
                             <th rowspan="2" class="text-center align-middle">Đã trả</th>
                             <th rowspan="2" class="text-center align-middle">Nợ</th>
                             <th rowspan="2" class="text-center align-middle">Trạng thái</th>
                             <th rowspan="2" class="text-center align-middle">Ghi chú</th>
                             <th rowspan="2" class="text-center align-middle">Thời gian</th>
                           </tr>
                           <tr>
                                <th  class="border-bottom text-center align-middle">Số hiệu</th>
                                <th  class="border-bottom text-center align-middle">Thời gian</th>
                           </tr>
                         </thead>
                          <tfoot>
                            <tr>
                                <th colspan="5" class="text-center align-middle">Tổng cộng</th>
                                <th class="text-center align-middle"></th>
                                <th class="text-center align-middle"></th>
                                <th class="text-center align-middle"></th>
                                <th class="text-center align-middle"></th>
                                <th class="text-center align-middle"></th>
                                <th class="text-center align-middle"></th>
                              </tr>
                          </tfoot>
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

@endsection
@push('styles')
{{-- <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" /> --}}
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" /> --}}
    
@endpush
@push('scripts')
    <script>
        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
          });
        var start = moment().format('L');
        var end = moment().format('L');
        getData(start, end, 'PX');
        $('#reportrange-PT').on('apply.daterangepicker', (e, picker) => {
            var cat = "PX";
            var item = $('#reportrange-PT span').text();
            var arr = item.split(' - ');
            var start = arr[0];
            var end = arr[1];
            $('#table').DataTable().destroy();

            getData(start, end, cat);
        });
        function getData(start, end, cat) {
            var numberFormat = $.fn.dataTable.render.number( '\,', '.', 0 ).display;
            var table = $('#table').DataTable({
                responsive: true,
                dom: "<'d-flex justify-content-between'<l><'text-center'B><f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
                processing: true,
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
                info: false,
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
                        text: 'Print all ',
                        exportOptions: {
                            modifier: {
                                selected: null
                            }
                        }
                    }
                ],
                initComplete: function () {
                    var btns = $('.dt-button');
                    btns.addClass('btn btn-primary btn-sm');
                    btns.removeClass('dt-button');
        
                },
                select: true,
                ajax: {
                    url: '{{  route("admin.PX")}}',
                    data: {
                        start: start,
                        end: end,
                        cat: 'PX',
                    },
                },
        
                columns: [

                    {
                        data: null, 
                        defaultContent: '',
                    },
                    {
                        data:'code',
                        name:'data.code'
                    },
                    {
                        data:'document',
                        name:'data.document'
                    },
                    {
                        data:'document_date',
                        name:'data.document_date',
                        render: function(data, type, row) {
                            return moment(data).format("DD/MM/YYYY");
                        }
                    },
                    {
                        data:'user',
                        name:'data.user',                    

                    },
                    {
                        data:'total',
                        name:'data.total',
                        render: $.fn.dataTable.render.number(',', '.')

                    },
                    {
                        data:'payment',
                        name:'data.payment',
                        render: $.fn.dataTable.render.number(',', '.')

                    },
                    {
                        data:'debt',
                        name:'data.debt',
                        render: $.fn.dataTable.render.number(',', '.')

                    },
                    {
                        data:'status',
                        name:'data.status',
                        render: function(data,type,row) {
                            console.log(row['id']);
                            
                            if (data == 'Chờ xuất kho') {
                                return '<span class="badge badge-danger">'+data+'</span><button type="button" class="btn btn-primary" onclick="outOfStock('+row['id']+')">Xuất kho</button>';
                            } else {
                                return '<button class="btn btn-success">'+data+'</button>';

                            }
                        }
                    },
                    {
                        data:'note',
                        name:'data.note',
                        render: $.fn.dataTable.render.number(',', '.')

                    },
                    {
                        data: 'date',
                        name: 'data.date',
                        render: function(data, type, row) {
                            return moment(data).format("DD/MM/YYYY");
                        }
                    },
                    {{--  {data: 'action', name: 'action', orderable: false, searchable: false},  --}}
                ],  
                "footerCallback": function ( row, data, start, end, display ) {
                    var api = this.api(), data;
                    // converting to interger to find total
                    var intVal = function ( i ) {
                        return typeof i === 'string' ?
                            i.replace(/[\$,]/g, '')*1 :
                            typeof i === 'number' ?
                                i : 0;
                    };
         
                    // computing column Total of the complete result 
                    var total = api
                        .column( 5 )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
                        
                var payment = api
                        .column( 6 )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
                        
                    var debt = api
                        .column( 7 )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
                    
                        
                    // Update footer by showing the total with the reference of the column index 
                $( api.column( 0 ).footer() ).html('Tổng cộng');
                    $( api.column( 5 ).footer() ).html(numberFormat(total));
                    $( api.column( 6 ).footer() ).html(numberFormat(payment));
                    $( api.column( 7 ).footer() ).html(numberFormat(debt));
                },
            });
            table.on('order.dt search.dt', function() {
                table.column(0, {
                    search: 'applied',
                    order: 'applied'
                }).nodes().each(function(cell, i)   {
                    cell.innerHTML = i + 1;
                });
            }).draw();

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
                        getData(start, end, 'PX');
                    }, 1000);
                },
                error: function(json) {
                    if (json.status === 404) {
                        var errors = json.responseJSON;
                    }
                }
            });
        }
        </script>
@endpush

