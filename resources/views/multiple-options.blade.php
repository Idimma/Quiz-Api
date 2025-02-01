@extends('layouts.master')
@section('content')
    <style>
        .form-check-label p {
            font-size: 16px;
            color: black;
        }

        #question {
            font-size: 24px;
            font-weight: bold;
            color: black;
        }

        .form-check {
            border-color: rgb(236, 238, 243);
            border-width: 3px;
            border-style: solid;
            cursor: pointer;
            border-radius: 19px;
            margin: 10px;
        }
    </style>
    <div class="card radius-10 ml-auto mr-auto mt-4 col-md-10 col-sm-11 col-lg-9 col-xl-8">
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
            <div>
                <div class="row  px-5">
                    <label for="a" class="form-check col-md-6">
                        <input class="form-check-input" type="radio" name="option" onchange="selectOption('a')" id="a"
                               value="a">
                        <label class="form-check-label" for="a">
                            <p id="option1"></p>
                        </label>
                    </label>
                    <label for="b" class="form-check col-md-6">
                        <input class="form-check-input" type="radio" id="b" onchange="selectOption('b')" name="option"
                               value="b">
                        <label class="form-check-label" for="b">
                            <p id="option2"></p>
                        </label>
                    </label>
                    <label for="c" class="form-check col-md-6">
                        <input class="form-check-input" type="radio" onchange="selectOption('c')" id="c" name="option"
                               value="c">
                        <label class="form-check-label" for="c">
                            <p id="option3"></p>
                        </label>
                    </label>
                    <label for="d" class="form-check col-md-6">
                        <input class="form-check-input" id="d"
                               onchange="selectOption('d')" type="radio" value="d" name="option">
                        <label class="form-check-label" for="d">
                            <p id="option4"></p>
                        </label>
                    </label>
                    <label for="e" class="form-check col-md-6 ">
                        <input class="form-check-input" onchange="selectOption('e')" id="e" type="radio" name="option"
                               value="e">
                        <label class="form-check-label" for="e">
                            <p id="option5"></p>
                        </label>
                    </label>
                </div>
            </div>
        </div>
        <div class="d-flex px-lg-4 px-md-3 px-xl-5 pb-2 justify-content-between">
            <p class="text-left text-danger " style="font-size: 60%">
                Be sure before you check an answer, You only get one chance at it
            </p>
            <p class="text-right" style="font-size: 60%">
                Name: {{$name??''}} &nbsp;
                Type: {{$zone??''}} &nbsp;
                Level: {{$class??''}} &nbsp;
            </p>
        </div>
    </div>
@stop
@section('script')
    <script>

			const QUESTIONS_LIST = {!! $questions !!};
			const QUESTION_COUNT = QUESTIONS_LIST.length
			const type = '{{$zone}}';
			const level = '{{$class}}';
			const Q_TIME = 15;
			const givenAnswers = new Array(QUESTIONS_LIST.length).fill("");
			const timeSpent = new Array(QUESTIONS_LIST.length).fill(0);

			let secondsUsed = Q_TIME;
			let currentIndex = -1, time, score = 0;

			const stopQuestions = () => {
				const baseUrl = "{{ url('/process') }}";

				let maxTime = Q_TIME * QUESTION_COUNT;
				const params = new URLSearchParams({
					name: "{{ $name }}",
					type,
					level,
					user_id: "{{ $user_id }}",
					score,
					meta: JSON.stringify({maxTime,}),

					seconds_used: timeSpent.reduce((p, c) => c + p, 0),
					seconds_spread: JSON.stringify(timeSpent),
					seconds_allocated: Q_TIME,
					seconds_expected: Q_TIME * QUESTION_COUNT,

					no_questions: QUESTION_COUNT,
					question_type: 'Multiple Choice Questions',
					percent: score / QUESTION_COUNT,
					given_answers: JSON.stringify(givenAnswers),
					answers: JSON.stringify(QUESTIONS_LIST.map(q => q[q.answer])),
					questions: JSON.stringify(QUESTIONS_LIST.map(q => q.question)),
				});
				window.location.href = `${baseUrl}?${params.toString()}`;
			};

			function selectOption(opt) {
				clearInterval(time);
				const quiz = QUESTIONS_LIST[currentIndex];

				givenAnswers[currentIndex] = quiz[opt] || '';

				timeSpent[currentIndex] = Q_TIME - secondsUsed;

				if (opt === quiz.answer) score++;

				document.querySelector('.form-check').disabled = true;

				setTimeout(loadNextQuestion, 500);
			}


			function loadNextQuestion() {
				currentIndex++;
				if (currentIndex >= QUESTION_COUNT) return stopQuestions();

				document.querySelector('.form-check').disabled = false;
				const checked = document.querySelector('input[name="option"]:checked');
				if (checked) checked.checked = false;
				const questionView = document.getElementById("question");
				const counter = document.getElementById("counter");

				const renderOption = (opt, ele) => {
					const element = document.getElementById(ele);
					if (element) {
						if (!opt) {
							element.parentElement.parentElement.className = "d-none";
						} else {
							element.innerHTML = opt;
						}
					}
				}

				const quiz = QUESTIONS_LIST[currentIndex];
				if (quiz) {
					startTimer();
					counter.innerHTML = `${currentIndex + 1}/${QUESTIONS_LIST.length}`;
					const {c, e, a, answer, d, b, question} = quiz;
					questionView.innerHTML = question;
					renderOption(a, 'option1')
					renderOption(b, 'option2')
					renderOption(c, 'option3')
					renderOption(d, 'option4')
					renderOption(e, 'option5')
				}
			}


			const formatTime = number => `0${number}`.slice(-2);

			function startTimer() {
				let now = 0;
				const timer = document.getElementById("timer");
				timer.innerHTML = "00:15";
				time = setInterval(function () {
					now++;
					secondsUsed = Q_TIME - now;
					let minutes = Math.floor(secondsUsed / 60);
					let seconds = secondsUsed - minutes * 60;
					timer.innerHTML = formatTime(minutes) + ":" + formatTime(seconds);

					if (secondsUsed < 0) {
						clearInterval(time);
						timer.innerHTML = "00:00";
						selectOption('')
					}
				}, 1000);
			}


			loadNextQuestion();

    </script>
@stop

