<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>EDG Quiz</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<body class="container-fluid " style="background-color: #147119; color: black">


<div id="dialogoverlay">
</div>
<div id="dialogbox">
    <div>
        <div id="dialogboxhead">
        </div>
        <div>
            <div style="display: inline-block">
            </div>
            <div id="dialogboxbody" align="center" style="display: inline-block" tex>
            </div>
        </div>
        <div id="dialogboxfoot">
        </div>
    </div>
</div>
<div>
    <header class="row body_header " style="color: white">
        <div class="col-md-3 text-center">
            <img src="{{asset('images/rccglogo.jpeg')}}" height="80px">
        </div>
        <div class="col-md-6 text-center">
            <h2 style="text-align: center; ">RCCG LP 69 BILBE QUIZ</h2>
        </div>
        <div class="col-md-3 text-center">
            <img src="{{asset('images/rccglogo.jpeg')}}" height="80px">
        </div>

    </header>
    <main class="quest modal-content">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4s">
                <a onclick="loadQuiz('stage1')">
                    <div class="panel panel-primary">
                        <div class="panel-heading text-center">
                            <img src="{{asset('images/rccglogo.jpeg')}}" height="80px">
                        </div>
                        <div class="panel-footer">
                            <span>STAGE 1</span>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4s">
                <a onclick="loadQuiz('stage2')">
                    <div class="panel panel-primary">
                        <div class="panel-heading text-center">
                            <img src="{{asset('images/rccglogo.jpeg')}}" height="80px">
                        </div>
                        <div class="panel-footer">
                            <span>STAGE 2</span>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4s">
                <a onclick="loadQuiz('stage3')">
                    <div class="panel panel-primary">
                        <div class="panel-heading text-center">
                            <img src="{{asset('images/rccglogo.jpeg')}}" height="80px">
                        </div>
                        <div class="panel-footer">
                            <span>STAGE 3</span>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="row">

            <div class="col-lg-4 col-md-4 col-sm-4s">
                <div class="panel panel-danger">
                    <a onclick="loadQuiz('draw1')">
                        <div class="panel-heading text-center" style="background-color: red">
                            <img src="{{asset('images/rccglogo.jpeg')}}" height="80px">
                        </div>
                        <div class="panel-footer text-center">
                            <span>DRAW 1</span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4s">
                <div class="panel panel-danger">
                    <a onclick="loadQuiz('draw2')" >
                        <div class="panel-heading text-center" style="background-color: red">
                            <img src="{{asset('images/rccglogo.jpeg')}}" height="80px">
                        </div>
                        <div class="panel-footer text-center">
                            <span>DRAW 2</span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4s">
                <div class="panel panel-danger">
                    <a onclick="loadQuiz('draw3')">
                        <div class="panel-heading text-center" style="background-color: red">
                            <img src="{{asset('images/rccglogo.jpeg')}}" height="80px">
                        </div>
                        <div class="panel-footer text-center">
                            <span>DRAW 3</span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>

        </div>
    </main>
    <div style="color: white; margin-top: 20px" class="text-center">Powered by GIDICODES Copyright &copy 2019</div>

</div>


<script type="text/javascript" src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/game.js')}}"></script>
<script type="text/javascript" src="{{asset('js/start.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
</body>
</html>