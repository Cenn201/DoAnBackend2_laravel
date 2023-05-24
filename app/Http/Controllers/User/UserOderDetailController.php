<?php

namespace App\Http\Controllers;
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\LoaiSanPham;
use Illuminate\Http\Request;

class UserOderDetailController extends Controller
{
    public function index()
    {
      $user = auth()->user();

      $user = auth()->user();       
      $donhang = $user->donhang()->with('donhangchitiet')->get();
      $productTypes = LoaiSanPham::all(); 
     
  
        return view('user.oderDetail.index', compact('donhang' ,'user','productTypes'));
    }
    public function status_dangGiao()
    {
      $user = auth()->user();

      $user = auth()->user();       
      $donhang = $user->donhang()->with('donhangchitiet')->get();
      $productTypes = LoaiSanPham::all(); 
     
  
        return view('user.oderDetail.status_dangGiao', compact('donhang' ,'user','productTypes'));
    }
    public function status_daGiao()
    {
      $user = auth()->user();

      $user = auth()->user();       
      $donhang = $user->donhang()->with('donhangchitiet')->get();
      $productTypes = LoaiSanPham::all(); 
     
  
        return view('user.oderDetail.status_daGiao', compact('donhang' ,'user','productTypes'));
    }
    
}
