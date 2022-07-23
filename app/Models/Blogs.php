<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blogs extends Model
{
    use HasFactory;

    protected $table = 'blogs';


    public $timestamps = false;


    protected $fillable = ['id', 'title', 'description', 'image', 'status', 'created_at', 'created_by', 'updated_at', 'deleted_at'];

    public static function insert($data)
    {
        $Auth =  Auth()->user();
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['created_by'] = $Auth->id;

        $insert = new Blogs($data);
        $insert->save();
        $insertId = $insert->id;
        return $insertId;
    }

    public static function updateData($whereId, $data)
    {
        $userId = Auth()->user();
        $data['updated_at'] = date('Y-m-d H:i:s');
        $update = Blogs::where($whereId)->update($data);
        return $update;
    }


    public static function softDelete($id)
    {
        $userId = Auth()->user();
        $data['deleted_at'] = date('Y-m-d H:i:s');
        $data['status'] = 0;
        $update = Blogs::where($id)->update($data);
        return $update;
    }

    public static function getAllBlogsList($createdDate = '')
    {
        $query = Blogs::select('id', 'title', 'description', 'image', 'created_at')->where('status', 1);

        if ($createdDate != '') {
            $query->whereDate('created_at', date('Y-m-d', strtotime($createdDate)));
        }

        $query = $query->orderBy('id', 'desc')->get();
        return $query;
    }

    public function blog_category()
    {
        return $this->hasMany(BlogsCategory::class, 'blog_id', 'id')->whereNull('deleted_at');
    }

    public static function getBlogsById($id)
    {
        $query = Blogs::where('id',$id)->with('blog_category')->first();
        return $query;
    }
}
