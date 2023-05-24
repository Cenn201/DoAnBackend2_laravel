<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KhuyenMai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;


class CouponController extends Controller
{
    //
    public function list_coupon()
    {
        $coupon = KhuyenMai::orderby('id','DESC')->get();
        return view('admin.list_coupon')->with(compact('coupon'));
    }
    public function insert_coupon()
    {
        return view('admin.insert_coupon');
    }
    public function insert_coupon_code(Request $request)
    {
        $data = $request->all();
        $coupon = new KhuyenMai();
        $coupon -> tenkhuyenmai = $data['tenkhuyenmai'];
        $coupon -> giatri = $data['giatri'];
        $coupon -> save();
        Session::put('message','Success');
        return Redirect::to('list-coupon');
    }
    public function delete_coupon($id)
    {
        $coupon = KhuyenMai::find($id);
        $coupon->delete();
        return redirect()->back();
    }
}
