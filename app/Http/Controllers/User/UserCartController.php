<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\GioHang;
use App\Models\LoaiSanPham;
use App\Models\SanPham;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserCartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $userID = $user->id;
        $carts = GioHang::with('products')->where('id_user', $userID)->get()->all();
        if (!empty($cart)) {
            $carts = null;
        }
        $productTypes = LoaiSanPham::all();
        return view('user.cart.index', compact('carts'))->with('productTypes', $productTypes)->with('userId', $userID);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($data)
    {
        return GioHang::create([
            'soluong' => 1,
            'id_user' => $data['user_id'],
            'id_sanpham' => $data['product_id'],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $productId = $request->input('product_id');
        $userId = $request->input('user_id');
        $data = $request->all();
        $carts = GioHang::where('id_user', $userId)->where('id_sanpham', $productId)->first();
        // $carts = GioHang::with('products')->where('id_user', $userId)->where('id_sanpham', $productId)->first();
        if ($carts != null) {
            // $carts = GioHang::where('id_user', $userId)->where('id_sanpham', $productId)->update(['soluong' => $carts->soluong + 1]);
            $this->update($request, $carts->id);
            return response()->json(['message' => 'Sản phẩm đã được thêm vào giỏ hàng'], 200);
        } else {
            $this->create($data);
            return response()->json(['message' => 'Sản phẩm đã được thêm vào giỏ hàng'], 200);
        }
        return response()->json(['message' => 'Thêm sản phẩm vào giỏ hàng thất bại'], 200);
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $product_id = $request->input('product_id');
        $user_id = $request->input('user_id');

        // Kiểm tra và cập nhật giỏ hàng
        $cart = GioHang::where('id_user', $user_id)->where('id_sanpham', $product_id)->first();
        $quantity = ($cart->soluong) + 1;
        if ($cart) {
            $cart->soluong = $quantity;
            $cart->save();
        }
        return response()->json(['message' => 'Sản phẩm đã được thêm vào giỏ hàng'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $userId = $request->input('user_id');
        // $productIds = explode(',', $request->input('product_ids'));
        // dd($productIds);
        // $data = $request->all();
        // Thực hiện xóa các sản phẩm tương ứng
        foreach ($request->input('product_ids') as $productId) {
                $carts = GioHang::with('products')->where('id_user', $userId)->where('id_sanpham', $productId)->first();
                if($carts){

                    // dd($carts);
                    GioHang::destroy($carts->id);
                }
        }
        // die();
        return redirect()->route('usercarts.index')
            ->with('success', 'Deleted successfully');
    }
}
