<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;


use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ProductPrice;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->AuthLogin();
        $products = Product::with('category','brand')->orderBy('id','DESC')->get();
        return view('admin.product.index')->with(compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->AuthLogin();
        $brands = Brand::where('status',1)->get();
        $category = Category::where('status',1)->get();
        return view('admin.product.add_product')->with(compact('brands','category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->AuthLogin();
        $request->validate(
            [
                'name' => 'required|unique:product|max:255',
                'slug' => 'required|unique:product|max:255',
                'quantity' => 'required',
                'content' => 'required',
                'cost' => 'required|max:255',
                'price' => 'required|max:255',
                'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=2000,max_height=2000',
                'status' => 'required',
                'category_id' => 'required',
//                'brand_id' => 'required',
            ],
            [
                'name.required' => 'Tên sản phẩm không được bỏ trống',
                'quantity.required' => 'Số lượng sản phẩm không được bỏ trống',
                'content.required' => 'Nội dung sản phẩm không được bỏ trống',
                'cost.required' => 'Giá nhập sản phẩm không được bỏ trống',
                'price.required' => 'Giá bán sản phẩm không được bỏ trống',
                'image.required' => 'Hình ảnh sản phẩm k đúng',
                'slug.required' => 'Slug không được bỏ trống',
                'name.unique' => 'Tên thương hiệu đã tồn tại',
                'slug.unique' => 'Slug thương hiệu đã tồn tại',
            ]
        );

        //them anh vao folder hinh188.jpg
        $get_image = $request->image;
        $path = 'uploads/product/';
        $get_name_image = $get_image->getClientOriginalName();
        $name_image = current(explode('.',$get_name_image));
        $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
        $get_image->move($path,$new_image);



        $data = $request->all();
        $product = new Product();
        $product->name = $data['name'];
        $product->slug = $data['slug'];
        $product->quantity = $data['quantity'];
        $product->sold = 0;
        $product->content = $data['content'];
        $product->price = $data['price'];
        $product->discount = $data['discount'];
        $product->image = $new_image;
        $product->category_id = $data['category_id'];
//        $product->brand_id = $data['brand_id'];
        $product->status = $data['status'];
        $product->save();

        // Product_price
        $order_date = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        $product_price = new ProductPrice();
        $product_price->product_id = $product->id;
        $product_price->cost = $data['cost'];
        $product_price->price = $data['price'];
        $product_price->order_date = $order_date;
        $product_price->quantity = $data['quantity'];
        $product_price->save();

        return redirect()->back()->with('message','Thêm sản phẩm thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->AuthLogin();
        $product = Product::find($id);
        $product_prices = ProductPrice::where('product_id',$id)->get();
        $category = Category::all();
        $brands = Brand::all();
        return view('admin.product.edit')->with(compact('product','category','brands','product_prices'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->AuthLogin();
        $request->validate(
            [
                'name' => 'required|max:255',
                'slug' => 'required|max:255',
//                'quantity' => 'required',
                'content' => 'required',
//                'price' => 'required|max:255',
//                'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=2000,max_height=2000',
                'status' => 'required',
                'category_id' => 'required',
//                'brand_id' => 'required',
            ],
            [
                'name.required' => 'Tên sản phẩm không được bỏ trống',
//                'quantity.required' => 'Số lượng sản phẩm sản phẩm không được bỏ trống',
                'content.required' => 'Nội dung sản phẩm không được bỏ trống',
//                'price.required' => 'Giá tiền sản phẩm không được bỏ trống',
//                'image.required' => 'Hình ảnh sản phẩm k đúng',
                'slug.required' => 'Slug không được bỏ trống',
                'name.unique' => 'Tên thương hiệu đã tồn tại',
                'slug.unique' => 'Slug thương hiệu đã tồn tại',
            ]
        );

        $data = $request->all();

        $product = Product::find($id);

        //them anh vao folder hinh188.jpg
        $get_image = $request->image;
        $path = 'uploads/product/';
        if ($get_image) {
            $old_image = $path.$product->image;
            if(file_exists($old_image)) {
                unlink($old_image);
            }
            $request->validate(
                [
                    'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=2000,max_height=2000',],
                [
                    'image.required' => 'Hình ảnh sản phẩm k đúng',
                ]);
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move($path,$new_image);


            $product->image = $new_image;
        }



        $product->name = $data['name'];
        $product->slug = $data['slug'];
//        $product->quantity = $data['quantity'];
        $product->content = $data['content'];
//        $product->price = $data['price'];

        $product->category_id = $data['category_id'];
//        $product->brand_id = $data['brand_id'];
        $product->status = $data['status'];
        $product->save();
        return redirect()->route('product.index')->with('message','Cập nhật sản phẩm thành công');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->AuthLogin();
        $product = Product::find($id);
        $path = 'uploads/product/';
        $old_image = $path.$product->image;
        if(file_exists($old_image)) {
            unlink($old_image);
        }
        $product->delete();
        return redirect()->back()->with('message','Xóa sản phẩm thành công');
    }

    public function product_status(Request $request){
        $this->AuthLogin();
        $data = $request->all();
        $product = Product::find($data['product_id']);
        $product->status = $data['status'];
        $product->save();

    }

    public function create_product_price($product_id){
        $this->AuthLogin();
        $product = Product::find($product_id);
        return view('admin.product.create_price')->with(compact('product'));
    }

    public function product_price_store(Request $request, $product_id){
        $this->AuthLogin();
        $data = $request->all();
        $order_date = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        $product_price = new ProductPrice();
        $product_price->product_id = $product_id;
        $product_price->cost = $data['cost'];
        $product_price->price = $data['price'];
        $product_price->order_date = $order_date;
        $product_price->quantity = $data['quantity'];
        $product_price->save();

        $product = Product::find($product_id);
        $product->price = $data['price'];
        $product->quantity += $data['quantity'];
        $product->save();
        return redirect()->route('product.index')->with('message','Cập nhật sản phẩm thành công');
    }

    public function edit_product_price($product_id){
        $this->AuthLogin();
        $product = Product::find($product_id);
        $product_prices = ProductPrice::where('product_id',$product_id)->get();
        $cost = 0;
        foreach ($product_prices as $pr => $product_price){
            $cost = $product_price->cost;
        }
        return view('admin.product.edit_price')->with(compact('product','product_prices','cost'));

    }

    public function product_price_update(Request $request, $product_id){
        $this->AuthLogin();
        $data = $request->all();
        $order_date = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        $product_price = new ProductPrice();
        $product_price->product_id = $product_id;
        $product_price->cost = $data['cost'];
        $product_price->price = $data['price'];
        $product_price->order_date = $order_date;
        $product_price->quantity = 0;
        $product_price->save();

        $product = Product::find($product_id);
        $product->price = $data['price'];

        $product->save();
        return redirect()->route('product.index')->with('message','Cập nhật sản phẩm thành công');
    }

    public function import_csv(){

    }
    public function export_csv(){

    }
}
