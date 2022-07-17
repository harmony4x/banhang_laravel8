<!DOCTYPE html>
<!--
	ustora by freshdesignweb.com
	Twitter: https://twitter.com/freshdesignweb
	URL: https://www.freshdesignweb.com/ustora/
-->
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ustora Demo</title>

    <!-- Google Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,200,300,700,600' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,100' rel='stylesheet' type='text/css'>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{asset('pages/css/bootstrap.min.css')}}">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('pages/css/font-awesome.min.css')}}">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{asset('pages/css/owl.carousel.css')}}">
    <link rel="stylesheet" href="{{asset('pages/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('pages/css/responsive.css')}}">
    <style>
        .shopping-item:hover{
            background: none;
            color: #5a88ca;
        }
        .shopping-item:hover a{
            color: #5a88ca;
        }
        .alert_success {
            padding: 20px;
            background-color: #5bfa27;
            color: white;
        }
        .alert {
            padding: 20px;
            background-color: #f44336;
            color: white;
        }

        .closebtn {
            margin-left: 15px;
            color: white;
            font-weight: bold;
            float: right;
            font-size: 22px;
            line-height: 20px;
            cursor: pointer;
            transition: 0.3s;
        }

        .closebtn:hover {
            color: black;
        }
    </style>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    <![endif]-->
</head>
<body>
    <div class="header-area">
        <div class="container">
            <div class="row">
                <div class="col-md-10">
                    <div class="user-menu">
                        <ul>
                            <li><a href="#"><i class="fa fa-phone"></i> 0917138144</a></li>
                            <li><a href="#"><i class="fa fa-facebook"></i> Facebook</a></li>
                            <li><a href="cart.html"><i class="fa fa-twitch"></i> Twitch</a></li>
                            <li><a href="checkout.html"><i class="fa fa-twitter"></i> Twitter</a></li>
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
                        <h1><a href="./"><img src="{{asset('pages/img/logo.png')}}"></a></h1>
                    </div>
                </div>

                <div class="col-sm-6 shopping-header">
                    <div class="shopping-item">
                        <a href="{{route('cart')}}">Giỏ hàng<i class="fa fa-shopping-cart"></i> <span class="product-count">{{Cart::count()}}</span></a>
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
    <div class="container">
        <div class="row">
            <div class="col-md-6">
{{--                <img src="{{asset('uploads/slider/banner1.jpg')}}" alt="">--}}
            </div>
            <div class="col-md-6">
                <div role="tabpanel">
                    <ul class="product-tab" role="tablist">
                        <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Đăng nhập</a></li>
                        <li role="presentation" class=""><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Đăng ký</a></li>
                    </ul>
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade  active in " id="home">
                            <h2>Đăng nhập</h2>
                            @if ($errors->any())
                                <div class="alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if(session('message_success'))
                                <div class="alert_success">
                                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                                    <strong>{{session('message_success')}}</strong>
                                </div>
                            @elseif(session('message_danger'))
                                <div class="alert">
                                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                                    <strong>{{session('message_danger')}}</strong>
                                </div>
                            @elseif(session('message'))
                                <div class="alert">
                                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                                    <strong>{{session('message')}}</strong>
                                </div>
                            @endif
                            <form method="POST" action="{{route('customer_login')}}">
                                @csrf
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    <div id="emailHelp" class="form-text"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Mật khẩu</label>
                                    <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                                </div>
                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">Nhớ mật khẩu</label>
                                </div>


                                <button type="submit" class="btn btn-primary">Đăng nhập</button>
                            </form>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="profile">
                            <h2>Đăng ký</h2>
                            @if ($errors->any())
                                <div class="alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form method="POST" action="{{route('add_customer')}}">
                                @csrf
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    <div id="emailHelp" class="form-text"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Tên hiển thị</label>
                                    <input type="text" name="customer_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    <div id="emailHelp" class="form-text"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Mật khẩu</label>
                                    <input type="password" name="customer_password" class="form-control" id="exampleInputPassword1">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Nhập lại mật khẩu</label>
                                    <input type="password" name="customer_password2" class="form-control" id="exampleInputPassword1">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Địa chỉ</label>
                                    <input type="text" name="customer_address" class="form-control" id="exampleInputPassword1">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Số điện thoại</label>
                                    <input type="text" name="customer_phone" class="form-control" id="exampleInputPassword1">
                                </div>
                                <button style="margin-top: 10px" type="submit" class="btn btn-primary">Đăng ký</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footer')
    <script src="https://code.jquery.com/jquery.min.js"></script>

    <!-- Bootstrap JS form CDN -->
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

    <!-- jQuery sticky menu -->
    <script src="{{asset('pages/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('pages/js/jquery.sticky.js')}}"></script>

    <!-- jQuery easing -->
    <script src="{{asset('pages/js/jquery.easing.1.3.min.js')}}"></script>

    <!-- Main Script -->
    <script src="{{asset('pages/js/main.js')}}"></script>

    <!-- Slider -->
    <script type="text/javascript" src="{{asset('pages/js/bxslider.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('pages/js/script.slider.js')}}"></script>

    <script type="text/javascript">
        const myFunction = (smallImg)=>{
            const largerImg = document.getElementById("demo");
            largerImg.src = smallImg.src

        }
    </script>

</body>
</html>
