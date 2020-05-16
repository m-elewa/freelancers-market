@extends('layouts.app')
@push('css')
<x-app-layouts.background/>
@endpush
@section('content')
<div id="main-content" class="container d-flex justify-content-center align-items-center pb-5 my-auto">
    <div class="text-dark">
        <div class="display-4 my-3">
            {{ config('setting.home_page_introduction_title') }}
        </div>
        {!! config('setting.home_page_introduction_details') !!}
        <a class="btn btn-primary btn-lg my-3" href="{{ route('register') }}" role="button">Get Started</a>
    </div>
</div>
<x-app-layouts.footer/>
@endsection
