<div class="modal" id="modalCreateUnit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Thêm đơn vị</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label for="regular1" class="control-label">Tên đơn vị<span class="color-red"> *</span></label>
                <input type="text"  id="name-unit-create"  autocomplete="off"required placeholder="Tên đơn vị" value="" name="phone" class="form-control" />
             </div>
        </div>
        <div class="modal-footer d-flex justify-content-between">
            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> &ensp;Hủy</button>

            <button onclick="storeUnit()" type="button" class="btn btn-primary"><i class="fas fa-save"></i> &ensp;Lưu</button>
        </div>
      </div>
    </div>
  </div>
  <script>

    function getUnit(){
        $.ajax({
            type: 'get',
            dataType: 'json',
            url: '{{ route("admin.unit.index") }}',
            success: function(result) {
                content='<select id="unit-select" class="selectpicker form-control" title="Chọn đơn vị" data-live-search="true" data-width="100%" placeholder="Chọn nhà cung cấp" data-size="5" data-actions-box="true">';
                    for(var item of result){
                        content+='<option  value="'+item['id']+'">'+item['name']+'</option>';
                    }
                content+='</select>';
                $("#form-unit-select").html(content);
                $("#unit-select").selectpicker('refresh');
            },
            error: function(response) {
                var errors = response.responseJSON.errors;
                showError(errors);
           }
        });
       
    }
    function storeUnit(){
        $.ajax({
            type: 'post',
            dataType: 'json',
            url: '{{ route("admin.unit.store") }}',
            data: {
                name:  $("#name-unit-create").val(),
            },
            success: function(result) {
                toastr.success('Cập nhật thành công');
                $("#modalUnitCreate").modal('hide');
                getUnit();
            },
            error: function(response) {
                var errors = response.responseJSON.errors;
                showError(errors);
           }
        });
    }
  </script>