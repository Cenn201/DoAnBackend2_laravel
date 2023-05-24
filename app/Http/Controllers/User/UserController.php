<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\LoaiSanPham;
use App\Models\User;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    
    public function show($id)
    {
        if (!$id) {
            abort(404); // Chuyển hướng đến trang lỗi 404 nếu không tồn tại ID
        }
        $user = User::findOrFail($id);
        $addressLink = route('user.address', $user->id);
        $productTypes = LoaiSanPham::all();
        return view('user.show', compact('user', 'addressLink','productTypes'));
    }
    public function edit(User $user)
    {
        $productTypes = LoaiSanPham::all();
        return view('user.edit',compact('user', 'productTypes'));
    }
    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|regex:/^[a-zA-Z0-9]{1,20}$/',
            'email' => 'required|email',
            'hoten' => 'required|regex:/^.{1,50}$/',
             'sdt' => 'required|digits:10',
        ]);

        if ($validator->fails()) {
           
            return redirect()->back()->withErrors($validator)->withInput();
            
        }
       
        $user->username = $request->username;
        $user->email = $request->email;
        $user->hoten = $request->hoten;
        $user->sdt = $request->sdt;

        $user->save();
       // dd($user); die();
      
      return redirect()->route('users.show', ['user' => $user->id]);
    }
   
}
