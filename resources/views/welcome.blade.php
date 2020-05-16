@extends('layouts.app')
@section('css')
<style>
    html, body, #app {
        height: 100%;
    }
    body::after {
        content: "";
        background: url('imgs/background_1920.jpg');
        opacity: 0.3;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        position: fixed;
        z-index: -1;
        background-position: center;
        background-size: cover;
        background-attachment: fixed;
    }
    nav {
        position: absolute !important;
        width: 100%;
    }
    #main-content {
        padding-top: 56px;
    }
    
</style>
@endsection

@section('content')

<div id="main-content" class="container d-flex justify-content-center align-items-center my-auto">
    <div class="text-dark">
        <div class="display-4 my-3">
            {{ config('setting.home_page_introduction_title') }}
        </div>
        {!! config('setting.home_page_introduction_details') !!}
        <a class="btn btn-primary btn-lg my-3" href="{{ route('register') }}" role="button">Get Started</a>
    </div>
</div>
@endsection
