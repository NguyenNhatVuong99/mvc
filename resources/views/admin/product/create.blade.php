@section('title', 'Tài khoản')
@extends('layouts.admin.master')
@section('main-content')
<!-- DataTales Example -->
<div class="row">
  <div class="col">
    <div class="card">
       <div class="card-header">
            <div class="d-flex justify-content-between">
                <h5 class="m-0 font-weight-bold  float-left">Thêm sản phẩm </h5>
                <div class="text-center">
                    <a onclick="store()" href="#"  id="btn-save" class="  mr-2 btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="Lưu"><i class="fas fa-save"></i>&ensp;Lưu</a>
                    <a  href="{{route('admin.product.index')}}"   class=" mr-2 btn btn-success btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="Quay lại "><i class="fas fa-undo"></i>&ensp;Quay lại</a>
                 </div>
            </div>
           
       </div>
       <div class="card-body">
          <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="regular1" class="control-label">Tên sản phẩm<span class="color-red"> *</span></label>
                            <input type="text"  id="title"  autocomplete="off"required placeholder="Tên sản phẩm" value="" name="phone" class="form-control input-create-supplier" />
                         </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                              <label for="inputEmail4">Giá vốn<span class="color-red"> *</span></label>
                              <input type="text" onkeyup="keyUpNumber(this)" class="form-control" id="cost_price" placeholder="Giá vốn">
                            </div>
                            <div class="form-group col-md-4">
                              <label for="inputPassword4">Giá website<span class="color-red"> *</span></label>
                              <input type="text" onkeyup="keyUpNumber(this)" class="form-control" id="price" placeholder="Giá website">
                            </div>
                            <div class="form-group col-md-4">
                              <label for="inputPassword4">Giá cửa hàng<span class="color-red"> *</span></label>
                              <input type="text" onkeyup="keyUpNumber(this)" class="form-control" id="off_price" placeholder="Giá cửa hàng">
                            </div>
                          </div>
                          <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Đơn vị<span class="color-red"> *</span>
                                </label>
                                <div class="row">
                                    <div class="col-10" id="form-unit-select">
                                       
                                    </div>
                                    <div class="col-2">
                                       <button class="form-control btn btn-primary btn-sm" data-toggle="modal" data-target="#modalCreateUnit"><i class="fas fa-plus"></i></button>
                                    </div>
                                 </div>
                              </div>
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Thương hiệu</label>
                                <div class="row">
                                    <div class="col-10" id="form-brand-select">
                                       
                                    </div>
                                    <div class="col-2">
                                       <button class="form-control btn btn-primary btn-sm" data-toggle="modal" data-target="#modalCreateBrand"><i class="fas fa-plus"></i></button>
                                    </div>
                                 </div>
                              </div>
                          </div>
                          <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Danh mục sản phẩm<span class="color-red"> *</span>
                                </label>
                                <div class="row">
                                    <div class="col-10" id="form-category-select">
                                       
                                    </div>
                                    <div class="col-2">
                                       <button class="form-control btn btn-primary btn-sm" data-toggle="modal" data-target="#modalCreateCategory"><i class="fas fa-plus"></i></button>
                                    </div>
                                 </div>
                              </div>
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Danh mục phụ</label>
                                <div class="row">
                                    <div class="col-12" id="form-child-category-select">
                                       
                                    </div>
                                    
                                 </div>
                              </div>
                          </div>
                    </div>
                </div>
                
               
            </div>
            <div class="col-6">
                   
              <div class="accordion" id="accordionExample">
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h5 class="mb-0">
                            <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapseOne"><i class="fa fa-angle-right"></i> Hình ảnh</button>									
                        </h5>
                    </div>
                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card-body">
                          <div class="form-group">
                              <button type="button" class="btn btn-primary btn-sm" id="btn-image" data-input="thumbnail" data-preview="holder"><i class="fas fa-upload"></i>&ensp;Chọn file</button>
                          </div>
                          <div class="form-group d-flex" id="gallery-create">
                          </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingTwo">
                        <h2 class="mb-0">
                            <button type="button" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo"><i class="fa fa-angle-right"></i>Tóm lược</button>
                        </h2>
                    </div>
                    <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionExample">
                        <div class="card-body">
                            <textarea id="summary" name="summary" class="form-control">{!! old('summary') !!}</textarea>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingThree">
                        <h2 class="mb-0">
                            <button type="button" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree"><i class="fa fa-angle-right"></i> Mô tả</button>                     
                        </h2>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                        <div class="card-body">
                            <textarea id="description" name="description" class="form-control">{!! old('description') !!}</textarea>
                        </div>
                    </div>
                </div>
                </div>
            </div>
          </div>
       </div>
    </div>
</div>
@extends('layouts.unit.index')
@extends('layouts.brand.index')
@extends('layouts.category.index')


@endsection
@push('styles')
    
@endpush
@push('scripts')
    <script src="{{ asset('js/gallery.js') }}"></script>
    <script>
        $(document).ready(function(){
            // Add down arrow icon for collapse element which is open by default
            $(".collapse.show").each(function(){
                $(this).prev(".card-header").find(".fa").addClass("fa-angle-down").removeClass("fa-angle-right");
            });
            
            // Toggle right and down arrow icon on show hide of collapse element
            $(".collapse").on('show.bs.collapse', function(){
                $(this).prev(".card-header").find(".fa").removeClass("fa-angle-right").addClass("fa-angle-down");
            }).on('hide.bs.collapse', function(){
                $(this).prev(".card-header").find(".fa").removeClass("fa-angle-down").addClass("fa-angle-right");
            });
            $('#btn-image').filemanager('image');

        });
        
        
        var arr_gallery=[];
        function gallery(file_path){
            arr_gallery.push(file_path);
            getGallery(arr_gallery);
          
        }
        function getGallery(arr_gallery){
            var content="";
            for(var item of arr_gallery){
                content+='<figure class="snip0013">'+
                    '<img src="'+item+'" alt="sample32"/>'+
                    '<div>'+
                        '<a  onclick="remove('+item+');return false;"><i class="ion-ios-trash-outline"></i></a>'+
                    '</div>'+	
                '</figure>';
            };
            $("#gallery-create").html(content);
        }
        getUnit();
        getBrand();
        getCategory();
        
        function store(){
            var title=$("#title").val();
            var slug=ChangeToSlug(title);
            {{--  console.log(slug);  --}}
            
        }
    </script>
   
@endpush