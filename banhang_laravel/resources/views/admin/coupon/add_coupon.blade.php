@extends('admin.layout.master')
@section('content')

    <div class="row">
        <div class="col-lg-12">
            <section class="">
                <header class="panel-heading">
                    Thêm mã giảm giá
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
                        <form role="form" method="POST" action="{{route('coupon.store')}}">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên mã giảm giá</label>
                                <input type="text" class="form-control"  placeholder="Tên mã giảm giá..." value="{{old('coupon_name')}}" name="coupon_name" >
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Mã giảm giá</label>
                                <input type="text" class="form-control"  placeholder="Mã giảm giá..." value="{{old('coupon_code')}}" name="coupon_code" >
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Số lượng</label>
                                <input type="text" class="form-control"  placeholder="Mã giảm giá..." value="{{old('coupon_code')}}" name="coupon_quantity" >
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Tính năng</label>
                                <select class="form-control m-bot15" name="coupon_condition">
                                    <option disabled selected >----Chọn----</option>
                                    <option value="1">Giảm theo %</option>
                                    <option value="2">Giảm theo giá tiền</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Nhập số tiền hoặc %</label>
                                <input type="text" class="form-control" placeholder="" value="{{old('coupon_number')}}" name="coupon_number">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Trạng thái</label>
                                <select class="form-control m-bot15" name="status">
                                    <option value="1">Kích hoạt</option>
                                    <option value="0">Không</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-info">Thêm mới</button>
                        </form>
                    </div>

                </div>
            </section>

        </div>

    </div>
@endsection
