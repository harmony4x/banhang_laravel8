@extends('admin.layout.master')
@section('content')

    <div class="row">
        <div class="col-lg-12">
            <section class="">
                <header class="panel-heading">
                    Thêm danh mục
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
                        <form role="form" method="POST" action="{{route('category.store')}}">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên danh mục</label>
                                <input type="text" class="form-control" id="slug" placeholder="Tên danh mục..." value="{{old('name')}}" name="name" onkeyup="ChangeToSlug()">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Slug danh mục</label>
                                <input type="text" class="form-control" id="convert_slug" placeholder="" value="{{old('slug')}}" name="slug">
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
