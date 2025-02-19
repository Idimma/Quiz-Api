@extends('layouts.master', [])
@section('js')
    <script src="https://unpkg.com/react@18/umd/react.development.js"></script>
    <script src="https://unpkg.com/react-dom@18/umd/react-dom.development.js"></script>
    <script src="https://unpkg.com/babel-standalone@6/babel.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <style>
        .time-counter {
            min-width: 56px;
            height: 33px;
            border-radius: 8px;
            padding: 8px 10px;
            gap: 4px;
            background-color: #F8E5BE;
            transition: background 0.5s ease-in-out;
        }

        .blink {
            background-color: red;
            color: white;
            animation: blink-animation 1s infinite;
        }

        @keyframes blink-animation {
            50% {
                background-color: #F8E5BE;
            }
        }

        .question-view {
            box-shadow: 0 20px 50px -10px #00000026;
            background: #FFFFFF;
            width: 100%;
            height: 229px;
            border-radius: 20px;
            display: flex;
            color: #000000;
            justify-content: center;
            align-items: center;
            padding: 20px;
            text-align: center;
            margin-top: -30px;
            z-index: 2;
        }

        .paragraph-view {
            box-shadow: 0 20px 50px -10px #00000026;
            background: #FFFFFF;
            width: 100%;
            min-height: 229px;
            border-radius: 20px;
            color: #000000;

            padding: 20px;
            text-align: left;
            margin-top: 30px;
        }

        .selector-options {
            width: 100%;
            padding: 8px 20px;
            display: flex;
            border-radius: 15px;
            box-shadow: 0 20px 50px -10px #00000026;
            background: #FFFFFF;
            min-height: 45px;
            justify-content: flex-start;
            gap: 10px;
            flex-direction: row;
            align-items: center;
        }

        .selector-options svg {
            width: unset !important;
        }
    </style>
@stop
@section('content')
    <div class="mobile-content py-[22px] overflow-y-hidden" style="background-color: rgba(0,0,0, 0.01)">
        <div class="flex-1 flex flex-col" id="question-panel"></div>
    </div>
@stop
@section('script')
    <script type="text/babel">
			const QUESTIONS = {!! $questions !!};
			const STUDENT = {!! $student !!};
			const maxSec = 60;

			const TOTAL_TIME = QUESTIONS.reduce((p, c) => p + c.timer, 0);
			const ANSWERS = QUESTIONS.map(w => w.answer);
			const QUESTION_COUNT = QUESTIONS.length
			const givenAnswers = new Array(QUESTION_COUNT).fill("");
			const timeSpent = new Array(QUESTION_COUNT).fill(0);
			let score = 0;


			const {useState, useEffect, useRef, forwardRef} = React

			const Selector = ({label, onClick, isSelected, option = 'a'}) => {
				return (
					<div
						className={`selector-options fade-in ${isSelected ? "selected" : ""}`}
						onClick={onClick}
						onKeyDown={(e) => {
							if (e.key === option) {
								onClick();
							}
						}}
						role="button"
						tabIndex={0}
						aria-pressed={isSelected}
					>
						{/* Checked and Unchecked SVGs */}
						{isSelected ? (
							<svg
								width="20"
								height="20"
								viewBox="0 0 24 24"
								fill="none"
								stroke="currentColor"
								strokeWidth="2"
								strokeLinecap="round"
								strokeLinejoin="round"
							>
								<polyline points="20 6 9 17 4 12"></polyline>
							</svg>
						) : (
							<svg
								width="20"
								height="20"
								viewBox="0 0 24 24"
								fill="none"
								stroke="currentColor"
								strokeWidth="2"
								strokeLinecap="round"
								strokeLinejoin="round"
							>
								<circle cx="12" cy="12" r="10"></circle>
							</svg>
						)}
						<span>{label}</span>
					</div>
				);
			};


			const CircularProgress = ({size = 120, progress = 0, strokeWidth = 7}) => {
				const radius = (size - strokeWidth) / 2; // Adjust for stroke width
				const circumference = 2 * Math.PI * radius;
				const offset = circumference - (progress / QUESTION_COUNT) * circumference;
				return (
					<div className="z-10 relative">
						<svg width={size} height={size} viewBox={`0 0 ${size} ${size}`}>
							<circle
								cx={size / 2}
								cy={size / 2}
								r={radius}
								fill="none"
								stroke="#C3EFFF"
								strokeWidth={strokeWidth}
							/>
							<circle
								cx={size / 2}
								cy={size / 2}
								r={radius}
								fill="none"
								stroke="#F6904C"
								strokeWidth={strokeWidth}
								strokeDasharray={circumference}
								strokeDashoffset={offset}
								strokeLinecap="round"
								transform={`rotate(-90 ${size / 2} ${size / 2})`}
							/>
							<text
								x="50%"
								y="50%"
								fontWeight="600"
								dominantBaseline="middle"
								textAnchor="middle"
								fontSize="36px"
								fill="#F6904C"
							>
								{progress}
							</text>
						</svg>

					</div>
				);
			};

			const MultipleChoice = ({progress, question, onDone}) => {
				const [answer, setAnswer] = React.useState('');
				useEffect(() => {
					showFaded()
				}, []);
				return (
					<div className="flex-1">
						<div className="relative">
							<CircularProgress size={85} progress={progress + 1}/>
							<div className="question-view fade-in">
								<p>{question.question}</p>
							</div>
						</div>
						<div className="flex flex-col py-[20px] gap-[20px]">
							{['a', 'b', 'c', 'd'].map((opt) => <Selector
								key={opt} label={question[opt]} option={opt}
								isSelected={answer === opt}
								onClick={() => {
									setAnswer(opt);
									onDone(question[opt])
									setTimeout(() => {
										setAnswer('')
									}, 500)
								}}/>)}
						</div>
					</div>
				)
			}


			const Paragraph = ({progress, onDone, question}) => {
				const [answer, setAnswer] = React.useState('');
				return (
					<div className="flex-1 gap-[20px] overflow-y-auto">
						<div className="relative">
							<CircularProgress size={85} progress={progress + 1}/>
							<div className="question-view">
								<p>{question.question}</p>
							</div>
						</div>
						<textarea
							value={answer}
							className="paragraph-view"
							onChange={(e) => setAnswer(e.target.value)}
							placeholder="Enter your answer here"
						></textarea>
						<div className="flex py-4 items-center justify-center">
							<button className="btn btn-primary btn-round " onClick={() => {
								onDone(answer)
								setTimeout(() => setAnswer(''), 400)
							}}>SUBMIT
							</button>
						</div>

					</div>
				)
			}


			const Spelling = ({progress, audio, onDone, onStartTimer}) => {
				const [answer, setAnswer] = React.useState('');

				const sayWord = () => {
					onStartTimer();
					new Audio(`data:audio/mp3;base64,${audio}`).play();
				};


				return (
					<div className="flex-1 flex flex-col gap-[20px]">
						<div className="relative">
							<CircularProgress size={85} progress={progress + 1}/>
							<div className="question-view">
								<button className="border-0 mx-auto btn-transparent" onClick={sayWord}>
									<img src="{{asset('images/speaker.svg')}}" alt="speaker" className="speaker-btn"/>
								</button>
							</div>
						</div>
						<div className="flex items-center mt-[50px] gap-[15px]">
							<div className="flex-1">
								<input
									autoComplete="off" autoCorrect="off" autoCapitalize="off" spellCheck="false"
									placeholder="Enter word you hear"
									className="spelling-input form-control  ml-auto mr-auto text-uppercase "
									value={answer}
									onChange={(e) => setAnswer(String(e.target.value).toUpperCase().toString())}
								/>
							</div>

							<button disabled={!answer} className="btn-primary btn text-white btn-round " onClick={() => {
								onDone(answer)
								setTimeout(() => {
									setAnswer('')
								}, 400)
							}}>
								SUBMIT
							</button>
						</div>
					</div>
				)
			}


			function App() {
				const [progress, setProgress] = React.useState(-1);

				const [question, setQuestion] = useState(null)

				const [type, setType] = useState('')

				const [seconds, setSeconds] = useState(maxSec);
				const intervalRef = useRef(null);
				const timerHasStarted = intervalRef && intervalRef.current


				const formatTime = (totalSeconds) => {
					const hrs = Math.floor(totalSeconds / 3600);
					const mins = Math.floor((totalSeconds % 3600) / 60);
					const secs = totalSeconds % 60;
					return [hrs, mins, secs]
					.map((val) => String(val).padStart(2, "0"))
					.join(":");
				};

				const startTimer = () => {
					if (intervalRef.current) return; // Prevent multiple intervals
					intervalRef.current = setInterval(() => {
						setSeconds((prev) => {
							if (prev <= 1) {
								stopTimer();
								onAnswer('')
								resetTimer()
								return 0;
							}
							return prev - 1;
						});
					}, 1000);
				};

				const stopTimer = () => {
					if (intervalRef.current) {
						clearInterval(intervalRef.current);
						intervalRef.current = null;
					}
				};

				const resetTimer = () => {
					stopTimer();
					setSeconds(question ? question.timer : 0);
				};


				useEffect(() => {


					return () => stopTimer();
				}, [])


				const stopQuestions = () => {
					setType('')
					setQuestion(null)
					showLoading("Calculating scores")
					const baseUrl = "{{ url('api/process-questions') }}";


					const params = {
						questions: JSON.stringify(QUESTIONS.map(w => {
							delete w.audio;
							delete w.type;
							delete w.word;
							delete w.level;
							delete w.id;
							return w
						})),
						name: "{{ $student->name }}",
						type: '{{$student->type}}',
						level: '{{$student->level}}',
						user_id: "{{ $student->user_id }}",
						question_type: 'mixed',
					}

					console.log()
					axios.post(baseUrl, params).then(({data}) => {
						showLoading("Loading results")
						window.location.href = "{{url('completed')}}/"+ data.id
          }).catch(() => {
						alert('Something went wrong')
            hideLoading()
          })


					// const params = new URLSearchParams();
				};


				const onMarkQuestion = (ans, question) => {
					const q = QUESTIONS[progress];
					q.given_answer = ans
					q.second_spent = question.timer - seconds
					QUESTIONS[progress] = q;
				};


				function onLoadNextQuestion() {
					const next = progress + 1;
					if (next < QUESTION_COUNT) {
						startQuiz(() => {
							setProgress(next)
							const question = QUESTIONS[next];
							setQuestion(question)
							setSeconds(question.timer)
							const type = String(question.question_type);
							setType(question.question_type)
							if (type.includes('multiple') || type.includes('paragraph')) {
								startTimer()
							}
						}, 1000)
						return
					}
					stopQuestions()
				}

				const onAnswer = (ans) => {
					//STOP TIME
					resetTimer()
					//MARK QUESTION
					onMarkQuestion(ans, question)
					//LOAD NEXT QUESTION
					onLoadNextQuestion()

				}
				return (
					<div className="flex-1 flex flex-col relative">
						<div className="flex justify-between mt-[10px] mb-[20px]">
							<div className={`time-counter text-center`}>
								<span>{progress + 1}/{QUESTION_COUNT}</span>
							</div>

							<div className={`time-counter ${seconds < 6 ? "blink" : ""}`}>
								<span>{formatTime(seconds)}</span>
							</div>
						</div>
						{type.includes('multiple') &&
							<MultipleChoice question={question ? question : {}} progress={progress} onDone={onAnswer}/>}
						{type.includes('paragraph') &&
							<Paragraph question={question ? question : {}} progress={progress} onDone={onAnswer}/>}
						{type.includes('spelling') &&
							<Spelling audio={question ? question.audio : ''} onStartTimer={startTimer} progress={progress}
							          onDone={onAnswer}/>}

						<div hidden={progress > -1}
						     className="flex inset-0 gap-[20px] absolute bg-white bg-opacity-50 rounded-lg justify-center items-center flex-col">
							<h1 className="text-[24px] ">Are you ready?</h1>
							<button onClick={onLoadNextQuestion} className="btn-primary btn text-white btn-round ">
								YES, I AM READY
							</button>
						</div>

					</div>
				);
			}


			ReactDOM.createRoot(document.getElementById("question-panel")).render(<App/>);
    </script>
@stop