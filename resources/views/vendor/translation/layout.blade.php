@extends('layouts.app')
@push('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{ asset('/vendor/translation/css/main.css') }}">
@endpush
@section('content')
<div class="languages-body">
    <div id="app">
        @include('translation::nav')
        @include('translation::notifications')
        @yield('body')
    </div>
</div>
@endsection
@push('foot')
<script src="{{ asset('/vendor/translation/js/app.js') }}"></script>
@endpush
