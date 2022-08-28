<!doctype html>
<html lang="en" dir="ltr">
<head>
    <?php
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
    ?>
        <!-- META DATA -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Goubba admin panel">
    <meta name="author" content="Goubba">
    <meta name="keywords" content="goubba admin">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- FAVICON -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('/favicon.png')}}"/>

    <!-- TITLE -->
    <title>Super Admin</title>

    <!-- BOOTSTRAP CSS -->
    <link href="{{asset('/theme/assets/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet"/>

    <!-- STYLE CSS -->
    <link href="{{asset('/theme/assets/css/style.css')}}" rel="stylesheet"/>
    <link href="{{asset('/theme/assets/css/skin-modes.css')}}" rel="stylesheet"/>
    <link href="{{asset('/theme/assets/css/dark-style.css')}}" rel="stylesheet"/>

    <!-- SIDE-MENU CSS -->
    <link href="{{asset('/theme/assets/css/sidemenu.css')}}" rel="stylesheet">

    <!--C3 CHARTS CSS -->
    <link href="{{asset('/theme/assets/plugins/charts-c3/c3-chart.css')}}" rel="stylesheet"/>

    <!-- P-scroll bar css-->
    <link href="{{asset('/theme/assets/plugins/p-scroll/perfect-scrollbar.css')}}" rel="stylesheet"/>

    <!--- FONT-ICONS CSS -->
    <link href="{{asset('/theme/assets/css/icons.css')}}" rel="stylesheet"/>

    <!-- SIDEBAR CSS -->
    <link href="{{asset('/theme/assets/plugins/sidebar/sidebar.css')}}" rel="stylesheet">
    <link href="{{asset('/theme/assets/lib/toastr/toastr.min.css')}}" rel="stylesheet">
    <!-- COLOR SKIN CSS -->
    <link id="theme" rel="stylesheet" type="text/css" media="all" href="{{asset('/theme/assets/colors/color1.css')}}"/>
    <!-- SELECT2 CSS -->
    <link href="{{asset('/theme/assets/plugins/select2/select2.min.css')}}" rel="stylesheet"/>

    <!--BOOTSTRAP-DATERANGEPICKER CSS-->
    <link rel="stylesheet" href="{{asset('/theme/assets/plugins/bootstrap-daterangepicker/daterangepicker.css')}}">

    <!-- TIME PICKER CSS -->
    <link href="{{asset('/theme/assets/plugins/time-picker/jquery.timepicker.css')}}" rel="stylesheet"/>

    <!-- DATE PICKER CSS -->
    <link href="{{asset('/theme/assets/plugins/date-picker/spectrum.css')}}" rel="stylesheet"/>
    <link href="{{asset('/theme/assets/plugins/datatable/css/dataTables.bootstrap5.min.css')}}" rel="stylesheet"/>
    <!-- MULTI SELECT CSS -->
    <link rel="stylesheet" href="{{asset('/theme/assets/plugins/multipleselect/multiple-select.css')}}">
    <link href="{{asset('/theme/assets/plugins/wysiwyag/richtext.css')}}" rel="stylesheet"/>
    <!-- COLOR SKIN CSS -->
    <link id="theme" rel="stylesheet" type="text/css" media="all" href="{{asset('/theme/assets/colors/color1.css')}}"/>
    <link href="{{asset('/theme/assets/plugins/datatable/css/dataTables.bootstrap5.min.css')}}" rel="stylesheet"/>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.79/theme-default.min.css"/>
    <link href="{{asset('/theme/assets/plugins/datatable/css/dataTables.bootstrap5.min.css')}}" rel="stylesheet"/>
    <!-- FILE UPLODE CSS -->
    <link href="{{asset('theme/assets/plugins/fileuploads/css/fileupload.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/css/custom.css')}}" rel="stylesheet" type="text/css"/>
    <!-- GALLERY CSS -->
    <link href="{{asset('/theme/assets/plugins/gallery/gallery.css')}}" rel="stylesheet">
    @yield('style')

    <style>
        .error {
            color: red !important;
        }
    </style>
</head>

<body class="app sidebar-mini">
{{--{{dd($all_nav)}}--}}
<!-- GLOBAL-LOADER -->
<div id="global-loader">
    <img src="{{asset('/theme/assets/images/loader.svg')}}" class="loader-img" alt="Loader">
</div>
<!-- /GLOBAL-LOADER -->

<!-- PAGE -->
<div class="page">
    <div class="page-main">

        <!--APP-SIDEBAR-->
        <div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
        <aside class="app-sidebar">
            @include('include.sideBarLogo')
            @include('include.sideNav')
        </aside>
        <!--/APP-SIDEBAR-->

        @include('include.mobileHeader')
        <!--app-content open-->
        <div class="app-content">
            <div class="side-app">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <div>
                        <h1 class="page-title">{{$pageTitle}}</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            @foreach($subTitle as $st)
                                @if(!next($subTitle))
                                    <li class="breadcrumb-item active" aria-current="page">
                                        {{$st}}
                                    </li>
                                @else
                                    <li class="breadcrumb-item">
                                        <a href="#">  {{$st}}</a>
                                    </li>
                                @endif

                            @endforeach
                        </ol>
                    </div>
                    <div class="d-flex  ms-auto header-right-icons header-search-icon">
                        <div class="dropdown d-md-flex">
                            <a class="nav-link icon full-screen-link nav-link-bg">
                                <i class="fe fe-maximize fullscreen-button"></i>
                            </a>
                        </div><!-- FULL-SCREEN -->
                        <div class="dropdown d-md-flex notifications">
                            <div class="dropdown profile-1">
                                <a href="#" data-bs-toggle="dropdown" class="nav-link pe-2 leading-none d-flex">
										<span>
                                             @if(auth()->user()->avatar != null)
                                                <img src="{{auth()->user()->avatar}}"
                                                     alt="profile-user"
                                                     class="avatar  profile-user brround cover-image">
                                            @else
                                                <img src="{{asset('/theme/assets/images/users/new.png')}}"
                                                     alt="profile-user"
                                                     class="avatar  profile-user brround cover-image">
                                            @endif
										</span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <div class="drop-heading">
                                        <div class="text-center">
                                            <h5 class="text-dark mb-0">{{auth()->user()->name}}</h5>
                                            <small class="text-muted">{{auth()->user()->name}}</small>
                                        </div>
                                    </div>
                                    <div class="dropdown-divider m-0"></div>
                                    <a class="dropdown-item" href="#">
                                        <i class="dropdown-icon mdi mdi-account-outline"></i> Profile
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <i class="dropdown-icon  mdi mdi-settings"></i> Settings
                                    </a>

                                    <form action="{{asset(route('logout'))}}" method="get">
                                        @csrf
                                        @method('get')
                                        <button type="submit" class="dropdown-item">
                                            <i class="dropdown-icon mdi  mdi-logout-variant"></i> Sign out
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xl-12">
                        @yield('content')
                    </div>
                </div>
            </div>

            <!-- CONTAINER END -->
        </div>


        @include('include.footer')
        <!-- FOOTER END -->

    </div>
</div>

<!-- BACK-TO-TOP -->
<a href="#top" id="back-to-top"><i class="fa fa-angle-up"></i></a>
<!-- JQUERY JS -->
<script src="{{asset('/theme/assets/js/jquery.min.js')}}"></script>

<!-- BOOTSTRAP JS -->
<script src="{{asset('/theme/assets/plugins/bootstrap/js/popper.min.js')}}"></script>
<script src="{{asset('/theme/assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>

<!-- SPARKLINE JS-->
<script src="{{asset('/theme/assets/js/jquery.sparkline.min.js')}}"></script>

<!-- CHART-CIRCLE JS-->
<script src="{{asset('/theme/assets/js/circle-progress.min.js')}}"></script>

<!-- RATING STARJS -->
<script src="{{asset('/theme/assets/plugins/rating/jquery.rating-stars.js')}}"></script>

{{--<!-- CHARTJS CHART JS-->--}}
<script src="{{asset('/theme/assets/plugins/chart/Chart.bundle.js')}}"></script>
<script src="{{asset('/theme/assets/plugins/chart/utils.js')}}"></script>

{{--<!-- PIETY CHART JS-->--}}
{{--<script src="{{asset('/theme/assets/plugins/peitychart/jquery.peity.min.js')}}"></script>--}}
{{--<script src="{{asset('/theme/assets/plugins/peitychart/peitychart.init.js')}}"></script>--}}

<!-- ECHART JS-->
<script src="{{asset('/theme/assets/plugins/echarts/echarts.js')}}"></script>

<!-- SIDE-MENU JS-->
<script src="{{asset('/theme/assets/plugins/sidemenu/sidemenu.js')}}"></script>

<!-- SIDEBAR JS -->
<script src="{{asset('/theme/assets/plugins/sidebar/sidebar.js')}}"></script>

<!-- Perfect SCROLLBAR JS-->
{{--<script src="{{asset('/theme/assets/plugins/p-scroll/perfect-scrollbar.js')}}"></script>--}}
{{--<script src="{{asset('/theme/assets/plugins/p-scroll/pscroll.js')}}"></script>--}}
{{--<script src="{{asset('/theme/assets/plugins/p-scroll/pscroll-1.js')}}"></script>--}}


<!-- APEXCHART JS -->
<script src="{{asset('/theme/assets/js/apexcharts.js')}}"></script>

<!-- INDEX JS -->
<script src="{{asset('/theme/assets/js/index1.js')}}"></script>

<!-- Color Change JS -->
<script src="{{asset('/theme/assets/js/color-change.js')}}"></script>


<!-- Perfect SCROLLBAR JS-->
<script src="{{asset('/theme/assets/plugins/p-scroll/perfect-scrollbar.js')}}"></script>
<script src="{{asset('/theme/assets/plugins/p-scroll/pscroll.js')}}"></script>
<script src="{{asset('/theme/assets/plugins/p-scroll/pscroll-1.js')}}"></script>

<!-- FILE UPLOADES JS -->
<script src="{{asset('/theme/assets/plugins/fileuploads/js/fileupload.js')}}"></script>
<script src="{{asset('/theme/assets/plugins/fileuploads/js/file-upload.js')}}"></script>

<!-- SELECT2 JS -->
<script src="{{asset('/theme/assets/plugins/select2/select2.full.min.js')}}"></script>

<!-- BOOTSTRAP-DATERANGEPICKER JS -->
<script src="{{asset('/theme/assets/plugins/bootstrap-daterangepicker/moment.min.js')}}"></script>
<script src="{{asset('/theme/assets/plugins/bootstrap-daterangepicker/daterangepicker.js')}}"></script>

<!-- TIMEPICKER JS -->
<script src="{{asset('/theme/assets/plugins/time-picker/jquery.timepicker.js')}}"></script>
<script src="{{asset('/theme/assets/plugins/time-picker/toggles.min.js')}}"></script>

<!-- DATEPICKER JS -->
<script src="{{asset('/theme/assets/plugins/date-picker/spectrum.js')}}"></script>
<script src="{{asset('/theme/assets/plugins/date-picker/jquery-ui.js')}}"></script>
<script src="{{asset('/theme/assets/plugins/input-mask/jquery.maskedinput.js')}}"></script>

<!-- MULTI SELECT JS-->
<script src="{{asset('/theme/assets/plugins/multipleselect/multiple-select.js')}}"></script>
<script src="{{asset('/theme/assets/plugins/multipleselect/multi-select.js')}}"></script>

<!-- FORMELEMENTS JS -->
<script src="{{asset('/theme/assets/js/form-elements.js')}}"></script>

<!-- CUSTOM JS -->
<script src="{{asset('/theme/assets/js/custom.js')}}"></script>
<script src="{{asset('/assets/js/methods.js')}}"></script>
<script src="{{asset('/assets/js/custom.js')}}"></script>

<!-- Color Change JS -->
<script src="{{asset('/theme/assets/js/color-change.js')}}"></script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"
        integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- DATA TABLE JS-->
<script src="{{asset('/theme/assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{asset('/theme/assets/lib/sweetalert2/sweetalert2.all.js')}}"></script>
<script type="text/javascript" src="{{asset('/theme/assets/lib/toastr/toastr.min.js')}}"></script>
<script src="{{asset('/theme/assets/plugins/datatable/js/dataTables.bootstrap5.min.js')}}"></script>
<script src="{{asset('/theme/assets/plugins/datatable/datatable.js')}}"></script>
<script src="{{asset('/theme/assets/plugins/datatable/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('/theme/assets/custom/custom.js')}}"></script>
<!-- WYSIWYG Editor JS -->
<script src="{{asset('/theme/assets/plugins/wysiwyag/jquery.richtext.js')}}"></script>
<script src="{{asset('/theme/assets/plugins/wysiwyag/wysiwyag.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>

<!-- GALLERY JS -->
<script src="{{('/theme/assets/plugins/gallery/picturefill.js')}}"></script>
<script src="{{('/theme/assets/plugins/gallery/lightgallery.js')}}"></script>
<script src="{{('/theme/assets/plugins/gallery/lightgallery-1.js')}}"></script>
<script src="{{('/theme/assets/plugins/gallery/lg-pager.js')}}"></script>
<script src="{{('/theme/assets/plugins/gallery/lg-autoplay.js')}}"></script>
<script src="{{('/theme/assets/plugins/gallery/lg-fullscreen.js')}}"></script>
<script src="{{('/theme/assets/plugins/gallery/lg-zoom.js')}}"></script>
<script src="{{('/theme/assets/plugins/gallery/lg-hash.js')}}"></script>
<script src="{{('/theme/assets/plugins/gallery/lg-share.js')}}"></script>
<script>
    @if(Session::has('message'))

    var type = "{{Session::get('alertType', 'info')}}";
    switch (type) {
        case 'info':
            toastr.info("{{Session::get('message')}}");
            break;
        case 'success':
            toastr.success("{{Session::get('message')}}");
            break;
        case 'warning':
            toastr.warning("{{Session::get('message')}}");
            break;
        case 'error':
            toastr.error("{{Session::get('message')}}");
            break;
    }
    @endif

    $("#myForm").validate({
        submitHandler: function (form) {
            form.submit();
        }
    })
</script>
@yield('script')
</body>
</html>
