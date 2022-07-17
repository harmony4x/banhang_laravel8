<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\City;
use App\Models\Province;
use App\Models\Wards;
use App\Models\Feeship;


class CartController extends Controller
{
    public function save_product(Request $request) {
        $data = $request->all();
        $session_id = substr(md5(microtime()),rand(0,26),5);
        $cart = Session::get('cart');
        if($cart==true) {
            $is_avaiable = 0;
            foreach ($cart as $key => $val) {
                if ($val['product_id'] == $data['product_id']) {
                    $is_avaiable++;
                    $cart[$key]['product_qty'] += $data['product_qty'];
                    Session::put('cart', $cart);
                }
            }
            if ($is_avaiable == 0) {
                $cart[] = array(
                    'session_id' => $session_id,
                    'product_name' => $data['product_name'],
                    'product_id' => $data['product_id'],
                    'product_image' => $data['product_image'],
                    'product_qty' => $data['product_qty'],
                    'product_price' => $data['product_price'],
                );
                Session::put('cart', $cart);
            }
        }else{
            $cart[] = array(
                'session_id' => $session_id,
                'product_name' => $data['product_name'],
                'product_id' => $data['product_id'],
                'product_image' => $data['product_image'],
                'product_qty' => $data['product_qty'],
                'product_price' => $data['product_price'],

            );
            Session::put('cart',$cart);
        }

        Session::save();
        return redirect()->route('cart');
    }

    public function index() {
        $brands = Brand::where('status',1)->orderBy('id','DESC')->get();
        $category = Category::where('status',1)->orderBy('id','DESC')->get();
        return view('pages.cart')->with(compact('brands','category'));
    }

    public function delete_to_cart($rowId) {
        Cart::remove($rowId);
        return redirect()->back();
    }

    public function update_cart_quantity(Request $request) {
        $data = $request->all();
//        echo '<pre>';
//        print_r($data);
//        echo '</pre>';
        $rowId = $request->rowId;
        $qty = $request->qty;
        Cart::update($rowId,$qty);

        return redirect()->route('cart');
    }

    public function add_cart_ajax(Request $request){
        $data = $request->all();
        $session_id = substr(md5(microtime()),rand(0,26),5);
        $cart = Session::get('cart');
        if($cart==true){
            $is_avaiable = 0;
            foreach($cart as $key => $val){
                if($val['product_id']==$data['cart_product_id']){
                    $is_avaiable++;
                    $cart[$key]['product_qty']+=1;
                    Session::put('cart',$cart);
                }
            }
            if($is_avaiable == 0){
                $cart[] = array(
                    'session_id' => $session_id,
                    'product_name' => $data['cart_product_name'],
                    'product_id' => $data['cart_product_id'],
                    'product_image' => $data['cart_product_image'],
                    'product_qty' => $data['cart_product_qty'],
                    'product_price' => $data['cart_product_price'],
                );
                Session::put('cart',$cart);
            }
        }else{
            $cart[] = array(
                'session_id' => $session_id,
                'product_name' => $data['cart_product_name'],
                'product_id' => $data['cart_product_id'],
                'product_image' => $data['cart_product_image'],
                'product_qty' => $data['cart_product_qty'],
                'product_price' => $data['cart_product_price'],

            );
            Session::put('cart',$cart);
        }

        Session::save();

    }

    public function delete_product($session_id){
        $cart = Session::get('cart');
        if ($cart) {
            foreach ($cart as $key => $val) {
                if ($val['session_id'] == $session_id) {
//                    Session::forget($cart[$key]);
                    unset($cart[$key]);
                    Session::put('cart', $cart);

                }

            }
        }
        if ($cart==null){
            Session::flush();
        }
        return redirect()->back()->with('message', 'Xóa sản phẩm thành công');
    }

    public function update_cart(Request $request) {
        $data = $request->all();
        $cart = Session::get('cart');
        if ($cart==true){
            foreach ($data['cart_qty'] as $key => $qty) {
                foreach ($cart as $session => $val) {
                    if ($val['session_id'] == $key) {
                        $cart[$session]['product_qty'] = $qty;
                    }
                }
            }
            Session::put('cart',$cart);
            return redirect()->back()->with('message2', 'Cập nhật giỏ hàng thành công');
        }
    }

    public function delete_all_cart() {
        Session::flush();
        return redirect()->back();
    }

    public function check_coupon(Request $request) {
        $data = $request->all();
        $coupon = Coupon::where('coupon_code', $data['coupon_code'])->first();
        if ($coupon){
            $coupon_session = Session::get('coupon');
            if ($coupon_session==true){
                $cou[] = array(
                    'coupon_code' => $coupon->coupon_code,
                    'coupon_number' => $coupon->coupon_number,
                    'coupon_condition' => $coupon->coupon_condition,
                );
                Session::put('coupon',$cou);
            }else {
                $cou[] = array(
                    'coupon_code' => $coupon->coupon_code,
                    'coupon_number' => $coupon->coupon_number,
                    'coupon_condition' => $coupon->coupon_condition,
                );
                Session::put('coupon',$cou);
            }
            Session::save();
            return redirect()->back()->with('message2', 'Áp dụng mã giảm giá thành công');

        }else {
            return redirect()->back()->with('message', 'Áp dụng mã giảm giá thất bại');
        }
    }
    public function check_coupon_ajax(Request $request) {
        $total = 0;
        foreach(Session::get('cart') as $key => $cart){
            $sub = $cart['product_price']*$cart['product_qty'];
            $total += $sub;
        }
        $data = $request->all();
        $coupon = Coupon::where('coupon_code', $data['coupon_code'])->first();
        if ($coupon){
            $coupon_session = Session::get('coupon');
            if ($coupon_session==true){
                $cou[] = array(
                    'coupon_code' => $coupon->coupon_code,
                    'coupon_number' => $coupon->coupon_number,
                    'coupon_condition' => $coupon->coupon_condition,
                );
                Session::put('coupon',$cou);
            }else {
                $cou[] = array(
                    'coupon_code' => $coupon->coupon_code,
                    'coupon_number' => $coupon->coupon_number,
                    'coupon_condition' => $coupon->coupon_condition,
                );
                Session::put('coupon',$cou);
            }
            Session::save();
            $out = '';

            if(Session::has('coupon')) {

                foreach(Session::get('coupon') as $key => $coup){
                    if($coup['coupon_condition']==1){

                        $total_coupon = ($total * $coup['coupon_number'])/100;
                        $out .= number_format($total_coupon) .' VNĐ';
                        Session::put('total_coupon',$total_coupon);
                    }else{
                        $out .= number_format($coup['coupon_number']) .' VNĐ';
                        Session::put('total_coupon',$coup['coupon_number']);
                    }
                }

            }else {
                $out .= 0;
                Session::put('total_coupon',0);
            }
            Session::save();
            echo $out;

        }


    }

}
