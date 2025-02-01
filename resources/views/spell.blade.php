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
            <h2 style="text-align: center; "> BIBLE QUIZ</h2>
        </div>
        <div class="col-md-3 text-center">
            <img src="{{asset('images/rccglogo.jpeg')}}" height="80px">
        </div>

    </header>

    <main class="modal-content dashboard row"
          style="width: 80%; height: auto; margin: auto;    padding: 7px;    border-radius: 5px;    border: 1px #ccc solid;
    position: relative;">
        <form action="{{url('spell')}}" class="col-md-8 col-md-offset-2 mb-4" method="post">
            <h1 class="text-center">Question {{$no}}</h1>
            {{csrf_field()}}
            <div class="form-group">
                <label>Spell IT</label>
                <input name="spell" class="form-control"/>
                <input name="user" aria-hidden="true" hidden="true" class="d-none" value="{{$user}}"
                       class="form-control"/>
                <input name="no" aria-hidden="true" hidden="true" class="d-none" value="{{$no}}" class="form-control"/>
                <input name="score" aria-hidden="true" hidden="true" class="d-none" value="{{$score}}"
                       class="form-control"/>

            </div>

            <button class="btn btn-warning" id="say" type="button"> Say Word</button>
            <button class="btn btn-primary" type="submit"> Submit</button>
            <div class="clearfix"></div>
        </form>
    </main>

</div>
<script>



    const _9to12 = [
        'GENESIS',
        'EXODUS',

    ];
    function sayWord(word) {
// get all voices that browser offers
        var available_voices = window.speechSynthesis.getVoices();

// this will hold an english voice
        var english_voice = '';

// find voice by language locale "en-US"
// if not then select the first voice
        for (var i = 0; i < available_voices.length; i++) {
            if (available_voices[i].lang === 'en-US') {
                english_voice = available_voices[i];
                break;
            }
        }
        if (english_voice === '')
            english_voice = available_voices[0];

// new SpeechSynthesisUtterance object
        var utter = new SpeechSynthesisUtterance();
        utter.rate = 1;
        utter.pitch = 0.5;
        utter.text = `Spell ${word}`;
        utter.voice = english_voice;

// event after text has been spoken
        utter.onend = function () {
            // alert('Speech has finished');
        }

// speak
        window.speechSynthesis.speak(utter);
    }
</script>
<script type="text/javascript" src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/game.js')}}"></script>
<script>
    $('#say').click(() => {
        sayWord("Leviticus")
    });
</script>
</body>
</html>

