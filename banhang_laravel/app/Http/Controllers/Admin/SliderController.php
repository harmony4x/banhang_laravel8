<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function AuthLogin() {
        $admin_id = Auth::id();
        if ($admin_id) {
            return redirect()->route('admin.dashboard');
        }
        else {
            return redirect()->route('admin.login')->send();
        }
    }
    public function index()
    {
        $this->AuthLogin();
        $all_slider = Slider::orderBy('id','DESC')->get();
        return view('admin.slider.index')->with(compact('all_slider'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.slider.add_slider');
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
                'name' => 'required',

                'desc' => 'required',
                'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=2000,max_height=2000',
                'status' => 'required',
            ],
            [
                'name.required' => 'Tên slide không được bỏ trống',
                'description.required' => 'Mô tả không được bỏ trống',
                'image.required' => 'Hình ảnh sản phẩm k đúng',
            ]
        );

        //them anh vao folder hinh188.jpg
        $get_image = $request->image;
        $path = 'uploads/slider/';
        $get_name_image = $get_image->getClientOriginalName();
        $name_image = current(explode('.',$get_name_image));
        $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
        $get_image->move($path,$new_image);

        $data = $request->all();
        $slider = new Slider();
        $slider->slider_name = $data['name'];
        $slider->slider_desc = $data['desc'];
        $slider->slider_image = $new_image;
        $slider->slider_status = $data['status'];
        $slider->save();
        return redirect()->back()->with('message','Thêm slider thành công');
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
        $slider = Slider::find($id);
        return view('admin.slider.edit')->with(compact('slider'));
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
                'name' => 'required',

                'desc' => 'required',
                'status' => 'required',
            ],
            [
                'name.required' => 'Tên slide không được bỏ trống',
                'description.required' => 'Mô tả không được bỏ trống',
            ]
        );

        $data = $request->all();
        $slider = Slider::find($id);

        $get_image = $request->image;
        $path = 'uploads/slider/';
        if ($get_image) {
            $old_image = $path.$slider->slider_image;
            if(file_exists($old_image)) {
                unlink($old_image);
            }
            $request->validate(
                [
                    'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=2000,max_height=2000',
                ],
                [
                    'image.required' => 'Hình ảnh sản phẩm k đúng',
                ]);
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move($path,$new_image);


            $slider->slider_image = $new_image;
        }

        $slider->slider_name = $data['name'];
        $slider->slider_desc = $data['desc'];
        $slider->slider_status = $data['status'];
        $slider->save();
        return redirect()->route('slider.index')->with('message','Cập nhật slider thành công');
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
        $slider = Slider::find($id);
        $path = 'uploads/slider/';
        $old_image = $path.$slider->slider_image;
        if(file_exists($old_image)) {
            unlink($old_image);
        }
        $slider->delete();
        return redirect()->route('slider.index')->with('message','Xóa slider thành công');
    }

    public function slider_status(Request $request){
        $this->AuthLogin();
        $data = $request->all();
        $slider = Slider::find($data['slider_id']);
        $slider->slider_status = $data['status'];
        $slider->save();

    }
}
