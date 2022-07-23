<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta content="Admin Dashboard" name="description" />
    <meta content="ThemeDesign" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <link rel="shortcut icon" href="">
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">

    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/css/icons.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/dist/css/toastr.min.css')}}" rel="stylesheet" type="text/css">

    <style>
        input[type="text"]::-webkit-search-decoration,
        input[type="text"]::-webkit-search-cancel-button,
        input[type="text"]::-webkit-search-results-button,
        input[type="text"]::-webkit-search-results-decoration {
            -webkit-appearance: none;
        }
    </style>

</head>


<body>

    <!-- Begin page -->
    <div class="accountbg"></div>
    <div class="wrapper-page">
        <div class="card card-pages">
            <div class="card-body">
                <div class="text-center m-t-20 m-b-30">
                    <a href="#" class="logo logo-admin"><img src=""></a>
                </div>

                <h4 class="text-muted text-center m-t-0"><b>Sign In</b></h4>

                <form method="POST" class="form-horizontal m-t-20" id="loginForm" action="{{route('user-login')}}">
                    @csrf

                    <div class="form-group">
                        <div class="col-12">
                            <input id="email" type="text" yourInput class="form-control " name="email" placeholder="Email" required data-parsley-required-message='Please enter Email'>


                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-12">
                            <input id="password" type="password" class="form-control " name="password" autocomplete="current-password" placeholder="Password" required data-parsley-required-message='Please enter Password'>
                            <span style="color: red;" id="passworderror"></span>

                        </div>
                    </div>



                    <div class="form-group text-center m-t-40">
                        <div class="col-12">
                            <button class="btn btn-primary btn-block btn-lg waves-effect waves-light" id="submitBtn1" type="submit">Log In</button>
                        </div>
                        <br>
                        <a href="{{route('sign-up')}}">Register</a>
                    </div>

                    <div class="form-group m-t-30 m-b-0">


                    </div>

                </form>
            </div>
        </div>
    </div>



</body>
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

<script src="{{asset('assets/dist/js/toastr.min.js')}}"></script>
<script src="http://parsleyjs.org/dist/parsley.js"></script>

<script type="text/javascript">
    $('#loginForm').parsley();
</script>


@if(Session::has('success'))
<script>
    Command: toastr["success"]('{{Session::get("success") }}')
</script>
@endif

@if(Session::has('error'))
<script>
    Command: toastr["error"]('{{ Session::get("error") }}')
</script>
@endif


</html>