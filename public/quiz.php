<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>EDG Quiz</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<body class="container-fluid " style="background-color: white; color: black">


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
    <header class="row body_header " style="color: black">
        <div class="col-md-3 text-right">
            <img src="images/rccglogo.jpeg" height="80px">
        </div>
        <div class="col-md-3">
            <h2 style="text-align: center; " class="timer" id="game-timer">00:59</h2>
        </div>
        <div class="col-md-3">
            <h2 style="text-align: center;" id="ques">1/15</h2>
        </div>
        <div class="col-md-3 text-left">
            <img src="images/rccglogo.jpeg" height="80px">
        </div>

    </header>
    <main class="quest modal-content">
        <div class="question modal-header">
            <strong><h4 id="question-view" style="text-align: center; ">
                </h4></strong>
        </div>
        <div class="modal-body disabled">
            <form class="choices" id="choice">
                <div class="row opt">

                    <label class=" col-md-6" id="A">
                        <input type="radio" name="opt" value="A" id="opt1"/>
                    </label>
                    <label class=" col-md-6" id="B">
                        <input type="radio" name="opt" value="B" id="opt2"/>
                    </label>

                </div>

                <div class="row opt">
                    <label class="col-md-6" id="C">
                        <input type="radio" name="opt" value="C" id="opt3"/>
                    </label>
                    <label class="col-md-6" id="D">
                        <input type="radio" name="opt" value="D" id="opt4"/>
                    </label>
                </div>

            </form>
            <div class="btn-nav text-center">
                <button class="invisible nextbutton nextbuttonbackgroundsvg  " onclick="calculate()" title="SUBMIT"
                        name="startnew"
                        id='next' value="SUBMIT" type="button">
                    SUBMIT
                </button>
            </div>
        </div>
    </main>
    <div style="color: white; margin-top: 20px" class="text-center">Powered by EDG Copyright &copy 2018</div>

</div>

<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/game.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>