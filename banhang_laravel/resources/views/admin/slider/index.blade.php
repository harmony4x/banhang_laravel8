@extends('admin.layout.master')

@section('content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Slider website
            </div>
            @if(session('message'))
                <div class="alert">
                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                    <strong>{{session('message')}}</strong>
                </div>
            @endif
            <div class="table-responsive">
                <table class="table table-striped b-t b-light">
                    <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên</th>
                        <th>Mô tả </th>
                        <th>Hình ảnh</th>
                        <th>Trạng thái</th>
                        <th style="width:30px;"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $i=1; @endphp
                    @foreach($all_slider as $key => $slider)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$slider->slider_name}}</td>
                            <td>{{$slider->slider_desc}}</td>
                            <td><img style="width: 350px;" src="{{asset('uploads/slider/'.$slider->slider_image)}}" alt=""></td>
                            <td>
                                <select name="slider_status" class="form-control slider_status">

                                    @if($slider->slider_status==0)
                                        <option data-slider_id={{$slider->id}} selected value="0">Ẩn</option>
                                        <option data-slider_id={{$slider->id}} value="1">Hiển thị</option>
                                    @else
                                        <option data-slider_id={{$slider->id}}  value="0">Ẩn</option>
                                        <option data-slider_id={{$slider->id}} selected value="1">Hiển thị</option>
                                    @endif
                                </select>

                            </td>
                            <td>
                                <a href="{{route('slider.edit',$slider->id)}}" class="active" ui-toggle-class=""><i class="fa fa-edit text-success text-active"></i></a>
                                <form action="{{route('slider.destroy',$slider->id)}}" method="POST">
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
