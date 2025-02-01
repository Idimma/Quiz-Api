@extends('layouts.master')
@section('content')
    <div class="pt-2">
        <div class="card radius-10 ml-auto mr-auto mt-4 col-md-7">
            <div class="card-body p-lg-4 p-xs-2 p-xl-5">
                <h3 class="bold">Instructions</h3>
                <div class="mb-3">
                    @foreach($instructions ?? [] as $inst)
                        @php
                            echo $inst->instructions ."<br>"
                        @endphp
                    @endforeach
                </div>
                <form action="{{url('quiz/' .$user_id)}}" method="post">
                    @csrf
                    <input name="user_id" hidden value="{{$user_id ?? ''}}">
                    <div>
                        Welcome <span class="bold text-primary">{{$name ?? ''}},</span>
                    </div>
                    <div class="py-3">
                        <p>Select Quiz Type</p>
                        <select name="type" class="form-control col-5">
                            @forelse($types ?? [] as $t)
                                <option>{{$t}}</option>
                            @empty
                                <option>Multiple Options</option>
                                <option>Spelling Bee</option>
                                <option disabled>Blank Paragraph</option>
                                <option disabled>Cloze Test</option>
                            @endforelse

                        </select>

                        <p class="pt-4">
                            I have read and understood the instructions stated above
                        </p>
                    </div>

                    <div class="row text-right px-5">
                        <button type="submit" class="btn-primary ml-auto btn btn-round"
                                style="width: 120px;">
                            Start Quiz
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop