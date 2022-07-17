@extends('layouts.app')
@section('content')
    <style>
        .lSSlideOuter .lSPager.lSGallery img{
            height: 100px;
        }
        .lSSlideOuter .lSPager.lSGallery li.active, .lSSlideOuter .lSPager.lSGallery li:hover {
            border: 1px solid #5a88ca;
        }

    </style>
    <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-content-right">
                        <div class="product-breadcroumb">
                            <a href="{{url('/')}}">Trang chủ</a>
                            <a href="{{route('category',$detail->category->slug)}}">{{$detail->category->name}}</a>
{{--                            <a href="{{route('brand',$detail->brand->slug)}}">{{$detail->brand->name}}</a>--}}
                            <a class="active" href="">{{$detail->name}}</a>
                        </div>

                        <div class="row">
                            <div class="col-sm-5">
                                <ul id="imageGallery">
                                    <li data-thumb="{{asset('uploads/product/'.$detail->image)}}" data-src="{{asset('uploads/product/'.$detail->image)}}">
                                        <img style="height: 350px" src="{{asset('uploads/product/'.$detail->image)}}" />
                                    </li>
                                    @foreach($gallery as $gal)
                                    <li data-thumb="{{asset('uploads/gallery/'.$gal->image)}}" data-src="{{asset('uploads/gallery/'.$gal->image)}}">
                                        <img src="{{asset('uploads/gallery/'.$gal->image)}}" />
                                    </li>
                                    @endforeach
                                </ul>
                            </div>

                            <div class="col-sm-7">
                                <div class="product-inner">
                                    <h2 class="product-name">{{$detail->name}}</h2>
                                    <h5>Mã sản phẩm: {{$detail->id}}</h5>
                                    <div class="product-inner-price">
                                        <ins>{{number_format($detail->price)}} <sup>đ</sup></ins>
                                    </div>

                                    @if($detail->quantity>0)
                                        <form action="{{route('save.product')}}" method="POST" class="cart">
                                            @csrf

                                            <input type="hidden" name="product_id" value="{{$detail->id}}">
                                            <input type="hidden" name="product_name" value="{{$detail->name}}">
                                            <input type="hidden" name="product_price" value="{{$detail->price}}">
                                            <input type="hidden" name="product_image" value="{{$detail->image}}">
                                            <div class="quantity">
                                                <input type="number" size="4" class="input-text qty text" title="Qty" value="1" name="product_qty" min="1" step="1">
                                            </div>
                                            <button class="add_to_cart_button" type="submit">Thêm vào giỏ hàng</button>
                                        </form>
                                    @else
                                        <span class="text text-danger" style="font-size: 25px">Sản phẩm hiện đang hết hàng</span>
                                    @endif

                                    <div class="product-inner-category">
                                        <p>Danh mục: <a href="{{route('category',$detail->category->slug)}}">{{$detail->category->name}}</a>
{{--                                            . Tags: <a href="">awesome</a>, <a href="">best</a>, <a href="">sale</a>, <a href="">shoes</a>. </p>--}}
                                    </div>



                                </div>
                            </div>
                        </div>

                        <div role="tabpanel">
                            <ul class="product-tab" role="tablist">
                                <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Mô tả</a></li>
                                <li role="presentation" class=""><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Đánh giá</a></li>

                            </ul>
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade active in" id="home">
                                    <h2>Mô tả sản phẩm</h2>
                                    {!! $detail->content !!}
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="profile">
                                    <h2>Đánh giá sản phẩm</h2>
                                    <style type="text/css">
                                        .comment{
                                            /*border: 1px solid #dddddd;*/
                                            border-radius: 10px;
                                            /*background: #fdfdfd;*/
                                            margin: 10px;
                                        }
                                    </style>
                                    <form >
                                        <div id="comment_show"></div>
                                        <input type="hidden" name="comment_product_id" class="comment_product_id" value="{{$detail->id}}">
                                    </form>
                                    <form>
                                        @csrf
                                        <div class="submit-review">
                                            <p><label for="name">Tên</label> <input name="name" type="text" class="comment_name"></p>
                                            <div class="rating-chooser">
                                                <p>Your rating</p>

                                                <div class="rating-wrap-post">
                                                    <ul class="list-inline rating" title="Đánh giá sau">
                                                        @for($count=1;$count<=5;$count++)
                                                            @php
                                                                if ($count<=$rating){
                                                                    $color = 'color:#ffcc00;';
                                                                }else {
                                                                    $color = 'color:#ccc';
                                                                }
                                                            @endphp
                                                            <li title="Đánh giá sao"
                                                                class="rating"  style="font-size: 30px; cursor: pointer; {{$color}}  "
                                                                id="{{$detail->id}}-{{$count}}"
                                                                data-index="{{$count}}"
                                                                data-product_id="{{$detail->id}}"
                                                                data-rating="{{$rating}}"
                                                            >&#9733</li>
                                                        @endfor
                                                    </ul>
                                                </div>
                                            </div>
                                            <p>
                                                <label for="review">Nội dung bình luận</label>
                                                <textarea class="comment_content" name="review" id="" cols="30" rows="10"></textarea>
                                            </p>
                                            <p><input class="send-comment" type="button" value="Bình luận"></p>
                                        </div>
                                    </form>
                                    <div class="notify_comment"></div>
                                </div>

                            </div>
                        </div>

                        <div class="latest-product" style="margin-bottom: 100px;">
                            <h2 class="section-title">Sản Phẩm Tương Tự</h2>
                            <div class="product-carousel">
                                @foreach($sp_lienquan as $sp => $lienquan)
                                    <div class="single-product">
                                        <div class="product-f-image">
                                            <img style="height: 200px" src="{{asset('uploads/product/'.$lienquan->image)}}" alt="">
                                            <div class="product-hover">

                                                <a href="{{route('detail',$lienquan->slug)}}" class="view-details-link"><i class="fa fa-link"></i> Chi tiết</a>
                                            </div>
                                        </div>

                                        <h2><a href="{{route('detail',$lienquan->slug)}}">{{$lienquan->name}}</a></h2>

                                        <div class="product-carousel-price">
                                            <ins>{{number_format($lienquan->price)}} VNĐ</ins>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
