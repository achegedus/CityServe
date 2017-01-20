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
        <link rel="shortcut" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans:400,300,600&subset=cyrillic,latin">

        <!-- CSS Global Compulsory -->
        <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/style.css">

        <!-- CSS Header and Footer -->
        <link rel="stylesheet" href="assets/css/headers/header-default.css">
        <link rel="stylesheet" href="assets/css/footers/footer-v1.css">

        <!-- CSS Implementing Plugins -->
        <link rel="stylesheet" href="assets/plugins/animate.css">
        <link rel="stylesheet" href="assets/plugins/line-icons/line-icons.css">
        <link rel="stylesheet" href="assets/plugins/font-awesome/css/font-awesome.css">

        <!-- CSS Theme -->
        <link rel="stylesheet" href="assets/css/theme-colors/orange.css">

        <!-- CSS Customization -->
        <link rel="stylesheet" href="assets/css/custom.css">

        <link rel="stylesheet" href="/css/app.css">

        <script>
            window.Laravel = <?php echo json_encode(['csrfToken' => csrf_token()]); ?>
        </script>
    </head>

    <body>
    <div class="wrapper">
        <div id="app">
            <app></app>
        </div>
    </div>

        <!-- JS Global Compulsory -->
        <script src="assets/plugins/jquery/jquery.min.js"></script>
        <script src="assets/plugins/jquery/jquery-migrate.min.js"></script>
        <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>

        <!-- JS Implementing Plugins -->
        <script src="assets/plugins/back-to-top.js"></script>
        <script src="assets/plugins/smoothScroll.js"></script>

        <!-- JS Customization -->
        <script type="text/javascript" src="assets/js/custom.js"></script>

        <!-- JS Page Level -->
        <script src="assets/js/app.js"></script>

        <script>
            jQuery(document).ready(function() {
                App.init();
            });
        </script>

        <script src="/js/app.js"></script>


        <!--[if lt IE 9]>
        <script src="assets/plugins/respond.js"></script>
        <script src="assets/plugins/html5shiv.js"></script>
        <script src="assets/plugins/placeholder-IE-fixes.js"></script>
        <![endif]-->
    </body>

</html>
