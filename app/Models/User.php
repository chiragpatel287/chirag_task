<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,SoftDeletes;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

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

    public static  function insert($data)
    {
        $Auth =  Auth()->user();
        $data['created_at'] = date('Y-m-d H:i:s');
        $insert = new User($data);
        $insert->save();
        $insertId = $insert->id;
        return $insertId;
    }

    public static function updateData($whereId, $data)
    {


        $userId = Auth()->user();
        $data['updated_at'] = date('Y-m-d H:i:s');
        $update = User::where($whereId)->update($data);
        return $update;
    }


    public static function softDelete($id)
    {
        $userId = Auth()->user();
        $data['deleted_at'] = date('Y-m-d H:i:s');
        $update = User::where($id)->update($data);
        return $update;
    }
}
