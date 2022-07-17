@extends('layouts.app')
@section('content')
    <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                @if(Session::get('cart')>0)
                <div class="col-md-11">
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
                                                            <input type="number" size="4" class="input-text qty text" title="Số lượng" value="{{$cart['product_qty']}}" min="1" step="1" name="cart_qty[{{$cart['session_id']}}]">
                                                        </div>
                                                    </td>

                                                    <td class="product-subtotal">
                                                    <span class="amount">
                                                        {{number_format($cart['product_price']*$cart['product_qty'])}} VNĐ
                                                    </span>
                                                    </td>

                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td class="actions" colspan="6">
                                                    <span class="amount" style="font-size: 25px;line-height: 60px;">
                                                        Tạm tính: {{number_format($total)}} VNĐ
                                                    </span>

                                                    <a href="{{route('checkout')}}"><input type="button" style="margin: 10px;background: none repeat scroll 0 0 #5a88ca;border: medium none;color: #fff;padding: 11px 20px;text-transform: uppercase;" value="Thanh toán ngay" name="proceed" class="checkout-button button alt wc-forward"></a>
                                                    <input style="margin: 10px" type="submit" value="Cập nhật giỏ hàng" name="update_qty" class="checkout-button button alt wc-forward">

                                                    <a href="{{route('all_product')}}"><input type="button" style="margin: 10px;background: none repeat scroll 0 0 #5a88ca;border: medium none;color: #fff;padding: 11px 20px;text-transform: uppercase;" value="Tiếp tục mua hàng" name="proceed" class="checkout-button button alt wc-forward"></a>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </form>
                                    </table>

                                </div>
                            </div>
                        </div>


                </div>
{{--                <div class="col-md-3">--}}
{{--                    <div class="cart_totals " style="margin-bottom:20px">--}}
{{--                        <h2>Thanh toán</h2>--}}
{{--                        <table cellspacing="0">--}}
{{--                            <tbody>--}}
{{--                            <tr class="cart-subtotal">--}}
{{--                                <th>Tạm tính</th>--}}
{{--                                <td><span class="amount">{{number_format($total)}} VNĐ</span></td>--}}
{{--                            </tr>--}}

{{--                            <tr class="shipping">--}}
{{--                                <th>Phí vận chuyển</th>--}}
{{--                                <td>-</td>--}}
{{--                            </tr>--}}


{{--                                @if(Session::get('coupon'))--}}
{{--                                    @foreach(Session::get('coupon') as $key => $coup)--}}
{{--                                        @if($coup['coupon_condition']==1)--}}
{{--                                            @php--}}
{{--                                                $total_coupon = ($total * $coup['coupon_number'])/100;--}}
{{--                                                $sub_total = $total - $total_coupon;--}}
{{--                                            @endphp--}}
{{--                                        <tr class="shipping">--}}
{{--                                            <th>Giảm giá:</th>--}}
{{--                                            <td>{{number_format($total_coupon)}} VNĐ</td>--}}
{{--                                        </tr>--}}
{{--                                        <tr class="order-total">--}}
{{--                                            <th>Tổng cộng</th>--}}
{{--                                            <td><strong><span class="amount">{{number_format($sub_total)}} VNĐ</span></strong> </td>--}}
{{--                                        </tr>--}}
{{--                                        @else--}}
{{--                                            @php--}}
{{--                                                $sub_total = $total - $coup['coupon_number'];--}}
{{--                                            @endphp--}}
{{--                                        <tr class="shipping">--}}
{{--                                            <th>Giảm giá:</th>--}}
{{--                                            <td>{{number_format($coup['coupon_number'])}} VNĐ</td>--}}
{{--                                        </tr>--}}
{{--                                        <tr class="order-total">--}}
{{--                                            <th>Tổng cộng</th>--}}
{{--                                            <td><strong><span class="amount">{{number_format($sub_total)}} VNĐ</span></strong> </td>--}}
{{--                                        </tr>--}}
{{--                                        @endif--}}
{{--                                    @endforeach--}}
{{--                                    @else--}}
{{--                                        <tr class="shipping">--}}
{{--                                            <th>Giảm giá:</th>--}}
{{--                                            <td>0</td>--}}
{{--                                        </tr>--}}
{{--                                        <tr class="order-total">--}}
{{--                                            <th>Tổng cộng</th>--}}
{{--                                            <td><strong><span class="amount">{{number_format($total)}} VNĐ</span></strong> </td>--}}
{{--                                        </tr>--}}
{{--                                    @endif--}}


{{--                            {{number_format($sub_total)}}--}}
{{--                            </tbody>--}}
{{--                        </table>--}}
{{--                    </div>--}}
{{--                    <div>--}}
{{--                        <form>--}}
{{--                            @csrf--}}
{{--                            <input style="width: 150px; margin-top: 10px" type="text" placeholder="Nhập mã giảm giá..." value="" id="coupon_code" class="input-text coupon_code" name="coupon_code">--}}
{{--                            <input type="button" value="Áp dụng" name="apply_coupon" class="checkout-button button alt wc-forward apply_coupon">--}}
{{--                        </form>--}}


{{--                    </div>--}}

{{--                </div>--}}
                @else
                    <div class="col-md-12">
                        <div class="product-content-right">
                            <h2 style="text-transform: uppercase">Giỏ hàng<span style="font-weight: 400; text-transform: none; margin-left: 10px; font-size: 17px">({{Cart::count()}} sản phẩm)</span></h2>
                            <div class="cart-empty">
                                <img alt="poster_1_up" class="center-block" src="{{asset('pages/img/empty-cart.png')}}">
                                <div class="btn-cart-empty center-block" style="width: 200px">
                                    <a href="{{route('all_product')}}"><input type="submit" value="Tiếp tục mua hàng" name="proceed" class="checkout-button button alt wc-forward"></a>
                                </div>
                            </div>


                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
