<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Config;
use App\Http\Traits\ImageUploadTrait;
use App\Models\Blogs;
use App\Models\BlogsCategory;
use App\Models\Category;
use Illuminate\Support\Str;

use Illuminate\Routing\Controller as BaseController;

class BlogController extends BaseController
{
    use ImageUploadTrait;
    public function index(Request $request)
    {
        return view('blogs.blog_list');
    }

    public function blogsAjaxList(Request $request)
    {
        $createdDate = $request->created_date;
        $data['allBlogsData'] = $allBlogsData = Blogs::getAllBlogsList($createdDate);
        return json_encode($data);
    }

    public function create(Request $request)
    {
        $data['categories'] = Category::get();

        return view('blogs.blog_add', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:20',
            'description' => 'required',
            'category' => 'required',
            'blog_image' => 'required|mimes:jpg,jpeg,png,svg|max:2048'
        ]);

        if ($validator->fails()) {

            return redirect("/blogs/create")
                ->withErrors($validator, 'blog')
                ->withInput();
        } else {


            $blogsInsertArray = array(
                'title' => $request->post('title'),
                'description' => $request->post('description'),
            );

            if (!empty($request->hasFile('blog_image'))) {
                $images = $request->blog_image;
                $blogsInsertArray['image'] = $this->uploadImage($images, 'blogs');
            }

            $insert = Blogs::insert($blogsInsertArray);



            if ($insert) {
                $categories = $request->category;
                if (!empty($categories) && count($categories) > 0) {

                    foreach ($categories as $rawData) {
                        $blogsCategoryArray = array(
                            'blog_id' => $insert,
                            'category_id' => $rawData,
                        );
                        BlogsCategory::insert($blogsCategoryArray);
                    }
                }

                Session::flash('success',  Config::get('constants.options.InsertSuccessMSG'));
                return redirect('/blogs');
            } else {
                Session::flash('error', Config::get('constants.options.ErrorMSG'));
                return redirect('/blogs');
            }
        }
    }

    public function edit($id)
    {
        $data['id'] = $id =  $id;
        $data['editData'] = $editData =  Blogs::getBlogsById($id);
        $data['categories'] = Category::get();

        $blogsSelectedCategory = array();
        if(count($editData->blog_category) > 0){
            foreach($editData->blog_category as $rwData){
                $blogsSelectedCategory[] = $rwData->category_id;
            }
        }
        $data['blogsSelectedCategory'] = $blogsSelectedCategory;

        if (empty($editData)) {
            return redirect('blogs');
        }

        return view('blogs.blog_edit', $data);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:20',
            'description' => 'required',
            'category' => 'required',
        ]);

        if ($validator->fails()) {

            return redirect("/blogs/" . $id . '/edit')
                ->withErrors($validator, 'blog')
                ->withInput();
        } else {

            $blogUpdateArray = array(
                'title' => $request->post('title'),
                'description' => $request->post('description'),
            );

            if (!empty($request->hasFile('blog_image'))) {
                $images = $request->blog_image;
                $blogUpdateArray['image'] = $this->uploadImage($images, 'blogs');
            }

            $where = array('id' => $id);
            $update = Blogs::updateData($where, $blogUpdateArray);

            if ($update) {
                $categories = $request->category;
                if (!empty($categories) && count($categories) > 0) {

                    $whereBlogCategory = array('blog_id' => $id);
                    $delete = BlogsCategory::softDelete($whereBlogCategory);

                    foreach ($categories as $rawData) {
                        $blogsCategoryArray = array(
                            'blog_id' => $id,
                            'category_id' => $rawData,
                        );
                        BlogsCategory::insert($blogsCategoryArray);
                    }
                }
                Session::flash('success',  Config::get('constants.options.UpdateSuccessMSG'));
                return redirect('blogs');
            } else {
                Session::flash('error', Config::get('constants.options.ErrorMSG'));
                return redirect('blogs');
            }
        }
    }

    public function destroy($id)
    {
        $where = array('id' => $id);
        $delete = Blogs::softDelete($where);
        return $delete;
    }
}
