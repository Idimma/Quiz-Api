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
            <h2 style="text-align: center; "> BIBLE QUIZ</h2>
        </div>
        <div class="col-md-3 text-center">
            <img src="{{asset('images/rccglogo.jpeg')}}" height="80px">
        </div>

    </header>

    <main class="modal-content dashboard row"
          style="width: 80%; height: auto; margin: auto;    padding: 7px;    border-radius: 5px;    border: 1px #ccc solid;
    position: relative;">
        <!--<div class="dashboard">-->
        <!--<h2>Test Your Bible Knowledge</h2>-->
        <div class="bdd col-md-6 col-md-offset-3">
            <form method="post" action="{{url('spell-insert')}}">
                {{csrf_field()}}
                <div class="row">
                    <input required type="text" name="spell" placeholder="Your Name"/>
                </div>
                <div class="row">
                    <div style="margin-top: 20px" class="btn-nav text-center">
                        <button class="nextbutton nextbuttonbackgroundsvg  " title="SUBMIT"
                                name="startnew"
                                type="submit"
                                value="SUBMIT" type="button">
                            Start
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <!--</div>-->
    </main>

</div>

<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/game.js">
</script>
</body>
</html>

