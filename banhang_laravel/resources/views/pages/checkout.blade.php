@extends('layouts.app')
@section('content')

        <div class="single-product-area">
            <div class="zigzag-bottom"></div>
            <div class="container">
                <?php
                $content = Cart::content();
                ?>
                <form method="POST">
                    @csrf
                    @if(Session::has('total_coupon'))
                        @foreach(Session::get('coupon') as $key => $cou)
                            <input type="hidden" class="order_coupon" name="order_coupon" value="{{$cou['coupon_code']}}">
                        @endforeach
                    @else
                        <input type="hidden" class="order_coupon" name="order_coupon" value="0">
                    @endif
                    @if(Session::has('fee'))
                        <input type="hidden" class="order_fee" name="order_fee" value="{{Session::get('fee')}}">
                    @else
                        <input type="hidden" class="order_fee" name="order_fee" value="30000">
                    @endif
                    <div class="row">
                        <div class="col-md-6">
                            @if(session('customer_id'))
                                <div class="flex">
                                    <h2 class="header-checkout">Thông tin nhận hàng</h2>

                                </div>
                                <div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Email</label>
                                        <input value="{{session('customer_email')}}" type="email" name="shipping_email" class="form-control shipping_email" id="exampleInputEmail1" aria-describedby="emailHelp" readonly>
                                        <div id="emailHelp" class="form-text"></div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Họ và tên</label>
                                        <input value="{{session('customer_name')}}" type="text" name="shipping_name" class="form-control shipping_name" id="exampleInputEmail1" aria-describedby="emailHelp" readonly>
                                        <div id="emailHelp" class="form-text"></div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Số điện thoại</label>
                                        <input value="{{session('customer_phone')}}" type="text" name="shipping_phone" class="form-control shipping_phone" id="exampleInputEmail1" aria-describedby="emailHelp" readonly>
                                        <div id="emailHelp" class="form-text"></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Thành phố</label>
                                        <select class="form-control m-bot15 city choose" name="city" id="city">
                                            <option disabled selected >----Chọn tỉnh thành phố----</option>
                                            @foreach($city as $key => $cit)
                                                <option value="{{$cit->matp}}">{{$cit->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Quận</label>
                                        <select class="form-control m-bot15 province choose" name="province" id="province">
                                            <option disabled selected >----Chọn quận huyện----</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Phường</label>
                                        <select class="form-control m-bot15 wards" name="wards" id="wards">
                                            <option disabled selected >----Chọn xã phường----</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Địa chỉ</label>
                                        <input value="{{session('customer_address')}}" type="text" name="shipping_address" class="form-control shipping_address" id="exampleInputEmail1" aria-describedby="emailHelp">
                                        <div id="emailHelp" class="form-text"></div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Ghi chú</label>
                                        <textarea style="resize: vertical"  class="form-control shipping_note" name="shipping_note" id="" cols="10" rows="5"></textarea>
                                        <div id="emailHelp" class="form-text"></div>
                                    </div>
                                    <div class="mb-3">
                                        <input type="button" value="Xác nhận đơn hàng" name="send_order" class="checkout-button button alt wc-forward send_order form-control">
                                    </div>
                                </div>
                            @else

                            <div class="flex">
                                <h2 class="header-checkout">Thông tin nhận hàng</h2>
                                <a class="header-checkout-login" href="{{route('login')}}"><i class="fa fa-user" style="margin-right: 5px"></i>Đăng nhập</a>
                            </div>
                            @if ($errors->any())
                                <div class="alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div>

                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Email</label>
                                    <input type="email" name="shipping_email" class="form-control shipping_email" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    <div id="emailHelp" class="form-text"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Họ và tên</label>
                                    <input type="text" name="shipping_name" class="form-control shipping_name" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    <div id="emailHelp" class="form-text"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Số điện thoại</label>
                                    <input type="text" name="shipping_phone" class="form-control shipping_phone" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    <div id="emailHelp" class="form-text"></div>
                                </div>
                                <form >
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Thành phố</label>
                                        <select class="form-control m-bot15 city choose" name="city" id="city">
                                            <option disabled selected >----Chọn tỉnh thành phố----</option>
                                            @foreach($city as $key => $cit)
                                                <option value="{{$cit->matp}}">{{$cit->city_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Quận</label>
                                        <select class="form-control m-bot15 province choose" name="province" id="province">
                                            <option disabled selected >----Chọn quận huyện----</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Phường</label>
                                        <select class="form-control m-bot15 wards cal_feeship" name="wards" id="wards">
                                            <option disabled selected >----Chọn xã phường----</option>
                                        </select>
                                    </div>
                                </form>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Địa chỉ</label>
                                    <input type="text" name="shipping_address" class="form-control shipping_address" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    <div id="emailHelp" class="form-text"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Ghi chú</label>
                                    <textarea style="resize: vertical"  class="form-control shipping_note" name="shipping_note" id="" cols="10" rows="5"></textarea>
                                    <div id="emailHelp" class="form-text"></div>
                                </div>
                                <div class="mb-3">
                                    <input type="button" value="Xác nhận đơn hàng" name="send_order" class="checkout-button button alt wc-forward send_order form-control">
                                </div>
                            </div>

                            @endif


                        </div>

                        <div class="col-md-6">
                            <div class="">
                                <h2 class="header-checkout">Vận chuyển</h2>
                                <div class="alert-info">Vui lòng nhập thông tin giao hàng</div>
                            </div>

                            <div class="zigzag-bottom" style="margin-bottom: 40px"></div>

                            <div id="payment">
                                <h2 class="header-checkout">Thanh toán</h2>
                                <ul class="payment_methods methods">
{{--                                    <li class="payment_method_bacs">--}}
{{--                                        <input type="radio" data-order_button_text="" checked="checked" value="1" name="payment_method" class="input-radio payment_method" id="payment_method_bacs">--}}
{{--                                        <label for="payment_method_bacs">Trả bằng thẻ ATM </label>--}}
{{--                                        <div class="payment_box payment_method_bacs">--}}
{{--                                            <p>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>--}}
{{--                                        </div>--}}
{{--                                    </li>--}}
                                    <li class="payment_method_cheque">
                                        <input type="radio" data-order_button_text="" value="0" name="payment_method" class="input-radio payment_method" id="payment_method_cheque">
                                        <label for="payment_method_cheque">Nhận tiền mặt</label>
                                        <div style="display:none;" class="payment_box payment_method_cheque">
                                            <p>Please send your cheque to Store Name, Store Street, Store Town, Store State / County, Store Postcode.</p>
                                        </div>
                                    </li>

                                </ul>


                                <div class="clear"></div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="row">
                        @if(Session::get('cart')>0)
                            <div class="col-md-9">
                                @if(session('message'))
                                    <div class="alert">
                                        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                                        <strong>{{session('message')}}</strong>
                                    </div>
                                @elseif(session('message2'))
                                    <div class="alert-success">
                                        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                                        <strong>{{session('message2')}}</strong>
                                    </div>

                                @endif

                                <div class="col-md-12">
                                    @php
                                        $quantity = 0;
                                    @endphp
                                    <div class="product-content-right">
                                        @foreach(Session::get('cart') as $qty => $car)
                                            @php
                                                $quantity += $car['product_qty'];
                                            @endphp
                                        @endforeach
                                        <h2 style="text-transform: uppercase">Giỏ hàng<span style="font-weight: 400; text-transform: none; margin-left: 10px; font-size: 17px">({{$quantity}} sản phẩm)</span></h2>

                                        <div class="woocommerce">

                                            <table cellspacing="0" class="shop_table cart">

                                                <thead>
                                                <tr>
                                                    <th class="product-remove">&nbsp;</th>
                                                    <th class="product-thumbnail">Hình ảnh</th>
                                                    <th class="product-name">Tên</th>
                                                    <th class="product-price">Giá</th>
                                                    <th class="product-quantity">Số lượng</th>
                                                    <th class="product-subtotal">Tổng</th>
                                                </tr>
                                                </thead>
                                                <form method="POST" action="{{route('update.cart')}}">
                                                    @csrf
                                                    <tbody>

                                                    @php
                                                        $total = 0;
                                                    @endphp
                                                    @foreach(Session::get('cart') as $key => $cart)
                                                        @php

                                                            $subtotal = $cart['product_price']*$cart['product_qty'];
                                                            $total += $subtotal;
                                                        @endphp

                                                        <tr class="cart_item">
                                                            <td class="product-remove">
                                                                <a title="Xóa sản phẩm" class="remove" href="{{route('delete.product',$cart['session_id'])}}">×</a>
                                                            </td>

                                                            <td class="product-thumbnail">
                                                                <img width="145" height="145" alt="poster_1_up" class="shop_thumbnail" src="{{asset('uploads/product/'.$cart['product_image'])}}">
                                                            </td>

                                                            <td class="product-name">
                                                                <span style="font-size: 14px">{{$cart['product_name']}}</span>
                                                            </td>

                                                            <td class="product-price">
                                                                <span class="amount">{{number_format($cart['product_price'])}} VNĐ</span>
                                                            </td>

                                                            <td class="product-quantity">
                                                                <div class="quantity buttons_added">
                                                                    <input type="number" size="4" class="input-text qty text" disabled title="Số lượng" value="{{$cart['product_qty']}}" min="1" step="1" name="cart_qty[{{$cart['session_id']}}]">
                                                                </div>
                                                            </td>

                                                            <td class="product-subtotal">
                                                    <span class="amount">
                                                        {{number_format($cart['product_price']*$cart['product_qty'])}} VNĐ
                                                    </span>
                                                            </td>

                                                        </tr>
                                                    @endforeach
{{--                                                    <tr>--}}
{{--                                                        <td class="actions" colspan="6">--}}
{{--                                                            --}}{{--                                                    <span class="amount" style="font-size: 25px;line-height: 60px;">--}}
{{--                                                            --}}{{--                                                        Tạm tính: {{number_format($total)}} VNĐ--}}
{{--                                                            --}}{{--                                                    </span>--}}

{{--                                                            <a href="{{route('checkout')}}"><input type="button" style="margin: 10px;background: none repeat scroll 0 0 #5a88ca;border: medium none;color: #fff;padding: 11px 20px;text-transform: uppercase;" value="Thanh toán ngay" name="proceed" class="checkout-button button alt wc-forward"></a>--}}
{{--                                                            <input style="margin: 10px" type="submit" value="Cập nhật giỏ hàng" name="update_qty" class="checkout-button button alt wc-forward">--}}

{{--                                                            <a href="{{route('all_product')}}"><input type="button" style="margin: 10px;background: none repeat scroll 0 0 #5a88ca;border: medium none;color: #fff;padding: 11px 20px;text-transform: uppercase;" value="Tiếp tục mua hàng" name="proceed" class="checkout-button button alt wc-forward"></a>--}}
{{--                                                        </td>--}}
{{--                                                    </tr>--}}
                                                    </tbody>
                                                </form>
                                            </table>

                                        </div>
                                    </div>
                                </div>


                            </div>
                            <div class="col-md-3">
                                <div class="cart_totals " style="margin-bottom:20px">
                                    <h2>Thanh toán</h2>
                                    <table cellspacing="0">
                                        <tbody>
                                        <tr class="cart-subtotal">
                                            <th>Tạm tính</th>

                                            <td><span class="amount">{{number_format($total)}} VNĐ</span></td>
                                        </tr>

                                        <tr class="shipping">
                                            <th >Phí vận chuyển</th>
                                            @if(Session::has('fee'))
                                                @php
                                                    $feeship_delivery = Session::get('fee');
                                                @endphp
                                                <td class="fee">{{number_format($feeship_delivery)}} VNĐ</td>
                                            @else
                                                <td class="fee">{{number_format(30000)}} VNĐ</td>
                                            @endif
                                        </tr>

                                        <tr class="shipping">
                                            <th>Giảm giá:</th>
                                            @if(Session::has('coupon'))
                                                @php
                                                    $total_coupon = Session::get('total_coupon');
                                                @endphp
                                                <td class="dis">{{number_format($total_coupon)}} VNĐ</td>
                                            @else
                                            <td class="dis">0</td>
                                            @endif
                                        </tr>
                                        <tr class="order-total">
                                            <?php
                                                $total_coupon = Session::get('total_coupon');
                                                $feeship_delivery = Session::get('fee');
                                                $tong = $total - $total_coupon + $feeship_delivery;

//                                                if ($feeship_delivery){
//                                                    $tong = $total - $total_coupon + $feeship_delivery;
//                                                }else {
//                                                    $tong = $total - $total_coupon + 30000;
//                                                }


                                            ?>
                                            <th>Tổng cộng</th>
                                            <td><strong><span class="amount">{{number_format($tong)}} VNĐ</span></strong> </td>
                                        </tr>

                                        {{--                            {{number_format($sub_total)}}--}}
                                        </tbody>
                                    </table>
                                </div>
                                <div>
                                    <form>
                                        @csrf
                                        <input style="width: 150px; margin-top: 10px" type="text" placeholder="Nhập mã giảm giá..." value="" id="coupon_code" class="input-text coupon_code" name="coupon_code">
                                        <input type="button" value="Áp dụng" name="apply_coupon" class="checkout-button button alt wc-forward apply_coupon">
                                    </form>


                                </div>

                            </div>

                        @endif
                    </div>

            </div>
        </div>
@endsection
