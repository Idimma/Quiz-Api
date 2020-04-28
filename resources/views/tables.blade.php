<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>RCCG Quiz</title>
    <link href="{{asset('css/bootstrap.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/style.css')}}" type="text/css">
</head>
<body class="container-fluid " style="background-color: #147119; color: black">

<div>
    <header class="row body_header " style="color: white">
        <div class="col-lg-3 col-md-3 col-sm-3 text-center">
            <img src="{{asset('images/rccglogo.jpeg')}}" height="80px">
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
            <h4 id="title" class="title text-center">Tables</h4>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-3 text-center">
            <img src="{{asset('images/rccglogo.jpeg')}}" height="80px">
        </div>
    </header>
    <main class="quest modal-content">
        <div style="margin: 5px">
            <table class="table">
                <thead id="table_head">
                </thead>
                <tbody style="margin-left: 20px; margin-right: 20px" id="tables_row">
                </tbody>
            </table>
        </div>
    </main>
    <div style="color: white; margin-top: 20px" class="text-center">Powered by GIDICODES Copyright &copy 2019</div>

</div>


<script type="text/javascript" src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/game.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
</body>
</html>