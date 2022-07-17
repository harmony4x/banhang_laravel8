@extends('layouts.app')
@section('content')
    <div class="slider-area">
        <!-- Slider -->
        <div class="block-slider block-slider4">
            <ul class="" id="bxslider-home4">
                @foreach($sliders as $sl => $slider)
                <li>
                    <img src="{{asset('uploads/slider/'.$slider->slider_image)}}" alt="Slide">
                    <div class="caption-group">
{{--                        <h2 class="caption title">--}}
{{--                            {{$slider->slider_desc}}--}}
{{--                        </h2>--}}
{{--                        <h4 class="caption subtitle">Dual SIM</h4>--}}
                        <a class="caption button-radius" href="{{route('all_product')}}"><span class="icon"></span>Shop now</a>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
        <!-- ./Slider -->
    </div> <!-- End slider area -->

    <div class="promo-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="single-promo promo1">
                        <i class="fa fa-money"></i>
                        <p>Thanh toán dễ dàng</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="single-promo promo2">
                        <i class="fa fa-truck"></i>
                        <p>Vận chuyển nhanh</p>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6">
                    <div class="single-promo promo4">
                        <i class="fa fa-gift"></i>
                        <p>Nhiều ưu đãi</p>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6">
                    <div class="single-promo promo3">
                        <i class="fa fa-phone-square"></i>
                        <p>0917138144</p>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End promo area -->

    <div class="brands-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <div class="brand-wrapper">
                        <div class="brand-list">
                            @foreach($brands as $key => $brand)
                                <img style="height: 120px; width: 230px" src="{{asset('uploads/brand/'.$brand->image)}}" alt="">
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End brands area -->

    <div class="maincontent-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="latest-product">
                        <h2 class="section-title">Whey Protein</h2>
                        <div class="product-carousel">
                            @foreach($products_whey as $pr => $whey)
                            <div class="single-product">
                                <div class="product-f-image">
                                    <img style="height: 200px" src="{{asset('uploads/product/'.$whey->image)}}" alt="">
                                    <div class="product-hover">

                                        <a href="{{route('detail',$whey->slug)}}" class="view-details-link"><i class="fa fa-link"></i> Chi tiết</a>
                                    </div>
                                </div>

                                <h2><a href="{{route('detail',$whey->slug)}}">{{$whey->name}}</a></h2>

                                <div class="product-carousel-price">
                                    <ins>{{number_format($whey->price)}} VNĐ</ins>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End main content area -->

    <div class="maincontent-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="latest-product">
                        <h2 class="section-title">Sản phẩm xem nhiều</h2>
                        <div class="product-carousel">
                            @foreach($products_view as $pr => $view)
                                <div class="single-product">
                                    <div class="product-f-image">
                                        <img style="height: 200px" src="{{asset('uploads/product/'.$view->image)}}" alt="">
                                        <div class="product-hover">

                                            <a href="{{route('detail',$view->slug)}}" class="view-details-link"><i class="fa fa-link"></i> Chi tiết</a>
                                        </div>
                                    </div>

                                    <h2><a href="{{route('detail',$view->slug)}}">{{$view->name}}</a></h2>

                                    <div class="product-carousel-price">
                                        <ins>{{number_format($view->price)}} VNĐ</ins>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End main content area -->


    <div class="maincontent-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="latest-product">
                        <h2 class="section-title">Sản phẩm bán chạy</h2>
                        <div class="product-carousel">
                            @foreach($products_sell as $pr => $sell)
                                <div class="single-product">
                                    <div class="product-f-image">
                                        <img style="height: 200px" src="{{asset('uploads/product/'.$sell->image)}}" alt="">
                                        <div class="product-hover">

                                            <a href="{{route('detail',$sell->slug)}}" class="view-details-link"><i class="fa fa-link"></i> Chi tiết</a>
                                        </div>
                                    </div>

                                    <h2><a href="{{route('detail',$sell->slug)}}">{{$sell->name}}</a></h2>

                                    <div class="product-carousel-price">
                                        <ins>{{number_format($sell->price)}} VNĐ</ins>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End main content area -->

@endsection
