<!doctype html>
<html lang="en" dir="ltr">
<head>

    <!-- META DATA -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description"
          content="Volgh –  Bootstrap 4 Responsive Application Admin panel /theme Ui Kit & Premium Dashboard Design Modern Flat HTML Template">
    <meta name="author" content="Spruko Technologies Private Limited">
    <meta name="keywords"
          content="analytics dashboard, bootstrap 4 web app admin template, bootstrap admin panel, bootstrap admin template, bootstrap dashboard, bootstrap panel, Application dashboard design, dashboard design template, dashboard jquery clean html, dashboard template /theme, dashboard responsive ui, html admin backend template ui kit, html flat dashboard template, it admin dashboard ui, premium modern html template">

    <!-- FAVICON -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('/favicon.png')}}"/>

    <!-- TITLE -->
    <title>Admin Login</title>

    <!-- BOOTSTRAP CSS -->
    <link href="{{asset('/theme/assets/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet"/>

    <!-- STYLE CSS -->
    <link href="{{asset('/theme/assets/css/style.css')}}" rel="stylesheet"/>
    <link href="{{asset('/theme/assets/css/skin-modes.css')}}" rel="stylesheet"/>
    <link href="{{asset('/theme/assets/css/dark-style.css')}}" rel="stylesheet"/>

    <!-- SIDE-MENU CSS -->
    <link href="{{asset('/theme/assets/css/sidemenu.css')}}" rel="stylesheet">

    <!-- SINGLE-PAGE CSS -->
    <link href="{{asset('/theme/assets/plugins/single-page/css/main.css')}}" rel="stylesheet" type="text/css">

    <!--C3 CHARTS CSS -->
    <link href="{{asset('/theme/assets/plugins/charts-c3/c3-chart.css')}}" rel="stylesheet"/>

    <!-- P-scroll bar css-->
    <link href="{{asset('/theme/assets/plugins/p-scroll/perfect-scrollbar.css')}}" rel="stylesheet"/>

    <!--- FONT-ICONS CSS -->
    <link href="{{asset('/theme/assets/css/icons.css')}}" rel="stylesheet"/>

    <!-- COLOR SKIN CSS -->
    <link id="/theme" rel="stylesheet" type="text/css" media="all" href="{{asset('/theme/assets/colors/color1.css')}}"/>

</head>

<body>

<!-- BACKGROUND-IMAGE -->
<div class="login">

    <!-- GLOABAL LOADER -->
    <div id="global-loader">
        <img src="{{asset('/theme/assets/images/loader.svg')}}" class="loader-img" alt="Loader">
    </div>
    <!-- /GLOABAL LOADER -->

    <!-- PAGE -->
    <div class="page">
        <div class="">
            <!-- CONTAINER OPEN -->
            <div class="col col-login mx-auto">
                <div class="text-center">
                    <img src="{{asset('/images/brand/logo.png')}}" class="header-brand-img" alt="">
                </div>
            </div>
            <div class="container-login100">
                <div class="wrap-login100 p-6">
                    <form class="login100-form validate-form" action="{{asset(route('web.login'))}}" method="post">
                        @csrf
                        @method('post')
                        <span class="login100-form-title">
									Register
								</span>
                        <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                            <input class="input100" type="text" name="name" placeholder="Name" required>
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
										<i class="mdi mdi-account" aria-hidden="true"></i>
									</span>
                        </div>
                        <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                            <input class="input100" type="text" name="email" placeholder="Email" required>
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
										<i class="zmdi zmdi-email" aria-hidden="true"></i>
									</span>
                        </div>
                        <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                            <input class="input100" type="text" name="phone" placeholder="Phone" >
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
										<i class="zmdi zmdi-phone" aria-hidden="true"></i>
									</span>
                        </div>
                        <div class="wrap-input100 validate-input" data-validate="Password is required">
                            <input class="input100" type="password" name="password" placeholder="Password" required>
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
										<i class="zmdi zmdi-lock" aria-hidden="true"></i>
									</span>
                        </div>
                        <div class="text-end pt-1">
                            <p class="mb-0"><a href="forgot-password.html" class="text-primary ms-1">Forgot
                                    Password?</a></p>
                        </div>
                        @error('email')
                        <p class="text-danger text-center mt-3" id="error">{{ $message }}</p>
                        @enderror
                        <div class="container-login100-form-btn">
                            <button type="submit" class="login100-form-btn btn-primary">Login</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- CONTAINER CLOSED -->
        </div>
    </div>
    <!-- End PAGE -->

</div>
<!-- BACKGROUND-IMAGE CLOSED -->

<!-- JQUERY JS -->
<script src="{{asset('/theme/assets/js/jquery.min.js')}}"></script>

<!-- BOOTSTRAP JS -->
<script src="{{asset('/theme/assets/plugins/bootstrap/js/popper.min.js')}}"></script>
<script src="{{asset('/theme/assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>

<!-- SPARKLINE JS -->
<script src="{{asset('/theme/assets/js/jquery.sparkline.min.js')}}"></script>

<!-- CHART-CIRCLE JS -->
<script src="{{asset('/theme/assets/js/circle-progress.min.js')}}"></script>

<!-- RATING STAR JS -->
<script src="{{asset('/theme/assets/plugins/rating/jquery.rating-stars.js')}}"></script>

<!-- INPUT MASK JS -->
<script src="{{asset('/theme/assets/plugins/input-mask/jquery.mask.min.js')}}"></script>

<!-- Perfect SCROLLBAR JS-->
<script src="{{asset('/theme/assets/plugins/p-scroll/perfect-scrollbar.js')}}"></script>


<!-- CUSTOM JS-->
<script src="{{asset('/theme/assets/js/custom.js')}}"></script>
<script>
    let error = document.getElementById('error');
    if(error)
    {
        setTimeout(function (){
            error.style.display = 'none'
        },3000)
    }
</script>
</body>
</html>
