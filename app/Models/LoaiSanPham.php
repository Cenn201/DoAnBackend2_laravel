<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\SanPham;

class LoaiSanPham extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    public $timestamps = false;
    protected $table="loaisanpham";
    protected $fillable=[
        'tenloaisanpham'
    ];
    protected $primaryKey = 'id';
}   
