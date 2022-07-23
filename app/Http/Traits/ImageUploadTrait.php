<?php

namespace App\Http\Traits;

use App\Models\PostLike;
use App\Models\AdvertisementLike;
use App\Models\StoryLike;
use App\Models\PostCommentLike;
use Image;

trait ImageUploadTrait
{
    public function uploadImage($file, $pathName)
    {
        $imageName = time() . '_' . rand(111, 999) . '.' . $file->getClientOriginalExtension();
        $path = '/uploads/' . $pathName . '/';
        $ext = $file->getClientOriginalExtension();
        $file->move(public_path($path), $imageName);
        return  $imageName;
    }
}
