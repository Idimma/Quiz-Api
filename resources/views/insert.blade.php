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

    <main class="modal-content dashboard row"
          style="width: 80%; height: auto; margin: auto;    padding: 7px;    border-radius: 5px;    border: 1px #ccc solid;
    position: relative;">
        <form action="{{url('insert')}}" class="col-md-8 col-md-offset-2" method="post">
            <div class="form-group">
                <label>Question</label>
                <input name="question" class="form-control"/>
            </div>
            <div class="form-group">
                <label>A</label>
                <input name="A" class="form-control"/>
            </div>
            <div class="form-group">
                <label>B</label>
                <input name="B" class="form-control"/>
            </div>
            <div class="form-group">
                <label>C</label>
                <input name="C" class="form-control"/>
            </div>
            <div class="form-group">
                <label>D</label>
                <input name="D" class="form-control"/>
            </div>
            <div class="form-group">
                <label>Answer</label>
                <select class="form-control" name="answer" >
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="D">D</option>
                </select>
            </div>   <div class="form-group">
                <label>Stage</label>
                <select class="form-control" name="stage" >
                    <option value="stage1">Stage 1</option>
                    <option value="stage2">Stage 2</option>
                    <option value="stage3">Stage 3</option>
                </select>
            </div>

            <button type="submit"> Submit</button>
        </form>
    </main>

</div>

<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/game.js"></script>
</body>
</html>

