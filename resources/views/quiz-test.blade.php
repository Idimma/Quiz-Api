@extends('layouts.master', ['no_header'=>true])
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
            box-shadow: 0 3px 10px -10px #00000026;
            background: #FFFFFF;
            width: 100%;
            min-height: 229px;
            border-radius: 20px;
            color: #000000;

            padding: 20px;
            text-align: left;
            margin-top: 30px;
        }

        .question-view p, .paragraph-view p {
            color: black;
            font-family: 'Avenir Next Medium', serif;
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
            color: rgba(0, 0, 0, 0.70);
            flex-direction: row;
            align-items: center;
        }

        .selector-options svg {
            width: unset !important;
        }
    </style>
@stop
@section('content')
    <div class="mobile-content  no-scrollbar">
        <div class="flex-1 flex flex-col" id="question-panel"></div>
    </div>
@stop
@section('script')
    <script type="text/babel">



			let QUESTIONS = {!! $questions !!};
			let STUDENT = {!! $student !!};

			let QUESTION_COUNT = QUESTIONS.length
			let score = 0;
			let PROGRESS = -1;

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
					<div className="flex-1 overflow-y-scroll no-scrollbar">
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
					<div className="gap-[20px] relative">
						<div className="relative">
							<CircularProgress size={85} progress={progress + 1}/>
							<div className="question-view">
								<div className="flex-1">
									<p className="font-medium text-[16px] text-center">{question.question}</p>
								</div>
								<article>{question.student_instruction}</article>
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
					new Audio(`data:audio/mp3;base64,${audio}`).play();
					onStartTimer();
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
				const [question, setQuestion] = useState(null)
				const [type, setType] = useState('')
				const [render, setRender] = useState('')
				const [progress, setProgress] = React.useState(PROGRESS);
				const [seconds, setSeconds] = useState(60);
				const intervalRef = useRef(null);


				const formatTime = (totalSeconds) => {
					const hrs = Math.floor(totalSeconds / 3600);
					const mins = Math.floor((totalSeconds % 3600) / 60);
					const secs = totalSeconds % 60;
					return [hrs, mins, secs]
					.map((val) => String(val).padStart(2, "0"))
					.join(":");
				};

				const startTimer = (index = null) => {
					if (intervalRef.current) return; // Prevent multiple intervals
					intervalRef.current = setInterval(() => {
						setSeconds((prev) => {
							if (prev <= 1) {
								onAnswer('', index)
								return 0;
							}
							return prev - 1;
						});
					}, 1000);
				};

				const stopTimer = () => {
					if (intervalRef && intervalRef.current) {
						clearInterval(intervalRef.current);
						intervalRef.current = null;
					}
				};

				const resetTimer = () => {
					stopTimer();
					setSeconds(question ? question.timer : 0);
				};




				const showResult = () => {
					showLoading("Opening results")
					window.location.href = `{{url('result')}}/{{ $student->user_id }}`
				}

				const stopQuestions = () => {
					setType('')
					setQuestion(null)
					showLoading("Calculating scores")
					const baseUrl = "{{ url('api/process-questions') }}";
					// TODO save data
					const params = {
						questions: QUESTIONS.map(w => {
							delete w.audio;
							delete w.type;
							delete w.word;
							delete w.level;
							delete w.id;
							return w
						}),
						name: "{{ $student->name }}",
						type: '{{$student->type}}',
						level: '{{$student->level}}',
						user_id: "{{ $student->user_id }}",
						question_type: 'mixed',
					}
					axios.post(baseUrl, params).then(({data}) => {
						showLoading("Loading results")
						hideLoading();
						setRender('success')
					}).catch(() => {
						hideLoading();
						setRender('retry')
					})
				};


				function onLoadNextQuestion(start) {
					const next = Number(start) + 1;
					if (next < QUESTION_COUNT) {
						setProgress(next)
						startQuiz(() => {
							const question = QUESTIONS[next];
							setQuestion(question)
							setSeconds(question.timer)
							const type = String(question.question_type);
							setType(question.question_type)
							if (type.includes('multiple') || type.includes('paragraph')) {
								startTimer(next)
							}
						}, 800)
						return
					}
					stopQuestions()
				}

				const onAnswer = (ans, index = null) => {
					resetTimer()
					const currentIndex = index != null ? index : progress;
					const q = QUESTIONS[currentIndex];
					if (q) {
						q.given_answer = ans
						q.second_spent = q.timer - seconds
						QUESTIONS[currentIndex] = q;
					}
					onLoadNextQuestion(currentIndex)
				}

				if (render === 'success') {
					return (
						<div className="flex-1 flex flex-col centered relative">
							<div className="mb-[80px] centered px-5 flex-col ">
								<img src="{{asset("/images/success.png")}}" alt="Completed"/>
								<p className="text-black font-medium text-[16px] text-center">Thank you for taking the test, you can now
									view your result</p>
							</div>
							<button type="button" onClick={showResult} className="btn btn-round btn-primary">
								View Results
							</button>
						</div>
					)
				}

				if (render === 'retry') {
					return (
						<div className="flex-1 flex flex-col centered relative">
							<div className="mb-[80px] centered px-5 flex-col ">
								<img src="{{asset("/images/error.png")}}" width="180px" alt="Completed"/>
								<p className="text-black font-medium text-[16px] mt-3 text-center">
									Could not process your request, please try again later
								</p>
							</div>
							<button type="button" onClick={stopQuestions} className="btn btn-round btn-primary">
								Retry
							</button>
						</div>
					)
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
							<MultipleChoice question={question ? question : {}} progress={progress}
							                onDone={(a) => onAnswer(a, progress)}/>}
						{type.includes('paragraph') &&
							<Paragraph question={question ? question : {}} progress={progress}
							           onDone={(a) => onAnswer(a, progress)}/>}
						{type.includes('spelling') &&
							<Spelling audio={question ? question.audio : ''} onStartTimer={startTimer} progress={progress}
							          onDone={(a) => onAnswer(a, progress)}/>}

						<div hidden={progress > -1}
						     className="flex inset-0 gap-[20px] absolute bg-white bg-opacity-50 rounded-lg justify-center items-center flex-col">
							<h1 className="text-[24px] ">Are you ready?</h1>
							<button onClick={() => onLoadNextQuestion(+progress)} className="btn-primary btn text-white btn-round ">
								YES, I AM READY !!!
							</button>
						</div>

					</div>
				);
			}

			ReactDOM.createRoot(document.getElementById("question-panel")).render(<App/>);
    </script>
@stop