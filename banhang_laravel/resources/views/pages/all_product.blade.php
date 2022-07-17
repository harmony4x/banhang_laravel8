@extends('layouts.app')
@section('content')
    <style>
        #product_quickview_title{
            text-align: center;
            font-size: 25px;
            color: brown;
        }
        p.quickview{
            font-size: 14px;
            color: brown;
        }
        span#product_quickview_content{
            width: 100%;
        }
        .cart_product_qty_ {
            width: 40px;
        }

        .modal-header .close {
            margin-top: -30px !important;
        }
        .add-to-cart-quickview {
            background: none repeat scroll 0 0 #5a88ca;
            border: medium none;
            color: #fff;
            padding: 6px;
        }


        @media screen and (min-width: 768px) {
            .modal-dialog{
                width: 700px;
            }
            .modal-sm{
                width: 350px;
            }
        }

        @media screen and (min-width: 992px) {
            .modal-lg {
                width: 1200px;
            }
        }
    </style>
    <div class="product-big-title-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        <h2>Tất cả sản phẩm</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="product-breadcroumb">
                    <a href="{{url('/')}}">Trang chủ</a>
                    <a class="active" href="">Tất cả sản phẩm</a>

                </div>
                @foreach($products as $key => $product)
                    <div class="col-md-3 col-sm-6">
                        <form>
                            @csrf
                            <input type="hidden" value="{{$product->id}}" class="cart_product_id_{{$product->id}}">
                            <input type="hidden" value="{{$product->name}}" class="cart_product_name_{{$product->id}}">
                            <input type="hidden" value="{{$product->image}}" class="cart_product_image_{{$product->id}}">
                            <input type="hidden" value="{{($product->price - ($product->price*$product->discount/100))}}" class="cart_product_price_{{$product->id}}">
                            <input type="hidden" value="1" class="cart_product_qty_{{$product->id}}">

                            <div class="single-shop-product">
                                <div class="product-upper">
                                    <img src="{{asset('uploads/product/'.$product->image)}}" alt="">
                                </div>
                                <h2><a href="{{route('detail',$product->slug)}}">{{$product->name}}</a></h2>
                                <div class="product-carousel-price">
                                    <ins>{{number_format($product->price - ($product->price*$product->discount/100))}} VNĐ</ins> <del>{{number_format($product->price)}} VNĐ</del>
                                </div>

                                <div class="product-option-shop">
                                    {{--                            <a class="add_to_cart_button" data-quantity="1" data-product_sku="" data-product_id="70" rel="nofollow" href="/canvas/shop/?add-to-cart=70">Add to cart</a>--}}
                                    <button type="button" class="btn btn-default add_to_cart_button add-to-cart" data-id_product="{{$product->id}}" name="add-to-cart">Thêm giỏ hàng</button>
                                    <button type="button" data-toggle="modal" data-target="#xemnhanh" class="btn btn-default xemnhanh" data-id_product="{{$product->id}}" name="xemnhanh">Xem nhanh</button>
                                </div>
                            </div>
                        </form>
                    </div>
                @endforeach
            </div>
            <!-- Modal -->
            <div class="modal fade" id="xemnhanh" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="product_quickview_title">
                                <span id="product_quickview_title"></span>
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-5">
                                    <span id="product_quickview_image"></span>
                                    <span id="product_quickview_gallery"></span>
                                </div>
                                <form >
                                    <div class="col-md-7">
                                        @csrf
                                        <div id="product_quickview_value"></div>
                                        <h2 class="quickview"><span id="product_quickview_title"></span></h2>
                                        <p>Mã ID: <span id="product_quickview_id"></span></p>

                                        <span >
                                            <h4 style="color: #FE980F">Giá sản phẩm <span id="product_quickview_price"></span></h4>
                                            <br>
                                            <label >Số lượng: </label>
                                            <input type="number"  name="qty" min="1" class="cart_product_qty_" value="1" disabled>
                                            <button id="buy_quickview" class="add-to-cart-quickview" data-id_product="" name="add-to-cart-quickview" type="button">Thêm vào giỏ hàng</button>
                                            <div id="beforesend_quickview"></div>
                                        </span><br><br>
                                        <p>Danh mục: <span id="product_quickview_category_name"></span></p>
                                        <p class="quickview" >
                                        <h3>Mô tả sản phẩm</h3>
                                        <hr>
                                        <span id="product_quickview_content" style="color: #FE980F"></span>
                                        </p>
                                    </div>
                                </form>
                                <div class="col-md-12">

                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                            <button type="button" class="btn btn-primary">Giỏ hàng</button>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>
@endsection
