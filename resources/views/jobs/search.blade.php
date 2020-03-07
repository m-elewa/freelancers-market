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
                <h5 class="card-title">{{Str::words($job->title, 15)}}</h5>
                <p class="card-text">{{Str::words(trim(strip_tags($job->description)), 30)}}</p>
            </div>

            <div class="card-footer text-muted d-flex justify-content-between">
                <div>{{$job->created_at->diffForHumans()}}</div>
                <div><a href="{{ route('jobs.show', ['job' => $job->id, 'title' => Str::slug($job->title)]) }}" class="btn btn-primary btn-sm stretched-link">Job Details</a></div>
            </div>
        </div>
    </div>
    @endforeach

    @if(!$jobs->count())
    <div class="col-12">
    <x-jobs.nodata/>
    </div>
    @endif

    <div class="col-12 my-3">
        {{ $jobs->links() }}
    </div>
    

</div>
</div>
@endsection
