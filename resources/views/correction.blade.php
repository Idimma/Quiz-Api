@extends('layouts.master')
@section('content')
    <style>
        p {
            color: white
        }

        p {
            /*color: black;*/
        }

        td {
            white-space: pre-wrap !important;
            font-size: 1rem;
            line-height: 1.714rem;
            text-align: left;
        }
    </style>
    <div class="card radius-10 ml-auto mr-auto mt-4 col-md-11 " style="min-height: 70vh">
        <div class="card-body p-lg-4 p-md-3 p-xl-5">
            <div class="d-flex justify-content-between">

                <h1>Results</h1>
                <a href="{{url('/table')}}" class="text-primary " style="font-size: 16px">
                    <span>    Leader Board</span>
                </a>
            </div>
            <h6 class="pb-1 text-black-50">
                Name: <span class="bold text-primary">{{$name ?? ''}},</span>, &nbsp; &nbsp;
                Type: {{$type??''}}, &nbsp; &nbsp;
                Level: {{$level??''}}, &nbsp; &nbsp;
                Quiz Score: {{$score.'/'.$no_questions}} &nbsp;
                Question Type: {{$question_type ?? ''}} &nbsp;
            </h6>

            <p class="pb-5 text-black-50">
                Keys: <span class="dot bg-success"></span> Got Correctly, &nbsp; &nbsp;
                <span class="dot bg-danger"></span> Got Wrong, &nbsp; &nbsp;
            </p>
            <div class="table-responsive">
                <table class="table mb-0 radius-5 ">
                    <thead class="bg-primary text-white radius-5  ">
                    <tr class="radius-5 ">
                        <th scope="col">#</th>
                        <th scope="col">Question</th>
                        <th scope="col">Answer</th>
                        <th scope="col">Your Selection</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($questions as $index =>  $question)
                        @php
                            $expected = $answers[$index] ?? '';
                            $given = $given_answers[$index]?? '';
                            $isCorrect = !str($given)->lower()->contains($expected, true)
                        @endphp
                        <tr>
                            <td>#{{($index ?? 0)+1}}</td>
                            <td><span>{{$question ?? ''}}</span></td>
                            <td><span>{{$expected}}</span></td>
                            <td class="text-white text-start {{$isCorrect ? 'bg-danger ' :'bg-success' }} ">
                                <p>{{$given}}</p>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop