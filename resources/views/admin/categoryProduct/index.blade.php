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
                         <h4 class="m-0 font-weight-bold text-primary float-left">Danh mục sản phẩm</h4>
                         <a href="{{ route('admin.categoryProduct.create') }}" class="btn btn-success"><i class="fas fa-plus"></i> Thêm danh mục</a>
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
                              <th class="text-center align-middle">Slug</th>
                              <th class="text-center align-middle">Danh mục cha</th>
                              <th class="text-center align-middle">Trạng thái</th>
                              <th></th>
                            </tr>
                            
                          </thead>
                          <tbody>
                            @foreach($categories as $key => $value)
                            <tr>
                              <td>{{ $key+1 }}</td>
                              <td>{{ $value->title }}</td>
                              <td>{{ $value->slug }}</td>
                              <td>{{ $value->parent_info['title']}}</td>
                              <td>{{ $value->status }}</td>
                              <td>
                                <a  class=" btn btn-primary float-right " data-toggle="tooltip" data-placement="bottom" title="Lưu"><i class="fas fa-pen"></i></a>
                                <a class=" mr-2 btn btn-primary float-right " data-toggle="tooltip" data-placement="bottom" title="Lưu"><i class="fas fa-trash"></i></a>

                              </td>
                            </tr>

                          @endforeach
                          </tbody>
                           
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
</div>
@endsection

@push('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">
  {{--  <link href="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">  --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
  
@endpush

@push('scripts')

  <!-- Page level plugins -->
  {{--  <script src="{{asset('backend/vendor/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>  --}}
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
  <!-- Page level custom scripts -->
  <script>
    $(function() {
      var table = $('#myTable').DataTable({
          dom: 'lifrtp',
          processing: true,
          language: {
              url: 'cdn.datatables.net/plug-ins/1.10.22/i18n/Vietnamese.json'
          },
          scrollY: 500,
          info: false,
          serverSide: true,
          buttons: [
              'copy', 'excel', 'pdf', 'print'
          ],
          ajax: {
              url: route('category.index'),
              type: "get"
          },
          columns: [{
                  data: null
              },
              {
                  data: 'id',
                  name: 'users.id',
                  render: function(data) {
                      return `<button type="button" class="btn btn-danger">${data}</button>`;
                  }
              },
              {
                  data: 'name',
                  name: 'users.name'
              },
              {
                  data: 'email',
                  name: 'users.email'
              },
              {
                  data: 'created_at',
                  name: 'users.created_at'
              },
          ],
  
          columnDefs: [{
              'targets': 0,
              'checkboxes': {
                  'selectRow': true
              }
          }],
          select: {
              'style': 'multi'
          },
  
      });
  });
</script>
  <script>
      $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
          $('.dltBtn').click(function(e){
            var form=$(this).closest('form');
              var dataID=$(this).data('id');
              // alert(dataID);
              e.preventDefault();
              swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this data!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                       form.submit();
                    } else {
                        swal("Your data is safe!");
                    }
                });
          })
      })
  </script>
@endpush