<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link rel="stylesheet" href="/css/app.css">

        <script>
            window.Laravel = <?php echo json_encode(['csrfToken' => csrf_token()]); ?>
        </script>


    </head>
    <body class="container">
        <div id="app">
            <app></app>
        </div>

        <script src="/js/app.js"></script>
    </body>
</html>
