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
            NEVER pay to work!
        </div>
        <p class="lead"><span class="font-weight-bold">Apply for Upwork jobs for free.</span> We will work like a broker between the clients and
             the freelancers but the actual work and pay will be done on Upwork website. <u>How it works?</u> clients can link their jobs here to
              let freelancers apply for free on their jobs. Then the client can invite the suited freelancer(s) to apply on his job on Upwork website.</p>
        <a class="btn btn-primary btn-lg my-3" href="{{ route('register') }}" role="button">Get Started</a>
    </div>
</div>
@endsection
