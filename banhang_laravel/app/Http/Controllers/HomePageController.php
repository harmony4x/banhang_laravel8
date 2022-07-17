<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Gallery;
use App\Models\Product;
use App\Models\Rating;
use App\Models\Slider;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Carbon;

class HomePageController extends Controller
{
    public function index() {
        $brands = Brand::where('status',1)->orderBy('id','DESC')->get();
        $category = Category::where('status',1)->orderBy('id','DESC')->get();
        $sliders = Slider::where('slider_status',1)->orderBy('id','DESC')->get();
        $products_whey = Product::where('status',1)->where('category_id',10)->orderBy('id','DESC')->take(10)->get();
        $products_view = Product::where('status',1)->orderBy('view','DESC')->take(10)->get();
        $products_sell = Product::where('status',1)->orderBy('quantity_sold','DESC')->take(10)->get();
        return view('pages.index')->with(compact('brands','category','sliders','products_whey','products_view','products_sell'));
    }

    public function category($slug) {
        $brands = Brand::where('status',1)->orderBy('id','DESC')->get();
        $category = Category::where('status',1)->orderBy('id','DESC')->get();
        $category_select = Category::where('slug',$slug)->first();
        $products = Product::with('brand','category')->where('category_id',$category_select->id)->where('status',1)->get();
        return view('pages.category')->with(compact('category','brands','category_select','products'));
    }

    public function brand($slug) {
        $brands = Brand::where('status',1)->orderBy('id','DESC')->get();
        $category = Category::where('status',1)->orderBy('id','DESC')->get();
        $brand_select = Brand::where('slug',$slug)->first();
        $products = Product::with('brand','category')->where('brand_id',$brand_select->id)->where('status',1)->get();
        return view('pages.brand')->with(compact('category','brands','brand_select','products'));
    }

    public function product() {
        $brands = Brand::where('status',1)->orderBy('id','DESC')->get();
        $category = Category::where('status',1)->orderBy('id','DESC')->get();
//        $product_select = Product::where('status')
        return view('pages.product')->with(compact('category','brands'));
    }

    public function all_product() {
        $brands = Brand::where('status',1)->orderBy('id','DESC')->get();
        $category = Category::where('status',1)->orderBy('id','DESC')->get();
        $products = Product::where('status',1)->get();
        return view('pages.all_product')->with(compact('category','brands','products'));
    }

    public function detail($slug){
        $brands = Brand::where('status',1)->orderBy('id','DESC')->get();
        $category = Category::where('status',1)->orderBy('id','DESC')->get();
        $detail = Product::with('brand','category')->where('slug',$slug)->first();
        $sp_lienquan = Product::with('category')->where('category_id',$detail->category_id)->whereNotIn('id',[$detail->id])->take(6)->get();
        $gallery = Gallery::with('product')->where('product_id',$detail->id)->get();
        $rating = Rating::where('product_id',$detail->id)->avg('rating');
        $rating = round($rating);

        $product_view = Product::where('slug',$slug)->first();
        $product_view->view  = $product_view->view +1;
        $product_view->save();
        return view('pages.detail')->with(compact('detail','brands','category','gallery','rating','sp_lienquan'));
    }


    public function login() {
        $brands = Brand::where('status',1)->orderBy('id','DESC')->get();
        $category = Category::where('status',1)->orderBy('id','DESC')->get();
        return view('pages.login')->with(compact('brands','category'));
    }

    public function add_customer(Request $request){
        $brands = Brand::where('status',1)->orderBy('id','DESC')->get();
        $category = Category::where('status',1)->orderBy('id','DESC')->get();
        $request->validate(
            [
                'email' => 'required|unique:users|max:255',
                'customer_name' => 'required|max:255',
                'customer_password' => 'required|max:255',
                'customer_password2' => 'required|max:255',
                'customer_address' => 'required|max:255',
                'customer_phone' => 'required|max:255',

            ],
            [
                'email.required' => 'Email không được bỏ trống',
                'customer_name.required' => 'Tên hiển thị không được bỏ trống',
                'customer_password.required' => 'Mật khẩu không được bỏ trống',
                'customer_password2.required' => 'Nhập lại mật khẩu không được bỏ trống',
                'customer_address.required' => 'Địa chỉ không được bỏ trống',
                'customer_phone.required' => 'Số điện thoại không được bỏ trống',
                'email.unique' => 'Email đã tồn tại',
                'slug.unique' => 'Slug danh mục đã tồn tại',
            ]
        );

        $data = $request->all();
        if ($data['customer_password']==$data['customer_password2']){
            $customer_user = new User();
            $customer_user->name = $data['customer_name'];
            $customer_user->email = $data['email'];
            $customer_user->password = md5($data['customer_password']);
            $customer_user->address = $data['customer_address'];
            $customer_user->phone = $data['customer_phone'];
            $customer_user->avatar = 'user_icon.png';
            $customer_user->save();
            return redirect()->back()->with(compact('brands','category'))->with('message_success','Tạo tài khoản thành công');
        }
        else {
            return redirect()->back()->with(compact('brands','category'))->with('message_danger','Mật khẩu không trùng nhau');
        }


    }

    public function customer_login(Request $request) {
        $request->validate(
            [
                'email' => 'required|email|max:255',
                'password' => 'required|max:255',
            ],
            [
                'email.required' => 'Email không được bỏ trống',
                'password.required' => 'Mật khẩu không được bỏ trống',
            ]
        );
        $data = $request->all();
        $email= $data['email'];
        $password = md5($data['password']);
        $customer_user = User::where('email',$email)->where('password',$password)->where('status',1)->first();
        if ($customer_user) {
            Session::put('customer_id',$customer_user->id);
            Session::put('customer_email',$customer_user->email);
            Session::put('customer_name',$customer_user->name);
            Session::put('customer_phone',$customer_user->phone);
            Session::put('customer_address',$customer_user->address);
            Session::put('customer_avatar',$customer_user->avatar);

            return redirect()->route('home')->with(compact('customer_user'));
        }else {
            return redirect()->back()->with('message','Tài khoản hoặc mật khẩu không trùng khớp');
        }
    }

    public function logout() {
        Session::flush();
        return redirect()->route('home');
    }

    public function send_mail() {
        $brands = Brand::where('status',1)->orderBy('id','DESC')->get();
        $category = Category::where('status',1)->orderBy('id','DESC')->get();
        //send mail
        $to_name = "tiny store";
        $to_email = "charlenee282@gmail.com";//send to this email

        $data = array("name"=>"noi dung ten","body"=>"noi dung body"); //body of mail.blade.php

                Mail::send('pages.send_mail',$data,function($message) use ($to_name,$to_email){
                    $message->to($to_email)->subject('test mail nhé');//send this mail with subject
                    $message->from($to_email,$to_name);//send from this mail
                });
                //--send mail
        return redirect('/');
    }

    public function contact() {
        $brands = Brand::where('status',1)->orderBy('id','DESC')->get();
        $category = Category::where('status',1)->orderBy('id','DESC')->get();
        $products = Product::where('status',1)->orderBy('id','DESC')->get();
        return view('pages.contact')->with(compact('brands','category','products'));
    }

    public function autocomplete_ajax(Request $request){
        $data = $request->all();
//        $output = '';
        if ($data['query']){
            $products = Product::where('status',1)->where('name','LIKE','%'.$data['query'].'%')->get();
            $output = '<ul class="dropdown-menu" style="display:block;position:relative">';
            foreach ($products as $key => $product){
                $output .= '
                <li class="li_search_ajax"><a href="#">'.$product->name.'</a></li>
                ';
            }
            $output .= '</ul>';
            echo $output;
        }
    }
    public function search(Request $request){
        $data = $request->all();
        $category = Category::where('status',1)->orderBy('id','DESC')->get();
        $products = Product::where('name','LIKE','%'.$data['keywords_submit'].'%')->get();

        return view('pages.search')->with(compact('category','products'));
    }

    public function quickview(Request $request){
        $product_id = $request->product_id;
        $product = Product::find($product_id);
        $category_name = Category::find($product->category_id)->first();
        $gallery = Gallery::where('product_id',$product_id)->get();
        $output['gallery'] = '';
        foreach ($gallery as $key => $gal){
            $output['gallery'] .= '<p><img width="100%" src="../uploads/gallery/'.$gal->image.'"></p>';
        }

        $output['name'] = $product->name;
        $output['id'] = $product->id;
        $output['category_name'] = $category_name->name;
        $output['content'] = $product->content;
        $output['price'] = number_format($product->price - ($product->price*$product->discount/100));
        $output['image'] = '<p><img width="100%" src="../uploads/product/'.$product->image.'" </p>';

        $output['product_quickview_value'] = '
        <input type="hidden" value="'.$product->id.'" class="cart_product_id_'.$product->id.'">
        <input type="hidden" value="'.$product->name.'" class="cart_product_name_'.$product->name.'">
        <input type="hidden" value="'.$product->image.'" class="cart_product_image_'.$product->image.'">
        <input type="hidden" value="'.($product->price - ($product->price*$product->discount/100)).'" class="cart_product_price_'.($product->price - ($product->price*$product->discount/100)).'">
        <input type="hidden" value="1" class="cart_product_qty_'.($product->price - ($product->price*$product->discount/100)).'">
                        ';

        echo json_encode($output);
    }

    public function load_comment(Request $request){
        $product_id = $request->product_id;
        $comments= Comment::where('product_id',$product_id)->where('parent_comment','=','0')->where('status',1)->get();
        $rep_comment = Comment::where('product_id',$product_id)->where('parent_comment','>','0')->where('status',1)->get();
        $output = '';
        foreach ($comments as $key => $comment){
            $output .= '
            <div class="row comment">
                <div class="col-md-2" >
                    <img  src="../pages/img/avatar1.png" alt="" class="img img-responsive img-thumbnail" style="border: none;">
                </div>
                <div class="col-md-10" style="margin-left: -20px;">
                <p style="color: grey; font-size: 16px" >'.$comment->user_name.' | <span style="font-size: 12px" ">'.$comment->created_at->diffForHumans().'</span></p>

                <p>'.$comment->comment.'</p>
                </div>
            </div><p></p>';
            foreach ($rep_comment as $com => $rep_comm){
                if ($rep_comm->parent_comment==$comment->id){

                    $output .= '
            <div class="row comment" style="margin: 5px 10px 5px 80px">
                <div class="col-md-1">
                    <img  src="../admin/images/5.png" alt="" class="img img-responsive img-thumbnail" style="border: none;">
                </div>
                <div class="col-md-11">
                <p style="color: grey; font-size: 14px" >'.$rep_comm->user_name.' | <span style="font-size: 10px" ">'.$rep_comm->created_at->diffForHumans().'</span></p>

                <p>'.$rep_comm->comment.'</p>
                </div>
            </div><p></p>';
                }
            }


        }
        echo $output;
    }

    public function send_comment(Request $request){
        $product_id = $request->product_id;
        $comment_name = $request->comment_name;
        $comment_content = $request->comment_content;
        $comment = new Comment();
        $comment->user_name = $comment_name;
        $comment->comment = $comment_content;
        $comment->product_id = $product_id;
        $comment->status = 0;
        $comment->parent_comment = 0;
        $comment->save();
    }

    public function insert_rating(Request $request){
        $data = $request->all();
        $rating = new Rating();
        $rating->product_id = $data['product_id'];
        $rating->rating = $data['index'];
        $rating->save();
        echo "done";
    }

}
