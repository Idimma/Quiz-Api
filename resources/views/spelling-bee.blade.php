@extends('layouts.master')
@section('content')
    <div class="card radius-10 ml-auto mr-auto mt-4 col-md-10 col-sm-11 col-lg-9 col-xl-8" style="min-height: 70vh">
        <div class="card-body px-lg-4 px-md-3 px-xl-5 pt-lg-4 pt-md-3 pt-xl-5 ">
            <div style="min-height: 100px;"
                 class="d-flex justify-content-center align-items-center bg-gray radius-5 p-2">
                <h3 class="p-2 text-center text-black-50">
                    Click on start only when you are ready
                </h3>
            </div>
            <div class="d-flex pt-5 justify-content-center align-items-center  text-center">
                <h4 id="timer" class="text-center col-6">00:00</h4>
                <h4 id="counter" class="text-center col-6">1/15</h4>
            </div>
            <div style="min-height: 80px;"
                 class="d-flex flex-column justify-content-center align-items-center  radius-5 pt-3 pb-5">
                <label for="spell">Enter Spelling</label>
                <input class="form-control col-md-6 ml-auto mr-auto " id="spell">
            </div>


            <div class="row">
                <button class="btn-primary ml-auto  btn btn-round " style="width: 160px;" onclick="sayWord()">
                    SAY WORD
                </button>
                <button class="btn-success ml-5 mr-auto btn btn-round "
                        onclick="checkSpelling()">
                    DONE
                </button>
            </div>

        </div>

        <p class="text-center px-lg-4 px-md-3 px-xl-5 pb-2" style="font-size: 60%">
            Name: {{$name??''}} &nbsp;
            Zone: {{$zone??''}} &nbsp;
            Age Group: {{$class??''}} &nbsp;
        </p>
    </div>
@stop
@section('script')
    <script src="https://code.responsivevoice.org/responsivevoice.js?key=mWhii7gw"></script>
    <script>

        let words = [], timeLeft = 10,
            count = 0, answers = {}, timelog = {}, time, id = '0',
            ans = '', got = 0, timeStarted = false;

        const spell = document.getElementById('spell');
        const timer = document.getElementById("timer");

        function stopQuestions() {
            window.location.href =
                `{{url('/process')}}?name={{$name}}&class={{$class}}&zone={{$zone}}&got=${got}&timer=${
                    JSON.stringify(timelog)}&answers=${JSON.stringify(answers)}`;
        }

        spell.addEventListener("keyup", function (event) {
            // Number 13 is the "Enter" key on the keyboard
            if (event.keyCode === 13) {
                // Cancel the default action, if needed
                event.preventDefault();
                checkSpelling();
            }
        });

        function checkSpelling() {
            timeStarted = false;
            timer.innerHTML = "00:00";
            clearInterval(time);
            if (count >= words.length) {
                stopQuestions();
            }

            if (spell) {
                const word = spell.value;
                answers[id] = word;
                timelog[id] = timeLeft;
                if (word.toLocaleLowerCase() === words[count].word.toLowerCase()) {
                    got++
                }
            }
            spell.value = '';
            count++
        }


        function getWords() {
            fetch('{{url('api/spelling')}}').then(r => r.json()).then(res => {
                words = res.data;
            }).catch(console.log)
        }

        getWords();

        function sayWord() {
            if (!timeStarted) {
                startTimer();
            }
            pronounWord(words[count].word)
        }

        function formatTime(number) {
            return `0${number}`.slice(-2)
        }

        function startTimer() {
            let now = 0;
            timeStarted = true;
            // Update the count down every 1 second;
            time = setInterval(function () {
                // Find the timeLeft between now and the count down date
                now++;
                timeLeft = timeLeft - now;
                let minutes = Math.floor(timeLeft / 60);
                let seconds = timeLeft - minutes * 60;
                timer.innerHTML = formatTime(minutes) + ":" + formatTime(seconds);
                // If the count down is finished, write some text
                if (timeLeft < 0) {
                    checkSpelling();
                }
            }, 1000);
        }


        function pronounWord(word) {
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

@stop

