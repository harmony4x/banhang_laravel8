<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\Statistical;
use App\Models\Visitor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class AdminController extends Controller
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

    public function loginAdmin() {
        return view('admin.login.index');
    }

    public function postLogin(Request $request) {
        $data = $request->all();
        $email = $data['email'];
        $password = md5($data['password']);
        $result = User::where('email',$email)->where('password',$password)->where('status',1)->first();
        if ($result){
            Session::put('admin_id', $result->id);
            Session::put('name', $result->name);
            return redirect()->route('admin.dashboard');
        }
        else{
            Session::flash('message',' Thông tin đăng nhập hoặc mật khẩu không chính xác');
            return redirect()->route('admin.login')->withInput($request->input());
        }

    }

    public function logout() {
        $this->AuthLogin();
        Auth::logout();
        Session::put('admin_id',null);
//        Session::flash('message','Đăng xuất thành công');
        return redirect()->route('admin.login');
    }

    public function dashboard(Request $request) {
        $this->AuthLogin();
        $user_ip_address = $request->ip();

        $early_last_month = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
        $end_last_month = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();
        $early_this_month = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
        $oneyears = Carbon::now('Asia/Ho_Chi_Minh')->subDays(365)->toDateString();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

        //total last month (so nguoi truy cap theo thang, nam)
        $visitor_of_lastmonth = Visitor::whereBetween('date_visitor',[$early_last_month,$end_last_month])->get();
        $visitor_last_month_count = $visitor_of_lastmonth->count();

        //total this month
        $visitor_of_thismonth = Visitor::whereBetween('date_visitor',[$early_this_month,$now])->get();
        $visitor_this_month_count = $visitor_of_thismonth->count();

        //total in one year
        $visitor_of_year = Visitor::whereBetween('date_visitor',[$oneyears,$now])->get();
        $visitor_of_year_count = $visitor_of_year->count();

        //total visitors
        $visitor_all = Visitor::all();
        $visitor_total = $visitor_all->count();

        //curent online
        $visitor_current = Visitor::where('ip_address',$user_ip_address)->get();
        $visitor_count = $user_ip_address;

        if ($visitor_count<1){
            $visitor = new Visitor();
            $visitor->ip_address = $user_ip_address;
            $visitor->date_visitor = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
            $visitor->save();
        }

        $product_count = Product::all()->count();
        $category_count = Category::all()->count();
        $user_count = User::all()->count();
        $order_count = Order::all()->count();

        $product_views = Product::orderBy('view','DESC')->take(10)->get();
        $product_sales = Product::orderBy('quantity_sold','DESC')->take(10)->get();
        return view('admin.dashboard.index')->with(compact('visitor_total','visitor_of_year_count','visitor_this_month_count','visitor_last_month_count','visitor_count','user_ip_address','product_count','category_count','user_count','order_count','product_views','product_sales'));
    }

    public function manage_order() {
        $this->AuthLogin();
        $manage_orders = Order::orderBy('id','DESC')->get();
        return view('admin.order.index')->with(compact('manage_orders'));
    }

    public function filter_by_date(Request $request){
        $data = $request->all();
        $from_date = $data['from_date'];
        $to_date = $data['to_date'];
        $get = Statistical::whereBetween('order_date',[$from_date,$to_date])->orderBy('order_date','ASC')->get();
        foreach ($get as $key => $val){
            $chart_data[] = array(
                'period' => $val->order_date,
                'order' => $val->total_order,
                'sales' => $val->sales,
                'profit' => $val->profit,
                'quantity' => $val->quantity,
            );
        }
        echo $data = json_encode($chart_data);
    }

    public function dashboard_filter(Request $request){
        $data = $request->all();
        $dauthangnay = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
        $dauthangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
        $cuoithangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();

        $sub7days = Carbon::now('Asia/Ho_Chi_Minh')->subDays(7)->toDateString();
        $sub365days = Carbon::now('Asia/Ho_Chi_Minh')->subDays(365)->toDateString();

        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

        if ($data['dashboard_value'] == '7ngay'){
            $get = Statistical::whereBetween('order_date',[$sub7days,$now])->orderBy('order_date','ASC')->get();
        }elseif ($data['dashboard_value'] == 'thangtruoc'){
            $get = Statistical::whereBetween('order_date',[$dauthangtruoc,$cuoithangtruoc])->orderBy('order_date','ASC')->get();
        }elseif ($data['dashboard_value'] == 'thangnay'){
            $get = Statistical::whereBetween('order_date',[$dauthangnay,$now])->orderBy('order_date','ASC')->get();
        }elseif ($data['dashboard_value'] == '365ngay'){
            $get = Statistical::whereBetween('order_date',[$sub365days,$now])->orderBy('order_date','ASC')->get();
        }
        foreach ($get as $key => $val){
            $chart_data[] = array(
                'period' => $val->order_date,
                'order' => $val->total_order,
                'sales' => $val->sales,
                'profit' => $val->profit,
                'quantity' => $val->quantity,
            );
        }
        echo $data = json_encode($chart_data);
    }

    public function days_order(Request $request){
        $sub30days = Carbon::now('Asia/Ho_Chi_Minh')->subDays(30)->toDateString();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $get = Statistical::whereBetween('order_date',[$sub30days,$now])->orderBy('order_date','ASC')->get();
        foreach ($get as $key => $val){
            $chart_data[] = array(
                'period' => $val->order_date,
                'order' => $val->total_order,
                'sales' => $val->sales,
                'profit' => $val->profit,
                'quantity' => $val->quantity,
            );
        }
        echo $data = json_encode($chart_data);
    }

}
