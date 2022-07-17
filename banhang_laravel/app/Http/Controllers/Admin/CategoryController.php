<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;


use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
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
        $category = Category::orderBy('id', 'DESC')->get();
        return view('admin.category.index')->with(compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->AuthLogin();
        return view('admin.category.add_category');
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
                'name' => 'required|unique:categories|max:255',
                'slug' => 'required|unique:categories|max:255',
                'status' => 'required',
            ],
            [
                'name.required' => 'Tên danh mục không được bỏ trống',
                'slug.required' => 'Slug không được bỏ trống',
                'name.unique' => 'Tên danh mục đã tồn tại',
                'slug.unique' => 'Slug danh mục đã tồn tại',
            ]
        );
        $data = $request->all();
        $category = new Category();
        $category->name = $data['name'];
        $category->slug = $data['slug'];
        $category->status = $data['status'];
        $category->save();
        return redirect()->back()->with('message','Thêm danh mục thành công');
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
        $category = Category::find($id);
        return view('admin.category.edit')->with(compact('category'));
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
                'status' => 'required',
            ],
            [
                'name.required' => 'Tên danh mục không được bỏ trống',
                'slug.required' => 'Slug không được bỏ trống',

            ]
        );

        $data = $request->all();
        $category = Category::find($id);
        $category->name = $data['name'];
        $category->slug = $data['slug'];
        $category->status = $data['status'];
        $category->save();
        return redirect()->route('category.index')->with('message','Cập nhật danh mục thành công');
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
        Category::find($id)->delete();
        return redirect()->back()->with('message','Xóa danh mục thành công');
    }

    public function category_status(Request $request){
        $this->AuthLogin();
        $data = $request->all();
        $category = Category::find($data['category_id']);
        $category->status = $data['status'];
        $category->save();

    }

}
