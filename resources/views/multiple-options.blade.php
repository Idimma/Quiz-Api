@extends('layouts.master')
@section('content')
    <div class="card radius-10 ml-auto mr-auto mt-4 col-md-10 col-sm-11 col-lg-9 col-xl-8" style="min-height: 70vh">
        <div class="card-body px-lg-4 px-md-3 px-xl-5 pt-lg-4 pt-md-3 pt-xl-5 ">
            <div style="min-height: 140px;"
                 class="d-flex justify-content-center align-items-center bg-gray radius-5 p-2">
                <p class="p-2 text-center text-black-50">
                    {{$question ?? ''}}
                </p>
            </div>
            <div class="d-flex justify-content-center align-items-center p-2 text-center">
                <h4 id="timer" class="text-center col-6">00:00</h4>
                <h4 class="text-center col-6">{{$count ?? '0'}}/15</h4>
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
                        <input class="form-check-input" type="radio" name="option" id="option1" value="{{$a ?? ''}}"
                               checked="">
                        <label class="form-check-label" for="option1">
                            <p>{{$a ?? ''}}</p>
                        </label>
                    </div>
                    <div class="form-check col-md-6">
                        <input class="form-check-input" type="radio" name="option" id="option2" value="{{$b ?? ''}}">
                        <label class="form-check-label" for="option2">
                            <p>{{$b ?? ''}}</p>
                        </label>
                    </div>
                    <div class="form-check col-md-6">
                        <input class="form-check-input" type="radio" name="option" id="option3" value="{{$c ?? ''}}">
                        <label class="form-check-label" for="option3">
                            <p>{{$c ?? ''}}</p>
                        </label>
                    </div>
                    <div class="form-check col-md-6">
                        <input class="form-check-input" type="radio" name="option" id="option4" value="{{$d ?? ''}}">
                        <label class="form-check-label" for="option4">
                            <p>{{$d ?? ''}}</p>
                        </label>
                    </div>
                    <div class="form-check col-md-6 ">
                        <input class="form-check-input" type="radio" name="option" id="option5" value="{{$e ?? ''}}">
                        <label class="form-check-label" for="option5">
                            <p>{{$e ?? ''}}</p>
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
        function getQuizQuestions() {
            fetch('{{url('api/quiz')}}').then(r=>json()).then(res=> {

            }).catch(console.log)
        }

        getQuizQuestions();
        const timer = document.getElementById("timer");
        const submit = document.getElementById("submit");
        const formatTime = number => `0${number}`.slice(-2);
        let now = 0;
        // Update the count down every 1 second
        let x = setInterval(function () {
            // Find the distance between now and the count down date
            now++;
            let distance = 10 - now;
            let minutes = Math.floor(distance / 60);
            let seconds = distance - minutes * 60;
            timer.innerHTML = formatTime(minutes) + ":" + formatTime(seconds);
            // If the count down is finished, write some text
            if (distance < 0) {
                clearInterval(x);
                timer.innerHTML = "00:00";
            }
        }, 1000);

        function submitForm() {
            submit.click();
        }
    </script>
@stop

