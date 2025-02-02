@extends('layouts.master')
@section('content')
    <style>
        .spelling-input {
            border-radius: 10px;
        }
        .btn-transparent{
            background-color: transparent;
            border: none;
            outline: none;
        }
        .btn-transparent:active{
            border: none;
            outline: none;
        }
        .btn-transparent:focus{
            border: none;
            outline: none;
        }

    </style>
    <div class="card radius-10 ml-auto mr-auto mt-4 col-md-10 col-sm-11 col-lg-9 col-xl-8 mb-4" style="min-height: 70vh">
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
                    <svg width="208" height="208" viewBox="0 0 208 208" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g filter="url(#filter0_di_29_1071)">
                            <circle cx="104" cy="100" r="100" fill="#EB1925"/>
                            <circle cx="104" cy="100" r="98.0263" stroke="#D9D9D9" stroke-width="3.94737"/>
                        </g>
                        <g clip-path="url(#clip0_29_1071)">
                            <path d="M120.071 96.7857C120.071 101.048 118.378 105.136 115.364 108.15C112.35 111.164 108.262 112.857 104 112.857C99.7376 112.857 95.6497 111.164 92.6357 108.15C89.6218 105.136 87.9285 101.048 87.9285 96.7857V74.2857C87.9285 70.0233 89.6218 65.9355 92.6357 62.9215C95.6497 59.9075 99.7376 58.2143 104 58.2143C108.262 58.2143 112.35 59.9075 115.364 62.9215C118.378 65.9355 120.071 70.0233 120.071 74.2857V96.7857Z"
                                  stroke="white" stroke-width="7" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M136.143 100C136.151 103.801 135.409 107.567 133.958 111.08C132.507 114.594 130.377 117.787 127.689 120.474C125.001 123.162 121.808 125.293 118.295 126.744C114.781 128.194 111.016 128.937 107.214 128.929H100.786C96.9844 128.937 93.2189 128.194 89.7053 126.744C86.1917 125.293 82.9993 123.162 80.3113 120.474C77.6233 117.787 75.4928 114.594 74.042 111.08C72.5912 107.567 71.8487 103.801 71.8572 100"
                                  stroke="white" stroke-width="7" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M104 128.929V141.786" stroke="white" stroke-width="7" stroke-linecap="round"
                                  stroke-linejoin="round"/>
                        </g>
                        <defs>
                            <filter id="filter0_di_29_1071" x="0" y="0" width="208" height="216.211"
                                    filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                                <feColorMatrix in="SourceAlpha" type="matrix"
                                               values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
                                <feOffset dy="4"/>
                                <feGaussianBlur stdDeviation="2"/>
                                <feComposite in2="hardAlpha" operator="out"/>
                                <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0"/>
                                <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_29_1071"/>
                                <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_29_1071"
                                         result="shape"/>
                                <feColorMatrix in="SourceAlpha" type="matrix"
                                               values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
                                <feMorphology radius="3" operator="dilate" in="SourceAlpha"
                                              result="effect2_innerShadow_29_1071"/>
                                <feOffset dy="22"/>
                                <feGaussianBlur stdDeviation="9.60526"/>
                                <feComposite in2="hardAlpha" operator="arithmetic" k2="-1" k3="1"/>
                                <feColorMatrix type="matrix"
                                               values="0 0 0 0 1 0 0 0 0 0.413097 0 0 0 0 0.413097 0 0 0 1 0"/>
                                <feBlend mode="normal" in2="shape" result="effect2_innerShadow_29_1071"/>
                            </filter>
                            <clipPath id="clip0_29_1071">
                                <rect width="90" height="90" fill="white" transform="translate(59 55)"/>
                            </clipPath>
                        </defs>
                    </svg>
                </button>
            </div>


            <div style="min-height: 80px;   max-width: 330px;"
                 class="d-flex flex-column justify-content-center  mx-auto align-items-center  radius-5 pt-3 pb-5">
                <label for="spell" class="w-100  " style="font-size: 12px">Enter Spelling</label>
                <input autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false"
                       placeholder="Enter word you hear"
                       class="spelling-input form-control   ml-auto mr-auto text-uppercase "
                       style="height: 56px!important;"
                       id="spell"/>
                <p style="font-size: 60%" class="text-danger p-0">You can press enter when done</p>
            </div>


            <div class="row center">

                <button id="doneButton" style="display: none" class="btn-warning   mx-auto btn bg-warning btn-round "
                        onclick="checkSpelling()">
                    DONE
                </button>
            </div>

        </div>

        <p class="text-center px-lg-4 px-md-3 px-xl-5 pb-2" style="font-size: 60%">
            Name: {{$student->name??''}} &nbsp;
            Type: {{$student->type??''}} &nbsp;
            Level: {{$student->level??''}} &nbsp;
        </p>
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


			function sayWord() {
				if (!timeStarted) startTimer();
				pronounWord(AUDIO_LIST[CURRENT_INDEX])
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

			function pronounWord(audioContent) {
				const audio = new Audio(`data:audio/mp3;base64,${audioContent}`);
				audio.play();
			}


    </script>

@stop

