<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Roles;
use App\Models\AdminRoles;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function register_admin() {
        return view('admin.login.register');
    }
    public function register(Request $request){
        $request->validate(
            [
                'name' => 'required',
                'admin_email' => 'required|unique:admin|email|max:255',
                'admin_password' => 'required',
            ],
            [
                'admin_email.required' => 'Email không được bỏ trống',
                'admin_email.unique' => 'Email đã tồn tại',
            ]
        );
        $data = $request->all();
        $admin = new Admin();
        $admin->admin_email = $data['admin_email'];
        $admin->admin_password = md5($data['admin_password']);
        $admin->admin_name = $data['name'];
        $admin->save();
        return redirect()->back()->with('message','Đăng ký thành công');
    }

    public function loginAdmin() {
        return view('admin.login.index');
    }

    public function postLogin(Request $request) {

        $data = $request->all();
        $email = $data['admin_email'];
        $password = $data['admin_password'];
        if (Auth::attempt(['admin_email' => $request->admin_email, 'admin_password' => $request->admin_password])){
            return redirect()->route('admin.dashboard');

        }else {
            return redirect()->back()->with('message','Thông tin đăng nhập không chính xác');
        }


    }

//    public function test(){
//        $admin = Admin::with('role')->find(1);
//
//        return view('admin.test')->with(compact('admin'));
//    }
}
