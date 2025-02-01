<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>RCCG Quiz</title>
    <link href="{{asset('css/bootstrap.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/style.css')}}" type="text/css">
</head>
<body class="container-fluid " style="background-color: white; color: black">

<div>
    <header class="row body_header " style="color: black">
        <div class="col-md-3 text-center">
            <img src="{{asset('images/rccglogo.jpeg')}}" height="80px">
        </div>
        <div class="col-md-6 text-center">
            <h2 style="text-align: center; ">BIBLE QUIZ</h2>
        </div>
        <div class="col-md-3 text-center">
            <img src="{{asset('images/rccglogo.jpeg')}}" height="80px">
        </div>

    </header>

    <main class="modal-content dashboard row"
          style="width: 80%; height: auto; margin: auto;    padding: 7px;    border-radius: 5px;    border: 1px #ccc solid;
    position: relative;">
        <form action="{{url('spell')}}" class="col-md-8 col-md-offset-2 mb-4" method="post">
            <div class="form-group">

                <h1 class="text-center">{{ucfirst($user)}}</h1>
                <h3 class="text-center">Number of Questions {{$no}}</h3>
                <h4 class="text-center">SCORE {{$score}}/{{$no}}</h4>

            </div>
{{--            <button class="btn btn-primary" type="submit"> Submit</button>--}}
            <div class="clearfix"></div>
        </form>
    </main>

</div>

<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/game.js"></script>
</body>
</html>

