@extends('admin.layout.master')
@section('content')
    <div class="container-fluid">
        <style type="text/css">
            .title_thongke{
                text-align: center;
                font-size: 20px;
                font-weight: bold;
            }
            #ui-datepicker-div {
                top: 180px  !important;

            }
        </style>
        <div class="row">
            <p class="title_thongke">Thống kê đơn hàng doanh số</p>
            <form autocomplete="off">
                @csrf
                <div class="col-md-2">
                    <p>Từ ngày: <input type="text" id="datepicker" class="form-control"></p>

                </div>
                <div class="col-md-2">
                    <p>Đến ngày: <input type="text" id="datepicker2" class="form-control"></p>
                </div>
                <div class="col-md-2">
                    <p>Lọc theo:
                        <select class="dashboard-filter form-control">
                            <option disabled selected>--Chọn--</option>
                            <option value="7ngay">7 ngày qua</option>
                            <option value="thangtruoc">Tháng trước</option>
                            <option value="thangnay">Tháng này</option>
                            <option value="365ngay">365 ngày</option>
                        </select>
                    </p>
                </div>
                <div class="col-md-2">
                    <input style="margin-top: 22px" type="button" id="btn-dashboard-filter" class="btn btn-primary btn-sm" value="Lọc kết quả">
                </div>
            </form>

            <div class="col-md-12">
                <div id="myfirstchart" style="height: 250px"></div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <p class="title_thongke" >Thống kê tất cả</p>
                <div id="donut-example" class="morris-donut-inverse"></div>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-4">
                <p class="title_thongke" style="margin-bottom: 20px;">Sản phẩm xem nhiều</p>
                <ol class="list-view">
                    @foreach($product_views as $key => $product_view)
                    <li>
                        <a style="color: black" target="_blank" href="{{route('detail',$product_view->slug)}}">{{$product_view->name}}</a>
                        | {{$product_view->view}}
                    </li>
                    @endforeach
                </ol>
            </div>
            <div class="col-md-4">
                <p class="title_thongke" style="margin-bottom: 20px;">Sản phẩm bán chạy</p>
                <ol class="list-view">
                    @foreach($product_sales as $key => $product_sale)
                        <li>
                            <a style="color: black" target="_blank" href="{{route('detail',$product_sale->slug)}}">{{$product_sale->name}}</a>
                            | {{$product_sale->quantity_sold}}
                        </li>
                    @endforeach
                </ol>
            </div>
        </div>

{{--        <div class="row">--}}
{{--            <style type="text/css">--}}
{{--                .table-dark{--}}
{{--                    background: #f2dddd;--}}
{{--                }--}}
{{--                .table-dark tr th{--}}
{{--                    color: #ddd;--}}
{{--                }--}}
{{--            </style>--}}
{{--            <p class="title_thongke">Thống kê truy cập</p>--}}
{{--            <table class="table table-bordered table-dark">--}}
{{--                <thead>--}}
{{--                <tr>--}}
{{--                    <th scope="col">Đang online</th>--}}
{{--                    <th scope="col">Tổng tháng trước</th>--}}
{{--                    <th scope="col">Tổng tháng này</th>--}}
{{--                    <th scope="col">Tổng năm nay</th>--}}
{{--                    <th scope="col">Tổng truy cập</th>--}}
{{--                </tr>--}}
{{--                </thead>--}}
{{--                <tbody>--}}
{{--                <tr>--}}
{{--                    <td>{{$visitor_count}}</td>--}}
{{--                    <td>{{$visitor_last_month_count}}</td>--}}
{{--                    <td>{{$visitor_this_month_count}}</td>--}}
{{--                    <td>{{$visitor_of_year_count}}</td>--}}
{{--                    <td>{{$visitor_total}}</td>--}}

{{--                </tr>--}}
{{--                </tbody>--}}
{{--            </table>--}}
{{--        </div>--}}
    </div>

@endsection
