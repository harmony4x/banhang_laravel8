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
            <form action="{{route('admin.insert_gallery',$pro_id)}}" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-3" align="right">

                    </div>
                    <div class="col-md-6">
                        <input type="file" id="file" class="form-control" name="file[]" accept="image/*" multiple>
                        <span id="error_gallery"></span>
                    </div>
                    <div class="col-md-3" >
                        <input type="submit" class="btn btn-success" name="uploads" value="Tải ảnh">
                    </div>
                </div>
            </form>

            <form >
                @csrf
                <input type="hidden" value="{{$pro_id}}" class="product_id" name="product_id">
                <div id="gallery_load">
                    <div class="table-responsive">
                        <table class="table table-striped b-t b-light">
                            <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên hình ảnh</th>
                                <th>Hình ảnh</th>
                                <th style="width:30px;"></th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>

                </div>
            </form>

        </div>
    </div>


@endsection


