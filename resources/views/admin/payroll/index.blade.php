

@section('title', 'Tài khoản')
@extends('layouts.admin.master')
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
                        <h4 class="m-0 font-weight-bold float-left">Bảng lương</h4>
                        <a href="{{ route('admin.salary.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Thêm bảng lương</a>
                   </div>
               </div>
               <div class="card-body">
                  <div class="table-responsive">
                     <input class="auto-numeric" type="hidden">
                     <table style="color: #333" class="table table-bordered display" id="table"  width="100%" cellspacing="0">
                        <thead>
                           <tr>
                            <th  class="text-center align-middle w-5">STT</th>
                             <th class="text-center align-middle w-30">Tên</th>
                             <th class="text-center align-middle">Thời gian</th>
                             <th class="text-center align-middle">Tổng số tiền</th>
                             <th class="text-center align-middle">Trạng thái</th>
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

 
@endsection
@push('styles')
@endpush
@push('scripts')

    <script>
        getData();
        function getData() {
            var numberFormat = $.fn.dataTable.render.number( '\,', '.', 0 );
            var table = $('#table').DataTable();
            table.destroy();
            var table = $('#table').DataTable({
                scrollY: "500px",
                scrollCollapse: true,
                responsive: true,
                dom: "<'d-flex justify-content-between'<l><'table_filter'<'filter-role'><'refresh'>><'text-center'B><f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
                processing: true,
                language: {
                    processing:'<svg class="spinner" width="65px" height="65px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">'+
                        '<circle class="path" fill="none" stroke-width="6" stroke-linecap="round" cx="33" cy="33" r="30"></circle>'+
                     '</svg>',
                      
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
                btns.addClass('btn btn-primary');
                    btns.removeClass('dt-button');
        
                },
                select: true,
                
                ajax: {
                    dataType: 'json',
                    type: 'get',

                    url: '{{  route("admin.salary.index")}}',
                },
        
                columns: [
                    {
                        data: null, 
                        defaultContent: '',
                    },
                    {
                        render: function(data,type,row) {
                            url ="{{route('admin.salary.show', '')}}"+"/"+row.slug;
                            content='<a href="'+url+'">'+row.name+'</a>';
                            return content;

                        }
                    },
                    
                    {
                        
                        render: function(data,type,row) {
                            
                            return'tháng '+ row.month+' năm '+row.year;

                        }
                    },
                    {
                        render: function(data,type,row) {
                            return $.fn.dataTable.render.number( '\,', '.', 0 ).display(row.total);
                        }
                    },
                    {
                        render: function(data,type,row) {
                            content='';
                                if(row.isPay==0){
                                    content+='<h4><span class="badge badge-danger">Chưa thanh toán</span></h4>';
                                }
                                else{
                                    content+='<h4><span class="badge badge-success">Đã thanh toán</span></h4>';

                                }
                                return content;
                        }
                    },
                ],  
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

