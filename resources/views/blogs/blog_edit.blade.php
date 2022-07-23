@extends('Layout.master')
@section('content')



<!-- Start content -->
<div class="content">

    <div class="">
        <div class="page-header-title">
            <h4 class="page-title">Blog</h4>
        </div>
    </div>

    <div class="page-content-wrapper">

        <div class="container-fluid">

            <div class="row">

                <div class="col-lg-12">

                    <div class="card">

                        <div class="card-header">









                            <h4 class="m-b-30 m-t-0">Blog Edit</h4>

                        </div>

                        <div class="card-body">







                            <div class="row">

                                <div class="col-sm-12">



                                    <form method="POST" action="{{route('blogs.update',$editData->id)}}" id="blogsEditForm" enctype="multipart/form-data" onsubmit="return validation()" autocomplete="off">
                                        @method('PUT')
                                        @csrf





                                        <div class="form-group">

                                            <label for="title">Title<span style="color:red" class="required-error">&nbsp;*</span></label>

                                            <input type="text" name="title" autocomplete="off" value="{{$editData->title}}" class="form-control" id="title" placeholder="Title">

                                            <span style="color: red;" id="title_error">{{$errors->blog->first('title')}}</span>

                                        </div>

                                        <div class="form-group">

                                            <label for="description">Description<span style="color:red" class="required-error">&nbsp;*</span></label>

                                            <textarea name="description" autocomplete="off"  class="form-control editor1" id="description" placeholder="Description">{!!$editData->description!!}</textarea>

                                            <span style="color: red;" id="description_error">{{$errors->blog->first('description')}}</span>

                                        </div>

                                        <div class="form-group">

                                            <label for="category">Category<span style="color:red" class="required-error">&nbsp;*</span></label>

                                            <select name="category[]" class="form-control" id="category" multiple>
                                                <option value="">Select Category</option>
                                                @foreach($categories as $rwData)
                                                <option value="{{$rwData->id}}" @if(in_array($rwData->id,$blogsSelectedCategory)) selected @endif >{{$rwData->name}}</option>
                                                @endforeach
                                            </select>
                                            <span style="color: red;" id="category_error">{{$errors->blog->first('category')}}</span>

                                        </div>

                                        <div class="form-group">

                                            <label for="blog_image">Blog Image </label>

                                            <input type="file" name="blog_image" id="blog_image">

                                            <br>
                                            <span id="images_error" style="color:red;">{{$errors->blog->first('blog_image')}}</span>

                                            @if($editData->image != '')
                                                <img src= "{{asset('uploads/blogs')}}/{{$editData->image}}" height="50px">
                                            @endif
                                        </div>

                                        <button type="submit" id="submitBtn1" class="btn btn-primary waves-effect waves-light">Update</button>
                                        <a href="{{route('blogs.index')}}"><button type="button" class="btn btn-secondary waves-effect m-l-5 form_btn_margin_top">Cancel</button></a>

                                </div>

                            </div>

                            </form>

                        </div>

                    </div>

                </div>



            </div> <!-- End Row -->




        </div><!-- container-fluid -->

    </div><!-- container-fluid -->

</div> <!-- Page content Wrapper -->

</div>
<!-- content -->

@endsection



@section('page-js')
<script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script>
    $('.editor1').each(function() {
        CKEDITOR.replace($(this).prop('id'));

    });
</script>
<script>
    function validation() {

        $('#submitBtn1').attr('disabled', 'disabled');
        var temp = 0;

        var title = $('#title').val();
        var description = CKEDITOR.instances['description'].getData().replace(/<[^>]*>/gi, '').length;
        var category = $('#category').val();

        var blog_image = $('#blog_image').val();
        $('#images_error').html("");
        regex = new RegExp("(.*?)\.(jpg|png|jpeg|svg)$");



        if (title.trim() == '') {
            $('#title_error').html('Please enter Title');
            temp++;

        } else if (title.length > 20) {
            $('#title_error').html('Title Should be less than 20 characters');
            temp++;
        } else {
            $('#title_error').html('');
        }

        if (description == 0) {

            $('#description_error').html('Please enter Description');
            temp++;

        } else {

            $('#description_error').html('');
        }

        if (category == '') {
            $('#category_error').html('Please select Category');
            temp++;
        } else {
            $('#category_error').html('');
        }

        if (blog_image != "") {
            if (!(regex.test(blog_image))) {
                $('#images_error').html("Only JPG, PNG and JPEG Blog image is allowed");
                temp++;
            }
        }


        if (temp == 0) {
            return true;
        } else {
            $('#submitBtn1').removeAttr('disabled');
            return false;
        }
    }
</script>
@endsection