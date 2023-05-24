<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Controllers\User\UserCartController;
use App\Models\DiaChi;
use App\Models\DonHang;
use App\Models\DonHangChiTiet;
use App\Models\GioHang;
use App\Models\LoaiSanPham;
use App\Models\SanPham;
use App\Models\User;
use Faker\Core\Number;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($product_id,$quantity)
    { if (!$product_id) {
        abort(404); // Chuyển hướng đến trang lỗi 404 nếu không tồn tại ID
    }
        // dd($product_id);
        $quantity = $quantity;
        $user = Auth::user();
        $userID = $user->id;
        $user = User::with('diachi')->findOrFail($userID);
      // dd($user) ; die();
        $address = $user->diachi->first();
        if (!$address) {
            $address = null;
        }
        $productTypes = LoaiSanPham::all();
        if(count(explode(",", $product_id))==1){
            $idProducts = [$product_id];
        }else{
            $idProducts = [explode(",", $product_id)][0];
        }
        // $idProducts =  array_merge($idProduct,$product_id);
        // dd($idProducts);
        $products = SanPham::whereIn('id', [...$idProducts])->get();
        if($quantity==0){
            $carts = GioHang::with('products')->where('id_user', $userID)->whereIn('id_sanpham', [...$idProducts])->get();
            // dd($carts);die();
            $quantity = [];
            foreach ($carts as $product) {
                // var_dump($product->soluong);
                array_push($quantity,$product->soluong);
            }
        }else{
            $quantity = [$quantity];
        }
        
        // dd($quantity);
        return view('user.order.index', compact('productTypes','userID','user','address','products','quantity','idProducts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // dd($request->input('productQuantity'));die();
        $user = Auth::user();
        $userID = $user->id;
        $order = DonHang::create([
            'tongtien' => $request->input('totalBill'),
            'id_user' => $userID,
            'trangthai' => 1
        ]);
        $i = 0;
        foreach ($request->input('product_ids') as $product) {
            DonHangChiTiet::create([
                'phivanchuyen' => 10000,
                'id_sanpham' => $product,
                'id_donhang' => $order->id,
                'soluongsp' => $request->input('productQuantity')[$i],
                'gia' => $request->input('productPrice')[$i]
            ]);
            $i++;
        }
        //tao obj xoa sản phẩm trong giỏ hàng khi thực hiện xog thanh toán
        // dd($request);die();
        $userCartController = new UserCartController;
        $userCartController->destroy($request);
        return response()->json(['message' => 'Mua sản phẩm thành công'], 200);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'hoten' => 'required|min:11',
            'sdt' => 'required',
            'tinh' => 'required',
            'huyen' => 'required',
            'xa' => 'required',
            'diachicuthe' => 'required',
        ]);
        $user = Auth::user();
        // dd($user);die();
        $userID = $user->id;
        // Tạo đối tượng địa chỉ mới
        $diaChi = new DiaChi();
        $diaChi->id_user = $userID;
        $diaChi->tinh = $request->input('tinh');
        $diaChi->huyen = $request->input('huyen');
        $diaChi->xa = $request->input('xa');
        $diaChi->cuThe = $request->input('diachicuthe');
        // Lưu địa chỉ mới vào cơ sở dữ liệu
        $diaChi->save();
        //cap nhat ho ten địa chỉ user
        User::where('id', $userID)->update(['hoten' =>  $request->input('hoten'), 'sdt' => $request->input('sdt')]);
        return redirect()->back()->withErrors('Vui lòng nhập dữ liệu');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $donhang = donhang::where('id',$id)->delete();
        // Chuyển trang
        return redirect()->back()->with('success', 'Delete successfully');
    }
}
