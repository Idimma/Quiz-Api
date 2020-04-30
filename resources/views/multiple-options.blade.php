@extends('layouts.master')
@section('content')
    <div class="card radius-10 ml-auto mr-auto mt-4 col-md-10 col-sm-11 col-lg-9 col-xl-8" style="min-height: 70vh">
        <div class="card-body px-lg-4 px-md-3 px-xl-5 pt-lg-4 pt-md-3 pt-xl-5 ">
            <div style="min-height: 140px;"
                 class="d-flex justify-content-center align-items-center bg-gray radius-5 p-2">
                <p id="question" class="p-2 text-center text-black-50">

                </p>
            </div>
            <div class="d-flex justify-content-center align-items-center p-2 text-center">
                <h4 id="timer" class="text-center col-6">00:00</h4>
                <h4 id="counter" class="text-center col-6"></h4>
            </div>
            <form action="{{url('next-question')}}" method="post">
                @csrf
                <input name="name" hidden value="{{$name ?? ''}}">
                <input name="zone" hidden value="{{$zone ?? ''}}">
                <input name="class" hidden value="{{$class ?? ''}}">
                <input name="class" hidden value="{{$count ?? ''}}">
                <input type="submit" hidden id="submit">
                <div class="row  pl-5">
                    <div class="form-check col-md-6">
                        <input class="form-check-input" type="radio" name="option" onchange="selectOption('a')" id="a"
                               value="a">
                        <label class="form-check-label" for="a">
                            <p id="option1"></p>
                        </label>
                    </div>
                    <div class="form-check col-md-6">
                        <input class="form-check-input" type="radio" id="b" onchange="selectOption('b')" name="option"
                               value="b">
                        <label class="form-check-label" for="b">
                            <p id="option2"></p>
                        </label>
                    </div>
                    <div class="form-check col-md-6">
                        <input class="form-check-input" type="radio" onchange="selectOption('c')" id="c" name="option"
                               value="c">
                        <label class="form-check-label" for="c">
                            <p id="option3"></p>
                        </label>
                    </div>
                    <div class="form-check col-md-6">
                        <input class="form-check-input" id="d"
                               onchange="selectOption('d')" type="radio" value="d" name="option">
                        <label class="form-check-label" for="d">
                            <p id="option4"></p>
                        </label>
                    </div>
                    <div class="form-check col-md-6 ">
                        <input class="form-check-input" onchange="selectOption('e')" id="e" type="radio" name="option"
                               value="e">
                        <label class="form-check-label" for="e">
                            <p id="option5"></p>
                        </label>
                    </div>
                </div>
            </form>
        </div>
        <div class="d-flex px-lg-4 px-md-3 px-xl-5 pb-2 justify-content-between">
            <p class="text-left text-danger " style="font-size: 60%">
                Be sure before you check an answer, You only get one chance at it
            </p>
            <p class="text-right" style="font-size: 60%">
                Name: {{$name??''}} &nbsp;
                Zone: {{$zone??''}} &nbsp;
                Age Group: {{$class??''}} &nbsp;
            </p>
        </div>
    </div>
@stop
@section('script')
    <script>


        let questions = [], count = -1, answers = {}, time, id = '0', ans ='', got = 0;
        const submit = document.getElementById("submit");

        function stopQuestions() {
            window.location.href =
                `{{url('/process')}}?name={{$name}}&class={{$class}}&zone={{$zone}}&got=${got}&answers=${JSON.stringify(answers)}`;
        }

        function selectOption(opt) {
            clearInterval(time);
            answers[id] = opt; // === ans;
            if(opt === ans){
                got++;
            }
            document.querySelector('.form-check').disabled = true;
            setTimeout(function () {
                if ((count + 1) >= questions.length) {
                    stopQuestions();
                    return
                }
                loadNextQuestion();
            }, 500);
        }

        function loadNextQuestion() {
            count++;
            document.querySelector('.form-check').disabled = false;
            const checked = document.querySelector('input[name="option"]:checked');
            if (checked) {
                checked.checked = false;
            }

            const questionView = document.getElementById("question");
            const counter = document.getElementById("counter");
            const opt1 = document.getElementById("option1");
            const opt2 = document.getElementById("option2");
            const opt3 = document.getElementById("option3");
            const opt4 = document.getElementById("option4");
            const opt5 = document.getElementById("option5");
            const quiz = questions[count];

            questionView.innerHTML = quiz.questions;
            opt1.innerHTML = quiz.a;
            opt2.innerHTML = quiz.b;
            opt3.innerHTML = quiz.c;
            opt4.innerHTML = quiz.d;
            opt5.innerHTML = quiz.e;
            id = quiz.id;
            ans = quiz.answers.toLowerCase();
            counter.innerHTML = `${count + 1}/${questions.length}`;
            startTimer();
        }

        function getQuizQuestions() {
            fetch('{{url('api/quiz')}}').then(r => r.json()).then(res => {
                questions = res.data;
                loadNextQuestion();
            }).catch(console.log)
        }

        getQuizQuestions();

        function formatTime(number) {
            return `0${number}`.slice(-2)
        }

        function startTimer() {
            let now = 0;
            // Update the count down every 1 second
            const timer = document.getElementById("timer");
            time = setInterval(function () {
                // Find the distance between now and the count down date
                now++;
                let distance = 10 - now;
                let minutes = Math.floor(distance / 60);
                let seconds = distance - minutes * 60;
                timer.innerHTML = formatTime(minutes) + ":" + formatTime(seconds);
                // If the count down is finished, write some text
                if (distance < 0) {
                    clearInterval(time);
                    timer.innerHTML = "00:00";
                    selectOption('')
                }
            }, 1000);
        }

        function submitForm() {
            submit.click();
        }
    </script>
@stop

