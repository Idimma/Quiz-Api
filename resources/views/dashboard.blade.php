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
    <p class="text-white">Web based quiz portal for all</p>
</header>

<div class="pt-2">
    <div class="card radius-10 ml-auto mr-auto mt-4 col-md-7">
        <div class="card-body p-lg-4 p-xs-2 p-xl-5">
            <h3 class="bold">Instructions</h3>
            <div class="mb-3">
                @foreach($instructions ?? [] as $inst)
                    @php
                        echo $inst->instructions ."<br>"
                    @endphp
                @endforeach
            </div>
            <form action="{{url('quiz')}}" method="post">
                @csrf
                <input name="name" hidden value="{{$name ?? ''}}">
                <input name="zone" hidden value="{{$zone ?? ''}}">
                <input name="user_id" hidden value="{{$user_id ?? ''}}">
                <input name="class" hidden value="{{$class ?? ''}}">

                <div>
                    Welcome <span class="bold text-primary">{{$name ?? ''}},</span>
                </div>
                <div class="py-3">
                    <p>Select Quiz Type</p>
                    <select name="type" class="form-control col-5">
                        @forelse($types ?? [] as $t)
                            <option>{{$t}}</option>
                        @empty
                            <option>Multiple Options</option>
                            <option>Spelling Bee</option>
                        @endforelse

                    </select>

                    <p class="pt-4">
                        I have read and understood the instructions stated above
                    </p>
                </div>

                <div class="row text-right px-5">
                    <button type="submit" class="btn-primary ml-auto btn btn-round"
                            style="width: 120px;">
                        Start Quiz
                    </button>
                </div>
            </form>

        </div>
    </div>

</div>


</body>
</html>

