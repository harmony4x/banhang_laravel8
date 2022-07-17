<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class GalleryController extends Controller
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

    public function add_gallery($product_id){
        $this->AuthLogin();
        $pro_id = $product_id;
        return view('admin.gallery.add_gallery')->with(compact('pro_id'));
    }

    public function select_gallery(Request $request){
        $data = $request->all();
        $product_id = $data['product_id'];
        $gallery = Gallery::where('product_id',$product_id)->get();
        $gallery_count = $gallery->count();
        $output = '';
        $output .= '
                    <form>
                    '.csrf_field().'
                        <div class="table-responsive ">
                            <table class="table table-striped b-t b-light">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Tên hình ảnh</th>
                                        <th>Hình ảnh</th>
                                        <th style="width:30px;"></th>
                                    </tr>
                                </thead>
                                <tbody>';
        if ($gallery_count>0){
            $i = 0;
            foreach ($gallery as $key => $gal){
                $i++;
                $output .= '

                    <tr >
                        <td>'.$i.'</td>
                        <td contenteditable class="edit_gallery_name" data-gal_id="'.$gal->id.'">'.$gal->name.'</td>
                        <td>
                            <img style="width: 100px;" src="'.url('uploads/gallery/'.$gal->image).'" alt="">
                            <input type="file" class="file_image" style="width: 40%" data-gal_id="'.$gal->id.'" id="file-'.$gal->id.'" name="file" accept="image/*">
                        </td>
                        <td>
                            <button type="button" class="delete-gallery" data-gal_id="'.$gal->id.'" style="background: none; border: none; padding: 0"><i class="fa fa-trash text-danger text "></i></button>
                        </td>
                    </tr>
                ';
            }
        }else{
            $output .= '
                <tr>
                    <td colspan="4">Sản phẩm chưa có ảnh</td>

                </tr>';
        }
            $output .= '    </tbody>
                        </table>
                    </div>
                </form>';
        echo $output;
    }

    public function insert_gallery(Request $request, $product_id){
        $get_image = $request->file('file');
        $path = 'uploads/gallery/';
        if ($get_image){
            foreach ($get_image as $image){
                $get_name_image = $image->getClientOriginalName();
                $name_image = current(explode('.',$get_name_image));
                $new_image =  $name_image.rand(0,99).'.'.$image->getClientOriginalExtension();
                $image->move($path,$new_image);
                $gallery = new Gallery();
                $gallery->name = $new_image;
                $gallery->image = $new_image;
                $gallery->product_id = $product_id;
                $gallery->save();
            }
        }
        return redirect()->back()->with('message','Thêm hình ảnh thành công');
    }

    public function update_gallery_name(Request $request){
        $gal_id = $request->gal_id;
        $gal_text = $request->gal_text;
        $gallery = Gallery::find($gal_id);
        $gallery->name = $gal_text;
        $gallery->save();
    }

    public function delete_gallery(Request $request){
        $gal_id = $request->gal_id;
        $gallery = Gallery::find($gal_id);
        unlink('uploads/gallery/'.$gallery->image);
        $gallery->delete();
    }

}
