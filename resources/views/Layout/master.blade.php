<!doctype html>

<html lang="en">

@include('include.header')

<body class="fixed-left">

    <div id="wrapper">

        <div class="topbar">

            <!-- LOGO -->

            <div class="topbar-left ">

                <div class="text-center moreSpaceTop pb-2" style="background: #fff;">

                    <div class="text-center" style="margin-top: 15px">

                        <img src="assets/images/users/avatar-1.jpg" alt="" class="rounded-circle img-thumbnail" style="height:50px">
                    </div>

                </div>

            </div>

            <!-- Button mobile view to collapse sidebar menu -->



            <nav class="navbar navbar-default">

                <div class="container-fluid">

                    <ul class="list-inline menu-left mb-0">

                        <li class="float-left">

                            <button class="button-menu-mobile open-left waves-light waves-effect">

                                <i class="mdi mdi-menu"></i>

                            </button>

                        </li>



                    </ul>



                    <ul class="nav navbar-right float-right list-inline">




                        <li class="dropdown">

                            <a href="" class="dropdown-toggle profile waves-effect waves-light" data-toggle="dropdown" aria-expanded="true">






                                <span class="profile-username">

                                    {{ Auth::user()->name }}<span class="mdi mdi-chevron-down font-15"></span>

                                </span>

                            </a>

                            <ul class="dropdown-menu">





                                <!-- <li class="dropdown-divider"></li> -->

                                <li><a class="dropdown-item" href="{{route('logout')}}" onclick="event.preventDefault();

                                                     document.getElementById('logout-form').submit();">

                                        {{ __('Logout') }}

                                    </a>



                                    <form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none;">

                                        @csrf

                                    </form>
                                </li>

                            </ul>

                        </li>

                    </ul>

                </div>

            </nav>
        </div>


        @include('include.nav')


        <div id="wrapper">
            <div class="content-page">
                @yield('content')
            </div>
        </div>



    </div>


    @include('include.footer')
    <script src="{{asset('assets/js/jquery.min.js')}}"></script>

    <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>

    <script src="{{asset('assets/js/modernizr.min.js')}}"></script>

    <script src="{{asset('assets/js/detect.js')}}"></script>

    <script src="{{asset('assets/js/fastclick.js')}}"></script>

    <script src="{{asset('assets/js/jquery.slimscroll.js')}}"></script>

    <script src="{{asset('assets/js/jquery.blockUI.js')}}"></script>

    <script src="{{asset('assets/js/waves.js')}}"></script>

    <script src="{{asset('assets/js/wow.min.js')}}"></script>

    <script src="{{asset('assets/js/jquery.nicescroll.js')}}"></script>

    <script src="{{asset('assets/js/jquery.scrollTo.min.js')}}"></script>



    <!-- Charts -->

    <script src="{{asset('assets/js/loader.js')}}"></script>

    <script src="{{asset('assets/js/popper.min.js')}}"></script>



    <!--Morris Chart-->

    <script src="{{asset('assets/plugins/morris/morris.min.js')}}"></script>

    <script src="{{asset('assets/plugins/raphael/raphael.min.js')}}"></script>



    <!-- Sweet-Alert  -->


    <script src="{{asset('assets/plugins/sweetalert2/sweetalert.min.js')}}"></script>



    <!-- DatePicker  -->

    <script src="{{asset('assets/plugins/timepicker/bootstrap-timepicker.js')}}"></script>
    <script src="{{asset('assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')}}"></script>
    <script src="{{asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
    <script src="http://parsleyjs.org/dist/parsley.js"></script>

    <script type="text/javascript">
        $(".datepicker").datepicker({
            format: 'dd-M-yyyy'
        });
        $("small").removeClass("text-primary");
    </script>


    <!-- KNOB JS -->

    <script src="{{asset('assets/plugins/jquery-knob/excanvas.js')}}"></script>

    <script src="{{asset('assets/plugins/jquery-knob/jquery.knob.js')}}"></script>

    <script src="{{asset('assets/plugins/flot-chart/jquery.flot.min.js')}}"></script>

    <script src="{{asset('assets/plugins/flot-chart/jquery.flot.tooltip.min.js')}}"></script>

    <script src="{{asset('assets/plugins/flot-chart/jquery.flot.resize.js')}}"></script>

    <script src="{{asset('assets/plugins/flot-chart/jquery.flot.pie.js')}}"></script>

    <script src="{{asset('assets/plugins/flot-chart/jquery.flot.selection.js')}}"></script>

    <script src="{{asset('assets/plugins/flot-chart/jquery.flot.stack.js')}}"></script>

    <script src="{{asset('assets/plugins/flot-chart/jquery.flot.crosshair.js')}}"></script>

    <script src="{{asset('assets/dist/js/toastr.min.js') }}"></script>



    <!-- Required datatable js-->

    <script src="{{asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>

    <script src="{{asset('assets/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Buttons examples -->

    <script src="{{asset('assets/plugins/datatables/dataTables.buttons.min.js')}}"></script>

    <script src="{{asset('assets/plugins/datatables/buttons.bootstrap4.min.js')}}"></script>



    <script src="{{asset('assets/plugins/datatables/jszip.min.js')}}"></script>

    <script src="{{asset('assets/plugins/datatables/pdfmake.min.js')}}"></script>

    <script src="{{asset('assets/plugins/datatables/vfs_fonts.js')}}"></script>

    <script src="{{asset('assets/plugins/datatables/buttons.html5.min.js')}}"></script>

    <script src="{{asset('/assets/plugins/datatables/buttons.print.min.js')}}"></script>

    <script src="{{asset('assets/plugins/datatables/dataTables.fixedHeader.min.js')}}"></script>

    <script src="{{asset('assets/plugins/datatables/dataTables.keyTable.min.js')}}"></script>

    <script src="{{asset('assets/plugins/datatables/dataTables.scroller.min.js')}}"></script>

    <!-- Responsive examples -->

    <script src="{{asset('assets/plugins/datatables/dataTables.responsive.min.js')}}"></script>

    <script src="{{asset('assets/plugins/datatables/responsive.bootstrap4.min.js')}}"></script>

    <script src="{{asset('assets/pages/dashboard.js')}}"></script>

    <!-- Datatable init js -->

    <script src="{{asset('assets/pages/datatables.init.js')}}"></script>

    <script src="{{asset('assets/js/app.js')}}"></script>

    <!-- DateTimepicker js -->
    <script src="{{asset('assets/plugins/datetimepicker/js/bootstrap-datetimepicker.js')}}"></script>

    <script src="{{asset('assets/plugins/datetimepicker/js/bootstrap-datetimepicker.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>

    <!-- DateTimepicker js end -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>
    <script src="{{asset('assets/plugins/select2/select2.min.js')}}"></script>

    @yield('page-js')
    @if(Session::has('success'))
    <script>
        Command: toastr["success"]('{{ Session::get("success") }}');
    </script>

    @endif



    @if(Session::has('error'))

    <script>
        Command: toastr["error"]('{{Session::get("error") }}')
    </script>

    @endif