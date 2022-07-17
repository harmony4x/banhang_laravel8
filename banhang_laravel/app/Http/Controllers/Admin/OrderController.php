<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Payment;
use App\Models\ProductPrice;
use App\Models\Shipping;
use App\Models\Product;
use App\Models\Statistical;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use PDF;

class OrderController extends Controller
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

    public function manage_order() {
        $this->AuthLogin();
        $manage_orders = Order::orderBy('id','DESC')->get();
        $order_details_qty = [];
//        foreach ($manage_orders as $key => $manage_order){
//            $order_details = OrderDetail::with('order')->where('order_code',$manage_order->order_code)->get();
//            array_push($order_details_qty,"")
//        }
        return view('admin.order.index')->with(compact('manage_orders'));
    }

    public function view_order($order_code){
        $this->AuthLogin();
        $order = Order::where('order_code',$order_code)->first();
        $shipping = Shipping::with('order')->where('id',$order->shipping_id)->get();
        $order_details = OrderDetail::with('order','product')->where('order_code',$order->order_code)->get();
        
        foreach ($order_details as $key => $order_de){
            $order_coupon = $order_de->product_coupon;
            $order_feeship = $order_de->product_feeship;
            $order_code = $order_de->order_code;
        }
        if ($order_coupon>0){
            $coupon = Coupon::where('coupon_code',$order_coupon)->first();
            $coupon_condition = $coupon->coupon_condition;
            $coupon_number = $coupon->coupon_number;
        }else {
            $coupon_condition = 0;
            $coupon_number = 0;
        }

        return view('admin.order.view_order')->with(compact('shipping','order_details','order','coupon_condition','coupon_number','order_coupon','order_feeship','order_code'));
    }

    public function destroy_order($id){
        $this->AuthLogin();
        Order::find($id)->delete();
        return redirect()->back()->with('message','Xóa danh mục thành công');
    }

    public function order_status(Request $request){
        $this->AuthLogin();
        $data = $request->all();
        $order = Order::find($data['order_id']);
        $order->order_status = $data['status'];
        $order->save();

        $coupon_price = $data['coupon_price'];
        $order_date = $order->order_date;
        $statistic = Statistical::where('order_date',$order_date)->get();
        if ($statistic){
            $statistic_count = $statistic->count();
        }else {
            $statistic_count = 0;
        }

        if ($order->order_status==1) {
            $total_order = 0;
            $sale = 0;
            $profit = 0;
            $quantity = 0;
            foreach ($data['order_product_id'] as $key => $product_id){
                $product = Product::find($product_id);
                $product_prices = ProductPrice::where('product_id',$product_id)->get();
                $cost = 0;
                foreach ($product_prices as $pr => $product_price){
                    $cost = $product_price->cost;
                }

                $product_quantity = $product->quantity;
                $sold = $product->sold;
                $quantity_sold = $product->quantity_sold;

                $price= $product->price-($product->price*$product->discount)/100;
                $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
                foreach ($data['quantity'] as $key2 => $qty){
                    if ($key==$key2){
                        $pro_remain = $product_quantity - $qty;
                        $product->quantity = $pro_remain;
                        $product->sold = $sold + $qty;
                        $product->quantity_sold = $quantity_sold+ $qty;
                        $product->save();
                        //update doanh thu
                        $quantity += $qty;
                        $total_order+=1;
                        $sale += $price*$qty;
                        $profit += $sale-($cost*$qty)-$coupon_price;
                    }
                }
            }
            if ($statistic_count>0){
                $statistic_update = Statistical::where('order_date',$order_date)->first();
                $statistic_update->sales = $statistic_update->sales + $sale;
                $statistic_update->profit = $statistic_update->profit + $profit;
                $statistic_update->quantity = $statistic_update->quantity + $quantity;
                $statistic_update->total_order = $statistic_update->total_order + $total_order;
                $statistic_update->save();
            }else {
                $statistic_new = new Statistical();
                $statistic_new->sales = $sale;
                $statistic_new->profit = $profit;
                $statistic_new->quantity = $quantity;
                $statistic_new->total_order = $total_order;
                $statistic_new->order_date = $order_date;
                $statistic_new->save();
            }


        }

    }



    public function print_details($checkout_code) {
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->print_details_convert($checkout_code));
        return $pdf->stream();
    }

    public function print_details_convert($checkout_code){
        $order = Order::where('order_code',$checkout_code)->first();
        $shipping = Shipping::with('order')->where('id',$order->shipping_id)->get();
        $order_details = OrderDetail::with('order','product')->where('order_code',$checkout_code)->get();
        foreach ($order_details as $key => $order_detail){
            $order_coupon = $order_detail->product_coupon;
            $order_feeship = $order_detail->product_feeship;

        }
        $output = '';

        $output .= '<table class="table-bordered table-striped" style="display: inline-block">

                        <thread>
                            <tr>Tên khách hàng</tr>
                            <tr>Số điện thoại</tr>
                            <tr>Email khách hàng</tr>
                        </thread>
                    </table>';

        return $output;
    }
}
