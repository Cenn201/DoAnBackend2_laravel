<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiaChi extends Model
{
    use HasFactory;
    protected $table = 'diachi';
    protected $fillable = [
        'id_user',
        'tinh',
        'huyen',
        'xa',
        'cuThe',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
