@extends('layouts.master')
@section('content')
    <main class="row row-no-gutter ">
        <div class="card radius-10 ml-auto mr-auto mt-4 col-lg-5 col-md-8 col-sm-10">
            <form action="{{url('insert')}}" class="card-body" method="post">
                @csrf
                @include('partial.form-area', ['name'=> 'question', 'label'=>'Question', 'props' => 'rows="5"',])
                @include('partial.form-control', ['name'=> 'A', 'wrapper'=>'mt-5', 'label'=>'Option A',  'placeholder' => 'Option A'])
                @include('partial.form-control', ['name'=> 'B', 'label'=>'Option B',  'placeholder' => 'Option B'])
                @include('partial.form-control', ['name'=> 'C', 'label'=>'Option C',  'placeholder' => 'Option C'])
                @include('partial.form-control', ['name'=> 'D', 'label'=>'Option D',  'placeholder' => 'Option D'])
                <input name="stage" hidden value="bible" class="form-control"/>
                <div class="mt-5 d-flex justify-content-center align-items-center">
                    <button type="submit" class="btn btn-primary mx-auto btn-round"> Submit</button>
                </div>
            </form>
        </div>
    </main>
@stop