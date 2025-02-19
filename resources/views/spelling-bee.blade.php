@extends('layouts.master')
@section('content')
    <style>
        .spelling-input {
            border-radius: 10px;
        }

        .btn-transparent {
            background-color: transparent;
            border: none;
            outline: none;
        }

        .btn-transparent:active {
            border: none;
            outline: none;
        }

        .btn-transparent:focus {
            border: none;
            outline: none;
        }

        .speaker-btn {
            width: 150px;
            height: 150px;
        }

        @media screen and (max-width: 768px) {
            .speaker-btn {
                width: 100px;
                height: 100px;
            }
        }
    </style>
    <div class="row row-no-gutter">
        <div class="card radius-10 ml-auto mr-auto mt-4 col-md-10 col-sm-11 col-lg-9 col-xl-8 mb-4"
             style="min-height: 70vh">
            <div class="card-body px-lg-4 px-md-3 px-xl-5 pt-lg-4 pt-md-3 pt-xl-5 ">
                <div style="min-height: 100px;"
                     class="d-flex justify-content-center align-items-center bg-gray radius-5 p-2">
                    <h3 class="p-2 text-center text-black-50">
                        Click on start only when you are ready
                    </h3>
                </div>
                <div class="d-flex pt-5 justify-content-center align-items-center  text-center">
                    <h4 id="timer" class="text-center col-6">00:00</h4>
                    <h4 id="counter" class="text-center col-6">1/{{count($spellings)}}</h4>
                </div>


                <div class="d-flex flex-column justify-content-center mx-auto align-items-center radius-5 pt-2 pb-3">
                    <button class="border-0 mx-auto btn-transparent" onclick="sayWord()">
                        <img src="{{asset('images/speaker.svg')}}" alt="speaker" class="speaker-btn">
                    </button>
                </div>


                <div style="min-height: 80px;   max-width: 330px;"
                     class="d-flex flex-column justify-content-center  mx-auto align-items-center  radius-5 pt-3 pb-5">
                    <label for="spell" class="w-100  " style="font-size: 12px">Enter Spelling</label>

                    <div class="d-flex align-items-center w-100 " style="gap:10px">
                        <div class="flex-grow-1">
                            <input autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false"
                                   placeholder="Enter word you hear"
                                   class="spelling-input form-control  ml-auto mr-auto text-uppercase "
                                   style="height: 56px!important;"
                                   id="spell"/>
                        </div>

                        <button id="doneButton" style="display: none" class="btn-warning btn bg-warning btn-round "
                                onclick="checkSpelling()">
                            DONE
                        </button>
                    </div>
                    <p style="font-size: 10px" class="text-danger w-100 p-0">You can press enter when done</p>
                </div>


            </div>

            <p class="text-center px-lg-4 px-md-3 px-xl-5 pb-2" style="font-size: 60%">
                Name: {{$student->name??''}} &nbsp;
                Type: {{$student->type??''}} &nbsp;
                Level: {{$student->level??''}} &nbsp;
            </p>
        </div>
    </div>
@stop
@section('script')
    <script>
			const SPELLING_LIST = {!! json_encode($spellings) !!};
			const QUESTIONS_LIST = SPELLING_LIST.map(a => a.word);
			const AUDIO_LIST = SPELLING_LIST.map(a => a.audio);
			const QUESTION_COUNT = QUESTIONS_LIST.length
			const type = '{{$student->type ?? ''}}';
			const level = '{{$student->level??''}}';
			const Q_TIME = 15;
			const timeSpent = new Array(QUESTIONS_LIST.length).fill(0);
			const answers = new Array(QUESTIONS_LIST.length).fill('');
			let timeLeft = Q_TIME, CURRENT_INDEX = 0, time, score = 0, timeStarted = false;


			const spell = document.getElementById('spell');
			const timer = document.getElementById("timer");
			const counter = document.getElementById("counter");
			const doneButton = document.getElementById("doneButton");


			const stopQuestions = () => {
				const baseUrl = "{{ url('/process') }}";
				const params = new URLSearchParams({
					answers: JSON.stringify(QUESTIONS_LIST.map(w => w.toUpperCase())),
					given_answers: JSON.stringify(answers.map(w => w.toUpperCase())),
					questions: JSON.stringify(QUESTIONS_LIST.map(w => `Spell "${w.toUpperCase()}"`)),
					name: "{{ $student->name }}",
					type,
					level,
					user_id: "{{ $student->user_id }}",
					score,
					meta: JSON.stringify({maxTime: Q_TIME * QUESTION_COUNT,}),
					seconds_used: timeSpent.reduce((p, c) => c + p, 0),
					seconds_spread: JSON.stringify(timeSpent),
					seconds_allocated: Q_TIME,
					seconds_expected: Q_TIME * QUESTION_COUNT,
					no_questions: QUESTION_COUNT,
					question_type: 'Spelling Bee',
					percent: score / QUESTION_COUNT,
				});
				window.location.href = `${baseUrl}?${params.toString()}`
			};


			spell.addEventListener("keypress", function (event) {
				if (event.code === 'Enter') {
					event.preventDefault();
					const word = spell.value;
					if (!word.length) return sayWord();
					checkSpelling();
				}
			});

			function checkSpelling() {
				timeStarted = false;
				timer.innerHTML = "00:00";
				doneButton.style.display = 'none'
				clearInterval(time);
				if (spell) {
					const word = spell.value;
					answers[CURRENT_INDEX] = word;
					timeSpent[CURRENT_INDEX] = Q_TIME - timeLeft;
					if (word.toLocaleLowerCase() === QUESTIONS_LIST[CURRENT_INDEX].toLowerCase()) {
						score++
					}
					spell.value = '';
				}
				CURRENT_INDEX++

				if (CURRENT_INDEX >= QUESTIONS_LIST.length) {
					stopQuestions();
				}
			}




			const formatTime = number => `0${number}`.slice(-2);

			const startTimer = () => {
				if (!timeStarted) {
					timeStarted = true
					doneButton.style.display = 'block'
					timeLeft = Q_TIME;
				}
				counter.innerHTML = `${CURRENT_INDEX + 1}/${QUESTION_COUNT}`
				time = setInterval(function () {
					timeLeft = timeLeft - 1;
					let minutes = Math.floor(timeLeft / 60);
					let seconds = timeLeft - minutes * 60;
					timer.innerHTML = formatTime(minutes) + ":" + formatTime(seconds);
					if (timeLeft < 0) {
						checkSpelling();
					}
				}, 1000);
			};

			function sayWord() {
				if (!timeStarted) startTimer();
				pronounWord(AUDIO_LIST[CURRENT_INDEX])
			}

			function pronounWord(audioContent) {
				const audio = new Audio(`data:audio/mp3;base64,${audioContent}`);
				audio.play();
			}


    </script>

@stop

