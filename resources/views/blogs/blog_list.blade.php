@extends('Layout.master')
@section('content')

<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<!-- Start content -->
<div class="content">

    <div class="">
        <div class="page-header-title">
            <h4 class="page-title">Blogs</h4>
        </div>
    </div>

    <div class="page-content-wrapper">

        <div class="container-fluid">

            <div class="row">

                <div class="col-lg-12">

                    <div class="card">

                        <div class="card-header">



                            <a href="{{url('blogs/create')}}" class=" btn btn-normal btn-primary float-right"><i class="fa fa-fw fa-plus-square"></i> Add</a>





                            <h4 class="m-b-30 m-t-0">Blogs List</h4>

                        </div>

                        <div class="card-body">

                            <p>Date: <input type="text" class="form-control" id="datepicker" style="width: 25%;"></p>





                            <table id="blog_data" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; width: 100%;">

                                <thead>

                                    <tr>
                                        <th>No</th>
                                        <th>Title</th>
                                        <th>Image</th>
                                        <th>Created Date</th>
                                        <th>Action</th>
                                    </tr>

                                </thead>

                                <tbody class="blogs_data">
                                </tbody>

                            </table>



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
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://php8.appworkdemo.com/idg/public/admin/libs/moment/moment.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

<script>
    $(document).ready(function() {


        GetBlogsList(created_date = '');

        $('#datepicker').datepicker().on('change', function(ev) {
            var created_date = $(this).val();
            GetBlogsList(created_date);
        });

        function GetBlogsList(created_date = '') {
            $.ajax({
                type: "GET",
                url: "{{url('get-blogs-ajax-list')}}",
                data: {
                    created_date: created_date
                },
                success: function(res) {
                    $('.blogs_data').html("");
                    var data = JSON.parse(res);
                    var htmls = '';
                    if (data.allBlogsData.length > 0) {
                        var no = 1;
                        $.each(data.allBlogsData, function(k, v) {
                            var convertCreatedDate = moment(v.created_at).format('YYYY-MM-DD');
                            var image = '{{asset("/uploads/blogs/")}}/' + v.image;
                            var url = '{{url("blogs/")}}/'+v.id+'/edit';
                            htmls += '<tr>';
                            htmls += '<td>' + no++ + '</td><td>' + v.title + '</td><td><img src="' + image + '" height="50px;"></img></td><td>' + convertCreatedDate + '</td><td><a href="'+url+'" title="Edit"><img class="imgsvg" src= {{  Config::get("constants.options.ImgSrcDisplay") }}/svg/edit.svg></a>&nbsp;&nbsp;<a href="javascript:;" title="Delete" onclick="deleteBlog('+v.id+')"><img class="imgsvg" src= {{  Config::get("constants.options.ImgSrcDisplay") }}/svg/delete.svg></a></td>';
                            htmls += '</tr>';
                        });
                        $('.blogs_data').html(htmls);
                    } else {
                        htmls += '<tr><td colspan="5" align="center">No record available</td></tr>';
                        $('.blogs_data').html(htmls);
                    }
                },
            });
        }
    });

    function deleteBlog(id) { //sweet alert
        if(id != ''){
            event.preventDefault(); // prevent form submit
            var form = event.target.form; // storing the form
            swal({
                    title: "Are you sure you want to delete this blog ?",
                    showCancelButton: true,
                    confirmButtonColor: "#ef5c6a",
                    confirmButtonText: "Yes",
                    cancelButtonText: "No",
                    closeOnConfirm: true,
                    closeOnCancel: true
                },
                function(isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            url: "{{ URL::to('/') }}/blogs/" + id,
                            type: 'POST',
                            method: "DELETE",
                            data: {
                                id: id,
                                _token: "{{ csrf_token(); }}"
                            },
                            success: function(response) {
                                if (response) {
                                    toastr.success('Successfully deleted');
                                    window.location.href = "{{URL::to('blogs')}}";
                                }
                            }
                        });

                    }
                });
        }
    }
</script>
@endsection