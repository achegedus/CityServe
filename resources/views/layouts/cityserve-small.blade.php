<!DOCTYPE html>
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<head>
    <title>CityServe 2017</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="description">
    <meta content="" name="author">

    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico">

    <!-- Web Fonts -->
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans:400,300,600&subset=cyrillic,latin">

    <!-- CSS Global Compulsory -->
    <link rel="stylesheet" type="text/css" href="/assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/style.css">


    <!-- CSS Header and Footer -->
    <link rel="stylesheet" href="/assets/css/headers/header-v6.css">
    <link rel="stylesheet" href="/assets/css/footers/footer-v7.css">

    <!-- CSS Implementing Plugins -->
    <link rel="stylesheet" href="/assets/plugins/animate.css">
    <link rel="stylesheet" href="/assets/plugins/line-icons/line-icons.css">
    <link rel="stylesheet" href="/assets/plugins/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="/assets/plugins/cube-portfolio/cubeportfolio/css/cubeportfolio.min.css">
    <link rel="stylesheet" href="/assets/plugins/cube-portfolio/cubeportfolio/custom/custom-cubeportfolio.css">

    <link rel="stylesheet" href="/assets/plugins/sky-forms-pro/skyforms/css/sky-forms.css">
    <link rel="stylesheet" href="/assets/plugins/sky-forms-pro/skyforms/custom/custom-sky-forms.css">
    <!--[if lt IE 9]><link rel="stylesheet" href="/assets/plugins/sky-forms-pro/skyforms/css/sky-forms-ie8.css"><![endif]-->

    <!-- CSS Theme -->
    <link rel="stylesheet" href="/assets/css/theme-colors/blue.css">

    <!-- CSS Customization -->
    <link rel="stylesheet" href="/assets/css/custom.css">

    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">

    <script>
        window.Laravel = <?php echo json_encode(['csrfToken' => csrf_token()]); ?>
    </script>
</head>

<body class="header-fixed header-fixed-space">

<!--=== Header v6 ===-->
<div class="header-v6 header-classic-white header-sticky">
    <!-- Navbar -->
    <div class="navbar mega-menu" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="menu-container">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Navbar Brand -->
                <div class="navbar-brand">
                    <a href="/">
                        <img class="default-logo" src="/CITY_SERVE_2017a.png" alt="Logo">
                        <img class="shrink-logo" src="/CITY_SERVE_2017a.png" alt="Logo">
                    </a>
                </div>
                <!-- ENd Navbar Brand -->


            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-responsive-collapse">
                <div class="menu-container">
                    <ul class="nav navbar-nav">
                        <!-- Home -->
                        <li class="dropdown">
                            <a href="/">
                                Home
                            </a>
                        </li>
                        <!-- End Home -->

                        <!-- About -->
                        <li class="dropdown">
                            <a href="/#about">
                                About
                            </a>
                        </li>
                        <!-- End About -->

                        <!-- Faq -->
                        <li class="dropdown">
                            <a href="/#faq">
                                FAQ
                            </a>
                        </li>
                        <!-- End Faq -->

                        <!-- Churches -->
                        <!--
                        <li class="dropdown">
                            <a href="/#churches">
                                Churches
                            </a>
                        </li>
                        -->
                        <!-- End Churches -->

                        <!-- Serve -->
                        <li class="dropdown">
                            <a href="/serve">
                                Serve
                            </a>
                        </li>
                        <!-- End Serve -->

                        <!-- Projects -->
                        <li class="dropdown">
                            <a href="/request">
                                Request a Project
                            </a>
                        </li>
                        <!-- End Projects -->

                        <!-- Login -->
                        <li class="dropdown">
                            <a href="/login">Login</a>
                        </li>
                        <!-- End Login -->

                        <!-- Register -->
                        <li>
                            <a href="/register">Register</a>
                        </li>

                    </ul>
                </div>
            </div><!--/navbar-collapse-->
        </div>
    </div>
    <!-- End Navbar -->
</div>
<!--=== End Header v6 ===-->

@yield('content')


<!-- JS Global Compulsory -->
<script src="/assets/plugins/jquery/jquery.min.js"></script>
<script src="/assets/plugins/jquery/jquery-migrate.min.js"></script>
<script src="/assets/plugins/bootstrap/js/bootstrap.min.js"></script>

<!-- JS Implementing Plugins -->
<script src="/assets/plugins/back-to-top.js"></script>
<script src="/assets/plugins/smoothScroll.js"></script>
<link rel="stylesheet" href="/assets/plugins/animate.css">
<!-- JS Customization -->
<script type="text/javascript" src="/assets/js/custom.js"></script>

<!-- JS Page Level -->
<script src="/assets/js/app.js"></script>

<script>
    jQuery(document).ready(function() {
        App.init();
    });
</script>

<script src="https://cdn.jsdelivr.net/vue.multiselect/2.0.0-beta.13/vue-multiselect.min.js"></script>
<script src="{{ mix('/js/app.js') }}"></script>

<script type="text/javascript" src="/assets/plugins/back-to-top.js"></script>
<script type="text/javascript" src="/assets/plugins/smoothScroll.js"></script>
<script type="text/javascript" src="/assets/plugins/jquery.parallax.js"></script>

<script type="text/javascript" src="/assets/plugins/cube-portfolio/cubeportfolio/js/jquery.cubeportfolio.min.js"></script>
<script type="text/javascript" src="/assets/js/plugins/cube-portfolio/cube-portfolio-3.js"></script>

<script type="text/javascript" src="/assets/js/custom.js"></script>


<!--[if lt IE 9]>
<script src="/assets/plugins/respond.js"></script>
<script src="/assets/plugins/html5shiv.js"></script>
<script src="/assets/plugins/placeholder-IE-fixes.js"></script>
<![endif]-->
</body>

</html>