@extends('admin.layout.master')

@section('content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Quản lý khách hàng
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
                        <th>Tên khách hàng</th>
                        <th>Email</th>
                        <th>Địa chỉ</th>
                        <th>Số điện thoại</th>
                        <th>Ngày sinh</th>
                        <th>Giới tính</th>
                        <th>Trạng thái</th>
                        <th style="width:30px;"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $i=1; @endphp
                    @foreach($users as $key => $user)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$user->name}}</td>
                            <td><span class="text-ellipsis">{{$user->email}}</span></td>
                            <td>{{$user->address}}</td>
                            <td>{{$user->phone}}</td>
                            <td>{{$user->birthday}}</td>
                            <td>
                                @if($user->gender==0)
                                    Nam
                                @else
                                    Nữ
                                @endif
                            </td>
                            <td>
                                <select name="user_status" class="form-control user_status">

                                    @if($user->status==0)
                                        <option data-user_id={{$user->id}} selected value="0">Ẩn</option>
                                        <option data-user_id={{$user->id}} value="1">Hiển thị</option>
                                    @else
                                        <option data-user_id={{$user->id}}  value="0">Ẩn</option>
                                        <option data-user_id={{$user->id}} selected value="1">Hiển thị</option>
                                    @endif
                                </select>

                            </td>
                            <td>
                                <a href="{{route('user.edit',$user->id)}}" class="active" ui-toggle-class=""><i class="fa fa-edit text-success text-active"></i></a>
                                <form action="{{route('user.destroy',$user->id)}}" method="POST">
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
