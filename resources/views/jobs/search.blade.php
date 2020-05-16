@extends('layouts.app')
@section('title', 'Find Work')
@push('css')
@endpush
@section('content')
<div class="container">
    <div class="row d-flex justify-content-between">
        <div class="col-auto">
            <h1 class="mb-3">Find Work</h1>
        </div>
    
        <form class="col-lg-6 col-md-12" method="GET" action="{{ route('jobs.search') }}">
            <div class="justify-content-lg-end mb-2">
                
                <div class="input-group">
                    <input type="text" name="q" class="form-control @error('q') is-invalid @enderror" value="{{ old('q', request('q')) }}" placeholder="Search For Jobs">
                    <div class="input-group-append">
                      <button type="submit" class="btn btn-outline-primary" type="button"><i class="fas fa-search"></i></button>
                    </div>
                    @error('q')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

            </div>
        </form>
    </div>

    <div class="row">

        @forelse ($jobs as $job)
        <div class="col-12">
            <div class="card my-2 shadow">
                
            <div class="card-body">
                <a href="{{ route('jobs.show', ['job' => $job->id, 'title' => Str::slug($job->title)]) }}"><h5 class="card-title">{{Str::words($job->title, 15)}}</h5></a>
                <p class="card-text">{{Str::words(trim(strip_tags($job->description)), 40)}}</p>
            </div>

            <div class="card-footer text-muted d-flex justify-content-between">
            <div>{{$job->created_at->diffForHumans()}} | {{ $job->bids_count }} {{ Str::plural('bid', $job->bids_count) }}</div>
                <div>
                    <a href="{{ route('jobs.show', ['job' => $job->id, 'title' => Str::slug($job->title)]) }}" class="btn btn-primary btn-sm">Job Details</a>
                    <a href="{{ $job->freelanceWebsiteLink() }}" target="_blank" class="btn btn-primary btn-sm">{{ config("setting.freelance_website_name") }} Link</a>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <x-jobs.nodata/>
    </div>
    @endforelse

    <div class="col-12 my-3">
        {{ $jobs->withQueryString()->links() }}
    </div>
    

</div>
</div>
@endsection
