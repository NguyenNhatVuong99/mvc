<div class="modal" id="modalCreateBrand" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Thêm thương hiệu</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label for="regular1" class="control-label">Tên thương hiệu<span class="color-red"> *</span></label>
                <input type="text"  id="name-brand-create"  autocomplete="off"required placeholder="Tên đơn vị" value="" name="phone" class="form-control" />
             </div>
        </div>
        <div class="modal-footer d-flex justify-content-between">
            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> &ensp;Hủy</button>

            <button onclick="storeBrand()" type="button" class="btn btn-primary"><i class="fas fa-save"></i> &ensp;Lưu</button>
        </div>
      </div>
    </div>
  </div>
  <script>
    function getBrand(){
        $.ajax({
            type: 'get',
            dataType: 'json',
            url: '{{ route("admin.brand.index") }}',
            success: function(result) {
                content='<select id="brand-select" class="selectpicker form-control" title="Chọn thương hiệu" data-live-search="true" data-width="100%" placeholder="Chọn nhà cung cấp" data-size="5" data-actions-box="true">';
                    for(var item of result){
                        content+='<option  value="'+item['id']+'">'+item['name']+'</option>';
                    }
                content+='</select>';
                $("#form-brand-select").html(content);
                $("#brand-select").selectpicker('refresh');
            },
            error: function(response) {
                var errors = response.responseJSON.errors;
                showError(errors);
           }
        });
    }

    function storeBrand(){

        $.ajax({
            type: 'post',
            dataType: 'json',
            url: '{{ route("admin.brand.store") }}',
            data: {
                name:  $("#name-brand-create").val(),
            },
            success: function(result) {
                toastr.success('Cập nhật thành công');
                $("#modalCreateBrand").modal('hide');
                getBrand();
            },
            error: function(response) {
                var errors = response.responseJSON.errors;
                showError(errors);
           }
        });
    }
  </script>