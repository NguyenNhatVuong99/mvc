

@section('title', 'Tài khoản')
@extends('layouts.admin.master')
@section('main-content')
<!-- DataTales Example -->
<div class="card shadow mb-4">

<!-- Button trigger modal -->
<!-- Modal -->
<div class="card-body">
<div class="table-responsive">
   <div class="row">
      <div class="col">
            <div class="card">
               <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="m-0 font-weight-bold text-primary float-left">Cập nhật {{ $salary->name }}</h4>
                        <input type="hidden" name="" id="salary_id" value="{{ $salary->id }}">
                        <div class="text-center">
                           <button onclick="storeSalary()" class=" mr-2 btn btn-success float-right " data-toggle="tooltip" data-placement="bottom" title="Lưu"><i class="fas fa-save"></i> Lưu</button>
                           <button onclick="deleteSalary({{ $salary->id }})" class=" mr-2 btn btn-danger float-right " data-toggle="tooltip" data-placement="bottom" title="Lưu"><i class="fas fa-trash"></i> Huỷ</button>

                        </div>
                    </div>
                   
               </div>
               <div class="card-body">
                  
                  <div class="table-responsive">
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
                              <th colspan="5" class="font-size-18 text-center align-middle">Tổng cộng</th>
                              <th class="font-size-18 text-center align-middle" id="total_hour"></th>
                              <th class="font-size-18 text-center align-middle" id="total_sub"></th>
                              <th class="font-size-18 text-center align-middle" id="total_advance"></th>
                              <th class="font-size-18 text-center align-middle"></th>
                              <th class="font-size-18 text-center align-middle" id="total_bonus"></th>
                              <th class="font-size-18 text-center align-middle" id="total_dedution"></th>
                              <th class="font-size-18 text-center align-middle" id="total"></th>
                              <th class="font-size-18 text-center align-middle"></th>
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
      var listSalary=[];
      var salary_id=$("#salary_id").val();
      var personels=<?php echo $personels ?>;

      table(personels);
      function table(personels){
         var STT=1;
         var content='';
         for (var personel of personels) {
            content+='<tr id="tr_' +STT +'">' +
                        '<td class="text-center align-middle">'+STT+'</td>'+      
                        '<td class="text-center align-middle"> <a href="#">'+personel.user.name+'</a></td>'+      
                        '<td class="text-center align-middle">';
                        for(var item of personel.user.roles){
                           content+= item.name;
                        }   
               content+='</td>' +
                        
                        '<td>' +    
                           '<input type="text" value="0" onkeyup="changeLate('+STT+')"  class="input-number text-center align-middle" id="late_'+STT+'">'+
                        '</td>'+
                        '<td class="text-center align-middle" id="basic_salary_'+STT+'">'+personel.salary+'</td>'+ 
                        '<td>' +    
                           '<input type="text"  value="0" onkeyup="changeHour('+STT+')" class=" hour input-number text-center align-middle" id="hour_'+STT+'">'+
                        '</td>'+     
                        '<td class="text-center align-middle" id="sub_salary_'+STT+'">0</td>'+      
                        '<td class="text-center align-middle" id="advance_salary_'+STT+'">'+0+'</td>'+      
                        '<td class="text-center align-middle"></td>'+
                        '<td>' +    
                           '<input type="text" value="0" data-k="'+STT+'" onkeyup="changeBonus(this)" class="input-number text-center align-middle" id="bonus_salary_'+STT+'">'+
                        '</td>'+
                        '<td>' +    
                           '<input type="text" value="0" data-k="'+STT+'" onkeyup="changeDedution(this)" class="input-number text-center align-middle" id="dedution_salary_'+STT+'">'+
                        '</td>'+      
                        '<td class="text-center align-middle" id="sum_salary_'+STT+'">0</td>'+      
                        '<td class="text-center align-middle">'+
                           '<button class="btn btn-primary" onclick="showNote('+STT+')"><i class="fas fa-pen"> Ghi chú</i></button>'+
                           '<input type="hidden" id="note_'+STT+'" >'+
                        '</td>'+      
                     '</tr>';
            var object = {
               id: STT,
               salary_id:salary_id,
               personel_id: personel.id,
               hour: 0,
               late: 0,
               basic_salary: personel.salary,
               sub_salary: 0,
               advance_salary: 0,
               receipt_id: null,
               bonus_salary: 0,
               sum_salary: 0,
               dedution_salary: 0,
               note: null,
           };
           listSalary.push(object);
           STT++;
        }
        $('#tbody').html(content);
        numberic(STT);
        totalSalary(STT)

      }
      function showNote(k){
         var note=$("#note_"+k).val();
         $("#modalNote").modal('show');
         $("#textarea").val(note);
         $("#id").val(k);
      }
      function storeNote(){
         k=$("#id").val();
         note=$("#textarea").val();
         $("#note_"+k).val(note);
         $("#modalNote").modal('hide');
         listSalary[k-1].note  = note;

      }
      function numberic(k) {
         for (var i=1; i<=k-1; i++ ) {
             new AutoNumeric("#hour_" + i, {
                 decimalPlaces: '0'
             });
             new AutoNumeric("#basic_salary_" + i, {
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
     function numbericTotal(){
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
     function changeLate(k){
      var late=$("#late_"+k).val();

      listSalary[k-1].late = parseInt(late);

     }
      function changeHour(k){
         var hour=$("#hour_"+k).val();
         var basic_salary=converTextNumber("#basic_salary_"+k);
         var sub_salary=hour*basic_salary;
         $("#sub_salary_"+k).text(sub_salary);
         new AutoNumeric("#sub_salary_" + k, {
            decimalPlaces: '0'
        });
        listSalary[k-1].hour = parseInt(hour);
        listSalary[k-1].sub_salary = parseInt(sub_salary);
        changeTotal(k);
        totalSalary(k);

      }
      function changeBonus(e){
         if (e.which >= 37 && e.which <= 40) return;
         e.value = e.value.replace(/\D/g, '')
                                .replace(/\B(?=(\d{3})+(?!\d))/g, ',');
         var k=$(e).data('k');
         var value=$(e).val();
         listSalary[k-1].bonus_salary = parseInt(converValueNumber(e));

         changeTotal(k);
      }
      function changeDedution(e){
         if (e.which >= 37 && e.which <= 40) return;
         e.value = e.value.replace(/\D/g, '')
                                .replace(/\B(?=(\d{3})+(?!\d))/g, ',');
         var k=$(e).data('k');
         var value=$(e).val();

         listSalary[k-1].dedution_salary = parseInt(converValueNumber(e));

         changeTotal(k);
      }


      function changeTotal(k){
         var sub_salary=parseInt(converTextNumber("#sub_salary_"+k));
         var advance_salary=parseInt(converTextNumber("#advance_salary_"+k));
         if($("#bonus_salary_"+k).val()==''){
            bonus=0;
         }
         else{
            bonus=parseInt(converValueNumber("#bonus_salary_"+k));
         }
         if($("#dedution_salary_"+k).val()==''){
            dedution=0;
         }
         else{
            dedution=parseInt(converValueNumber("#dedution_salary_"+k));
         }
         var sum_salary=sub_salary+bonus-dedution-advance_salary;
         listSalary[k-1].sum_salary = parseInt(sum_salary);
         $("#sum_salary_"+k).text(sum_salary);
         new AutoNumeric("#sum_salary_" + k, {
            decimalPlaces: '0'
        });
        totalSalary(k);
      }
      function totalSalary(k){
         var total_hour=total_sub=total_advance=total_bonus=total_dedution=total=0;
         total_hour = listSalary.reduce(function (x, a) {
            return x + a.hour;
        }, 0);
        total_sub = listSalary.reduce(function (x, a) {
            return x + a.sub_salary;
        }, 0);
        total_advance = listSalary.reduce(function (x, a) {
            return x + a.advance_salary;
        }, 0);
        total_bonus = listSalary.reduce(function (x, a) {
            return x + a.bonus_salary;
        }, 0);
        total_dedution = listSalary.reduce(function (x, a) {
            return x + a.dedution_salary;
        }, 0);
        total = listSalary.reduce(function (x, a) {
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
      function storeSalary(){
         $.ajax({
            type: 'post',
            dataType: 'json',
            url : "{{route('manager.salary.store')}}",
            data:{
               id:$("#salary_id").val(),
               listSalary:listSalary,
               total:converTextNumber("#total"),
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
                  window.location.href="{{ route('manager.salary.index') }}";
              })
            },
            
        }); 
      }
      function deleteSalary(id){
         Swal.fire({
            title: 'Bạn muốn xóa bảng lương?',
            text: "Bạn sẽ không thể hoàn nguyên điều này",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Xóa',
            cancelButtonText: 'Thoát'
          }).then((result) => {
            if (result.isConfirmed) {
               $.ajax({
                  type: 'delete',
                  dataType: 'json',
                  url : "{{route('manager.salary.destroy', '')}}"+"/"+id,

                  
                  success: function(result) {
                     Swal.fire({
                        title: "Xóa thành công",
                        type: "success",
                        icon: 'success',
                        timer: 2000,
                        showCancelButton: false,
                        showConfirmButton: false
                     }).then(() => {
                        window.location.href = "{{ route('manager.salary.index')}}";
                    })
                  },
                  
              }); 
              
            }
          })
      }
   </script>
   
@endpush
