@extends('admin.layout.master')
@section('content')

    <div class="row">
        <div class="col-lg-12">
            <section class="">
                <header class="panel-heading">
                    Cập nhật thương hiệu
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
                        <form role="form" method="POST" action="{{route('brand.update',$brand->id)}}" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên thương hiệu</label>
                                <input type="text" class="form-control" id="slug" placeholder="Tên danh mục..." value="{{$brand->name}}" name="name" onkeyup="ChangeToSlug()">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Slug thương hiệu</label>
                                <input type="text" class="form-control" id="convert_slug" placeholder="" value="{{$brand->slug}}" name="slug">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Mô tả thương hiệu</label>
                                <textarea style="resize: none" name="description" id="" cols="30" rows="10" class="form-control" >{{$brand->description}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Hình ảnh thương hiệu</label>
                                <input type="file" class="form-control"  placeholder="" name="image">
                                <img style="width: 120px;" src="{{asset('uploads/brand/'.$brand->image)}}" alt="">
                            </div>
                            <div class="form-group">
                                <select class="form-control m-bot15" name="status">
                                    <label for="exampleInputPassword1">Trạng thái</label>
                                    @if($brand->status==1)
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
