@extends('layouts.master')
@section('content')
    <div class="card radius-10 ml-auto mr-auto mt-4 col-md-10 col-sm-11 col-lg-9 col-xl-8" style="min-height: 70vh">
        <div class="card-body p-lg-4 p-md-3 p-xl-5">
            <div style="min-height: 140px;"
                 class="d-flex justify-content-center align-items-center bg-gray radius-5 p-2">
                <p class="p-2 text-center text-black-50">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed porttitor lectus nibh. Vestibulum ac
                    diam
                    sit amet quam vehicula elementum sed sit amet dui. Vivamus suscipit tortor eget felis porttitor
                    volutpat. Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Donec rutrum congue leo
                    eget malesuada. Pellentesque in ipsum id orci porta dapibus. Sed porttitor lectus nibh. Donec
                    sollicitudin molestie malesuada. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices
                    posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula.
                </p>
            </div>

            <div class="d-flex justify-content-center align-items-center p-2 text-center">
                <h4 class="text-center col-6">00:00</h4>
                <h4 class="text-center col-6">1/15</h4>
            </div>

            <form action="{{url('quiz')}}" method="post">
                @csrf
                <input name="name" hidden value="{{$name ?? ''}}">
                <input name="zone" hidden value="{{$zone ?? ''}}">
                <input name="class" hidden value="{{$class ?? ''}}">
                <div class="row pl-5">
                    <div class="form-check col-md-6">
                        <input class="form-check-input" type="radio" name="option" id="option1" value="option1"
                               checked="">
                        <label class="form-check-label" for="option1">
                            <p>Third disabled radio</p>
                        </label>
                    </div>
                    <div class="form-check col-md-6">
                        <input class="form-check-input" type="radio" name="option" id="option2" value="option2">
                        <label class="form-check-label" for="option2">
                            <p>Third disabled radio</p>
                        </label>
                    </div>
                    <div class="form-check col-md-6">
                        <input class="form-check-input" type="radio" name="option" id="option3" value="option3">
                        <label class="form-check-label" for="option3">
                            <p>Third disabled radio</p>
                        </label>
                    </div>
                    <div class="form-check col-md-6">
                        <input class="form-check-input" type="radio" name="option" id="option4" value="option4">
                        <label class="form-check-label" for="option4">
                            <p>Third disabled radio</p>
                        </label>
                    </div>
                    <div class="form-check col-md-6 ">
                        <input class="form-check-input" type="radio" name="option" id="option5" value="option5">
                        <label class="form-check-label" for="option5">
                            <p>Five disabled radio</p>
                        </label>
                    </div>
                </div>

                <p class="text-center text-danger " style="font-size: 60%">Be sure before you check an answer, You only get one chance at it </p>

            </form>

        </div>
    </div>
@stop

