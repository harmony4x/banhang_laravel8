@extends('admin.layout.master')

@section('content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Liệt kê bình luận
            </div>
            @if(session('message'))
                <div class="alert">
                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                    <strong>{{session('message')}}</strong>
                </div>
            @endif
            <div id="notify_comment"></div>
            <div class="table-responsive">
                <table class="table table-striped b-t b-light">
                    <thead>
                    <tr>
                        <th>STT</th>
                        <th>Trạng thái</th>
                        <th>Tên người gửi</th>
                        <th>Ngày gửi</th>
                        <th>Bình luận</th>
                        <th>Sản phẩm</th>
                        <th>Quản lý</th>

                    </tr>
                    </thead>
                    <tbody>
                    @php $i=1; @endphp
                    @foreach($comments as $key => $comment)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>
                                @if($comment->status==0)
                                    <input type="button" data-comment_status="1" data-comment_id="{{$comment->id}}" id="{{$comment->product_id}}" class="btn btn-success comment-status btn-xs" value="Duyệt">
                                @else
                                    <input type="button" data-comment_status="0" data-comment_id="{{$comment->id}}" id="{{$comment->product_id}}" class="btn btn-danger comment-status btn-xs" value="Bỏ duyệt">
                                    @endif
                            </td>
                            <td>{{$comment->user_name}}</td>
                            <td><span class="text-ellipsis">{{$comment->created_at}}</span></td>
                            <td>
                                <style type="text/css">
                                    .reply_comment{
                                        list-style-type: decimal;
                                        color: blue;
                                        margin: 5px 20px;
                                    }
                                </style>
                                <span class="text-ellipsis">{{$comment->comment}}</span>
                                <ul>
                                    @foreach($rep_comment as $com => $comment_reply)
                                        @if($comment_reply->parent_comment == $comment->id)
                                            <li class="reply_comment">{{$comment_reply->comment}}</li>
                                        @endif
                                    @endforeach
                                </ul>
                                <br>
                                <textarea class="form-control reply_comment_{{$comment->id}}"></textarea>
                                <button class="btn btn-default btn-xs btn-reply-comment" data-product_id="{{$comment->product_id}}" data-comment_id="{{$comment->id}}">Trả lời</button>
                            </td>
                            <td><a target="_blank" href="{{route('detail',$comment->product->slug)}}">{{$comment->product->name}}</a></td>


                            <td>
{{--                                <a href="{{route('coupon.edit',$comment->id)}}" class="active" ui-toggle-class=""><i class="fa fa-edit text-success text-active"></i></a>--}}
                                <form action="{{route('comment.destroy',$comment->id)}}" method="GET">
{{--                                    @method('DELETE')--}}
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
