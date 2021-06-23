@extends('backend.layouts.master')

@section('main-content')

<div class="card">
    <h5 class="card-header">Thêm sản phẩm</h5>
    <div class="card-body">
      <form method="post" action="{{route('admin.product.store')}}">
        {{csrf_field()}}
        
        <div class="form-row">
          <div class="col">
            <div class="form-group">
              <label for="inputTitle" class="col-form-label">Tên sản phẩm <span class="text-danger">*</span></label>
              <input id="inputTitle" type="text" name="title" placeholder="Enter title"  value="{{old('title')}}" class="form-control">
              @error('title')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label for="inputTitle" class="col-form-label">Mã sản phẩm <span class="text-danger">*</span></label>
              <input id="inputTitle" type="text" name="title"  placeholder="Tự động nếu không nhập"  value="{{old('title')}}" class="form-control">
              @error('title')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>
          </div>
        </div>
        

        <div class="form-group">
          <label for="summary" class="col-form-label">Summary <span class="text-danger">*</span></label>
          <textarea id="summary" name="summary" class="form-control">{!! old('summary', 'test editor content') !!}</textarea>
          {{--  <textarea class="form-control" id="summary" name="summary">{{old('summary')}}</textarea>  --}}
          @error('summary')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="description" class="col-form-label">Description</label>
          <textarea id="description" name="description" class="form-control">{!! old('description', 'test editor content') !!}</textarea>
          @error('description')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

              {{-- {{$categories}} --}}
              <div class="form-row">
          <div class="col">
            <div class="form-group">
              <label for="cat_id">Category <span class="text-danger">*</span></label>
              <select name="cat_id" id="cat_id" class="form-control">
                  <option value="">--Select any category--</option>
                  @foreach($categories as $key=>$cat_data)
                      <option value='{{$cat_data->id}}'>{{$cat_data->title}}</option>
                  @endforeach
              </select>
            </div>
    
          </div>
          <div class="col">
            <div class="form-group d-none" id="child_cat_div">
              <label for="child_cat_id">Sub Category</label>
              <select name="child_cat_id" id="child_cat_id" class="form-control">
                  <option value="">--Select any category--</option>
                
              </select>
            </div>
          </div>
        </div>
       
        
          <div class="form-row">
            <div class="col">
              <div class="form-group">
                <label for="price" class="col-form-label">Giá nhập<span class="text-danger">*</span></label>
                <input id="price" type="number" name="price" placeholder="Enter price"  value="{{old('price')}}" class="form-control">
                @error('price')
                <span class="text-danger">{{$message}}</span>
                @enderror
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="price" class="col-form-label">Giá bán<span class="text-danger">*</span></label>
                <input id="price" type="number" name="price" placeholder="Enter price"  value="{{old('price')}}" class="form-control">
                @error('price')
                <span class="text-danger">{{$message}}</span>
                @enderror
              </div>
            </div>
          </div>
        
          <div class="form-row">
            <div class="col">
              <div class="form-group">
                <label for="size">Size</label>
                <select name="size[]" class="form-control selectpicker"  multiple data-live-search="true">
                    <option value="">--Select any size--</option>
                    <option value="S">Nhỏ (S)</option>
                    <option value="M">Vừa (M)</option>
                    <option value="L">Lớn (L)</option>
                    <option value="XL">Cực lớn(XL)</option>
                </select>
              </div>
            </div>
            {{--  <div class="col">
              <div class="form-group">
                <label for="supplier_id">Thương hiệu</label>
      
                <select name="supplier_id" class="form-control">
                    <option value="">--Select supplier--</option>
                   @foreach($suppliers as $supplier)
                    <option value="{{$supplier->id}}">{{$supplier->title}}</option>
                   @endforeach
                </select>
              </div>
            </div>  --}}
          </div>
   
        

        

        <div class="form-group">
          <label for="condition">Tình trạng</label>
          <select name="condition" class="form-control">
              <option value="">--Chọn tình trạng--</option>
              <option value="default">Mặc định</option>
              <option value="new">Mới</option>
              <option value="hot">Hot</option>
          </select>
        </div>
        <div class="form-group">
          <label for="inputPhoto" class="col-form-label">Photo <span class="text-danger">*</span></label>
          <div class="input-group">
              <span class="input-group-btn">
                  <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                  <i class="fa fa-picture-o"></i> Choose
                  </a>
              </span>
          <input id="thumbnail" class="form-control" type="text" name="photo" value="{{old('photo')}}">
        </div>
        <div class="row" id="gallery">
       
        </div>
          @error('photo')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <input type="hidden" id="photo" name="photo">
        <div class="form-group mb-3">
          <button type="reset" class="btn btn-warning">Reset</button>
           <button class="btn btn-success" type="submit">Submit</button>
        </div>
      </form>
    </div>
</div>

@endsection

@push('styles')
  <style>
    #gallery .column {
      float: left;
      width: 25%;
      padding: 10px;
    }
    
    /* Style the images inside the grid */
    #gallery .column img {
      width: 200px;
      opacity: 0.8;
      cursor: pointer;
    }
    
    #gallery .column img:hover {
      opacity: 1;
    }
    
    /* Clear floats after the columns */
    .row:after {
      content: "";
      display: table;
      clear: both;
    }
    
    /* The expanding image container (positioning is needed to position the close button and the text) */
    .container {
      position: relative;
      display: none;
    }
    
    /* Expanding image text */
    #imgtext {
      position: absolute;
      bottom: 15px;
      left: 15px;
      color: white;
      font-size: 20px;
    }
    
    /* Closable button inside the image */
    .closebtn {
      position: absolute;
      top: 10px;
      right: 15px;
      color: white;
      font-size: 35px;
      cursor: pointer;
    }
  </style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
@endpush
@push('scripts')
<script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
<script src="{{ asset('vendor/laravel-filemanager/js/gallery.js') }}"></script>

<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

  <script>
    CKEDITOR.replace('summary', options);
    CKEDITOR.replace('description', options);

      
      var arr_gallery = []; 
      $('#lfm').filemanager('image');

      // $('select').selectpicker();

  </script>

  <script>
    gallery();
    function gallery(){
      $("#photo").val('');
      console.log(arr_gallery);
      for(item of arr_gallery){
        var content="";
        content+='<div class="column">'+
          '<img  src="'+item+'"  onclick="myFunction(this);">'+
        '</div>';
        
      }
      $("#gallery").append(content);

      var photo=arr_gallery.toString();
      $("#photo").val(photo);


    }
    $('#cat_id').change(function(){
      var cat_id=$(this).val();
      // alert(cat_id);
      if(cat_id !=null){
        // Ajax call
        $.ajax({
          url:"/admin/category/"+cat_id+"/child",
          data:{
            _token:"{{csrf_token()}}",
            id:cat_id
          },
          type:"POST",
          success:function(response){
            if(typeof(response) !='object'){
              response=$.parseJSON(response)
            }
            // console.log(response);
            var html_option="<option value=''>----Select sub category----</option>"
            if(response.status){
              var data=response.data;
              // alert(data);
              if(response.data){
                $('#child_cat_div').removeClass('d-none');
                $.each(data,function(id,title){
                  html_option +="<option value='"+id+"'>"+title+"</option>"
                });
              }
              else{
              }
            }
            else{
              $('#child_cat_div').addClass('d-none');
            }
            $('#child_cat_id').html(html_option);
          }
        });
      }
      else{
      }
    })
  </script>
@endpush