@extends('admin.layout.master')
@section('content')

    <div class="row">
        <div class="col-lg-12">
            <section class="">
                <header class="panel-heading">
                    Cập nhật sản phẩm
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
                        <form role="form" method="POST" action="{{route('product.update',$product->id)}}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên sản phẩm</label>
                                <input type="text" class="form-control" id="slug" placeholder="Tên danh mục..." value="{{$product->name}}" name="name" onkeyup="ChangeToSlug()">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Slug sản phẩm</label>
                                <input type="text" class="form-control" id="convert_slug" placeholder="" value="{{$product->slug}}" name="slug">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Số lượng trong kho</label>
                                <input type="text" class="form-control" id="slug" value="{{$product->quantity}}" name="quantity" disabled>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Chi tiết sản phẩm</label>
                                <textarea style="resize: none" name="content" id="content" cols="30" rows="10" class="form-control" >{{$product->content}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Giá sản phẩm</label>
                                <input type="text" class="form-control"  placeholder="" value="{{$product->price}}" name="price" disabled>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Giảm giá</label>
                                <input type="text" class="form-control"  placeholder="" value="{{$product->discount}}" name="discount">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Hình ảnh sản phẩm</label>
                                <input type="file" class="form-control"  placeholder="" name="image">
                                <img style="width: 120px;" src="{{asset('uploads/product/'.$product->image)}}" alt="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Danh mục sản phẩm</label>
                                <select class="form-control m-bot15" name="category_id">
                                    @foreach($category as $key => $cate)
                                        @if($cate->id == $product->category_id)
                                            <option selected value="{{$cate->id}}">{{$cate->name}}</option>
                                        @else
                                            <option value="{{$cate->id}}">{{$cate->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
{{--                            <div class="form-group">--}}
{{--                                <label for="exampleInputPassword1">Thương hiệu sản phẩm</label>--}}
{{--                                <select class="form-control m-bot15" name="brand_id">--}}
{{--                                    @foreach($brands as $key => $brand)--}}
{{--                                        @if($brand->id == $product->brand_id)--}}
{{--                                            <option selected value="{{$brand->id}}">{{$brand->name}}</option>--}}
{{--                                        @else--}}
{{--                                            <option value="{{$brand->id}}">{{$brand->name}}</option>--}}
{{--                                        @endif--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                            </div>--}}
                            <div class="form-group">
                                <label for="exampleInputPassword1">Trạng thái</label>
                                <select class="form-control m-bot15" name="status">
                                    @if($product->status==1)
                                        <option selected value="1">Kích hoạt</option>
                                        <option value="0">Không</option>
                                    @else
                                        <option  value="1">Kích hoạt</option>
                                        <option selected value="0">Không</option>
                                    @endif
                                </select>
                            </div>

                            <button type="submit" class="btn btn-info">Cập nhật</button>
                        </form>
                    </div>

                </div>


                <div class="table-agile-info">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Thông tin xuất nhập sản phẩm
                        </div>


                        <div class="table-responsive">
                            <table class="table table-striped b-t b-light ">
                                <thead>
                                <tr>
                                    <?php
                                    $i=1;
                                    ?>
                                    <th>#</th>
                                    <th>Giá nhập</th>
                                    <th>Giá bán</th>
                                    <th>Số lượng nhập</th>
                                    <th>Ngày nhập hàng</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($product_prices as $pr => $product_price)
                                    <tr>
                                        <td><?php echo $i++?></td>
                                        <td>{{number_format($product_price->cost)}}</td>
                                        <td>{{number_format($product_price->price)}}</td>
                                        <td>{{$product_price->quantity}}</td>
                                        <td>{{$product_price->order_date}}</td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>


                    </div>
                </div>
                <a class="btn btn-success" href="{{route('admin.create_product_price',$product->id)}}">Nhập hàng</a>
                <a class="btn btn-success" href="{{route('admin.edit_product_price',$product->id)}}">Cập nhật giá sản phẩm</a>
            </section>

        </div>

    </div>
@endsection
