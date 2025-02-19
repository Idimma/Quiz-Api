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
    <div class="row row-no-gutter">
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
                    Type: {{$type??''}}, &nbsp; | &nbsp;
                    Level: {{$level??''}}, &nbsp; &nbsp;|  &nbsp;
                    Quiz Score: {{$score.'/'.$mark}} &nbsp; | &nbsp;
                    Percent: {{$percent *100 ?? ''}}% &nbsp; |  &nbsp;
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
                            <th scope="col">Seconds used</th>
                            <th scope="col">AI Score</th>
                            <th scope="col" class="text-center" width="130px">Points</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($questions as $index =>  $question)
                            <tr>
                                <td>#{{($index ?? 0)+1}}</td>
                                <td><span>{{$question['question'] ?? ''}}</span></td>
                                <td style="max-width: 400px" ><span>{{$question['expected_answer'] ?? ''}}</span></td>
                                <td  class='text-white text-start '
                                    style="max-width: 350px; background-color: {{$question['color'] ?? ''}}">
                                    <p>{{$question['given_answer'] ?? ''}}</p>
                                </td>
                                <td class="text-center"><span class="text-center">{{$question['second_spent'] ?? ''}} Sec</span></td>
                                <td class="text-center"><span class="text-center">{{$question['ai_score'] ?? ''}}%</span></td>
                                <td class="text-center"><span class="text-center">{{$question['score'] ?? ''}} Point(s) / {{$question['mark'] ?? ''}} </span></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop