@extends('layouts.app')
@section('head-title', 'Find Work')
@section('css')
@endsection

@section('content')
<div class="container">
    <h1 class="mb-3">Find Work</h1>
    <div class="row">

        @foreach ($jobs as $job)
        <div class="col-12">
            <div class="card my-2 shadow">
                
            <div class="card-body">
                <h5 class="card-title">{{Str::words($job->title, 10)}}</h5>
                <p class="card-text">{{Str::words($job->description, 20)}}</p>
                <a href="{{ route('jobs.show', $job->id) }}" class="btn btn-primary">Submit a Proposal</a>
            </div>

            <div class="card-footer text-muted">
                {{$job->created_at->diffForHumans()}}
            </div>
        </div>
    </div>
    @endforeach

    <div class="col-12 my-3">
        {{ $jobs->links() }}
    </div>
    

</div>
</div>
@endsection
