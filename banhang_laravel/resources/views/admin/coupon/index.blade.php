@extends('admin.layout.master')

@section('content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Danh mục mã giảm giá
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
                        <th>Tên mã giảm giá</th>
                        <th>Mã giảm giá</th>
                        <th>Tính năng mã</th>
                        <th>Số lượng</th>
                        <th>% hoặc tiền</th>
                        <th>Trạng thái</th>
                        <th style="width:30px;"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $i=1; @endphp
                    @foreach($coupons as $key => $coupon)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$coupon->coupon_name}}</td>
                            <td><span class="text-ellipsis">{{$coupon->coupon_code}}</span></td>
                            <td>
                                @if($coupon->coupon_condition==1)
                                    <span class="text-ellipsis">Giảm theo %</span>
                                @else
                                    <span class="text-ellipsis">Giảm theo giá tiền</span>
                                @endif
                            </td>
                            <td>{{$coupon->coupon_quantity}}</td>
                            <td>
                                @if($coupon->coupon_number>100)
                                    <span class="text-ellipsis">{{number_format($coupon->coupon_number)}} <sup>VND</sup></span>
                                @else
                                    <span class="text-ellipsis">{{$coupon->coupon_number}}%</span>
                                @endif
                            </td>
                            <td>
                                <select name="coupon_status" class="form-control coupon_status">

                                    @if($coupon->status==0)
                                        <option data-coupon_id={{$coupon->id}} selected value="0">Ẩn</option>
                                        <option data-coupon_id={{$coupon->id}} value="1">Hiển thị</option>
                                    @else
                                        <option data-coupon_id={{$coupon->id}}  value="0">Ẩn</option>
                                        <option data-coupon_id={{$coupon->id}} selected value="1">Hiển thị</option>
                                    @endif
                                </select>

                            </td>
                            <td>
                                <a href="{{route('coupon.edit',$coupon->id)}}" class="active" ui-toggle-class=""><i class="fa fa-edit text-success text-active"></i></a>
                                <form action="{{route('coupon.destroy',$coupon->id)}}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button onclick="return confirm('Bạn có muốn xóa hay không?');" style="background: none; border: none; padding: 0"><i class="fa fa-trash text-danger text"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>


@endsection
