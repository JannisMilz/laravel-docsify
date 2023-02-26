@extends('docsify::layouts.main')

@section('content')
    <div>
        @include('docsify::partials.sidebar')

        <div class="documentation">
            {!! $content !!}
        </div>
    </div>
@endsection
