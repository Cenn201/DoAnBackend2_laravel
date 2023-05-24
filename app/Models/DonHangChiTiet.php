<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonHangChiTiet extends Model
{
    use HasFactory;
    protected $table="DonHangChiTiet";
    protected $fillable = [
        'phivanchuyen',
        'id_sanpham',
        'id_donhang',
        'soluongsp',
        'gia',
    ];
    public function donhang()
    {
        return $this->belongsTo(DonHang::class, 'id_donhang');
    }
    public function sanpham()
    {
        return $this->hasOne(SanPham::class, 'id', 'id_sanpham');
    }
}
