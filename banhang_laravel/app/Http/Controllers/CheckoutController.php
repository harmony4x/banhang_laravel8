<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Payment;
use App\Models\Shipping;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;
use App\Models\City;
use App\Models\Province;
use App\Models\Wards;
use App\Models\Feeship;

class CheckoutController extends Controller
{
    public function index() {
        $brands = Brand::where('status',1)->orderBy('id','DESC')->get();
        $category = Category::where('status',1)->orderBy('id','DESC')->get();
        $city = City::orderBy('matp','ASC')->get();
        return view('pages.checkout')->with(compact('brands','category','city'));
    }


    public function coupon (Request $request) {
        $data = $request->all();
        print_r($data);
    }

    public function select_delivery(Request $request){
        $data = $request->all();
        if ($data['action']){
            $output = '';
            if ($data['action']=="city") {
                $output .= '<option disabled selected>----Chọn quận huyện----</option>';
                $select_province = Province::where('matp',$data['ma_id'])->orderBy('maqh','ASC')->get();
                foreach ($select_province as $key => $province){
                    $output .= '<option value="'.$province->maqh.'">'.$province->name.'</option>';
                }
            }else {
                $output .= '<option disabled selected>----Chọn xã phường----</option>';
                $select_wards = Wards::where('maqh',$data['ma_id'])->orderBy('xaid','ASC')->get();
                foreach ($select_wards as $key => $wards){
                    $output .= '<option value="'.$wards->xaid.'">'.$wards->name.'</option>';
                }
            }
        }
        echo $output;
    }

    public function calculate_delivery(Request $request) {
        $data = $request->all();

        Session::put('fee',30000);
        Session::save();
        $output = '';
        if ($data['matp']) {
            $feeship = Feeship::where('fee_matp',$data['matp'])->where('fee_maqh',$data['maqh'])->where('fee_xaid',$data['xaid'])->get();
            foreach ($feeship as $key => $fee){
                if (isset($fee)){
                    Session::put('fee',$fee->fee_feeship);
                    Session::save();


                }else {
                    Session::put('fee',30000);
                    Session::save();

                }

            }

        }
        $feeship_delivery = Session::get('fee');

        $output .= number_format($feeship_delivery).' VNĐ';
        echo $output;
//            echo (Session::get('fee'));
    }

    public function confirm_order(Request $request){
        $data = $request->all();
        $shipping = new Shipping();
        $shipping->shipping_name = $data['shipping_name'];
        $shipping->shipping_address = $data['shipping_address'];
        $shipping->shipping_phone = $data['shipping_phone'];
        $shipping->shipping_email = $data['shipping_email'];
        $shipping->shipping_note = $data['shipping_note'];
        $shipping->shipping_method = $data['shipping_method'];
        $shipping->save();
        $shipping_id = $shipping->id;

        $order_code = substr(md5(microtime()),rand(0,26),5);
        $order_date = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');

        $order = new Order();
        $order->shipping_id = $shipping_id;
        $order->order_status = 0;
        $order->order_code = $order_code;
        $order->order_date = $order_date;
        $order->save();


        if (Session::has('cart')) {
            foreach(Session::get('cart') as $key => $cart){
                $order_details = new OrderDetail();
                $order_details->order_code = $order_code;
                $order_details->product_id = $cart['product_id'];
                $order_details->product_name = $cart['product_name'];
                $order_details->product_price = $cart['product_price'];
                $order_details->product_quantity = $cart['product_qty'];
                $order_details->product_coupon = $data['order_coupon'];
                $order_details->product_feeship = $data['order_fee'];
                $order_details->save();
            }

        }
        Session::flush();
    }
}
