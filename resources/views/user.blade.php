<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Gidicodes">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <!-- app favicon -->
    <link rel="shortcut icon" href="{{asset('images/rccg_img.png')}}">
    <title>Quiz Portal</title>
    <link href="{{asset('css/index.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/style.css')}}" type="text/css">
</head>
<body class="d-flex  flex-column">

<header style=" background:#14AAE0 !important;" class="text-center text-white mb-3 py-2 ">
    <div class="d-flex justify-content-center align-items-center">
        <img height="45" width="45" src="{{asset('images/rccg_img.png')}}">
        <h1 class="ml-3 bold text-white">BIBLE QUIZ PORTAL</h1>
    </div>
    <p class="text-white">Web based quiz portal for all</p>
</header>

<div class="pt-2">

    <div class="card radius-10 ml-auto mr-auto mt-4 col-md-6">

        <div class="card-body p-lg-4 p-xs-2 p-xl-5">
            <h3>Student Created Successfully</h3>
            <h5>Name: {{$user->name}}</h5>
            <h5>ID: <b>{{$user->user_id}}</b></h5>
            <h5>Age Group: {{$user->class}}</h5>
            <h5>Zone: {{$user->zone}}</h5>
            <div class="text-center pt-3">
                <a href="{{url('/')}}" style="width: 120px" class="btn-primary btn  btn-round ">
                    Start Quiz
                </a>
            </div>

        </div>
    </div>

</div>

</body>
</html>

