@extends('admin.layout.master')

@section('content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Thông tin vận chuyển
            </div>
            @if(session('message'))
                <div class="alert">
                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                    <strong>{{session('message')}}</strong>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-striped b-t b-light">
                    <thead>
                    <tr>

                        <th>Tên khách hàng</th>
                        <th>Email</th>
                        <th>Số điện thoại</th>
                        <th>Địa chỉ</th>
                        <th>Ghi chú</th>
                        <th>Phương thức thanh toán</th>
                        <th>Trạng thái đơn hàng</th>
                        <th>In đơn hàng</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($shipping as $key => $ship)
                        <tr>
                            <td>{{$ship->shipping_name}}</td>
                            <td><span class="text-ellipsis">{{$ship->shipping_email}}</span></td>
                            <td>{{$ship->shipping_phone}}</td>
                            <td>{{$ship->shipping_address}}</td>
                            <td>{{$ship->shipping_note}}</td>
                            <td>@if($ship->shipping_method==0) Tiền mặt @else Chuyển khoản @endif</td>
                            <td>
                                <select name="order_status" class="form-control order_status">

                                    @if($order->order_status==0)
                                        <option data-order_id={{$order->id}} selected value="0">Đơn hàng mới</option>
                                        <option data-order_id={{$order->id}} value="1">Thành công</option>
                                        <option data-order_id={{$order->id}} value="2">Đã hủy</option>
                                        <option data-order_id={{$order->id}} value="3">Đang xử lý</option>
                                    @elseif($order->order_status==1)
                                        <option data-order_id={{$order->id}} disabled value="0">Đơn hàng mới</option>
                                        <option data-order_id={{$order->id}} disabled selected value="1">Thành công</option>
                                        <option data-order_id={{$order->id}} disabled value="2">Đã hủy</option>
                                        <option data-order_id={{$order->id}} disabled value="3">Đang xử lý</option>
                                    @elseif($order->order_status==3)
                                        <option data-order_id={{$order->id}} disabled value="0">Đơn hàng mới</option>
                                        <option data-order_id={{$order->id}}   value="1">Thành công</option>
                                        <option data-order_id={{$order->id}}  value="2">Đã hủy</option>
                                        <option data-order_id={{$order->id}} selected value="3">Đang xử lý</option>
                                    @else
                                        <option data-order_id={{$order->id}} disabled disabled value="0">Đơn hàng mới</option>
                                        <option data-order_id={{$order->id}} disabled  value="1">Thành công</option>
                                        <option data-order_id={{$order->id}} disabled selected value="2">Đã hủy</option>
                                        <option data-order_id={{$order->id}} disabled value="3">Đang xử lý</option>
                                    @endif
                                </select>
                            </td>
                            <td style="text-align: center"><a target="_blank" href="{{route('admin.print_details',$order_code)}}"><i class="fa fa-file-excel-o" style=" font-size: 24px"></i></a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>


        </div>
    </div>




    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Chi tiết đặt hàng
            </div>
            @if(session('message'))
                <div class="alert">
                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                    <strong>{{session('message')}}</strong>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-striped b-t b-light">
                    <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên sản phẩm</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Tổng</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php
                        $i=1;
                        $subtotal = 0;
                    @endphp
                    @foreach($order_details as $key => $order_detai)
                        @php
                            $subtotal += $order_detai->product_quantity*$order_detai->product_price
                        @endphp
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$order_detai->product_name}}</td>

                            <td>{{number_format($order_detai->product_price)}} VNĐ</td>
                            <td>
                                {{$order_detai->product_quantity}}
                                <input type="hidden" value="{{$order_detai->product_quantity}}" name="product_quantity" class="order_qty_{{$order_detai->product_id}}">
                                <input type="hidden" value="{{$order_detai->product_id}}" name="order_product_id" class="order_product_id">
                                <input type="hidden" value="{{$order_detai->product->quantity}}" class="order_qty_storage_{{$order_detai->product_id}}">
                            </td>
                            <td>{{number_format($order_detai->product_quantity*$order_detai->product_price)}} VNĐ</td>

                        </tr>
                    @endforeach
                    <tr >
                        @if($order_coupon!=0)
                            @if($coupon_condition==2)
                                @php $total_coupon = $coupon_number @endphp
                                <td colspan="1" >Mã giảm giá: {{$order_coupon}} VNĐ</td>
                                <td colspan="4" >Giảm giá: {{number_format($total_coupon)}} VNĐ</td>
                                <input type="hidden" class="coupon_price" name="coupon_price" value="{{$total_coupon}}">
                            @else
                                @php $total_coupon = $subtotal*$coupon_number/100 @endphp
                                <td colspan="1" >Mã giảm giá: {{$order_coupon}}</td>
                                <td colspan="4" >Giảm giá: {{number_format($total_coupon)}} VNĐ</td>

                            @endif
                        @else
                                @php $total_coupon = 0 @endphp
                                <td colspan="5" >Mã giảm giá: Không</td>
                        @endif
                        <input type="hidden" class="coupon_price" name="coupon_price" value="{{$total_coupon}}">
                    </tr>
                    <tr >
                        <td colspan="5">Phí vận chuyển: {{number_format($order_feeship)}} VNĐ</td>
                    </tr>
                    <tr >
                        @php $total = $subtotal - $total_coupon + $order_feeship @endphp
                        <td colspan="5" style="text-align: center; color: red">Thanh toán: {{number_format($total)}} VNĐ</td>
                    </tr>
                    </tbody>
                </table>
            </div>


        </div>
    </div>


@endsection
