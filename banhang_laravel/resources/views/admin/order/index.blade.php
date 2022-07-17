@extends('admin.layout.master')

@section('content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Đơn hàng
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
                        <th>Mã vận chuyển</th>
                        <th>Mã đơn hàng</th>
                        <th>Ngày đặt hàng</th>
                        <th>Trạng thái</th>
                        <th style="width:30px;"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $i=1; @endphp
                    @foreach($manage_orders as $key => $manage_order)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$manage_order->shipping_id}}</td>
                            <td><span class="text-ellipsis">{{$manage_order->order_code}}</span></td>

                            <td><span class="text-ellipsis">{{$manage_order->created_at}}</span></td>
                            <td>
                                @if($manage_order->order_status==0)
                                <span class="text text-warning">Đơn hàng mới</span>
                                @elseif($manage_order->order_status==1)
                                    <span class="text text-success">Thành công</span>
                                @elseif($manage_order->order_status==2)
                                    <span class="text text-danger">Đã hủy</span>
                                @elseif($manage_order->order_status==3)
                                    <span class="text text-primary">Đang xử lý</span>
                                @endif

                            </td>
                            <td>
                                <a href="{{route('view_order',$manage_order->order_code)}}" class="active" ui-toggle-class=""><i class="fa fa-eye text-success text-active"></i></a>
{{--                                <form action="{{route('manage_order.destroy',$manage_order->id)}}" method="POST">--}}
{{--                                    @method('DELETE')--}}
{{--                                    @csrf--}}
{{--                                    <button onclick="return confirm('Bạn có muốn xóa hay không?');" style="background: none; border: none; padding: 0"><i class="fa fa-trash text-danger text"></i></button>--}}
{{--                                </form>--}}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>


@endsection
