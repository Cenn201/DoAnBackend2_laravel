<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KhuyenMai extends Model
{

    public $timestamps = false;
    protected $fillable = [
        'tenkhuyenmai','giatri','created_at','updated_at'
    ];
    protected $primaryKey = 'id';
    protected $table = 'khuyenmai';}
