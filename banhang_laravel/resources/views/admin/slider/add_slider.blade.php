@extends('admin.layout.master')
@section('content')

    <div class="row">
        <div class="col-lg-12">
            <section class="">
                <header class="panel-heading">
                    Thêm slider
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
                        <form role="form" method="POST" action="{{route('slider.store')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên slider</label>
                                <input type="text" class="form-control" id="slug" placeholder="Tên slider..." value="{{old('name')}}" name="name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Mô tả</label>
                                <input type="text" class="form-control"  placeholder="Mô tả slider..." value="{{old('desc')}}" name="desc">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Hình ảnh slider</label>
                                <input type="file" class="form-control"  placeholder="" name="image">
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
