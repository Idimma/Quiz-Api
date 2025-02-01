<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Gidicodes">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <!-- app favicon -->
    <link rel="shortcut icon" href="{{asset('images/rccg_img.png')}}">
    <title> Quiz Portal</title>
    <link href="{{asset('css/index.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/style.css')}}" type="text/css">
</head>
<body class="d-flex  flex-column">

<header style=" background: #0E1558 !important;" class="text-center text-white mb-3 py-2 ">
    <div class="d-flex justify-content-center align-items-center">
        <img height="45" width="45" src="{{asset('images/rccg_img.png')}}">
        <h1 class="ml-3 bold text-white">BIBLE QUIZ PORTAL</h1>
    </div>
    <p class="text-white">Web based quiz portal for children department</p>
</header>

<div class="pt-2">
    @yield('content', 'Default Content')
</div>
@yield('script')
</body>
</html>

