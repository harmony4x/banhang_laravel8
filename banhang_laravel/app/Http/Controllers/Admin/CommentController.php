<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function AuthLogin() {
        $admin_id = Auth::id();
        if ($admin_id) {
            return redirect()->route('admin.dashboard');
        }
        else {
            return redirect()->route('admin.login')->send();
        }
    }
    public function index(){
        $this->AuthLogin();
        $comments = Comment::with('product')->where('parent_comment','=','0')->orderBy('id','DESC')->get();
        $rep_comment = Comment::where('parent_comment','>','0')->where('status',1)->get();
        return view('admin.comment.index')->with(compact('comments','rep_comment'));
    }

    public function comment_status(Request $request){
        $product_id = $request->product_id;
        $comment_id = $request->comment_id;
        $comment_status = $request->comment_status;
        $comment = Comment::find($comment_id);
        $comment->status = $comment_status;
        $comment->save();
    }

    public function reply_comment(Request $request){
        $product_id = $request->product_id;
        $comment_id = $request->comment_id;
        $content = $request->comment;
        $comment = new Comment();
        $comment->product_id = $product_id;
        $comment->parent_comment = $comment_id;
        $comment->user_name = "TinyStore";
        $comment->comment = $content;
        $comment->status = 1;
        $comment->save();
    }

    public function destroy($id)
    {
        $this->AuthLogin();
        $comment = Comment::find($id);
        $comment->delete();
        return redirect()->back()->with('message','Xóa bình luận thành công');
    }
}
