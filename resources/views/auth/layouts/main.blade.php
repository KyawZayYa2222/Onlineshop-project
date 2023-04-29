<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meron Olineshop</title>

    <link href="{{asset('admin/img/favicon.ico')}}" rel="icon">
    <link href="{{asset('user/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('user/bootstrap/css/bootstrap.min.css')}}">
    <link href="{{asset('user/css/style.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('user/css/responsive.css')}}">

</head>
<body>
    <content>
        <div class="container">
            @yield('content')
        </div>
    </content>

    <script type="text/javascript" src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('user/js/jquery-3.6.3.js')}}"></script>
    <script type="text/javascript" src="{{asset('user/js/custom.js')}}"></script>
</body>
</html>
