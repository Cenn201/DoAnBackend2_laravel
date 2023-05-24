<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\LoaiSanPham;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

use function Termwind\render;

class CustomAuthController extends Controller
{
    //dashboard
    public function dashboard()
    {
        if (Auth::check()) {
            $user = Auth::user();
          //  dd($user); die();
            $productTypes = LoaiSanPham::all();
                return view('dashboard', compact('user', 'productTypes'));
        } else {
            return redirect()->back();
        }
    }

    //view login
    public function showLogin()
    {
        $productTypes = LoaiSanPham::all();
        return view('auth.login', compact('productTypes'));
    }

    // process login
    public function handleLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]); //kiểm tra yêu cầu nhập của người dùng

        $credentials = $request->only('email', 'password'); // nhận một array có trường email, password
        if (Auth::attempt($credentials)) { //xác nhận kiểm tra để đăng nhập hệ thống
            return redirect()->route('userproduct.index')->withSuccess('Signed in');
            // return redirect()->intended('dashboard')
        }
        return redirect("customer/login")->with("success", "Tài khoản hoặc mật khẩu sai!");
    }
    //view register
    public function showRegister()
    {
        $productTypes = LoaiSanPham::all();
        return view('auth.register', compact('productTypes'));
    }
    //process register
    public function handleRegister(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users,username|min:10',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:6',
            'passwordagain' => 'required_with:password|same:password|min:6'
        ]);
        $user = User::where('email', '=', $request->input('email'))->first();

        // user does not exist
        $data['username'] = $request->input('username');
        $data['email'] = $request->input('email');
        $data['password'] = $request->input('password');
        $data['phanquyen'] = 'customer';
        $this->create($data);
        return redirect("customer/login")->with("success", "Bạn đã đăng ký thành công!");
    }
    public function create(array $data)
    {
        return User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phanquyen' => $data['phanquyen']
        ]);
    }
    //logout
    public function signOut()
    {
        Session::flush();
        Auth::logout();
        return redirect('customer/login');
    }
    //change password
    public function changePasswordShow()
    {
        $productTypes = LoaiSanPham::all();
        return view('auth.changePassword', compact('productTypes'));
    }
    public function editPassword(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'oldpassword' => 'required',
            'newpassword' => 'required|min:6',
        ]); //kiểm tra yêu cầu nhập của người dùng
        $email = $request->input('email');
        $userExists = User::where('email', $email)->exists();
        $user = User::all()->first();
        // dd($user);die();
        if ($userExists) {
            // Kiểm tra mật khẩu hiện tại
            if (!Hash::check($request->input('oldpassword'), $user->password)) {
                return redirect()->back()->withErrors(['oldpassword' => 'Mật khẩu hiện tại không đúng']);
            }
            // Thay đổi mật khẩu mới
            $user->password = Hash::make($request->input('newpassword'));
            $user->save();
            return redirect()->back()->with('success', 'Mật khẩu đã được thay đổi thành công');
        } else {
            return redirect()->back()->with('success', 'Tài khoản không tồn tại');
        }
    }
}
