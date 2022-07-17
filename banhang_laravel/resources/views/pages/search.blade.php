@extends('layouts.app')
@section('content')
    <div class="product-big-title-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        <h2>Tìm kiếm</h2>
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
                    <a class="active" href="">Tìm kiếm</a>

                </div>
                @foreach($products as $key => $product)
                    <div class="col-md-3 col-sm-6">
                        <form>
                            @csrf
                            <input type="hidden" value="{{$product->id}}" class="cart_product_id_{{$product->id}}">
                            <input type="hidden" value="{{$product->name}}" class="cart_product_name_{{$product->id}}">
                            <input type="hidden" value="{{$product->image}}" class="cart_product_image_{{$product->id}}">
                            <input type="hidden" value="{{$product->price}}" class="cart_product_price_{{$product->id}}">
                            <input type="hidden" value="1" class="cart_product_qty_{{$product->id}}">

                            <div class="single-shop-product">
                                <div class="product-upper">
                                    <img src="{{asset('uploads/product/'.$product->image)}}" alt="">
                                </div>
                                <h2><a href="{{route('detail',$product->slug)}}">{{$product->name}}</a></h2>
                                <div class="product-carousel-price">
                                    <ins>{{number_format($product->price)}}</ins>
                                </div>

                                <div class="product-option-shop">
                                    {{--                            <a class="add_to_cart_button" data-quantity="1" data-product_sku="" data-product_id="70" rel="nofollow" href="/canvas/shop/?add-to-cart=70">Add to cart</a>--}}
                                    <button type="button" class="btn btn-default add_to_cart_button add-to-cart" data-id_product="{{$product->id}}" name="add-to-cart">Thêm giỏ hàng</button>
                                </div>
                            </div>
                        </form>
                    </div>
                @endforeach
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="product-pagination text-center">
                        <nav>
                            <ul class="pagination">
                                <li>
                                    <a href="#" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                                <li><a href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">4</a></li>
                                <li><a href="#">5</a></li>
                                <li>
                                    <a href="#" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
