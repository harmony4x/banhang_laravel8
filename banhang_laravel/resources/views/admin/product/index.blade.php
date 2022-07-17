@extends('admin.layout.master')

@section('content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Sản phẩm
            </div>
            @if(session('message'))
                <div class="alert">
                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                    <strong>{{session('message')}}</strong>
                </div>
            @endif
                        <div class="row w3-res-tb">
                            {{--import data excel--}}
                            <form action="{{route('import-csv')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="col-sm-4">
                                        <input class="form-control" type="file" name="file" accept=".xlsx"><br>
                                </div>
                                <div class="col-sm-2">
                                    <input type="submit" value="Import Excel" name="import_csv" class="btn btn-primary">
                                </div>
                            </form>
                            <div class="col-sm-3">
                            {{--export data excel--}}
                                <form action="{{route('export-csv')}}" method="POST">
                                    @csrf
                                    <input type="submit" value="Export Excel" name="export_csv" class="btn btn-success">
                                </form>
                            </div>
                            <div class="col-sm-3">
                                <div class="input-group" style="width: 100%">
                                    <form action="" method="GET">
                                        <input type="text" class="input-sm form-control" placeholder="Search" name="keyword" style="width: 70%; margin-right: 5px">
                                        <button class="btn btn-sm btn-default" type="submit">Tìm kiếm</button>
                                    </form>

                                </div>
                            </div>
                        </div>
            <div class="table-responsive">
                <table class="table table-striped b-t b-light">
                    <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên sản phẩm</th>
                        <th>Slug sản phẩm</th>
                        <th>Số lượng sản phẩm</th>
                        <th>Chi tiết sản phẩm</th>
                        <th>Giá sản phẩm</th>
                        <th>Giảm giá</th>
                        <th>Hình ảnh</th>
                        <th>Thư viện ảnh</th>
                        <th>Danh mục</th>
                        <th>Lượt xem</th>
                        <th>Đã bán</th>
{{--                        <th>Thương hiệu</th>--}}
                        <th>Trạng thái</th>
                        <th style="width:30px;"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $i=1; @endphp
                    @foreach($products as $key => $product)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$product->name}}</td>
                            <td><span class="text-ellipsis">{{Str::limit($product->slug,5)}}</span></td>
                            <td>{{$product->quantity}}</td>
                            <td>{!! Str::limit($product->content,30) !!}</td>
                            <td>{{number_format($product->price)}}</td>
                            <td>{{$product->discount}}%</td>
                            <td><img style="width: 70px;" src="{{asset('uploads/product/'.$product->image)}}" alt=""></td>
                            <td><a href="{{route('admin.create_gallery',$product->id)}}"><i class="fa fa-image"></i></a></td>
                            <td>{{$product->category->name}}</td>
                            <td>{{$product->view}}</td>
                            <td>{{$product->quantity_sold}}</td>
{{--                            <td>{{$product->brand->name}}</td>--}}
                            <td>

                                <select name="product_status" class="form-control product_status">

                                    @if($product->status==0)
                                        <option data-product_id={{$product->id}} selected value="0">Ẩn</option>
                                        <option data-product_id={{$product->id}} value="1">Hiển thị</option>
                                    @else
                                        <option data-product_id={{$product->id}}  value="0">Ẩn</option>
                                        <option data-product_id={{$product->id}} selected value="1">Hiển thị</option>
                                    @endif
                                </select>

                            </td>
                            <td>
                                <a href="{{route('product.edit',$product->id)}}" class="active" ui-toggle-class=""><i class="fa fa-edit text-success text-active"></i></a>
                                <form action="{{route('product.destroy',$product->id)}}" method="POST">
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
