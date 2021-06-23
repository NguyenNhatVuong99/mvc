            
<div class="card">
    
  <div class="card-header py-3">
    <h4 class="m-0 font-weight-bold text-primary float-left"> Bán hàng</h4>
    <a onclick="store()" href="#"  id="btn-save" class="disabled btn btn-primary float-right" data-toggle="tooltip" data-placement="bottom" style="margin-left: 20px;" title="Lưu"><i class="fas fa-save"></i>Lưu</a>
    <a onclick="store()" href="#" id="btn-savePrint"class="disabled btn btn-primary  float-right" data-toggle="tooltip" data-placement="bottom" title="Lưu và in"><i class="fas fa-print"></i> Lưu và in</a>
  </div>
    <div class="card-body row">
        <div class="col-md-8 col-12">
            <div class="card m-b-10">
                <div class="card-body">
                    
                    <div class="form-group">
                        <select id="product-select" class="show-tick  form-control" title="Chọn sản phấm" data-size="5" data-actions-box="true" multiple data-live-search="true">
                            @foreach ($products as $product)
                                <option data-type="PX"  value="{{ $product->id }}"> {{ $product->name }} - Mã: {{ $product->code }} - Số lượng: {{ $product->quantity }} </option>
                            @endforeach

                          </select>
                        
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table style="color: #333;" class="table table-bordered"  width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="text-align-center vertical-align-middle">STT</th>
                                    <th class="text-align-center vertical-align-middle">Tên</th>
                                    <th class="w-20 text-align-center vertical-align-middle">Số lượng</th>
                                    <th class="text-align-center vertical-align-middle">Giá gốc</th>
                                    <th class="text-align-center vertical-align-middle">Giá bán</th>
                                    <th class="text-align-center vertical-align-middle">Thành tiền</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="table-product"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-12">
            <div class="card">
                <div class="card-header">
                    Thông tin khách hàng
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="inputTitle" class="col-form-label">Khách hàng<span class="text-danger">*</span></label>
                            <div class="d-flex justify-content-between">
                                <div class="flex-item flex-basis-80">
                                    <select id="user-select" class="selectpicker form-control" title="Chọn khách hàng" data-live-search="true" placeholder="Chọn khách hàng" data-size="5" data-actions-box="true">
                                        @foreach ($users as $item)
                                            <option  value="{{ $item->code }}">{{ $item->name }} - {{ $item->code }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="flex-item ">
                                    <button class="btn btn-light"   onclick="showModalCreateUser()"><i class="fas fa-plus"></i></button>
                                </div>
                                <div class="flex-item ">
                                    <button class="d-none btn btn-light"  data-toggle="tooltip" data-placement="top" title="Thông tin khách hàng" id="btnShowInfoUser" onclick="showInfoUser()"><i class="fas fa-angle-down "></i></button>
                                </div>
                            </div>
                    </div>
                    <div class="collapse form-group" id="formInfoUser">
                        <div class="card ">
                            <div class="card-header">
                                Thông tin khách hàng
                            </div>
                            <div class="card-body" style="padding: 0.25rem">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item" id="nameUser"></li>
                                    <li class="list-group-item" id="phoneUser"></li>
                                    <li class="list-group-item" id="addressUser"></li>
                                  </ul>
                            </div>
                        </div>
                      </div>
                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                        <label for="regular1" class="control-label">Ngày tạo phiếu</label>
                        <input type="text" required placeholder="" value="{{ old('date') }}" name="date" id="datetime" class="form-control" />

                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    Thông tin thanh toán
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                          
                            <div class="row">
                                <div class="col-6">
                                    Tổng cộng:
                                </div>
                                <div class="col-6" id="total_price"></div>
                                <input type="hidden" name="" id="total_quantity">
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-6">
                                    Thanh toán:
                                </div>
                                <div class="col-6">
                                    <input type="text" disabled class="form-control" onkeyup="updatePayment()" value="0" id="payment" />
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-6">
                                    Nợ:
                                </div>
                                <div class="col-6" id="debt">0</div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <h5 id="nameMoney">Nhất Vương</h5>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <label for="inputTitle" class="col-form-label">Chi chú<span class="text-danger">*</span></label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" style="height: 80px;"></textarea>
                            </div>
                        </li>
                    </ul>
                    <div class="form-group">
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalCreateUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Thêm khách hàng</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label for="regular1" class="control-label">Họ và tên <span class="color-red" >*</span></label>
                <input type="text" id="name-create" required autofocus placeholder="Họ và tên" value="" name="name"   class="form-control" />
            </div>
            <div class="form-group">
                <div class="alert alert-danger d-none " id="error-name">
                </div>
            </div>
            <div class="form-group">
                <label for="regular1" class="control-label">Email</label>
                <input type="text" id="email-create" required  placeholder="Email" value="" name="email" id="title"  class="form-control" />
            </div>
            <div class="form-group">
                <label for="regular1" class="control-label">Số điện thoại <span class="color-red">*</span></label>
                <input type="text"  id="phone-create"required placeholder="Số điện thoại" value="" name="phone" id="title"  class="form-control" />
            </div>
            <div class="form-group">
                <div class="alert alert-danger d-none " id="error-phone">
                </div>
            </div>
            <div class="form-group">
                <label for="inputAddress">Tỉnh - Thành phố</label>
                <select name="" required data-live-search="true" data-size="5" title="Vui lòng chọn tỉnh-thành phố" class="selectpicker province form-control" id="province-create" data-type="create" >
                </select>
                <div class="dis-none alert m-t-5 alert-danger" id="error-create-province">
                </div>
             </div>
             <div class="form-group dis-none form-district-create" >
                <label for="inputAddress">Quận - Huyện</label>
                <select name="" required data-live-search="true" data-size="5" title="Vui lòng chọn quận-huyện" class="selectpicker district form-control" id="district-create" data-type="create" >
                </select>
                <div class="dis-none alert m-t-5 alert-danger" id="error-create-district">
                </div>
             </div>
             <div class="form-group dis-none form-ward-create">
                <label for="inputAddress">Xã, phường</label>
                <select name="" required data-live-search="true" data-size="5" title="Vui lòng chọn xã-phường" class="selectpicker ward ward-create form-control" id="ward-create" data-type="create">
                </select>
                <div class="dis-none alert m-t-5 alert-danger" id="error-create-ward">
                </div>
             </div>
             <div class="form-group">
                <label for="inputAddress">Địa chỉ</label>
                <input type="text"  name="address" required  class="form-control" id="address-create" placeholder="Số nhà, khu, thôn">
                <div class="dis-none alert m-t-5 alert-danger" id="error-create-address">
                </div>
             </div>
            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Thoát</button>
          <button type="button" class="btn btn-primary" onclick="storeProfile(this)">Lưu</button>
        </div>
      </div>
    </div>
  </div>