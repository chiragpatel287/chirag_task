<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogsCategory extends Model
{
    use HasFactory;

    protected $table = 'blog_category_id';


    public $timestamps = false;


    protected $fillable = ['id', 'blog_id', 'category_id', 'created_at','created_by', 'updated_at', 'deleted_at'];

    public static function insert($data)
    {
        $Auth =  Auth()->user();
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['created_by'] = $Auth->id;

        $insert = new BlogsCategory($data);
        $insert->save();
        $insertId = $insert->id;
        return $insertId;
    }
     public static function softDelete($id)
    {
        $userId = Auth()->user();
        $data['deleted_at'] = date('Y-m-d H:i:s');
        $update = BlogsCategory::where($id)->update($data);
        return $update;
    }
}