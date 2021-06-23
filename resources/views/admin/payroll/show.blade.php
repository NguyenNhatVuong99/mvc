

@section('title', 'Tài khoản')
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
            <div class="card">
               <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="m-0 font-weight-bold text-primary float-left">{{ $salary->name }}</h4>
                        <input type="hidden" name="" id="salary_id" value="{{ $salary->id }}">
                        <div class="text-center">
                           <a href="{{ route('admin.salary.index') }}" class=" mr-2 btn btn-primary float-right " data-toggle="tooltip" data-placement="bottom" title="Lưu"><i class="fas fa-reply"></i> Trở lại</a>
                        </div>
                    </div>
                   
               </div>
               <div class="card-body">
                  
                  <div class="table-responsive">
                     <div class="status">

                     </div>
                     <table style="color: #333" class="table table-bordered display" id="table"  width="100%" cellspacing="0">
                        <thead>
                           <tr >
                              <th  rowspan="2" class="text-center align-middle">STT</th>
                              <th rowspan="2" class="text-center align-middle">Tên</th>
                              <th rowspan="2" class="text-center align-middle">Vị trí</th>
                              <th rowspan="2" class="text-center align-middle">Đi trễ (ngày)</th>
                              <th rowspan="2" class="text-center align-middle">Lương cơ bản</th>
                              <th rowspan="2" class="text-center align-middle">Số giờ (giờ)</th>
                              <th rowspan="2" class="text-center align-middle">Tạm tính</th>
                              <th colspan="2" class="text-center align-middle">Tạm ứng</th>
                              <th rowspan="2" class="text-center align-middle">Tiền thưởng</th>
                              <th rowspan="2" class="text-center align-middle">Tiền phạt</th>
                              <th rowspan="2" class="text-center align-middle">Tổng cộng</th>
                              <th rowspan="2" class="text-center align-middle">Ghi chú</th>
                           </tr>
                           <tr>
                              <th  class="border-bottom text-center align-middle">Số tiền</th>
                              <th  class="border-bottom text-center align-middle">Chứng từ</th>
                           </tr>
                         </thead>
                         <tbody id="tbody">

                         </tbody>
                         <tfoot>
                           <tr>
                              <td colspan="5" class="font-size-18 text-center align-middle">Tổng cộng</td>
                              <td class="font-size-18 text-center align-middle" id="total_hour"></td>
                              <td class="font-size-18 text-center align-middle" id="total_sub"></td>
                              <td class="font-size-18 text-center align-middle" id="total_advance"></td>
                              <td class="font-size-18 text-center align-middle"></td>
                              <td class="font-size-18 text-center align-middle" id="total_bonus"></td>
                              <td class="font-size-18 text-center align-middle" id="total_dedution"></td>
                              <td class="font-size-18 text-center align-middle" id="total"></td>
                              <td class="font-size-18 text-center align-middle"></td>
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
<div class="modal fade" id="modalNote" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">Ghi chú</h5>
         <input type="hidden" name="" id="id" val>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <div class="modal-body">
         <div class="form-group">
            <textarea id="textarea" class="form-control" rows="3"></textarea>
         </div>
       </div>
       <div class="modal-footer">
         <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
         <button type="button" class="btn btn-primary" onclick="storeNote()">Save changes</button>
       </div>
     </div>
   </div>
 </div>
@endsection
@push('styles')
    <link href="{{asset('css/checkbox.css')}}" rel="stylesheet">

    <link href="{{asset('vendor/css/util.css')}}" rel="stylesheet">
   <style>
      .input-number {
         border: 1px solid #eceded;
         width: 100%;
         text-align: center;
         height: 47px;
         border-radius: 0;
         overflow: hidden;
         }
   </style>
@endpush
@push('scripts')
   <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
   <script>
      var salary=<?php echo $salary ?>;
      var listSalary = [];
      var salary_id = $("#salary_id").val();
      var details = <?php echo $details ?>;
      table(details);
      statusSalary(salary);
      function statusSalary(salary){
         content='';
         if(salary['isPay']==0){
            content+='<button  class=" mr-0 m-b-5 btn btn-danger float-right " data-toggle="tooltip" data-placement="bottom" title="Thanh toán"><i class="fas fa-money-check-alt"></i> Chưa thanh toán</button>';
         }
         else{
            content+='<button  class=" mr-0 m-b-5 btn btn-success float-right " data-toggle="tooltip" data-placement="bottom" title="Thanh toán"><i class="fas fa-money-check-alt"></i> Đã thanh toán</button>';
         }
         
         $(".status").html(content);
      }
      function table(details) {

         console.log(details);
         var STT = 1;
         var content = '';
         for (var detail of details) {
            var user = detail.personel.user;
            content += '<tr id="tr_' + STT + '">' +
                  '<td class="text-center align-middle">' + STT + '</td>' +
                  '<td class="text-center align-middle"> <a href="#">' + user.name + '</a></td>' +
                  '<td class="text-center align-middle">';
            for (var item of user.roles) {
                  content += item.name;
            }
            content += '</td>' +
                  '<td data-editable class="text-center align-middle" data-field-name="late" data-k=' + STT + ' id="late_' + STT + '">' + detail.late + '</td>' +
                  '<td class="text-center align-middle" id="basic_salary_' + STT + '">' + detail.basic_salary + '</td>' +
                  '<td data-editable data-field-name="hour" class="text-center align-middle" data-k=' + STT + ' id="hour_' + STT + '">' + detail.hour + '</td>' +
                  '<td class="text-center align-middle" data-k=' + STT + ' id="sub_salary_' + STT + '">' + detail.sub_salary + '</td>' +
                  '<td class="text-center align-middle"  id="advance_salary_' + STT + '">' + detail.advance_salary + '</td>' +
                  '<td class="text-center align-middle"></td>' +
                  '<td data-editable data-field-name="bonus_salary" data-k=' + STT + ' class="text-center align-middle" id="bonus_salary_' + STT + '">' + detail.bonus_salary + '</td>' +
                  '<td data-editable data-field-name="dedution_salary" data-k=' + STT + ' class="text-center align-middle" id="dedution_salary_' + STT + '">' + detail.dedution_salary + '</td>' +
                  '<td class="text-center align-middle" id="sum_salary_' + STT + '">' + detail.total_salary + '</td>' +
                  '<td class="text-center align-middle">' +
                  '<button class="btn btn-primary" onclick="showNote(' + STT + ')"><i class="fas fa-pen"> Ghi chú</i></button>' +
                  '<input type="hidden" id="note_' + STT + '" value=' + detail.note + ' >' +
                  '</td>' +
                  '</tr>';
            var object = {
                  id: detail.id,
                  salary_id: salary_id,
                  personel_id: detail.personel_id,
                  hour: detail.hour,
                  late: detail.late,
                  basic_salary: detail.basic_salary,
                  sub_salary: detail.sub_salary,
                  advance_salary: detail.advance_salary,
                  receipt_id: detail.receipt_id,
                  bonus_salary: detail.bonus_salary,
                  sum_salary: detail.total_salary,
                  dedution_salary: detail.dedution_salary,
                  note: detail.note,
            };
            listSalary.push(object);
            STT++;
         }
         $('#tbody').html(content);
         numberic(STT);
         totalSalary(STT);
      }

      function showNote(k) {
         var note = $("#note_" + k).val();
         $("#modalNote").modal('show');
         $("#textarea").val(note);
         $("#id").val(k);
      }

      function storeNote() {
         k = $("#id").val();
         note = $("#textarea").val();
         $("#note_" + k).val(note);
         $("#modalNote").modal('hide');
         listSalary[k - 1].note = note;

      }

      function numberic(k) {
         for (var i = 1; i <= k - 1; i++) {
            new AutoNumeric("#hour_" + i, {
                  decimalPlaces: '0'
            });
            new AutoNumeric("#basic_salary_" + i, {
                  decimalPlaces: '0'
            });
            new AutoNumeric("#bonus_salary_" + i, {
                  decimalPlaces: '0'
            });
            new AutoNumeric("#dedution_salary_" + i, {
                  decimalPlaces: '0'
            });
            new AutoNumeric("#advance_salary_" + i, {
                  decimalPlaces: '0'
            });
            new AutoNumeric("#sub_salary_" + i, {
                  decimalPlaces: '0'
            });
            new AutoNumeric("#sum_salary_" + i, {
                  decimalPlaces: '0'
            });
         }
      }

      function numbericTotal() {
         new AutoNumeric("#total_hour", {
            decimalPlaces: '0'
         });
         new AutoNumeric("#total", {
            decimalPlaces: '0'
         });
         new AutoNumeric("#total_bonus", {
            decimalPlaces: '0'
         });
         new AutoNumeric("#total_advance", {
            decimalPlaces: '0'
         });
         new AutoNumeric("#total_dedution", {
            decimalPlaces: '0'
         });
         new AutoNumeric("#total_sub", {
            decimalPlaces: '0'
         });
      }
      

      function changeListSalary(k, val, fieldName, id) {
         if (fieldName == 'hour') {
            var basic_salary = listSalary[k - 1].basic_salary;
            var sub_salary = val * basic_salary;
            listSalary[k - 1].sub_salary = parseInt(sub_salary);
            $("#sub_salary_" + k).text(sub_salary);
            new AutoNumeric("#sub_salary_" + k, {
                  decimalPlaces: '0'
            });
         }
         listSalary[k - 1][fieldName] = parseInt(val);
         new AutoNumeric("#" + id, {
            decimalPlaces: '0'
         });
         changeTotal(k);
      }

      function changeTotal(k) {
         var sub_salary = parseInt(converTextNumber("#sub_salary_" + k));
         var advance_salary = parseInt(converTextNumber("#advance_salary_" + k));
         var bonus = parseInt(converTextNumber("#bonus_salary_" + k));
         var dedution = parseInt(converTextNumber("#dedution_salary_" + k));
         var sum_salary = sub_salary + bonus - dedution - advance_salary;
         listSalary[k - 1].sum_salary = parseInt(sum_salary);
         $("#sum_salary_" + k).text(sum_salary);
         new AutoNumeric("#sum_salary_" + k, {
            decimalPlaces: '0'
         });
         totalSalary(k);
      }


      function totalSalary(k) {
         var total_hour = total_sub = total_advance = total_bonus = total_dedution = total = 0;
         total_hour = listSalary.reduce(function(x, a) {
            return x + a.hour;
         }, 0);
         total_sub = listSalary.reduce(function(x, a) {
            return x + a.sub_salary;
         }, 0);
         total_advance = listSalary.reduce(function(x, a) {
            return x + a.advance_salary;
         }, 0);
         total_bonus = listSalary.reduce(function(x, a) {
            return x + a.bonus_salary;
         }, 0);
         total_dedution = listSalary.reduce(function(x, a) {
            return x + a.dedution_salary;
         }, 0);
         total = listSalary.reduce(function(x, a) {
            return x + a.sum_salary;
         }, 0);
         $("#total_hour").text(total_hour);
         $("#total_sub").text(total_sub);
         $("#total_advance").text(total_advance);
         $("#total").text(total);
         $("#total_bonus").text(total_bonus);
         $("#total_dedution").text(total_dedution);
         numbericTotal();
      }

      function defaultSalary() {
         Swal.fire({
            title: 'Bạn muốn quay lại dữ liệu gốc?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            denyButtonColor: '#757575',
            cancelButtonText: 'Thoát',
            confirmButtonText: 'Tiếp tục',
         }).then((result) => {
            table(details);
         });
      }

      function isPay() {
         Swal.fire({
            title: 'Xác nhận thanh toán bảng lương',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            denyButtonColor: '#757575',
            cancelButtonText: 'Thoát',
            confirmButtonText: 'Xác nhận',
         }).then((result) => {
            $.ajax({
                  type: 'post',
                  dataType: 'json',
                  url: "{{route('manager.salary.status')}}",
                  data: {
                     isPay:1,
                     id: $("#salary_id").val(),
                  },

                  success: function(result) {
                     Swal.fire({
                        title: "Cập nhật thành công",
                        type: "success",
                        icon: 'success',
                        timer: 2000,
                        showCancelButton: false,
                        showConfirmButton: false
                     }).then(() => {
                        statusSalary(result);
                     })
                  },

            });
         });
      }
      function isStatus() {
         Swal.fire({
            title: 'Xác nhận công bố bảng lương',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            denyButtonColor: '#757575',
            cancelButtonText: 'Thoát',
            confirmButtonText: 'Xác nhận',
         }).then((result) => {
            $.ajax({
                  type: 'post',
                  dataType: 'json',
                  url: "{{route('manager.salary.status')}}",
                  data: {
                     isPublic:1,
                     id: $("#salary_id").val(),
                  },

                  success: function(result) {
                     Swal.fire({
                        title: "Cập nhật thành công",
                        type: "success",
                        icon: 'success',
                        timer: 2000,
                        showCancelButton: false,
                        showConfirmButton: false
                     }).then(() => {
                        statusSalary(result);
                     })
                  },

            });
         });
      }

      function storeSalary() {

         $.ajax({
            type: 'post',
            dataType: 'json',
            url: "{{route('manager.salary.update')}}",
            data: {
                  id: $("#salary_id").val(),
                  listSalary: listSalary,
                  total: converTextNumber("#total"),
            },

            success: function(result) {
                  Swal.fire({
                     title: "Cập nhật thành công",
                     type: "success",
                     icon: 'success',
                     timer: 2000,
                     showCancelButton: false,
                     showConfirmButton: false
                  }).then(() => {
                     table(result);
                  })
            },

         });
      }
         
   </script>
   
@endpush
