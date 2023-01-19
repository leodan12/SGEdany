@include('base.scripts')
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Bootstrap CSS -->
<?php echo Html::style('css/bootstrap.min.css')?>
<!-- bootstrap theme -->
<?php echo Html::style('css/bootstrap-theme.css')?>
<!--external css-->
<!-- font icon -->
<?php echo Html::style('css/elegant-icons-style.css')?>
<?php echo Html::style('css/font-awesome.css')?>
<?php echo Html::style('css/style.css')?>
<?php echo Html::style('css/style-responsive.css')?>

    <?php echo Html::script('js/jquery-1.12.4.min.js')?>


    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>RESWORK EIRL</title>

</head>
<body class="login-img3-body">
    
    @yield('content')
</body>
</html>
