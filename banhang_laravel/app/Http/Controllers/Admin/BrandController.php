<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class BrandController extends Controller
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
        $brands = Brand::orderBy('id','DESC')->get();
        return view('admin.brand.index')->with(compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->AuthLogin();
        return view('admin.brand.add_brand');
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
                'name' => 'required|unique:brand|max:255',
                'slug' => 'required|unique:brand|max:255',
                'description' => 'required',
                'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=2000,max_height=2000',
                'status' => 'required',
            ],
            [
                'name.required' => 'Tên thương hiệu không được bỏ trống',
                'description.required' => 'Tên thương hiệu không được bỏ trống',
                'slug.required' => 'Slug không được bỏ trống',
                'image.required' => 'Hình ảnh sản phẩm k đúng',
                'name.unique' => 'Tên thương hiệu đã tồn tại',
                'slug.unique' => 'Slug thương hiệu đã tồn tại',
            ]
        );

        //them anh vao folder hinh188.jpg
        $get_image = $request->image;
        $path = 'uploads/brand/';
        $get_name_image = $get_image->getClientOriginalName();
        $name_image = current(explode('.',$get_name_image));
        $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
        $get_image->move($path,$new_image);

        $data = $request->all();
        $brand = new Brand();
        $brand->name = $data['name'];
        $brand->slug = $data['slug'];
        $brand->description = $data['description'];
        $brand->image = $new_image;
        $brand->status = $data['status'];
        $brand->save();
        return redirect()->back()->with('message','Thêm thương hiệu thành công');
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
        $brand = Brand::find($id);
        return view('admin.brand.edit')->with(compact('brand'));
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
                'description' => 'required',
                'status' => 'required',
            ],
            [
                'name.required' => 'Tên thương hiệu không được bỏ trống',
                'description.required' => 'Mô tả thương hiệu không được bỏ trống',
                'slug.required' => 'Slug không được bỏ trống',
                'name.unique' => 'Tên thương hiệu đã tồn tại',
                'slug.unique' => 'Slug thương hiệu đã tồn tại',
            ]
        );

        $data = $request->all();
        $brand = Brand::find($id);

        $get_image = $request->image;
        $path = 'uploads/brand/';
        if ($get_image) {
            $old_image = $path.$brand->image;
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


            $brand->image = $new_image;
        }

        $brand->name = $data['name'];
        $brand->slug = $data['slug'];
        $brand->description = $data['description'];
        $brand->status = $data['status'];
        $brand->save();
        return redirect()->route('brand.index')->with('message','Cập nhật thương hiệu thành công');
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
        $brand = Brand::find($id);
        $path = 'uploads/brand/';
        $old_image = $path.$brand->image;
        if(file_exists($old_image)) {
            unlink($old_image);
        }
        $brand->delete();
        return redirect()->back()->with('message','Xóa thương hiệu thành công');
    }

    public function brand_status(Request $request){
        $this->AuthLogin();
        $data = $request->all();
        $brand = Brand::find($data['brand_id']);
        $brand->status = $data['status'];
        $brand->save();

    }
}
