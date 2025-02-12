@extends('layouts.master')
@section('content')

    <style>
        p {
            color: white
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
                <h1>Leader Board</h1>
                <a href="{{url('/')}}" class="text-primary " style="font-size: 16px">
                    <span>Home</span>
                </a>
            </div>

            <div class="table-responsive">
                <table class="table mb-0 radius-5 ">
                    <thead class="bg-primary text-white radius-5  ">
                    <tr class="radius-5 ">
                        <th scope="col">#</th>
                        <th scope="col">Player</th>
                        <th scope="col">Type</th>
                        <th scope="col">Score</th>
                        <th scope="col">Percent</th>
                        <th scope="col">Duration</th>
                        <th scope="col">Time</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($players as $index => $player )
                        <tr>
                            <td>#{{$index+ 1}}</td>
                            <td>{{$player->name}}</td>
                            <td>{{$player->question_type}}</td>
                            <td>{{$player->score}}/{{$player->no_questions}}</td>
                            <td>{{number_format($player->percent *100, 0)}}%</td>
                            <td>{{$player->seconds_used}} Sec</td>
                            <td>{{Carbon\Carbon::parse ($player->created_at)->diffForHumans()}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


@stop