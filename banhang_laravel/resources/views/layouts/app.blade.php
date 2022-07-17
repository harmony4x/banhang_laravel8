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
    <title>Tiny Store</title>

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
    <link rel="stylesheet" href="{{asset('pages/css/sweetalert.css')}}">
    <link rel="stylesheet" href="{{asset('pages/css/lightslider.min.css')}}">
    <link rel="stylesheet" href="{{asset('pages/css/prettify.css')}}">
    <link rel="stylesheet" href="{{asset('pages/css/lightgallery.min.css')}}">


    <style>
        .alert {
            padding: 20px;
            background-color: #f44336;
            color: white;
        }

        .alert-success {
            padding: 20px;
            color: #3c763d;
            background-color: #dff0d8;
            border-color: #d6e9c6;
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

        .image_small {
            border: 1px solid black;
        }
        .single-product h2{
            height: 45px;
        }
        @media only screen and (max-width: 767px){
            .header-right {
                float: none;
                margin-bottom: 20px;
                margin-top: 5px;
                text-align: center;
            }
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

@include('layouts.header')

@yield('content')

@include('layouts.footer')

<!-- Latest jQuery form server -->
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

<!-- Gallery -->
<script type="text/javascript" src="{{asset('pages/js/lightslider.js')}}"></script>
<script type="text/javascript" src="{{asset('pages/js/prettify.js')}}"></script>
<script type="text/javascript" src="{{asset('pages/js/lightgallery-all.min.js')}}"></script>

<script type="text/javascript">
    const myFunction = (smallImg)=>{
        const largerImg = document.getElementById("demo");
        largerImg.src = smallImg.src

    }
</script>

<script type="text/javascript">
    $('#keywords').keyup(function (){
        var query = $(this).val();

        if (query != ''){
            var _token = $('input[name="_token"]').val();

            $.ajax({
                url: '{{url('/autocomplete-ajax')}}',
                method: 'POST',
                data : {query:query,_token:_token},
                success:function(data){
                    $('#search_ajax').fadeIn();
                    $('#search_ajax').html(data);
                }
            });
        }else {
            $('#search_ajax').fadeOut();
        }
    });
    $(document).on('click','.li_search_ajax',function (){
        $('#keywords').val($(this).text());
        $('#search_ajax').fadeOut();
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#imageGallery').lightSlider({
            gallery:true,
            item:1,
            loop:true,
            thumbItem:5,
            slideMargin:0,
            enableDrag: false,
            currentPagerPosition:'left',
            onSliderLoad: function(el) {
                el.lightGallery({
                    selector: '#imageGallery .lslide'
                });
            }
        });
    });
</script>

<!-- Sweetalert -->
<script type="text/javascript" src="{{asset('pages/js/sweetalert.js')}}"></script>
{{--<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>--}}

<!-- Chatbot -->
<iframe style="width: 380px;height: 570px; float: right; border: none;position: fixed; bottom: 0; right: 0;z-index:999" src="http://127.0.0.1:5000/"></iframe>


<script type="text/javascript">
    $(document).ready(function(){
        $('.add-to-cart').click(function(){
            var id = $(this).data('id_product');
            var cart_product_id = $('.cart_product_id_' + id).val();
            var cart_product_name = $('.cart_product_name_' + id).val();
            var cart_product_image = $('.cart_product_image_' + id).val();
            var cart_product_price = $('.cart_product_price_' + id).val();
            var cart_product_qty = $('.cart_product_qty_' + id).val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: '{{url('/add-cart-ajax')}}',
                method: 'POST',
                data:{cart_product_id:cart_product_id,cart_product_name:cart_product_name,cart_product_image:cart_product_image,cart_product_price:cart_product_price,cart_product_qty:cart_product_qty,_token:_token},
                success:function(){

                    swal({
                            title: "",
                            icon: "success",
                            text: "Thêm sản phẩm thành công",
                            showCancelButton: true,
                            cancelButtonText: "Xem tiếp",
                            confirmButtonClass: "btn-success",
                            confirmButtonText: "Đi đến giỏ hàng",
                            closeOnConfirm: false
                        },
                        function() {
                            window.location.href = "{{url('/gio-hang')}}";
                        });

                }

            });
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function (){
        $('.apply_coupon').click(function (){
            var coupon_code = $('.coupon_code').val();
            var _token = $('input[name="_token"]').val();


            if (coupon_code==''){

            }else {
                $.ajax({
                    url : '{{url('/check-coupon-ajax')}}',
                    method : 'POST',
                    data : {coupon_code:coupon_code,_token:_token},
                    success:function (data){
                        alert('Áp dụng mã giảm giá thành công')

                        // fetch_delivery();
                        $('.dis').html(data);
                        location.reload();
                    }
                })
            }

        })

    })
</script>

<script type="text/javascript">
    $(document).ready(function (){
        $('.choose').on('change',function (){
            var action = $(this).attr('id');
            var ma_id = $(this).val();
            var _token = $('input[name="_token"]').val();
            var result = '';

            if (action=='city'){
                result = 'province';
            }else {
                result = 'wards';
            }
            $.ajax({
                url : '{{url('/select-delivery')}}',
                method : 'POST',
                data : {action:action,ma_id:ma_id,_token:_token},
                success:function (data){
                    $('#'+result).html(data);
                }
            })
        });
    })

</script>

<script type="text/javascript">
    $(document).ready(function (){
        {{--$('.calculate_delivery').click(function (){--}}
        {{--    var matp = $('.city').val();--}}
        {{--    var maqh = $('.province').val();--}}
        {{--    var xaid = $('.wards').val();--}}
        {{--    var _token = $('input[name="_token"]').val();--}}
        {{--    if (matp=='' && maqh=='' && xaid ==''){--}}
        {{--        alert('Nhập đầy đủ thông tin để tính phí vận chuyển');--}}
        {{--    }else {--}}
        {{--        $.ajax({--}}
        {{--            url : '{{url('/calculate-delivery')}}',--}}
        {{--            method : 'POST',--}}
        {{--            data : {matp:matp,maqh:maqh,xaid:xaid,_token:_token},--}}
        {{--            success:function (data){--}}
        {{--                $('.fee').html(data);--}}

        {{--            }--}}
        {{--        })--}}
        {{--    }--}}

        {{--});--}}
        $(document).on('blur','.cal_feeship',function (){
            var matp = $('.city').val();
            var maqh = $('.province').val();
            var xaid = $('.wards').val();
            var _token = $('input[name="_token"]').val();
            if (matp=='' && maqh=='' && xaid ==''){
                alert('Nhập đầy đủ thông tin để tính phí vận chuyển');
            }else {
                $.ajax({
                    url : '{{url('/calculate-delivery')}}',
                    method : 'POST',
                    data : {matp:matp,maqh:maqh,xaid:xaid,_token:_token},
                    success:function (data){
                        $('.fee').html(data);
                        // location.reload();
                        // console.log(data)

                    }
                })
            }
        })
    })
</script>

<script type="text/javascript">
    $(document).ready(function (){

        $('.send_order').click(function (){
            swal({
                    title: "Xác nhận đơn hàng",
                    text: "Đơn hàng sẽ không được hoàn trả khi đặt hàng. Bạn có muốn tiếp tục đặt hàng không?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Đặt hàng",
                    cancelButtonText: "Hoàn tác",
                    closeOnConfirm: false
                },
                function(){
                    var shipping_email = $('.shipping_email').val();
                    var shipping_name = $('.shipping_name').val();
                    var shipping_phone = $('.shipping_phone').val();
                    var shipping_address = $('.shipping_address').val();
                    var shipping_note = $('.shipping_note').val();
                    var shipping_method = $('.payment_method').val();
                    var order_coupon = $('.order_coupon').val();
                    var order_fee = $('.order_fee').val();
                    var _token = $('input[name="_token"]').val();


                    $.ajax({
                        url : '{{url('/confirm-order')}}',
                        method : 'POST',
                        data : {shipping_email:shipping_email,shipping_name:shipping_name,shipping_phone:shipping_phone,shipping_address:shipping_address,shipping_note:shipping_note,order_coupon:order_coupon,order_fee:order_fee,shipping_method:shipping_method,_token:_token},
                        success:function (data){
                            swal("Thông báo!", "Đơn hàng của bạn đã được đặt thành công.", "success");
                            window.setTimeout(function (){
                                window.location.replace("/");
                            },3000);
                        }
                    })

            });


        })

    })
</script>

<script type="text/javascript">
    $('.xemnhanh').click(function (){
        var product_id = $(this).data('id_product');
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url : '{{url('/quickview')}}',
            method: "POST",
            dataType: "JSON",
            data : {product_id:product_id,_token:_token},
            success:function (data){
                $('#buy_quickview').attr('data-id_product',product_id);
                $('#product_quickview_title').html(data.name);
                $('#product_quickview_id').html(data.id);
                $('#product_quickview_price').html(data.price);
                $('#product_quickview_image').html(data.image);
                $('#product_quickview_gallery').html(data.gallery);
                $('#product_quickview_desc').html(data.desc);
                $('#product_quickview_content').html(data.content);
                $('#product_quickview_category_name').html(data.category_name);
                $('#product_quickview_value').html(data.product_quickview_value);
            }
        })
    })
</script>
{{--Add to cart quick view--}}
<script type="text/javascript">
        $(document).on('click','.add-to-cart-quickview',function(){
            var id = $(this).data('id_product');
            var cart_product_id = $('.cart_product_id_' + id).val();
            var cart_product_name = $('.cart_product_name_' + id).val();
            var cart_product_image = $('.cart_product_image_' + id).val();
            var cart_product_price = $('.cart_product_price_' + id).val();
            var cart_product_qty = $('.cart_product_qty_' + id).val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: '{{url('/add-cart-ajax')}}',
                method: 'POST',
                data:{cart_product_id:cart_product_id,cart_product_name:cart_product_name,cart_product_image:cart_product_image,cart_product_price:cart_product_price,cart_product_qty:cart_product_qty,_token:_token},
                beforeSend: function (){
                  $('#beforesend_quickview').html('<p class="text-danger">Đang thêm sản phẩm vào giỏ hàng</p>')
                },
                success:function(){

                    $('#beforesend_quickview').html('<p class="text-success">Sản phẩm đã thêm vào giỏ hàng</p>')
                    $('#buy_quickview').attr('disabled',true)
                    $('#buy_quickview').background('grey')
                }

            });
        });
</script>

//Comment
<script type="text/javascript">
    $(document).ready(function (){
        load_comment()
        function load_comment(){
            var product_id = $('.comment_product_id').val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url : '{{url('/load-comment')}}',
                method : 'POST',
                data : {product_id:product_id,_token:_token},
                success:function (data){
                    $('#comment_show').html(data)

                }
            })
        }
        $('.send-comment').click(function (){
            var product_id = $('.comment_product_id').val();
            var comment_name = $('.comment_name').val();
            var comment_content = $('.comment_content').val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url : '{{url('/send-comment')}}',
                method : 'POST',
                data : {product_id:product_id,comment_name:comment_name,comment_content:comment_content,_token:_token},
                success:function (data){
                    $('.notify_comment').html('<p class="text text-success">Thêm bình luận thành công. Bình luận đang chờ duyệt!</p>')
                    load_comment()
                    $('.notify_comment').fadeOut(5000);
                    $('.comment_name').val('');
                    $('.comment_content').val('');
                }
            })
        })
    })
</script>

<script type="text/javascript">
    function remove_background(product_id){
        for (var count=1; count<=5; count++){
            $('#'+product_id+'-'+count).css('color','#ccc')
        }
    }

    // Hover chuot danh gia sao
    $(document).on('mouseenter','.rating', function (){
        var index = $(this).data('index')
        var product_id = $(this).data('product_id')
        remove_background(product_id)

        for (var count=1 ; count<=index ; count++){
            $('#'+product_id+'-'+count).css('color','#ffcc00')
        }
    })

    // Nha chuot khong danh gia
    $(document).on('mouseleave','.rating', function (){
        var index = $(this).data('index')
        var product_id = $(this).data('product_id')
        var rating = $(this).data('rating')
        remove_background(product_id)

        for (var count=1 ; count<=rating ; count++){
            $('#'+product_id+'-'+count).css('color','#ffcc00')
        }
    })

    {{--$(document).on('click','.rating', function (){--}}
    {{--    var index = $(this).data('index')--}}
    {{--    var product_id = $(this).data('product_id')--}}
    {{--    var _token = $('input[name="_token"]').val()--}}
    {{--    $.ajax({--}}
    {{--        url : '{{url('/insert-rating')}}',--}}
    {{--        method : 'POST',--}}
    {{--        data : {product_id:product_id,index:index,_token:_token},--}}
    {{--        success:function (data){--}}
    {{--            if (data == 'done'){--}}
    {{--                alert("Bạn đã đánh giá "+index+" trên 5 sao")--}}
    {{--            }else {--}}
    {{--                alert("Lỗi đánh giá")--}}
    {{--            }--}}
    {{--        }--}}
    {{--    })--}}
    {{--})--}}
</script>

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/formvalidation/0.6.2-dev/css/formValidation.min.css"></script>
<script type="text/javascript">
    $.validate({

    });
</script>
 -->
</body>
</html>
