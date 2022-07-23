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

                <h4 class="text-muted text-center m-t-0"><b>Sign UP</b></h4>

                <form method="POST" class="form-horizontal m-t-20" id="registerForm" action="{{route('user-register')}}" onsubmit="return validation()">
                    @csrf

                    <div class="form-group">
                        <div class="col-12">
                            <input id="name" type="text"  class="form-control " name="name" placeholder="Name">
                            <span style="color: red;" id="name_error">{{$errors->admin->first('name')}}</span>

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-12">
                            <input id="email" type="text"  class="form-control " name="email" placeholder="Email">
                            <span style="color: red;" id="email_error">{{$errors->admin->first('email')}}</span>

                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-12">
                            <input id="password" type="password" class="form-control " name="password" autocomplete="current-password" placeholder="Password">
                            <span style="color: red;" id="passworderror">{{$errors->admin->first('password')}}</span>

                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-12">
                            <input id="confirm_password" type="password" class="form-control " name="confirm_password" autocomplete="current-password" placeholder="Confirm Password">
                            <span style="color: red;" id="confirm_passworderror">{{$errors->admin->first('confirm_password')}}</span>

                        </div>
                    </div>

                    <div class="form-group text-center m-t-40">
                        <div class="col-12">
                            <button class="btn btn-primary btn-block btn-lg waves-effect waves-light" id="submitBtn1" type="submit">Register</button>
                        </div>
                    </div>

                    <div class="form-group m-t-30 m-b-0">
                        <div class="col-12">
                            <a href="{{route('login')}}" class="text-muted"><i class="fa fa-user m-r-5"></i>Log In</a>

                        </div>

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
    function validation(){
        $('#submitBtn1').attr('disabled', 'disabled');
        var temp = 0;

        var name = $('#name').val();
        var email = $('#email').val();
        var password = $('#password').val();
        var confirm_password = $('#confirm_password').val();

        if (name.trim() == '') {
            $('#name_error').html('Please enter Name');
            temp++;

        }else if(name.length > 20){
            $('#name_error').html('Name Should be less than 20 characters');
            temp++;
        }else{
            $('#name_error').html('');
        }

        if (email.trim() == '') {
            $('#email_error').html('Please enter Email');
            temp++;

        }else if(!ValidateEmail(email)){
            $('#email_error').html('Please enter valid Email');
            temp++;
        }else{
            $.ajax({
                async: false,
                global: false,
                url: "{{ route('check_customer_register_email')}}",
                type: "POST",
                data: {
                    email: email,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response)
                {
                    if (response == 1) {
                        $('#email_error').html("Email is already Exist");
                        temp++;
                    } else
                    {
                        $('#email_error').html("");
                    }
                }
            });

        }

        if (password.trim() == "") {
            $('#passworderror').html("Please enter Password");
            temp++;
        }else if(password.length < 8)
        {
            $("#passworderror").html("Password should be at least 8 characters long");
            temp++;
        }
        else
        {
            $('#passworderror').html("");
        }

        if (confirm_password.trim() == '') {
            $('#confirm_passworderror').html("Please enter Confirm Password");
            temp++;
        }else if(password != confirm_password)
        {
            $('#confirm_passworderror').html("Password and confirm password does not match");
            temp++;
        }
        else
        {
            $('#confirm_passworderror').html("");
        }


        if (temp == 0)
        {
           return true;
        } else
        {
            $('#submitBtn1').removeAttr('disabled');
            return false;
        }
    }

    function ValidateEmail(subscribeEmail)
    {
        var expr =
            /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
        return expr.test(subscribeEmail);
    }
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