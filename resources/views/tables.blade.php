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

    <div class="row row-no-gutter">
        <livewire:leaderboard />
    </div>

@stop