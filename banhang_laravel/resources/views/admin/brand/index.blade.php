@extends('admin.layout.master')

@section('content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Thương hiệu sản phẩm
            </div>
            @if(session('message'))
                <div class="alert">
                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                    <strong>{{session('message')}}</strong>
                </div>
            @endif
            {{--            <div class="row w3-res-tb">--}}
            {{--                <div class="col-sm-5">--}}
            {{--                </div>--}}
            {{--                <div class="col-sm-4">--}}
            {{--                </div>--}}
            {{--                <div class="col-sm-3">--}}
            {{--                    <div class="input-group" style="width: 100%">--}}
            {{--                        <form action="" method="GET">--}}
            {{--                            <input type="text" class="input-sm form-control" placeholder="Search" name="keyword" style="width: 70%; margin-right: 5px">--}}
            {{--                            <button class="btn btn-sm btn-default" type="submit">Tìm kiếm</button>--}}
            {{--                        </form>--}}

            {{--                    </div>--}}
            {{--                </div>--}}
            {{--            </div>--}}
            <div class="table-responsive">
                <table class="table table-striped b-t b-light">
                    <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên thương hiệu</th>
                        <th>Slug thương hiệu</th>
                        <th>Mô tả thương hiệu</th>
                        <th>Hình ảnh</th>
                        <th>Trạng thái</th>
                        <th style="width:30px;"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $i=1; @endphp
                    @foreach($brands as $key => $brand)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$brand->name}}</td>
                            <td><span class="text-ellipsis">{{$brand->slug}}</span></td>
                            <td>{{$brand->description}}</td>
                            <td><img style="width: 70px;" src="{{asset('uploads/brand/'.$brand->image)}}" alt=""></td>
                            <td>
                                <select name="brand_status" class="form-control brand_status">

                                    @if($brand->status==0)
                                        <option data-brand_id={{$brand->id}} selected value="0">Ẩn</option>
                                        <option data-brand_id={{$brand->id}} value="1">Hiển thị</option>
                                    @else
                                        <option data-brand_id={{$brand->id}}  value="0">Ẩn</option>
                                        <option data-brand_id={{$brand->id}} selected value="1">Hiển thị</option>
                                    @endif
                                </select>

                            </td>
                            <td>
                                <a href="{{route('brand.edit',$brand->id)}}" class="active" ui-toggle-class=""><i class="fa fa-edit text-success text-active"></i></a>
                                <form action="{{route('brand.destroy',$brand->id)}}" method="POST">
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
            {{--            <footer class="panel-footer">--}}
            {{--                <div class="row">--}}

            {{--                    <div class="col-sm-5 text-center">--}}
            {{--                        <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>--}}
            {{--                    </div>--}}
            {{--                    <div class="col-sm-7 text-right text-center-xs">--}}
            {{--                        <ul class="pagination pagination-sm m-t-none m-b-none">--}}
            {{--                            <li><a href=""><i class="fa fa-chevron-left"></i></a></li>--}}
            {{--                            <li><a href="">1</a></li>--}}
            {{--                            <li><a href="">2</a></li>--}}
            {{--                            <li><a href="">3</a></li>--}}
            {{--                            <li><a href="">4</a></li>--}}
            {{--                            <li><a href=""><i class="fa fa-chevron-right"></i></a></li>--}}
            {{--                        </ul>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--            </footer>--}}
        </div>
    </div>


@endsection
