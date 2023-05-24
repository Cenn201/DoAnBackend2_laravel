<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\DiaChi;
use App\Models\LoaiSanPham;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $productTypes = LoaiSanPham::all();
        return view('diachi.create' , compact('productTypes'));
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
            'tinh' => 'required|regex:/^.{1,30}$/',
            'huyen' => 'required|regex:/^.{1,30}$/',
            'xa' => 'required|regex:/^.{1,30}$/',
            'cuThe' => 'required|regex:/^.{1,70}$/',
           ]);
        // Lấy thông tin địa chỉ từ request
       
        $tinh = $request->input('tinh');
        $huyen = $request->input('huyen');
        $xa = $request->input('xa');
        $cuThe = $request->input('cuThe');

        // Lấy id_user từ user hiện tại
        $id_user = auth()->user()->id;

        // Tạo đối tượng địa chỉ mới
        $diaChi = new diachi();
        $diaChi->id_user = $id_user;
        $diaChi->tinh = $tinh;
        $diaChi->huyen = $huyen;
        $diaChi->xa = $xa;
        $diaChi->cuThe = $cuThe;

        // Lưu địa chỉ mới vào cơ sở dữ liệu
        $diaChi->save();
        return redirect()->route('user.address', ['id' => auth()->user()->id])->with('success', 'Thêm địa chỉ mới thành công');
        // $request->validate([
        //     'hoten' => 'required',
        //     'sdt' => 'required',
        //     'tinh' => 'required',
        //     'huyen' => 'required',
        //     'xa' => 'required',
        //     'diachicuthe' => 'required',
        // ]);
        // $user = Auth::user();
        // // dd($user);die();
        // $userID = $user->id;
        // // Tạo đối tượng địa chỉ mới
        // $diaChi = new DiaChi();
        // $diaChi->id_user = $userID;
        // $diaChi->tinh = $request->input('tinh');
        // $diaChi->huyen = $request->input('huyen');
        // $diaChi->xa = $request->input('xa');
        // $diaChi->cuThe = $request->input('diachicuthe');
        // // Lưu địa chỉ mới vào cơ sở dữ liệu
        // $diaChi->save();
        // //cap nhat ho ten địa chỉ user
        // User::where('id', $userID)->update(['hoten' =>  $request->input('hoten'), 'sdt' => $request->input('sdt')]);
        // return redirect()->back()->withErrors('Vui lòng nhập dữ liệu');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!$id) {
            abort(404); // Chuyển hướng đến trang lỗi 404 nếu không tồn tại ID
        }
        $address = DiaChi::findOrFail($id);
        $productTypes = LoaiSanPham::all();
        return view('diachi.address', compact('address' ,'productTypes'));
    }
    public function address($id)
    {
        $user = User::with('diachi')->findOrFail($id);
        $addresses = $user->diachi;
        $productTypes = LoaiSanPham::all();
        return view('diachi.address', compact('user', 'addresses','productTypes'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(DiaChi $diachi)
    {
        $user = Auth::user();
        $productTypes = LoaiSanPham::all();
        return view('diachi.edit', compact('user', 'diachi', 'productTypes'));
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
         //    dd($request->all());
         $request->validate([
            'tinh' => 'required|regex:/^.{1,30}$/',
            'huyen' => 'required|regex:/^.{1,30}$/',
            'xa' => 'required|regex:/^.{1,30}$/',
            'cuThe' => 'required|regex:/^.{1,70}$/',
           ]);

    
        //truy vấn người dùng đang đăng nhập
        $user = auth()->user();
        // lấy ra id cụ thể của người dùng
        $diachi = $user->diachi->find($id);
      
            $diachi->tinh = $request->tinh;
            $diachi->huyen = $request->huyen;
            $diachi->xa = $request->xa;
            $diachi->cuThe = $request->cuThe;
            $diachi->save();


            return redirect()->route('user.address', ['id' => auth()->user()->id])->with('success', 'Cập nhật địa chỉ thành công');
      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $address = diachi::where('id',$id)->delete();
        // Chuyển trang
        return redirect()->back()->with('success', 'Delete successfully');
    }
}
