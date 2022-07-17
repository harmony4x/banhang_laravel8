<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CouponController extends Controller
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
        $coupons = Coupon::orderBy('id', 'DESC')->get();
        return view('admin.coupon.index')->with(compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->AuthLogin();
        return view('admin.coupon.add_coupon');
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
                'coupon_name' => 'required|unique:coupon|max:255',
                'coupon_code' => 'required|max:100',
                'coupon_quantity' => 'required',
                'coupon_condition' => 'required',
                'coupon_number' => 'required',
            ],
            [
                'coupon_name.required' => 'Tên mã giảm giá không được bỏ trống',
                'coupon_name.unique' => 'Tên mã giảm giá đã tồn tại',

                'coupon_code.required' => 'Mã giảm giá không được bỏ trống',
                'coupon_quantity.required' => 'Số lượng không được bỏ trống',
                'coupon_number.required' => 'Giá tiền hoặc % không được bỏ trống',
            ]
        );
        $data = $request->all();
        $coupon = new Coupon();
        $coupon->coupon_name = $data['coupon_name'];
        $coupon->coupon_code = $data['coupon_code'];
        $coupon->coupon_quantity = $data['coupon_quantity'];
        $coupon->coupon_condition = $data['coupon_condition'];
        $coupon->coupon_number = $data['coupon_number'];
        $coupon->status = $data['status'];
        $coupon->save();
        return redirect()->back()->with('message','Thêm mã giảm giá thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

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
        $coupon = Coupon::find($id);
        return view('admin.coupon.edit')->with(compact('coupon'));
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
                'coupon_name' => 'required|max:255',
                'coupon_code' => 'required|max:100',
                'coupon_quantity' => 'required',
                'coupon_condition' => 'required',
                'coupon_number' => 'required',
            ],
            [
                'coupon_name.required' => 'Tên mã giảm giá không được bỏ trống',
                'coupon_code.required' => 'Mã giảm giá không được bỏ trống',
                'coupon_quantity.required' => 'Số lượng không được bỏ trống',
                'coupon_number.required' => 'Giá tiền hoặc % không được bỏ trống',
            ]
        );

        $data = $request->all();
        $coupon = Coupon::find($id);
        $coupon->coupon_name = $data['coupon_name'];
        $coupon->coupon_code = $data['coupon_code'];
        $coupon->coupon_quantity = $data['coupon_quantity'];
        $coupon->coupon_condition = $data['coupon_condition'];
        $coupon->coupon_number = $data['coupon_number'];
        $coupon->status = $data['status'];
        $coupon->save();
        return redirect()->route('coupon.index')->with('message','Cập nhật mã giảm giá thành công');
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
        Coupon::find($id)->delete();
        return redirect()->back()->with('message','Xóa mã giảm giá thành công');
    }

    public function coupon_status(Request $request){
        $this->AuthLogin();
        $data = $request->all();
        $coupon = Coupon::find($data['coupon_id']);
        $coupon->status = $data['status'];
        $coupon->save();

    }
}
