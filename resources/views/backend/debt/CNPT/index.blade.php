

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
         <div class="collapse panel-collapse show collapse-stock" id="CNPT">
            <div class="card">
               <div class="card-header">
                  <h4 class="m-0 font-weight-bold text-primary float-left">Công nợ phải thu</h4>
                  <div id="reportrange-PT" data-cat="PT" class="float-right datetimepicker datetime-PT" onapply="changeDateTimePT(e)" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 24%; margin-left:20px">
                     <i class="fa fa-calendar" style="color: #007DFF"></i>&nbsp;
                     <span id="date-PT"></span> <i class="fa fa-caret-down" style="color: #007DFF"></i>
                  </div>
                  <a class="btn btn-primary btn-sm float-right mr-2" href="{{route('admin.CNPC')}}"> Công nợ phải chi</a>
               </div>
               <div class="card-body">
                  <div class="table-responsive">
                     <input class="auto-numeric" type="hidden">
                     <table style="color: #333" class="table table-bordered display" id="table-CNPT"  width="100%" cellspacing="0">
                        <thead>
                            <tr>

                              <th rowspan="2" style=" text-align: center;vertical-align: middle;">STT</th>
                              <th rowspan="2" style=" text-align: center;vertical-align: middle;">Mã khách hàng</th>
                              <th rowspan="2" style=" text-align: center;vertical-align: middle;">Tên khách hàng</th>
                              <th colspan="2" style=" text-align: center;vertical-align: middle;">Đầu kỳ</th>
                              <th colspan="2" style=" text-align: center;vertical-align: middle;">Phát sinh</th>
                              <th colspan="2" style=" text-align: center;vertical-align: middle;">Cuối kỳ</th>
                              <th rowspan="2" style=" text-align: center;vertical-align: middle;"></th>

                            </tr>
                            <tr>
                              <th style=" text-align: center;vertical-align: middle;">Nợ</th>
                              <th style=" text-align: center;vertical-align: middle;">Có</th>
                              <th style=" text-align: center;vertical-align: middle;">Nợ</th>
                              <th style=" text-align: center;vertical-align: middle;">Có</th>
                              <th style=" text-align: center;vertical-align: middle;">Nợ</th>
                              <th style=" text-align: center;vertical-align: middle;">Có</th>
                              
                            </tr>
                          </thead>
                          <tfoot>
                            <tr>
                                <th colspan="3" style="font-size:18px; text-align: center;vertical-align: middle;">Tổng cộng</th>
                                <th style="font-size:18px; text-align: center;vertical-align: middle;"></th>
                                <th style="font-size:18px; text-align: center;vertical-align: middle;"></th>
                                <th style="font-size:18px; text-align: center;vertical-align: middle;"></th>
                                <th style="font-size:18px; text-align: center;vertical-align: middle;"></th>
                                <th style="font-size:18px; text-align: center;vertical-align: middle;"></th>
                                <th style="font-size:18px; text-align: center;vertical-align: middle;"></th>
                                <th style="font-size:18px; text-align: center;vertical-align: middle;"></th>
                                
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
{{--  
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">
--}}
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
{{--  <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />  --}}
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
    <script>
      
        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
          });
          
          var start = moment().format('L');
        var end = moment().format('L');
        getDataCNPT(start, end, 'CNPT');
        //  getDataCNPT(start, end, 'CNPT'); 
        $('#reportrange-CNPT').on('apply.daterangepicker', (e, picker) => {
            var cat = "CNPT";
            var item = $('#reportrange-CNPT span').text();
            var arr = item.split(' - ');
            var start = arr[0];
            var end = arr[1];
            $('#table-CNPT').DataTable().destroy();
            getDataCNPT(start, end, cat);
        });
          function getDataCNPT(start, end, cat) {
            var numberFormat = $.fn.dataTable.render.number( '\,', '.', 0 ).display;
            var table = $('#table-CNPT').DataTable({
                responsive: true,
                {{--  dom: 'Blfrtip',  --}}
                dom: 'lfrtip',
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
                    url: route("admin.CNPT"),
                    data: {
                        start: start,
                        end: end,
                        cat: 'CNPT',
                    },
                },
        
                columns: [

                    {
                        data: null, 
                        defaultContent: '',
                    },
                    {
                        data:'code',
                        name:'debt.code'
                    },
                    {
                        data:'name',
                        name:'debt.name'
                    },
                    {
                        data:'no_dau_ky',
                        name:'debt.no_dau_ky',                    
                        render: $.fn.dataTable.render.number(',', '.')

                    },
                    {
                        data:'co_dau_ky',
                        name:'debt.co_dau_ky',
                        render: $.fn.dataTable.render.number(',', '.')

                    },
                    {
                        data:'no_phat_sinh',
                        name:'debt.no_phat_sinh',
                        render: $.fn.dataTable.render.number(',', '.')

                    },
                    {
                        data:'co_phat_sinh',
                        name:'debt.co_phat_sinh',
                        render: $.fn.dataTable.render.number(',', '.')

                    },
                    {
                        data:'no_cuoi_ky',
                        name:'debt.no_cuoi_ky',
                        render: $.fn.dataTable.render.number(',', '.')

                    },
                    {
                        data:'co_cuoi_ky',
                        name:'debt.no_cuoi_ky',
                        render: $.fn.dataTable.render.number(',', '.')

                    },
                {data: 'action', name: 'action', orderable: false, searchable: false},
            

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
                    var no_dau_ky = api
                        .column( 3 )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
                        
                var co_dau_ky = api
                        .column( 4 )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
                        
                    var no_phat_sinh = api
                        .column( 5 )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
                        
                 var co_phat_sinh = api
                        .column( 6 )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
                        
                 var no_cuoi_ky = api
                        .column( 7 )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
                 var co_cuoi_ky = api
                        .column( 8 )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
                    
                        
                    // Update footer by showing the total with the reference of the column index 
                $( api.column( 0 ).footer() ).html('Tổng cộng');
                    $( api.column( 3 ).footer() ).html(numberFormat(no_dau_ky));
                    $( api.column( 4 ).footer() ).html(numberFormat(co_dau_ky));
                    $( api.column( 5 ).footer() ).html(numberFormat(no_phat_sinh));
                    $( api.column( 6 ).footer() ).html(numberFormat(co_phat_sinh));
                    $( api.column( 7 ).footer() ).html(numberFormat(no_cuoi_ky));
                    $( api.column( 8 ).footer() ).html(numberFormat(co_cuoi_ky));
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
        </script>
@endpush

