@extends('layouts.app')
@section('head-title', $job->title)

@section('css')
@endsection

@section('javascript')
<x-jobs.textarea/>
@endsection

@section('content')
<div class="container">
    <h1 class="mb-5 mt-3">{{ $job->title }}</h1>
    <div class="row">
        <div class="col-12">
            <div class="jumbotron shadow">
                <p class="lead">{!! $job->description !!}</p>
                <hr class="my-4">
                <p>{{ $job->created_at->diffForHumans() }}</p>
            </div>
        </div>

        @can('create-bid', $job)
        <div class="col-12">
            <div class="card my-4 shadow">
                <h5 class="card-header">Place a Bid on this Project</h5>
                <div class="card-body">
                    <h5 class="card-title">Bid Details</h5>


                    <form method="POST" action="{{ route('jobs.store-bid', $job->id) }}">
                        @csrf
                        <div class="form-group">
                            <label for="amount">Bid Details</label>
                            <input name="amount" type="number" step="0.01"
                                class="form-control @error('amount') is-invalid @enderror" value="{{ old('amount') }}"
                                id="amount" required>
                            @error('amount')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description">Describe your proposal</label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                                id="description" rows="3" required>{{ old('description') }}</textarea>
                            @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>


                </div>
            </div>
        </div>
        @endcan
        @can('view-bids', $job)
        <div class="col-12">
        <div class="card my-3 shadow-sm">
            <div class="card-header h4">
                Freelancers bids on the job
            </div>
        </div>
        </div>

            <div class="col-12">

                @foreach ($bids as $bid)
                <div class="card my-3 shadow-sm mx-3">
                    <div class="card-body">
                        <p class="card-text">{!! $bid->description !!}</p>
                    </div>
                    <div class="card-footer text-muted d-flex justify-content-between">
                        <div><strong>${{ $bid->amount }}</strong> | {{ $bid->user->name() }} | {{ $bid->created_at->diffForHumans() }}</div>
                        <div><a href="#" class="btn btn-primary btn-sm stretched-link">Show Upwork Profile</a></div>
                    </div>
                </div>

                @endforeach
                
                @if(!$bids->count())
                <x-jobs.nodata/>
                @endif

                <div class="col-12 pt-3 justify-content-end d-flex">
                {{ $bids->links() }}
            </div>
            </div>
        
        @endcan

        @can('view-freelancer-bid', $job)
        <div class="col-12">

            <div class="card my-3 shadow border-success">
                <div class="card-header border-success">
                    Your bid on the job
                </div>
                <div class="card-body">
                    <p class="card-text">{!! $bid->description !!}</p>
                </div>
                <div class="card-footer text-muted border-success d-flex justify-content-between">
                    <div><strong>${{ $bid->amount }}</strong> | {{ $bid->user->name() }} | {{ $bid->created_at->diffForHumans() }}</div>
                    <div><a href="#" class="btn btn-primary btn-sm stretched-link">Show Upwork Profile</a></div>
                </div>
            </div>

        </div>
        @endcan

    </div>
</div>
@endsection
