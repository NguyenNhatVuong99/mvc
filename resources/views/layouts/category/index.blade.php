<div class="modal" id="modalCreateCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Thêm danh mục</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label for="inputTitle" class="col-form-label">Tên <span class="text-danger">*</span></label>
                <input id="inputTitle" type="text" name="title" placeholder="Enter title"  value="{{old('title')}}" class="form-control">
                @error('title')
                <span class="text-danger">{{$message}}</span>
                @enderror
              </div>

              <div class="form-group">
                <label for="summary" class="col-form-label">Mô tả</label>
                <textarea id="my-editor" id="summary" name="summary" class="form-control">{!! old('content', 'test editor content') !!}</textarea>
                @error('summary')
                <span class="text-danger">{{$message}}</span>
                @enderror
              </div>

              <div class="form-group">
                <label for="is_parent">Danh mục cha</label><br>
                <input type="checkbox" name='is_parent' id='is_parent' value='1' checked> Yes                        
              </div>

              <div class="form-group d-none" id='parent_cat_div'>
                <label for="parent_id">Parent Category</label>
                
              </div>

              <div class="form-group">
                <label for="inputPhoto" class="col-form-label">Photo</label>
                <div class="input-group">
                    <span class="input-group-btn">
                        <a id="lfm" style="color: #fff" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                        <i class="fa fa-picture-o"></i> Choose
                        </a>
                    </span>
                <input id="thumbnail" class="form-control" type="text" name="photo" value="{{old('photo')}}">
              </div>
              <img id="holder" style="margin-top:15px;max-height:100px;" >
                @error('photo')
                <span class="text-danger">{{$message}}</span>
                @enderror
              </div>
              
              <div class="form-group">
                <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
                <select name="status" class="form-control">
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
                @error('status')
                <span class="text-danger">{{$message}}</span>
                @enderror
              </div>
            <div class="form-group">
                <label for="regular1" class="control-label">Tên thương hiệu<span class="color-red"> *</span></label>
                <input type="text"  id="name-brand-create"  autocomplete="off"required placeholder="Tên đơn vị" value="" name="phone" class="form-control" />
             </div>
        </div>
        <div class="modal-footer d-flex justify-content-between">
            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> &ensp;Hủy</button>

            <button onclick="storeCategory()" type="button" class="btn btn-primary"><i class="fas fa-save"></i> &ensp;Lưu</button>
        </div>
      </div>
    </div>
  </div>
  <script>
    function getCategory(){
        $.ajax({
            type: 'get',
            dataType: 'json',
            url: '{{ route("admin.category.index") }}',
            success: function(result) {
                content='<select id="category-select"  onChange="selectCategory(this)" class="selectpicker form-control" title="Chọn danh mục" data-live-search="true" data-width="100%" placeholder="Chọn nhà cung cấp" data-size="5" data-actions-box="true">';
                    for(var item of result){
                        content+='<option  value="'+item['id']+'">'+item['title']+'</option>';
                    }
                content+='</select>';
                $("#form-category-select").html(content);
                $("#category-select").selectpicker('refresh');
            },
            error: function(response) {
                var errors = response.responseJSON.errors;
                showError(errors);
           }
        });
    }
    function selectCategory(e){
        id = $(e).val();
        $.ajax({
            type: 'get',
            dataType: 'json',
            url: '{{ route("admin.category.child") }}',
            data:{
                id:id
            },
            success: function(result) {
                content='<select id="child-category-select"  class="selectpicker form-control" title="Chọn danh mục phụ" data-live-search="true" data-width="100%" placeholder="Chọn nhà cung cấp" data-size="5" data-actions-box="true">';
                    for(var item of result){
                        content+='<option  value="'+item['id']+'">'+item['title']+'</option>';
                    }
                content+='</select>';
                $("#form-child-category-select").html(content);
                $("#child-category-select").selectpicker('refresh');
            },
            error: function(response) {
                var errors = response.responseJSON.errors;
                showError(errors);
           }
        });
    }

    function storeCategory(){

        $.ajax({
            type: 'post',
            dataType: 'json',
            url: '{{ route("admin.category.store") }}',
            data: {
                name:  $("#name-category-create").val(),
            },
            success: function(result) {
                toastr.success('Cập nhật thành công');
                $("#modalCreateCategory").modal('hide');
                getCategory();
            },
            error: function(response) {
                var errors = response.responseJSON.errors;
                showError(errors);
           }
        });
    }
  </script>