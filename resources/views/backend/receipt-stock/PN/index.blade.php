

@section('title', 'PHIẾU NHẬP KHO')
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
                    <h4 class="m-0 font-weight-bold text-primary float-left">Phiếu nhập kho</h4>
                     <div class="text-center">
                        <a href="{{route('admin.PN.create')}}" class=" mr-2 btn btn-success btn-sm float-right " data-toggle="tooltip" data-placement="bottom" title="Tạo phiếu nhập"><i class="fas fa-plus"></i> Tạo phiếu nhập</a>
                        <a class="btn btn-primary btn-sm float-right mr-2" href="{{route('admin.PX')}}"><i class="fas fa-file"></i> Phiếu xuất kho</a>
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
                            <th style="">STT</th>
                             <th style=" text-align: center;vertical-align: middle;">Mã phiếu xuất</th>
                             <th style=" text-align: center;vertical-align: middle; ">Nhà cung cấp</th>
                             <th style=" text-align: center;vertical-align: middle;">Tổng tiền</th>
                             <th style=" text-align: center;vertical-align: middle;">Đã trả</th>
                             <th style=" text-align: center;vertical-align: middle;">Nợ</th>
                             <th style=" text-align: center;vertical-align: middle;">Trạng thái</th>
                             <th style=" text-align: center;vertical-align: middle;">Ghi chú</th>
                             <th style=" text-align: center;vertical-align: middle;">Thời gian</th>
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
<div class="modal fade" id="modalInfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Thông tin đối tác</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <ul class="list-group list-group-flush">
                <li class="list-group-item" id="list-code">Mã: </li>
                <li class="list-group-item"id="list-code">Tên: </li>
                <li class="list-group-item"id="list-code">Địa chỉ: </li>
                <li class="list-group-item"id="list-code">Điện thoại: </li>
            </ul>
            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>

@endsection
@push('styles')

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
        getData(start, end, 'PN');
        $('#reportrange-PT').on('apply.daterangepicker', (e, picker) => {
            var cat = "PN";
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
                    url: '{{ route("admin.PN") }}',
                    data: {
                        start: start,
                        end: end,
                        cat: 'PN',
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
                        data: 'slug',
                        render: function (data, type, full, meta) {
                            var currentCell = $("#table").DataTable().cells({"row":meta.row, "column":meta.col}).nodes(0);
                            $.ajax({
                                type: 'post',
                                dataType: 'json',
                                url: '{{ route("admin.partner.index") }}',  
                                data: {
                                    slug:data,
                                    partner_code:full['partner_code']
                                },
                                success: function(result) {
                                    console.log(result['name']);
                                    var content='<a onclick="openModal(this)"  data-toggle="modal" data-target="#modalInfo" data-name='+result['name']+' data-address='+result['address']+' data-phone='+result['phone']+' data-code='+result['code']+' >'+result["name"]+'</a>';
                                    $(currentCell).html(content);
                                }
                            });
                            return null;
                        }      

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
                            if (data == 'Hoàn thành') {
                                return '<button class="btn btn-success">'+data+'</button>';
                            } else {
                                return '<button class="btn btn-danger">'+data+'</button>';
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
                        .column( 3 )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
                        
                var payment = api
                        .column( 4 )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
                        
                    var debt = api
                        .column( 5 )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
                    
                        
                    // Update footer by showing the total with the reference of the column index 
                $( api.column( 0 ).footer() ).html('Tổng cộng');
                    $( api.column( 3 ).footer() ).html(numberFormat(total));
                    $( api.column( 4 ).footer() ).html(numberFormat(payment));
                    $( api.column( 5 ).footer() ).html(numberFormat(debt));
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
        function   getPartner(data,partner_code){
            $.ajax({
                type: 'post',
                dataType: 'json',
                url: '{{ route("admin.partner.index") }}',  
                data: {
                    slug:data,
                    partner_code:full['partner_code']
                },
                success: function(result) {
                    return $result;
                }
            });
        }
        $("#btn").hover(function () {
            console.log('ok');
            {{--  $('#exampleModal').modal({
                show: true,
                backdrop: false
            })  --}}
        });
        function openModal(e){
            $('#exampleModal').modal({
                show: true,
                backdrop: false
            });
            
            var code=$(e).data('code');
            var name=$(e).data('name');
            var phone=$(e).data('phone');
            var address=$(e).data('address');
            console.log(code);
            console.log(name);
            console.log(phone);
            console.log(address);
            $("#list-code").text(code);
            $("#list-name").text(name);
            $("#list-phone").text(phone);
            $("#list-address").text(address);
        }
        function format ( d ) {
            // `d` is the original data object for the row
            return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
                '<tr>'+
                    '<td>Full name:</td>'+
                    '<td>'+d.name+'</td>'+
                '</tr>'+
                '<tr>'+
                    '<td>Extension number:</td>'+
                    '<td>'+d.extn+'</td>'+
                '</tr>'+
                '<tr>'+
                    '<td>Extra info:</td>'+
                    '<td>And any further details here (images etc)...</td>'+
                '</tr>'+
            '</table>';
        }
         
        </script>
@endpush

