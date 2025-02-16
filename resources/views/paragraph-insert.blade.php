@extends('layouts.master')
@section('content')
    <main class="container mt-4">
        <div class="row row-no-gutter flex-md-row-reverse">
            <div class=" mb-4 col-md-5">
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
                            <div class="mt-4 d-flex justify-content-end">
                                <button type="submit"
                                        class="btn btn-primary btn-round">{{ isset($question) ? 'Update' : 'Submit' }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class=" col-md-7 mb-4">
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

                                    <div style="font-size: 12px">
                                        {{$q->answer}}
                                    </div>
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
    </main>
@stop
