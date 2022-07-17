<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<head>
    <title>Visitors an Admin Panel Category Bootstrap Responsive Website Template | Home :: w3layouts</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!-- bootstrap-css -->
    <link rel="stylesheet" href="{{asset('admin/css/bootstrap.min.css')}}" >
    <!-- //bootstrap-css -->
    <!-- Custom CSS -->
    <link href="{{asset('admin/css/style.css')}}" rel='stylesheet' type='text/css' />
    <link href="{{asset('admin/css/style-responsive.css')}}" rel="stylesheet"/>
    <!-- font CSS -->
    <link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <!-- font-awesome icons -->
    <link rel="stylesheet" href="{{asset('admin/css/font.css')}}" type="text/css"/>
    <link href="{{asset('admin/css/font-awesome.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('admin/css/morris.css')}}" type="text/css"/>
    <!-- calendar -->
    <link rel="stylesheet" href="{{asset('admin/css/monthly.css')}}">
{{--    <link rel="stylesheet" href="{{asset('admin/css/jquery-ui.css')}}">--}}
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">

    <!-- //calendar -->
    <!-- //font-awesome icons -->
    <script src="{{asset('admin/js/jquery2.0.3.min.js')}}"></script>
    <script src="{{asset('admin/js/raphael-min.js')}}"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">


</head>
<body>
<section id="container">
    <!--header start-->
    <header class="header fixed-top clearfix">
        <!--logo start-->
        <div class="brand">
            <a href="{{route('admin.dashboard')}}" class="logo">
                VISITORS
            </a>
            <div class="sidebar-toggle-box">
                <div class="fa fa-bars"></div>
            </div>
        </div>
        <!--logo end-->
        <div class="nav notify-row" id="top_menu">
            <!--  notification start -->

            <!--  notification end -->
        </div>
        <div class="top-nav clearfix">
            <!--search & user info start-->
            <ul class="nav pull-right top-menu">
{{--                <li>--}}
{{--                    <input type="text" class="form-control search" placeholder=" Search">--}}
{{--                </li>--}}
                <!-- user login dropdown start-->
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <img style="" alt="" src="{{asset('/admin/images/5.png')}}">
                        <span class="username">{{Auth::user()->admin_name}}</span>
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu extended logout">
                        <li><a href="#"><i class=" fa fa-suitcase"></i>Profile</a></li>
                        <li><a href="#"><i class="fa fa-cog"></i> Settings</a></li>
                        <li><a href="{{route('admin.logout')}}"><i class="fa fa-key"></i> Log Out</a></li>
                    </ul>
                </li>
                <!-- user login dropdown end -->

            </ul>
            <!--search & user info end-->
        </div>
    </header>
    <!--header end-->
    <!--sidebar start-->
    <aside>
        <div id="sidebar" class="nav-collapse">
            <!-- sidebar menu start-->
            <div class="leftside-navigation">
                <ul class="sidebar-menu" id="nav-accordion">
                    <li>
                        <a class="active" href="{{route('admin.dashboard')}}">
                            <i class="fa fa-dashboard"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <li class="sub-menu">
                        <a href="javascript:;">
                            <i class="fa fa-book"></i>
                            <span>Danh mục</span>
                        </a>
                        <ul class="sub">
                            <li><a href="{{route('category.create')}}">Thêm danh mục</a></li>
                            <li><a href="{{route('category.index')}}">Hiển thị danh mục</a></li>
                        </ul>
                    </li>

{{--                    <li class="sub-menu">--}}
{{--                        <a href="javascript:;">--}}
{{--                            <i class="fa fa-life-buoy"></i>--}}
{{--                            <span>Thương hiệu</span>--}}
{{--                        </a>--}}
{{--                        <ul class="sub">--}}
{{--                            <li><a href="{{route('brand.create')}}">Thêm thương hiệu</a></li>--}}
{{--                            <li><a href="{{route('brand.index')}}">Hiển thị thương hiệu</a></li>--}}
{{--                        </ul>--}}
{{--                    </li>--}}

                    <li class="sub-menu">
                        <a href="javascript:;">
                            <i class="fa fa-star"></i>
                            <span>Sản phẩm</span>
                        </a>
                        <ul class="sub">
                            <li><a href="{{route('product.create')}}">Thêm sản phẩm</a></li>
                            <li><a href="{{route('product.index')}}">Hiển thị sản phẩm</a></li>
                        </ul>
                    </li>

                    <li class="sub-menu">
                        <a href="javascript:;">
                            <i class="fa fa-shopping-bag"></i>
                            <span>Đơn hàng</span>
                        </a>
                        <ul class="sub">
                            <li><a href="{{route('admin.order')}}">Hiển thị đơn hàng</a></li>
                        </ul>
                    </li>

                    <li class="sub-menu">
                        <a href="javascript:;">
                            <i class="fa fa-barcode"></i>
                            <span>Mã giảm giá</span>
                        </a>
                        <ul class="sub">
                            <li><a href="{{route('coupon.create')}}">Thêm mã giảm giá</a></li>
                            <li><a href="{{route('coupon.index')}}">Hiển thị mã giảm giá</a></li>
                        </ul>
                    </li>
                    <li class="sub-menu">
                        <a href="javascript:;">
                            <i class="fa fa-tags"></i>
                            <span>Phí vận chuyển</span>
                        </a>
                        <ul class="sub">
                            <li><a href="{{route('admin.delivery')}}">Quản lý phí vận chuyển</a></li>
                        </ul>
                    </li>
                    <li class="sub-menu">
                        <a href="javascript:;">
                            <i class="fa fa-sliders"></i>
                            <span>Slider</span>
                        </a>
                        <ul class="sub">
                            <li><a href="{{route('slider.create')}}">Thêm slider</a></li>
                            <li><a href="{{route('slider.index')}}">Hiển thị slider</a></li>
                        </ul>
                    </li>
                    <li class="sub-menu">
                        <a href="javascript:;">
                            <i class="fa fa-commenting"></i>
                            <span>Bình luận</span>
                        </a>
                        <ul class="sub">
                            <li><a href="{{route('admin.comment')}}">Hiển thị bình luận</a></li>
                        </ul>
                    </li>
                    <li class="sub-menu">
                        <a href="javascript:;">
                            <i class="fa fa-user"></i>
                            <span>Khách hàng</span>
                        </a>
                        <ul class="sub">
                            <li><a href="{{route('user.create')}}">Thêm khách hàng</a></li>
                            <li><a href="{{route('user.index')}}">Hiển thị khách hàng</a></li>
                        </ul>
                    </li>

                </ul>            </div>
            <!-- sidebar menu end-->
        </div>
    </aside>
    <!--sidebar end-->
    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">
            @yield('content')
        </section>
        <!-- footer -->

        <!-- / footer -->
    </section>
    <!--main content end-->
</section>
<script src="{{asset('admin/js/bootstrap.js')}}"></script>
<script src="{{asset('admin/js/jquery.dcjqaccordion.2.7.js')}}"></script>
<script src="{{asset('admin/js/scripts.js')}}"></script>
<script src="{{asset('admin/js/jquery.slimscroll.js')}}"></script>
<script src="{{asset('admin/js/jquery.nicescroll.js')}}"></script>
{{--<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="{{asset('admin/js/flot-chart/excanvas.min.js')}}"></script><![endif]-->--}}
<script src="{{asset('admin/js/jquery.scrollTo.js')}}"></script>
<script src="{{asset('admin/js/ckeditor/ckeditor.js')}}"></script>
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

<!-- morris JavaScript -->

<!-- calendar -->
<script type="text/javascript" src="{{asset('admin/js/monthly.js')}}"></script>

<script type="text/javascript">
    CKEDITOR.replace('content');
</script>

<script type="text/javascript">

    function ChangeToSlug()
    {
        var slug;

        //Lấy text từ thẻ input title
        slug = document.getElementById("slug").value;
        slug = slug.toLowerCase();
        //Đổi ký tự có dấu thành không dấu
        slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
        slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
        slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
        slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
        slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
        slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
        slug = slug.replace(/đ/gi, 'd');
        //Xóa các ký tự đặt biệt
        slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
        //Đổi khoảng trắng thành ký tự gạch ngang
        slug = slug.replace(/ /gi, "-");
        //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
        //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
        slug = slug.replace(/\-\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-/gi, '-');
        slug = slug.replace(/\-\-/gi, '-');
        //Xóa các ký tự gạch ngang ở đầu và cuối
        slug = '@' + slug + '@';
        slug = slug.replace(/\@\-|\-\@|\@/gi, '');
        //In slug ra textbox có id “slug”
        document.getElementById('convert_slug').value = slug;
    }

</script>


<script type="text/javascript">
    $('.category_status').change( function() {
        var status = $(this).val();
        var category_id = $(this).find(':selected').data('category_id');
        $.ajax({
            url:"{{url('/category-status')}}",
            method:"POST",

            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data:{status:status,category_id:category_id},
            success:function(data){
                alert('Thay đổi trang thái thành công');
                // location.reload();


            }
        });
    });
</script>

<script type="text/javascript">
    $('.brand_status').change( function() {
        var status = $(this).val();
        var brand_id = $(this).find(':selected').data('brand_id');
        $.ajax({
            url:"{{url('/brand-status')}}",
            method:"POST",

            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data:{status:status,brand_id:brand_id},
            success:function(data){
                alert('Thay đổi trang thái thành công');
                // location.reload();


            }
        });
    });
</script>

<script type="text/javascript">
    $('.product_status').change( function() {
        var status = $(this).val();
        var product_id = $(this).find(':selected').data('product_id');

        $.ajax({
            url:"{{url('/product-status')}}",
            method:"POST",

            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data:{status:status,product_id:product_id},
            success:function(data){
                alert('Thay đổi trang thái thành công');
                // location.reload();


            }
        });
    });
</script>

<script type="text/javascript">
    $('.order_status').change( function() {
        var status = $(this).val();
        var order_id = $(this).find(':selected').data('order_id');
        var coupon_price = $('.coupon_price').val();
        quantity = [];
        $("input[name='product_quantity']").each(function (){
            quantity.push($(this).val());
        });
        order_product_id = [];
        $("input[name='order_product_id']").each(function (){
            order_product_id.push($(this).val());
        });

        for (i=0;i<order_product_id.length;i++){
            var order_qty = $('.order_qty_' + order_product_id[i]).val();
            var order_qty_storage =  $('.order_qty_storage_' + order_product_id[i]).val();
            // if (parseInt(order_qty)>parseInt(order_qty_storage)){
            //     $('.color_qty_' + order_product_id[i].css('background','#000'))
            // }
        }

        $.ajax({
            url:"{{url('/order-status')}}",
            method:"POST",

            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data:{status:status,order_id:order_id,quantity:quantity,order_product_id:order_product_id,coupon_price:coupon_price},
            success:function(data){

                alert("Thay đổi trạng thái đơn hàng thành công")

            }
        });
    });
</script>



<script type="text/javascript">
    $('.coupon_status').change( function() {
        var status = $(this).val();
        var coupon_id = $(this).find(':selected').data('coupon_id');
        $.ajax({
            url:"{{url('/coupon-status')}}",
            method:"POST",

            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data:{status:status,coupon_id:coupon_id},
            success:function(data){
                alert('Thay đổi trang thái thành công');
                // location.reload();


            }
        });
    });
</script>

<script type="text/javascript">
    $('.slider_status').change( function() {
        var status = $(this).val();
        var slider_id = $(this).find(':selected').data('slider_id');
        $.ajax({
            url:"{{url('/slider-status')}}",
            method:"POST",

            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data:{status:status,slider_id:slider_id},
            success:function(data){
                alert('Thay đổi trang thái thành công');
                // location.reload();


            }
        });
    });
</script>

<script type="text/javascript">
    $('.user_status').change( function() {
        var status = $(this).val();
        var user_id = $(this).find(':selected').data('user_id');
        $.ajax({
            url:"{{url('/user-status')}}",
            method:"POST",

            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data:{status:status,user_id:user_id},
            success:function(data){
                alert('Thay đổi trang thái thành công');
                // location.reload();


            }
        });
    });
</script>


<script type="text/javascript">
    $(document).ready(function (){
        fetch_delivery();
        function fetch_delivery() {
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url : '{{url('/admin/load-delivery')}}',
                method : 'POST',
                data : {_token:_token},
                success:function (data){
                    $('#load_delivery').html(data);
                }
            })
        }

        $(document).on('blur','.feeship_edit',function (){
            var feeship_id = $(this).data('feeship_id');
            var fee_value = $(this).text();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url : '{{url('/admin/update-delivery')}}',
                method : 'POST',
                data : {feeship_id:feeship_id,fee_value:fee_value,_token:_token},
                success:function (data){
                    alert('Cập nhật phí vận chuyển thành công')
                    fetch_delivery();
                }
            })
        })

        $('.add_delivery').click(function () {
            var city = $('.city').val();
            var province = $('.province').val();
            var wards = $('.wards').val();
            var fee_ship = $('.fee_ship').val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url : '{{url('/admin/create-delivery')}}',
                method : 'POST',
                data : {city:city,province:province,wards:wards,fee_ship:fee_ship,_token:_token},
                success:function (data){
                    alert('Thêm phí vận chuyển thành công')
                    location.reload();
                    // fetch_delivery();
                }
            })

        });
        $('.choose').on('change',function (){
            var action = $(this).attr('id');
            var ma_id = $(this).val();
            var _token = $('input[name="_token"]').val();
            var result = '';
            // alert(action)
            // alert(matp)
            // alert(_token)
            if (action=='city'){
                result = 'province';
            }else {
                result = 'wards';
            }
            $.ajax({
                url : '{{url('/admin/select-delivery')}}',
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
        load_gallery()
        function load_gallery(){
            var product_id = $('.product_id').val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url : '{{url('/admin/select-gallery')}}',
                method : 'POST',
                data : {product_id:product_id,_token:_token},
                success:function (data){
                    $('#gallery_load').html(data);
                }
            })
        }

        $('#file').change(function (){
            var error = '';
            var files = $('#file')[0].files;
            if (files.length>5){
                error += '<p>Chọn tối đa 5 ảnh.</p>'
            }else if(files.length=='') {
                error += '<p>Không thể bỏ trống trường này.</p>'
            }else if(files.size > 2000000) {
                error += '<p>File ảnh không được lớn hơn 2MB.</p>'
            }

            if (error==''){

            }else {
                $('#file').val('');
                $('#error_gallery').html('<span class="text-danger">'+error+'</span>')
                return false;
            }
        })

        $(document).on('blur','.edit_gallery_name',function (){
            var gal_id = $(this).data('gal_id');
            var gal_text = $(this).text();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url : '{{url('/admin/update-gallery-name')}}',
                method : 'POST',
                data : {gal_id:gal_id,gal_text:gal_text,_token:_token},
                success:function (data){
                    load_gallery()
                    $('#error_gallery').html('<span class="text-danger">Cập nhật tên hình ảnh thành công</span>');
                }
            })
        })

        $(document).on('click','.delete-gallery',function (){
            var gal_id = $(this).data('gal_id');
            var _token = $('input[name="_token"]').val();
            if (confirm('Bạn có muốn xóa hình ảnh này không')){
                $.ajax({
                    url : '{{url('/admin/delete-gallery')}}',
                    method : 'POST',
                    data : {gal_id:gal_id,_token:_token},
                    success:function (data){
                        load_gallery()
                        $('#error_gallery').html('<span class="text-danger">Xóa hình ảnh thành công</span>');
                    }
                })
            }

        })

        $(document).on('change','.file_image',function (){
            var gal_id = $(this).data('gal_id');
            var image = document.getElementById('file'+gal_id).files[0];

            var form_data = new FormData();
            form_data.append("file",document.getElementById('file'+gal_id).files[0]);
            form_data.append("gal_id",gal_id);

            if (confirm('Bạn có muốn xóa hình ảnh này không')){
                $.ajax({
                    url : '{{url('/admin/delete-gallery')}}',
                    method : 'POST',
                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data : {form_data},
                    contentType:false,
                    cache:false,
                    processData:false,
                    success:function (data){
                        load_gallery()
                        $('#error_gallery').html('<span class="text-danger">Xóa hình ảnh thành công</span>');
                    }
                })
            }

        })
    })
</script>

<script type="text/javascript">
    $('.comment-status').click(function (){
        var comment_status = $(this).data('comment_status');
        var comment_id = $(this).data('comment_id');
        var product_id = $(this).attr('id');
        $.ajax({
            url : '{{url('/comment-status')}}',
            method : 'POST',
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data : {comment_status:comment_status,comment_id:comment_id,product_id:product_id},
            success:function (data){
                location.reload()
                $('#notify_comment').html('<span class="text text-primary">Thay đổi trạng thái bình luận thành công</span>')
            }
        })
    })
    $('.btn-reply-comment').click(function (){
        var comment_id = $(this).data('comment_id');
        var comment = $('.reply_comment_'+comment_id).val();

        var product_id = $(this).data('product_id');

        $.ajax({
            url : '{{url('/reply-comment')}}',
            method : 'POST',
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data : {comment:comment,comment_id:comment_id,product_id:product_id},
            success:function (data){
                location.reload()
                $('#notify_comment').html('<span class="text text-primary">Trả lời bình luận thành công</span>')
                $('.reply-comment').val('');
            }
        })
    })
</script>

<script type="text/javascript">
    $( function() {
        $("#datepicker" ).datepicker({
            prevText:"Tháng trước",
            nextText:"Tháng sau",
            dateFormat: "yy-mm-dd",
            dayNamesMin: [ "Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7", "Chủ Nhật"],
            duration: "slow"
        });
        $("#datepicker2" ).datepicker({
            prevText:"Tháng trước",
            nextText:"Tháng sau",
            dateFormat: "yy-mm-dd",
            dayNamesMin: [ "Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7", "Chủ Nhật"],
            duration: "slow"
        });
    } );
</script>

<script type="text/javascript">
    $(document).ready(function (){
        chart30daysorder();

        var chart =  new Morris.Bar({
            element: 'myfirstchart',

            lineColors: ['#819C79', '#fc8710', '#ff6541', '#a4add3', '#766856'],
            // pointFillColors: ['#ffffff'],
            // pointStrokeColors: ['black'],
            fillOpacity: 0.6,
            hideHover: 'auto',
            parseTime: false,
            xkey: 'period',
            ykeys: ['order','sales','profit','quantity'],
            labels: ['Đơn hàng', 'Doanh số','Lợi nhuận', 'Số lượng'],
        });

        function chart30daysorder(){
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url : '{{url('/days-order')}}',
                method : 'POST',
                dataType: 'JSON',
                data : {_token:_token},
                success:function (data){
                    chart.setData(data)
                }
            })
        }

        $('.dashboard-filter').change(function (){
            var dashboard_value = $(this).val()
            var _token = $('input[name="_token"]').val();

            $.ajax({
                url : '{{url('/dashboard-filter')}}',
                method : 'POST',
                dataType: 'JSON',
                data : {dashboard_value:dashboard_value,_token:_token},
                success:function (data){
                    chart.setData(data)
                }
            })
        })

        $('#btn-dashboard-filter').click(function (){
            var _token = $('input[name="_token"]').val();
            var from_date = $('#datepicker').val();
            var to_date = $('#datepicker2').val();

            $.ajax({
                url : '{{url('/filter-by-date')}}',
                method : 'POST',
                dataType: 'JSON',
                data : {from_date:from_date,to_date:to_date,_token:_token},
                success:function (data){
                    chart.setData(data)
                }
            })
        })
    })
</script>

<script type="text/javascript">

    var colorDanger = "#FF1744";
    Morris.Donut({
        element: 'donut-example',
        resize: true,
        colors: [
            '#fc95e4',
            '#b2f7ce',
            '#80DEEA',
            '#4DD0E1',
            '#26C6DA',
            '#00BCD4',
            '#00ACC1',
            '#0097A7',
            '#00838F',
            '#006064'
        ],
        //labelColor:"#cccccc", // text color
        //backgroundColor: '#333333', // border color
        data: [
            {label:"Sản phẩm", value:<?php echo $product_count ?>},
            {label:"Danh mục", value:<?php echo $category_count ?>},
            {label:"Khách hàng", value:<?php echo $user_count ?>},
            {label:"Đơn hàng", value:<?php echo $order_count ?>},
        ]
    });

</script>
<!-- //calendar -->
</body>
</html>
