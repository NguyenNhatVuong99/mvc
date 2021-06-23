@extends('backend.layouts.master')

@section('main-content')

<div class="card">
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
                         <h4 class="m-0 font-weight-bold text-primary float-left">Thêm danh mục sản phẩm</h4>
                         <div class="text-center">
                            <button onclick="storeSalary()" class=" mr-2 btn btn-success float-right " data-toggle="tooltip" data-placement="bottom" title="Lưu"><i class="fas fa-save"></i> Lưu</button>
                            <a href="{{ route('admin.categoryProduct.index') }}" class=" mr-2 btn btn-primary float-right " data-toggle="tooltip" data-placement="bottom" title="Lưu"><i class="fas fa-reply"></i> Trở lại</a>

                         </div>
                     </div>
                    
                </div>
                <div class="card-body">
                    <form method="post" action="{{route('admin.categoryProduct.store')}}">
                      {{csrf_field()}}
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
                        <select name="parent_id" class="form-control">
                            <option value="">Chọn danh muc</option>
                            @foreach($parent_cats as $key=>$parent_cat)
                                <option value='{{$parent_cat->id}}'>{{$parent_cat->title}}</option>
                            @endforeach
                        </select>
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
                      <div class="form-group mb-3">
                        <button type="reset" class="btn btn-warning">Reset</button>
                          <button class="btn btn-success" type="submit">Submit</button>
                      </div>
                    </form>
                </div>
             </div>
       </div>
    </div>
 </div>
    {{-- <h5 class="card-header">Add Category</h5>
    <div class="card-body">
      <form method="post" action="{{route('admin.categoryProduct.store')}}">
        {{csrf_field()}}
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Title <span class="text-danger">*</span></label>
          <input id="inputTitle" type="text" name="title" placeholder="Enter title"  value="{{old('title')}}" class="form-control">
          @error('title')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="summary" class="col-form-label">Summary</label>
          <textarea id="my-editor" id="summary" name="summary" class="form-control">{!! old('content', 'test editor content') !!}</textarea>
          @error('summary')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="is_parent">Is Parent</label><br>
          <input type="checkbox" name='is_parent' id='is_parent' value='1' checked> Yes                        
        </div>

        <div class="form-group d-none" id='parent_cat_div'>
          <label for="parent_id">Parent Category</label>
          <select name="parent_id" class="form-control">
              <option value="">--Select any category--</option>
              @foreach($parent_cats as $key=>$parent_cat)
                  <option value='{{$parent_cat->id}}'>{{$parent_cat->title}}</option>
              @endforeach
          </select>
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
        <div class="form-group mb-3">
          <button type="reset" class="btn btn-warning">Reset</button>
           <button class="btn btn-success" type="submit">Submit</button>
        </div>
      </form>
    </div> --}}
</div>

@endsection

@push('styles')
<link rel="stylesheet" href="{{asset('backend/summernote/summernote.min.css')}}">
@endpush
@push('scripts')


  <script src="/vendor/laravel-filemanager/js/lfm.js"></script>
  
  <script>
    {{-- CKEDITOR.replace('my-editor', options); --}}

      $('#lfm').filemanager('image');

    
  </script>

  <script>
    $('#is_parent').change(function(){
      var is_checked=$('#is_parent').prop('checked');
      // alert(is_checked);
      if(is_checked){
        $('#parent_cat_div').addClass('d-none');
        $('#parent_cat_div').val('');
      }
      else{
        $('#parent_cat_div').removeClass('d-none');
      }
    })
  </script>
@endpush