@extends('frontend.layouts.master') @section('title','Checkout page') @section('main-content')

<!-- Breadcrumbs -->

<!-- End Breadcrumbs -->

<!-- Start Checkout -->
<section class="shop checkout section">
    <div class="container">
            <div class="row">
                <div class="col-lg-8 col-12">
                    <div class="wizard-v4-content">
                        <div class="wizard-form">
                            <div class="wizard-header">
                                <h3 class="heading">Thanh toán</h3>
                                @php $weight=Helper::cart()['weight']; @endphp
                                <input id="weight" type="text" value="{{ $weight }}" />
                            </div>
                            <form class="form-register">
                                <div id="form-total">
                                    <!-- SECTION 1 -->
                                    <h2>
                                        <span class="step-icon"><i class="zmdi zmdi-account"></i></span>
                                    </h2>
                                    <section>
                                        <div class="inner">
                                            <div class="card">
                                                <div class="card-header" style="background: #fff">
                                                    <h4 class="m-0 font-weight-bold text-primary float-left"> Địa chỉ</h4>
                                                    {{-- <button class="btn btn-primary float-right" data-toggle="modal" data-target="#modal" data-placement="bottom" title="Add User" style="padding: 10px 20px;background:#007BFF">Thêm địa chỉ mới</button> --}}
                                                    <a href="{{ route('user.address.index') }}" target="_bank" class="btn btn-primary float-right" style="padding: 10px 20px; margin-right:15px;background:#007BFF;color:#fff">Thiết lập địa chỉ</a>

                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    @foreach ($profiles as $item)
                                                    @php
                                                        $province=explode(',', $item->province);
                                                        $district=explode(',', $item->district);
                                                        $ward=explode(',', $item->ward);
                                                        $address=$item->address.", ". $ward[1].", ".$district[1].", ".$province[1];
                                                    @endphp
    
                                                    @if ($item->default==1)
                                                    <div class="form-group">
                                                        <input onchange="changeAddress()" type="radio" data-id="{{ $item->id }}" value="{{ $item->id }}" class="checkbox_address" checked name="address" id="address_{{ $item->id }}" />
                                                        
                                                        <label for="address_{{ $item->id }}">{{ $item->name}},{{ $item->phone }} ,{{ $address }} </label>
                                                    </div>
                                                    <input type="hidden" id="name_receiver_{{ $item->id }}" value="{{ $item->name }}">
                                                        <input type="hidden" id="phone_receiver_{{ $item->id }}" value="{{ $item->phone }}">
                                                        <input type="hidden" id="address_receiver_{{ $item->id }}" value="{{ $address }}">
                                                        <input type="hidden" id="province_receiver_{{ $item->id }}" data-name="{{ $province[1] }}" value="{{ $province[0] }}">
                                                        <input type="hidden" id="district_receiver_{{ $item->id }}" data-name="{{ $district[1] }}" value="{{ $district[0] }}">
                                                        <input type="hidden" id="ward_receiver_{{ $item->id }}" data-name="{{ $ward[1] }}" value="{{ $ward[0] }}">
                                                        <input type="hidden" id="region_receiver_{{ $item->id }}" value="{{ $item->region }}">
                                                        <input type="hidden" id="urban_receiver_{{ $item->id }}" value="{{ $item->urban }}">
                                                    @else
                                                    <div class="form-group">
                                                        <input onchange="changeAddress()" type="radio" data-id="{{ $item->id }}" value="{{ $item->id }}" class="checkbox_address" name="address" id="address_{{ $item->id }}" />
                                                        
                                                        <label for="address_{{ $item->id }}">{{ $item->name}},{{ $item->phone }} ,{{ $address }} </label>
                                                    </div>
                                                    <input type="hidden" id="name_receiver_{{ $item->id }}" value="{{ $item->name }}">
                                                        <input type="hidden" id="phone_receiver_{{ $item->id }}" value="{{ $item->phone }}">
                                                        <input type="hidden" id="address_receiver_{{ $item->id }}" value="{{ $address }}">
                                                        <input type="hidden" id="province_receiver_{{ $item->id }}" data-name="{{ $province[1] }}" value="{{ $province[0] }}">
                                                        <input type="hidden" id="district_receiver_{{ $item->id }}" data-name="{{ $district[1] }}" value="{{ $district[0] }}">
                                                        <input type="hidden" id="ward_receiver_{{ $item->id }}" data-name="{{ $ward[1] }}" value="{{ $ward[0] }}">
                                                        <input type="hidden" id="region_receiver_{{ $item->id }}" value="{{ $item->region }}">
                                                        <input type="hidden" id="urban_receiver_{{ $item->id }}" value="{{ $item->urban }}">
                                                    @endif
                                                    @endforeach
                                                </div>
                                                <div class="form-group">
                                                    <input type="checkbox" name="giveFriend" id="giveFriend" />
                                                    <label for="giveFriend">Gửi tặng người thân, bạn bè</label>
                                                </div>
                                                
                                            </div>
                                         </div>
                                    </section>
                                    <!-- SECTION 2 -->

                                    <h2>
                                        <span class="step-icon"><i class="zmdi zmdi-receipt"></i></span>
                                    </h2>
                                    <section>
                                        <div class="inner">
                                            <h3>Hình thức giao hàng</h3>
                                            <section class="cards" id="card-shipping"></section>
                                        </div>
                                    </section>
                                    <!-- SECTION 4 -->
                                    <h2>
                                        <span class="step-icon"><i class="zmdi zmdi-money"></i></span>
                                    </h2>
                                    <section>
                                        <div class="inner">
                                            <h3>Phương thức thanh toán</h3>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <input type="radio" value="Online" class="payment" name="payment" id="checkbox_online" />
                                                            <label for="checkbox_online">Thanh toán online</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <input type="radio" class="payment" value="Tiền mặt" checked name="payment" id="checkbox_cash" />
                                                            <label for="checkbox_cash">Thanh toán tiền mặt</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                    <img src="{{('backend/img/payment-method.png')}}" alt="#" />
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="order-details">
                        <div class="single-widget">
                            <h2>Thông tin khách hàng</h2>
                                <div class="card-body">
                                    <p class="card-text" id="name_final"></p>
                                    <p class="card-text" id="address_final"></p>
                                  </div>
                        </div>
                    </div>
                    <div class="order-details">
                        <!-- Order Widget -->
                        <!--/ End Order Widget -->
                        <!-- Order Widget -->
                        <div class="single-widget">
                            <h2>Thông tin đơn hàng</h2>
                            <div class="card-body">
                                <table class="table">
                                      <tr>
                                        <th >Tạm tính</th>
                                        <td id="cart_sub_price">{{number_format(Helper::cart()['sub_price'])}} vnđ</td>
                                      </tr>
                                      @if (Helper::cart()['coupon']!=0)
                                        <tr>
                                            <th >Giảm giá</th>
                                            <td id="cart_coupon">{{number_format(Helper::cart()['coupon'])}} %</td>
                                        </tr>
                                    @endif

                                        <tr class="tr-shipping">
                                            <th >Phí vận chuyển</th>
                                            <td id="cart_fee_ship">{{number_format(Helper::cart()['fee_ship'])}} vnđ</td>
                                        </tr>
                                      
                                      
                                      <tr>
                                        <th >Tổng cộng</th>
                                        <input type="hidden" id="total_price" value="{{ Helper::cart()['total_price'] }}">
                                        <td id="cart_total_price">{{number_format(Helper::cart()['total_price'])}} vnđ</td>
                                      </tr>
                                      <tr>
                                          
                                        <th colspan="2" id="nameMoney"></th>
                                      </tr>
                                  </table>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
    </div>
</section>
<!--/ End Checkout -->

<!-- Start Shop Services Area  -->
<section class="shop-services section home">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-12">
                <!-- Start Single Service -->
                <div class="single-service">
                    <i class="ti-rocket"></i>
                    <h4>Free shiping</h4>
                    <p>Orders over $100</p>
                </div>
                <!-- End Single Service -->
            </div>
            <div class="col-lg-3 col-md-6 col-12">
                <!-- Start Single Service -->
                <div class="single-service">
                    <i class="ti-reload"></i>
                    <h4>Free Return</h4>
                    <p>Within 30 days returns</p>
                </div>
                <!-- End Single Service -->
            </div>
            <div class="col-lg-3 col-md-6 col-12">
                <!-- Start Single Service -->
                <div class="single-service">
                    <i class="ti-lock"></i>
                    <h4>Sucure Payment</h4>
                    <p>100% secure payment</p>
                </div>
                <!-- End Single Service -->
            </div>
            <div class="col-lg-3 col-md-6 col-12">
                <!-- Start Single Service -->
                <div class="single-service">
                    <i class="ti-tag"></i>
                    <h4>Best Peice</h4>
                    <p>Guaranteed price</p>
                </div>
                <!-- End Single Service -->
            </div>
        </div>
    </div>
</section>
<!-- End Shop Services -->

<!-- Start Shop Newsletter  -->
<section class="shop-newsletter section">
    <div class="container">
        <div class="inner-top">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 col-12">
                    <!-- Start Newsletter Inner -->
                    <div class="inner">
                        <h4>Newsletter</h4>
                        <p>Subscribe to our newsletter and get <span>10%</span> off your first purchase</p>
                        <form action="mail/mail.php" method="get" target="_blank" class="newsletter-inner">
                            <input name="EMAIL" placeholder="Your email address" required="" type="email" />
                            <button class="btn">Subscribe</button>
                        </form>
                    </div>
                    <!-- End Newsletter Inner -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Shop Newsletter -->
@endsection @push('styles')
<link rel="stylesheet" href="{{ asset('frontend/css/step.css') }}">
    <style>
        input[type="radio"] + label {
            display: block;
            margin: 0.2em;
            cursor: pointer;
            padding: 0.2em;
        }

        input[type="radio"] {
            display: none;
        }

        input[type="radio"] + label:before {
            content: "\2714";
            border: 0.1em solid #189eff;
            border-radius: 0.2em;
            display: inline-block;
            width: 2em;
            height: 2em;
            padding-left: 0.5em;
            padding-bottom: 0.3em;
            margin-right: 0.2em;
            vertical-align: bottom;
            color: transparent;
            transition: 0.2s;
        }

        input[type="radio"] + label:active:before {
            transform: scale(0);
        }

        input[type="radio"]:checked + label:before {
            background: linear-gradient(69deg, rgba(3, 70, 148, 1) 0%, rgba(24, 158, 255, 1) 58%, rgba(24, 158, 255, 1) 100%);

            color: #fff;
        }

        input[type="radio"]:disabled + label:before {
            transform: scale(1);
            border-color: #aaa;
        }

        input[type="radio"]:checked:disabled + label:before {
            transform: scale(1);
            background-color: #bfb;
            border-color: #bfb;
        }
    </style>
    <style>
        input[type="checkbox"] + label {
            display: block;
            margin: 0.2em;
            cursor: pointer;
            padding: 0.2em;
        }

        input[type="checkbox"] {
            display: none;
        }

        input[type="checkbox"] + label:before {
            content: "\2714";
            border: 0.1em solid #189eff;
            border-radius: 0.2em;
            display: inline-block;
            width: 2em;
            height: 2em;
            padding-left: 0.5em;
            padding-bottom: 0.3em;
            margin-right: 0.2em;
            vertical-align: bottom;
            color: transparent;
            transition: 0.2s;
        }

        input[type="checkbox"] + label:active:before {
            transform: scale(0);
        }

        input[type="checkbox"]:checked + label:before {
            background: linear-gradient(69deg, rgba(3, 70, 148, 1) 0%, rgba(24, 158, 255, 1) 58%, rgba(24, 158, 255, 1) 100%);

            color: #fff;
        }

        input[type="checkbox"]:disabled + label:before {
            transform: scale(1);
            border-color: #aaa;
        }

        input[type="checkbox"]:checked:disabled + label:before {
            transform: scale(1);
            background-color: #bfb;
            border-color: #bfb;
        }
    </style>
    <style>
            #card-shipping {
                display: flex;
                flex-flow: row wrap;
        }
            #card-shipping > div {
                flex: 1;
                padding: 0.5rem;
        }
            #card-shipping input[type="radio"] {
                display: none;
        }
            #card-shipping input[type="radio"]:not(:disabled) ~ label {
                cursor: pointer;
        }
            #card-shipping input[type="radio"]:disabled ~ label {
                color: rgba(188, 194, 191, 1);
                border-color: rgba(188, 194, 191, 1);
                box-shadow: none;
                cursor: not-allowed;
        }
            #card-shipping label {
                height: 100%;
                display: block;
                background: white;
                border: 2px solid #333;
                border-radius: 20px;
                padding: 1rem;
                padding-top: 2rem
                margin-bottom: 1rem;
                box-shadow: 0px 3px 10px -2px rgba(161, 170, 166, 0.5);
                position: relative;
        }
            #card-shipping input[type="radio"]:checked + label {
                background:#fff;
                box-shadow: 10px 26px 24px 1px rgba(24,158,255,0.25);
                border: 2px solid rgba(24,158,255,0.54);
        }
            {{--  #card-shipping input[type="radio"]:checked + label::after {
                color:#189EFF;
                font-family: FontAwesome;
                border: 2px solid #189EFF;
                content: "\f00c";
                font-size: 24px;
                position: absolute;
                top: -25px;
                left: 50%;
                transform: translateX(-50%);
                height: 50px;
                width: 50px;
                line-height: 50px;
                text-align: center;
                border-radius: 50%;
                background: white;
                box-shadow: 0px 2px 5px -2px rgba(0, 0, 0, 0.25);
        }  --}}
            {{--  #card-shipping input[type="radio"]#control_05:checked + label {
                background: red;
                border-color: red;
        }  --}}
            #card-shipping p {
                font-weight: 900;
        }
            @media only screen and (max-width: 700px) {
                #card-shipping {
                    flex-direction: column;
            }
        }
    </style>

    
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" integrity="sha512-aOG0c6nPNzGk+5zjwyJaoRUgCdOrfSDhmMID2u4+OIslr0GjpLKo7Xm0Ao3xmpM4T8AmIouRkqwj1nrdVsLKEQ==" crossorigin="anonymous" />

<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css"
    integrity="sha512-rRQtF4V2wtAvXsou4iUAs2kXHi3Lj9NE7xJR77DE7GHsxgY9RTWy93dzMXgDIG8ToiRTD45VsDNdTiUagOFeZA=="
    crossorigin="anonymous"
/>
<link rel="stylesheet" href="{{ asset('frontend/css/step.css') }}" />
@endpush @push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
{{--  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous"></script>  --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.1/moment-with-locales.min.js" integrity="sha512-lQR9pLx+zmyQV/T99+vuBITpGAYXR+nMAZXVjtdEgnC3jodfmtjhRTuAnQ7jHjlWgUL0KE+SORFWdWEp1BYLFw==" crossorigin="anonymous"></script>
{{--  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>  --}}
{{--  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>  --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" integrity="sha512-uto9mlQzrs59VwILcLiRYeLKPPbS/bT71da/OEBYEwcdNUk8jYIy+D176RYoop1Da+f9mvkYrmj5MCLZWEtQuA==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-steps/1.1.0/jquery.steps.min.js" integrity="sha512-bE0ncA3DKWmKaF3w5hQjCq7ErHFiPdH2IGjXRyXXZSOokbimtUuufhgeDPeQPs51AI4XsqDZUK7qvrPZ5xboZg==" crossorigin="anonymous"></script>
{{--
<script src="{{asset('frontend/js/progress.js')}}"></script>
--}}

<script>
    {{--  $(document).ready(function () {
        $(".shipping select[name=shipping]").change(function () {
            let cost = parseFloat($(this).find("option:selected").data("price")) || 0;
            let subtotal = parseFloat($(".order_subtotal").data("price"));
            let coupon = parseFloat($(".coupon_price").data("price")) || 0;
            // alert(coupon);
            $("#order_total_price span").text("$" + (subtotal + cost - coupon).toFixed(2));
        });
    });  --}}
</script>

@endpush
