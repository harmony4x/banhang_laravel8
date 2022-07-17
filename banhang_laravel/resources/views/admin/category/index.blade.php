@extends('admin.layout.master')

@section('content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Danh mục sản phẩm
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
                        <th>Tên danh mục</th>
                        <th>Slug danh mục</th>
                        <th>Trạng thái</th>
                        <th style="width:30px;"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $i=1; @endphp
                    @foreach($category as $key => $cate)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$cate->name}}</td>
                        <td><span class="text-ellipsis">{{$cate->slug}}</span></td>
                        <td>
                            <select name="category_status" class="form-control category_status">

                                @if($cate->status==0)
                                    <option data-category_id={{$cate->id}} selected value="0">Ẩn</option>
                                    <option data-category_id={{$cate->id}} value="1">Hiển thị</option>
                                @else
                                    <option data-category_id={{$cate->id}}  value="0">Ẩn</option>
                                    <option data-category_id={{$cate->id}} selected value="1">Hiển thị</option>
                                @endif
                            </select>

                        </td>
                        <td>
                            <a href="{{route('category.edit',$cate->id)}}" class="active" ui-toggle-class=""><i class="fa fa-edit text-success text-active"></i></a>
                            <form action="{{route('category.destroy',$cate->id)}}" method="POST">
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
