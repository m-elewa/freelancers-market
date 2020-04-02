@extends('layouts.app')
@section('css')
<style>
    html,
    body {
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

    #app,
    main {
        height: 100%;
        overflow: hidden;
    }

    @media (max-height: 750px) {
        #app,
        main {
            height: auto;
        }
    }
    
</style>
@endsection

@section('content')

<div class="container d-flex justify-content-center align-items-center h-100">
    <div class="text-dark">
        <div class="display-4 my-3">
            {{ config('setting.home_page_introduction_title') }}
        </div>
        {!! config('setting.home_page_introduction_details') !!}
        <a class="btn btn-primary btn-lg my-3" href="{{ route('register') }}" role="button">Get Started</a>
    </div>
</div>
@endsection
