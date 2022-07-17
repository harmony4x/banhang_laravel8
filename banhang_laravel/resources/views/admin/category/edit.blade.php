@extends('admin.layout.master')
@section('content')

    <div class="row">
        <div class="col-lg-12">
            <section class="">
                <header class="panel-heading">
                    Cập nhật danh mục
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
                        <form role="form" method="POST" action="{{route('category.update',$category->id)}}">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên danh mục</label>
                                <input type="text" class="form-control" id="slug" placeholder="Tên danh mục..." value="{{$category->name}}" name="name" onkeyup="ChangeToSlug()">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Slug danh mục</label>
                                <input type="text" class="form-control" id="convert_slug" placeholder="" value="{{$category->slug}}" name="slug">
                            </div>
                            <div class="form-group">
                                <select class="form-control m-bot15" name="status">
                                    <label for="exampleInputPassword1">Trạng thái</label>
                                    @if($category->status==1)
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
            </section>

        </div>

    </div>
@endsection
