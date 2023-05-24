<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GioHang extends Model
{
    use HasFactory;
    protected $table="GioHang";
    protected $fillable = ['id', 'soluong', 'id_user', 'id_sanpham'];
    public function products()
    {
        return $this->hasMany(SanPham::class, 'id', 'id_sanpham');
    }
}
