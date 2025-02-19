@extends('layouts.master')
@section('content')
    <div class="flex px-3 gap-8 justify-center flex-md-row-reverse flex-col md:flex-row">
        <div class="mb-4 mx-auto   md:w-5/12">
            <div class="card shadow-sm rounded overflow-hidden">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0 text-white">{{ isset($question) ? 'Edit Paragraph Question' : 'Create Paragraph Question' }}</h5>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div style="font-size: 12px" class="alert text-white alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ isset($question) ? url('/paragraphs/'.$question->id) : url('paragraphs') }}"
                          method="post">
                        @csrf
                        @if( isset($question))
                            @method('PATCH')
                        @endif

                        @include('partial.form-area', [
                            'name' => 'question',
                            'label' => 'Question',
                            'props' => 'rows="5"',
                            'value' => old('question', isset($question) ? $question->question : '')
                        ])

                        @include('partial.form-area', [
                            'name' => 'answer',
                            'label' => 'Answer',
                            'props' => 'rows="5"',
                            'value' => old('answer', isset($question) ? $question->answer : '')
                        ])
                        @include('partial.form-control', [
                            'name' => 'bible_ref',
                            'label' => 'Bible Ref',
                            'placeholder' => 'Is 60:1',
                            'value' => old('type', isset($question) ? optional($question->meta)['bible_ref'] ??'' : '')
                        ])


                        @include('partial.form-area', [
                            'name' => 'student_instruction',
                            'label' => 'Instruction for clearer understanding of the question',
                            'placeholder' => 'In lesson 5 we ....',
                            'props' => 'rows="2"',
                            'value' => old('student_instruction', isset($question) ? $question->student_instruction : '')
                        ])

                        @include('partial.form-area', [
                            'name' => 'ai_instruction',
                            'label' => 'Instruction for AI marking guide',
                            'placeholder' =>  "-Check the number of responses before awarding marks \n-Each mark is 20%",
                            'props' => 'rows="3"',
                            'value' => old('ai_instruction', isset($question) ? $question->ai_instruction : '')
                        ])
                        <div class="mt-4 d-flex justify-content-end">
                            <button type="submit"
                                    class="btn btn-primary btn-round">{{ isset($question) ? 'Update' : 'Submit' }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="mb-4 mx-auto md:w-7/12">
            <div class="card shadow-sm rounded overflow-hidden">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0 text-white">Questions</h5>
                </div>
                <div class="card-body" style="max-height: 80vh; overflow-y: auto;">
                    <ul class="list-group">
                        @foreach($questions as $q)
                            <li class="list-group-item">

                                <div class="bg-gray rounded-lg py-1 px-3 mb-2 flex-grow-1 text-black-50">
                                    {{ $q->question }}
                                </div>

                                <div class="py-1 px-3 mb-2 text-black" style="font-size: 12px">
                                    {{$q->answer}}
                                </div>

                                @if($q->student_instruction)
                                    <div class="bg-brown rounded-lg py-1 px-3 mb-2 text-black-50"
                                         style="font-size: 12px">
                                        {{$q->student_instruction}}
                                    </div>
                                @endif
                                @if($q->ai_instruction)
                                    <div class="bg-pink rounded-lg py-1 px-3 mb-2 text-black-50"
                                         style="font-size: 12px">
                                        {{$q->ai_instruction}}
                                    </div>
                                @endif
                                <div class="d-flex justify-content-between align-items-center" style="gap: 8px">
                                    <div style="font-size: 12px">
                                        Bible Ref: {{optional($q->meta)['bible_ref']}}
                                    </div>
                                    <div>
                                        <a href="{{ url('paragraphs/'.$q->id) }}"
                                           class="btn btn-sm text-white btn-primary">Edit</a>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@stop
