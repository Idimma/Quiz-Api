@extends('layouts.master')
@section('content')
    <main class="container mt-4">
        <div class="row row-no-gutter flex-md-row-reverse">
            <!-- Left Side: List of Questions -->
            <div class="mb-4 col-md-5">
                <div class="card shadow-sm rounded overflow-hidden">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0 text-white">{{ isset($question) ? 'Edit Question' : 'Create Question' }}</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ isset($question) ? url('/insert/edit/'.$question->id) : url('insert') }}"
                              method="post">
                            @csrf
                            @include('partial.form-area', [
                                'name' => 'question',
                                'label' => 'Question',
                                'props' => 'rows="5"',
                                'value' => old('question', isset($question) ? $question->question : '')
                            ])

                            @foreach(['a', 'b', 'c', 'd'] as $option)
                                @include('partial.form-control', [
                                    'name' => $option,
                                    'label' => 'Option ' . strtoupper($option),
                                    'placeholder' => 'Option ' . strtoupper($option),
                                    'value' => old($option, isset($question) ? $question->$option : '')
                                ])
                            @endforeach

                            @include('partial.form-select', [
                                'name' => 'answer',
                                'label' => 'Correct Answer',
                                'select_data' => ['a', 'b', 'c', 'd'],
                                'value' => old('answer', isset($question) ? $question->answer : ''),
                                'placeholder' => 'Select Correct Option'
                            ])

                            @include('partial.form-control', [
                                'name' => 'bible_ref',
                                'label' => 'Bible Ref',
                                'placeholder' => 'Is 60:1',
                                'value' => old('type', isset($question) ? optional($question->meta)->bible_ref : '')
                            ])
                            <div class="mt-4 d-flex justify-content-end">
                                <button type="submit"
                                        class="btn btn-success btn-round">{{ isset($question) ? 'Update' : 'Submit' }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Right Side: Create/Edit Form -->
            <div class="col-md-7 mb-4">
                <div class="card shadow-sm rounded overflow-hidden">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0 text-white">Questions</h5>
                    </div>
                    <div class="card-body" style="max-height: 80vh; overflow-y: auto;">
                        <ul class="list-group">
                            @foreach($questions as $q)
                                <li class="list-group-item">
                                    <div class="d-flex " style="gap: 8px">
                                        <div class="flex-grow-1 text-black-50">
                                            {{ $q->question }}
                                        </div>
                                        <div>
                                            <a href="{{ url('insert/edit/'.$q->id) }}"
                                               class="btn btn-sm text-white btn-primary">Edit</a>
                                        </div>
                                    </div>
                                    <ul class="mt-2 list-style-none">
                                        @foreach(['a', 'b', 'c', 'd'] as $option)
                                            <li class="p-1 " style="font-size: 13px">
                                                {{ strtoupper($option) }}:
                                                @if(strtolower($q->answer) === $option)
                                                    <span class="dot  bg-success"></span>
                                                @endif{{ $q->$option }}
                                                @if(strtolower($q->answer) === $option)
                                                    <span class="dot  bg-success"></span>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>

                                    <div class="bg-gray rounded py-1 px-3 mt-2">
                                        Bible Ref: {{optional($q->meta)['bible_ref']}}
                                    </div>

                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </main>
@stop
