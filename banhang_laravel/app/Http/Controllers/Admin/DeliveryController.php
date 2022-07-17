<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\City;
use App\Models\Province;
use App\Models\Wards;
use App\Models\Feeship;

class DeliveryController extends Controller
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

    public function index() {
        $this->AuthLogin();
        $city = City::orderBy('matp','ASC')->get();
        return view('admin.delivery.index')->with(compact('city'));
    }

    public function add_delivery(Request $request){
        $this->AuthLogin();
        $data = $request->all();
        $fee_ship = new Feeship();
        $fee_ship->fee_matp = $data['city'];
        $fee_ship->fee_maqh = $data['province'];
        $fee_ship->fee_xaid = $data['wards'];
        $fee_ship->fee_feeship = $data['fee_ship'];
        $fee_ship->save();
        return redirect()->back()->with('message','Thêm phí vận chuyển thành công');


    }

    public function select_delivery(Request $request){
        $data = $request->all();
        if ($data['action']){
            $output = '';
            if ($data['action']=="city") {
                $output .= '<option disabled selected>---Chọn quận huyện---</option>';
                $select_province = Province::where('matp',$data['ma_id'])->orderBy('maqh','ASC')->get();
                foreach ($select_province as $key => $province){
                    $output .= '<option value="'.$province->maqh.'">'.$province->name.'</option>';
                }
            }else {
                $output .= '<option disabled selected>---Chọn xã phường---</option>';
                $select_wards = Wards::where('maqh',$data['ma_id'])->orderBy('xaid','ASC')->get();
                foreach ($select_wards as $key => $wards){
                    $output .= '<option value="'.$wards->xaid.'">'.$wards->name.'</option>';
                }
            }
        }
        echo $output;
    }

    public function load_delivery() {
        $fee_ship = Feeship::orderBy('id','ASC')->get();
        $output = '';
        $output .= '
            <div class="table-responsive">
                <table class="table table-striped b-t b-light">
                    <thead>
                    <tr style="background-color: #ddede0">
                        <th>STT</th>
                        <th>Tên thành phố</th>
                        <th>Tên quận huyện</th>
                        <th>Tên xã phường</th>
                        <th>Số tiền vận chuyển</th>
                    </tr>
                    </thead>
                    <tbody>
                    ';
                    $i=1;
                    foreach ($fee_ship as $key => $fee){
                        $output .= '
                    <tr style="background-color: #f9f9f9">
                        <td>'.$i++.'</td>
                        <td><span class="text-ellipsis">'.$fee->city->name.'</span></td>
                        <td><span class="text-ellipsis">'.$fee->province->name.'</span></td>
                        <td><span class="text-ellipsis">'.$fee->wards->name.'</span></td>
                        <td contenteditable data-feeship_id="'.$fee->id.'" class="feeship_edit">'.number_format($fee->fee_feeship,0,',','.').'</td>
                    </tr>
                    ';
                    }
                    $output .='
                    </tbody>
                </table>
            </div>
        ';
    echo $output;
    }

    public function update_delivery(Request $request) {
        $data = $request->all();
        $fee_ship = Feeship::find($data['feeship_id']);
        $fee_value = rtrim($data['fee_value'],'.');
        $fee_ship->fee_feeship = $fee_value;
        $fee_ship->save();
    }
}
