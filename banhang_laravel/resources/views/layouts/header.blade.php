<style type="text/css">


    .dropdown-menu a{
        background: white !important;
        color: black !important;
        padding: 10px !important;
    }

    .dropdown-menu a:hover{
        background: whitesmoke !important;
        text-decoration: none;
    }

    .dropdown-item {
        display: block;
        width: 100%;
        padding: 0.25rem 1rem;
        clear: both;
        font-weight: 400;
        color: #c3bdbd;
        text-align: inherit;
        text-decoration: none;
        white-space: nowrap;
        background-color: transparent;
        border: 0;
    }

</style>

<div class="header-area">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <div class="user-menu">
                    <ul>
                        <li><a href="#"><i class="fa fa-phone"></i> 0917138144</a></li>
                        <li><a href="#"><i class="fa fa-facebook"></i> Facebook</a></li>
{{--                        <li><a href="cart.html"><i class="fa fa-twitch"></i> Twitch</a></li>--}}
{{--                        <li><a href="checkout.html"><i class="fa fa-twitter"></i> Twitter</a></li>--}}
                        <li><a href="#"><i class="fa fa-mail-forward"></i> charlenee282@gmail.com</a></li>
                    </ul>
                </div>
            </div>


        </div>
    </div>
</div> <!-- End header area -->

<div class="site-branding-area">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="logo">
                    <h1><a href="./"><img width="100px" src="{{asset('admin/images/logo.png')}}"></a></h1>
                </div>
            </div>

            <div class="col-sm-6 shopping-header">
                <div class="shopping-item">
                    @php
                        $quantity = 0;
                    @endphp
                    @if(Session::has('cart'))
                        @foreach(Session::get('cart') as $qty => $car)
                            @php
                                $quantity += $car['product_qty'];
                            @endphp
                        @endforeach
                    @endif
                    <a href="{{route('cart')}}">Giỏ hàng<i class="fa fa-shopping-cart"></i> <span class="product-count">{{$quantity}}</span></a>
                </div>
                <div class="header-right" >
                    <ul class="list-unstyled list-inline">

                        @if(session('customer_id'))
                            <li class="dropdown dropdown-small dropdown-toggle avatar">
                                <img src="{{asset('uploads/avatar/'.session('customer_avatar'))}}" alt="" class="icon-avatar">
                                <a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" href="#">{{Session::get('customer_name')}} <i class="fa fa-angle-down"></i></a>
                                <ul class="dropdown-menu" style="float: right">
                                    <li><a href="#">Thông tin tài khoản</a></li>
                                    <li><a href="{{route('logout')}}">Đăng xuất</a></li>

                                </ul>
                            </li>
                        @else
                            <li><a href="{{route('login')}}"><i class="fa fa-user"></i> Đăng nhập</a></li>
                        @endif
                    </ul>
                </div>

            </div>
        </div>
    </div>
</div> <!-- End site branding area -->

<div class="mainmenu-area">
    <div class="container">
        <div class="row">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="navbar-collapse collapse" >
                <ul class="nav navbar-nav" style="width: 100%">
                    <li class="active"><a href="{{url('/')}}">Trang chủ</a></li>
                    <li class="nav-item dropdown" >
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Danh mục
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            @foreach($category as $key => $cate)
                            <a class="dropdown-item" href="{{route('category',$cate->slug)}}" >{{$cate->name}}</a>
                            @endforeach
                        </div>
                    </li>
{{--                    <li class="nav-item dropdown" >--}}
{{--                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
{{--                            Thương hiệu--}}
{{--                        </a>--}}
{{--                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">--}}
{{--                            @foreach($brands as $key => $brand)--}}
{{--                                <a class="dropdown-item" href="{{route('brand',$brand->slug)}}">{{$brand->name}}</a>--}}
{{--                            @endforeach--}}
{{--                        </div>--}}
{{--                    </li>--}}
                    <li class="nav-item"><a href="{{route('all_product')}}">Sản phẩm</a></li>
{{--                    <li><a href="#">Others</a></li>--}}
                    <li><a href="{{route('contact')}}">Liên hệ</a></li>
                    <li style="float: right; line-height: 60px">
                        <form class="form-inline my-2 my-lg-0" autocomplete="off" action="{{route('search')}}" method="POST">
                            @csrf

                            <input class="form-control mr-sm-2" id="keywords" name="keywords_submit" type="text" placeholder="Nhập tên sản phẩm..." aria-label="Search">
                            <button class="btn btn-success my-2 my-sm-0" type="submit">Tìm kiếm</button>
                            <div id="search_ajax"></div>

                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div> <!-- End mainmenu area -->
