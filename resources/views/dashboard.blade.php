@extends('layouts.master', ['no_header' => true])
@section('content')
    <div class="mobile-content py-[22px] overflow-y-hidden">
        <img src="{{asset('images/lsc.png')}}" alt="RCCG Logo" class="mx-auto" style=" height: 140px"/>
        <h1 class="text-center text-[24px] mt-[20px] mb-[10px]">
            Welcome <span class="bold text-primary">{{$name ?? ''}},</span>
        </h1>

        <div class="instructions-container ">
            <h3 class="bold">Instructions:</h3>
            <p>
                Please read these instructions carefully before starting the quiz.
            </p>

            <h4>Quiz Structure</h4>
            <ul>
                <li>The quiz consists of 25 questions.</li>
                <li>Questions are divided into three sections:
                    <ul>
                        <li><strong>Multiple-choice questions (20):</strong> Each carries 3 marks.</li>
                        <li><strong>Spelling questions (2):</strong> Each carries 5 marks.</li>
                        <li><strong>Knowledge-based questions (3):</strong> Each carries 10 marks. These require written
                            answers and will be graded by the Sunday School AI.
                        </li>
                    </ul>
                </li>
            </ul>

            <h4>Answering Rules</h4>
            <ul>
                <li>Each multiple-choice question is timed, and you have <strong>15 seconds</strong> to answer.</li>
                <li>Once you select an answer, it will be marked immediately, and the system will move to the next
                    question.
                </li>
                <li>The timer starts automatically when the quiz loads, so stay focused.</li>
            </ul>

            <h4>Spelling Questions</h4>
            <ul>
                <li>Each spelling question has a "SAY WORD" button—click it to hear the word.</li>
                <li>Spelling questions are not timed until you click "SAY WORD," so ensure your speakers are at a high
                    volume.
                </li>
                <li>Type your answer carefully before submitting.</li>
            </ul>

            <h4>Knowledge-Based Questions</h4>
            <ul>
                <li>These require written responses. Type your answers clearly and concisely in the input field.</li>
                <li>Answers will be graded by the Sunday School AI based on accuracy and clarity.</li>
            </ul>

            <h4>General Guidelines</h4>
            <ul>
                <li>Ensure a stable internet connection before starting the quiz.</li>
                <li>Do not refresh the page or navigate away, as this may result in losing progress.</li>
                <li>Review all questions carefully before submitting your answers.</li>
                <li>For the best experience, use a laptop or desktop computer rather than a mobile device.</li>
            </ul>
        </div>

{{--        <div class="flex text-center pt-4 gap-3  flex-col">--}}
{{--            <p>I have read the instruction and I clear on all</p>--}}
{{--            <button type="submit" href="{{url('quiz/' .$user_id)}}" class="btn-primary mx-auto btn btn-round"--}}
{{--                    style="width: 120px;">--}}
{{--                Start Quiz--}}
{{--            </button>--}}
{{--        </div>--}}

        <form action="{{ url('quiz-test/' . $user_id) }}" method="GET" >
            <div class="flex pt-4 gap-3 items-center flex-col">
                <label class="flex text-[13px] text-black-50 items-center gap-2">
                    <input type="checkbox" id="confirmCheckbox" class="form-checkbox">
                    <span >I have read the instructions and I am clear on all</span>
                </label>

                <button type="submit" id="startQuizButton" class="btn-primary mx-auto btn btn-round"
                        style="width: 120px;" disabled>
                    Start Quiz
                </button>
            </div>
        </form>

        <script>
			    document.getElementById("confirmCheckbox").addEventListener("change", function () {
				    document.getElementById("startQuizButton").disabled = !this.checked;
			    });
        </script>
    </div>
@stop