@extends('admin.layout.master')
@section('content')

    <div class="row">
        <div class="col-lg-12">
            <section class="">
                <header class="panel-heading">
                    Cập nhật mã giảm giá
                </header>
                @if ($errors->any())
                    <div class="alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if(session('message'))
                    <div class="alert">
                        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                        <strong>{{session('message')}}</strong>
                    </div>
                @endif
                <div class="panel-body">
                    <div class="position-center">
                        <form role="form" method="POST" action="{{route('coupon.update',$coupon->id)}}">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên mã giảm giá</label>
                                <input type="text" class="form-control"  placeholder="Tên mã giảm giá..." value="{{$coupon->coupon_name}}" name="coupon_name" >
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Mã giảm giá</label>
                                <input type="text" class="form-control"  placeholder="Mã giảm giá..." value="{{$coupon->coupon_code}}" name="coupon_code" >
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Số lượng</label>
                                <input type="text" class="form-control"  placeholder="Mã giảm giá..." value="{{$coupon->coupon_quantity}}" name="coupon_quantity" >
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Tính năng</label>
                                <select class="form-control m-bot15" name="coupon_condition">
                                    @if($coupon->coupon_condition==1)
                                        <option selected value="1">Giảm theo %</option>
                                        <option value="2">Giảm theo giá tiền</option>
                                    @else
                                        <option  value="1">Giảm theo %</option>
                                        <option selected value="2">Giảm theo giá tiền</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Nhập số tiền hoặc %</label>
                                <input type="text" class="form-control" placeholder="" value="{{$coupon->coupon_number}}" name="coupon_number">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Trạng thái</label>
                                <select class="form-control m-bot15" name="status">
                                    @if($coupon->status==0)
                                        <option  selected value="0">Ẩn</option>
                                        <option value="1">Hiển thị</option>
                                    @else
                                        <option  value="0">Ẩn</option>
                                        <option  selected value="1">Hiển thị</option>
                                    @endif
                                </select>
                            </div>

                            <button type="submit" class="btn btn-info">Cập nhật</button>
                        </form>
                    </div>

                </div>
            </section>

        </div>

    </div>
@endsection
