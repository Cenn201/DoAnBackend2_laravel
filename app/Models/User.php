<?php

namespace App\Models;
use App\Models\DonHang;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table ='users';
    protected $fillable = [
        'username',
        'email',
        'password',
        'phanquyen',
        'hoten',
        'sdt',
       
    ];
    public function diachi()
    {
        return $this->hasMany(DiaChi::class , 'id_user');
    }
    public function donhang()
    {
        return $this->hasMany(DonHang::class , 'id_user');
    }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
