@extends('layouts.master')
@section('content')
    <div class=" row row-no-gutter pt-2">

        <div class="card radius-10 ml-auto mr-auto mt-4 col-md-6">
            <form action="{{url('/create')}}" method="post">
                @csrf
                <div class="card-body p-lg-4 p-xs-2 p-xl-5">
                    <h3 class="py-2">
                        Add a new student
                    </h3>
                    <div class="form-group">
                        <label for="name">Student Name <span
                                    style="font-size: 70%; font-style: italic">(Surname First)</span></label>
                        <input required id="name" name="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="name">Phone <span
                                    style="font-size: 70%; font-style: italic">(Registration number)</span></label>
                        <input required id="phone" name="phone" class="form-control">
                    </div>

                    <div class="form-group pt-3">
                        <label for="zone">Select Your Question Type</label>
                        <select id="zone" name="zone" class="form-control">
                            @forelse(\App\Question::pluck('type')->unique()->toArray() as $zone)
                                <option value="{{$zone}}">{{str($zone)->lower()->ucfirst()->toString()}}</option>
                            @empty
                                <option disabled>No Question type added yet..</option>
                            @endforelse
                        </select>
                    </div>
                    <div class="form-group pt-3">
                        <label for="class">Select Your Levels</label>
                        <select id="class" name="class" class="form-control">
                            @forelse(\App\Question::pluck('class')->unique()->toArray() as $zone)
                                <option value="{{$zone}}">{{str($zone)->lower()->ucfirst()->toString()}}</option>
                            @empty
                                <option disabled>No Level added yet...</option>
                            @endforelse
                        </select>
                    </div>
                    <div class="text-center pt-3">
                        <button type="submit" style="width: 120px" class="btn-primary btn  btn-round ">Add Student
                        </button>
                    </div>

                </div>
            </form>
        </div>
    </div>
@stop