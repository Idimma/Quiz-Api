@extends('layouts.master')
@section('content')
    <style>
        p {
            color: white
        }

        td {
            white-space: pre-wrap !important;
            font-size: 1rem;
            line-height: 1.714rem ;
            text-align: left;
        }
    </style>
    <div class="card radius-10 ml-auto mr-auto mt-4 col-md-11 " style="min-height: 70vh">
        <div class="card-body p-lg-4 p-md-3 p-xl-5">
            <h2>Results</h2>
            <p class="pb-1 text-black-50">
                Name: {{$name??''}}, &nbsp; &nbsp;
                Zone: {{$zone??''}}, &nbsp; &nbsp;
                Age Group: {{$class??''}}, &nbsp; &nbsp;
                Quiz Score: {{$score.'/'.$total}} &nbsp;
            </p>

            <p class="pb-5 text-black-50">
                Keys: <span class="">----</span> Got Correctly, &nbsp; &nbsp;
                <span class="text-danger">----</span> Got Wrong, &nbsp; &nbsp;
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
                    @foreach($questions as $question)
                        <tr @if ($answers[$question['id']] !== strtolower( $question['answers']))
                            class="bg-danger text-white"
                                @endif>
                            <td>{{$question['id']}}</td>
                            <td>{{$question['questions'] ?? ''}}</td>
                            <td>{{$question[strtolower( $question['answers'])]}}</td>
                            <td>{{$question[$answers[$question['id']]]}}</td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>

    </div>
@stop

