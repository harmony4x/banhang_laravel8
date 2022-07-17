@extends('admin.layout.master')
@section('content')

    <div class="row">
        <div class="col-lg-12">
            <section class="">
                <header class="panel-heading">
                    Thêm sản phẩm
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
                        <form role="form" method="POST" action="{{route('product.store')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên sản phẩm</label>
                                <input type="text" class="form-control" id="slug" placeholder="Tên sản phẩm..." value="{{old('name')}}" name="name" onkeyup="ChangeToSlug()">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Slug sản phẩm</label>
                                <input type="text" class="form-control" id="convert_slug" placeholder="" value="{{old('slug')}}" name="slug">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Số lượng sản phẩm</label>
                                <input type="text" class="form-control" id="quantity" placeholder="Số lượng sản phẩm..." value="{{old('quantity')}}" name="quantity">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Chi tiết sản phẩm</label>
                                <textarea style="resize: none" name="content" id="content" cols="30" rows="10" class="form-control" >{{old('content')}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Giá nhập sản phẩm</label>
                                <input type="text" class="form-control"  placeholder="" value="{{old('cost')}}" name="cost">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Giá bán sản phẩm</label>
                                <input type="text" class="form-control"  placeholder="" value="{{old('price')}}" name="price">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Giảm giá</label>
                                <input type="text" class="form-control"  placeholder="" value="{{old('discount')}}" name="discount">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Hình ảnh sản phẩm</label>
                                <input type="file" class="form-control"  placeholder="" name="image">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Danh mục sản phẩm</label>
                                <select class="form-control m-bot15" name="category_id">
                                    @foreach($category as $key => $cate)
                                    <option value="{{$cate->id}}">{{$cate->name}}</option>
                                    @endforeach
                                </select>
                            </div>
{{--                            <div class="form-group">--}}
{{--                                <label for="exampleInputPassword1">Thương hiệu sản phẩm</label>--}}
{{--                                <select class="form-control m-bot15" name="brand_id">--}}
{{--                                    @foreach($brands as $key => $brand)--}}
{{--                                        <option value="{{$brand->id}}">{{$brand->name}}</option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                            </div>--}}
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
