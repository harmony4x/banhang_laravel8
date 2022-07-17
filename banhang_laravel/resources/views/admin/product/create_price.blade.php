@extends('admin.layout.master')
@section('content')

    <div class="row">
        <div class="col-lg-12">
            <section class="">
                <header class="panel-heading">
                    Nhập sản phẩm
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
                        <form role="form" method="POST" action="{{route('product_price.store',$product->id)}}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên sản phẩm</label>
                                <input type="text" class="form-control" id="slug" placeholder="Tên sản phẩm..." disabled value="{{$product->name}}" name="name" onkeyup="ChangeToSlug()">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Giá nhập sản phẩm</label>
                                <input type="text" class="form-control"  placeholder="Giá nhập sản phẩm" value="{{old('cost')}}" name="cost">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Giá bán sản phẩm</label>
                                <input type="text" class="form-control"  placeholder="" value="{{$product->price}}" name="price">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Số lượng sản phẩm</label>
                                <input type="text" class="form-control" id="quantity" placeholder="Số lượng sản phẩm..." value="{{old('quantity')}}" name="quantity">
                            </div>
                            <button type="submit" class="btn btn-info">Thêm mới</button>
                        </form>
                    </div>

                </div>
            </section>

        </div>

    </div>
@endsection
