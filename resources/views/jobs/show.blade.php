@extends('layouts.app')
@section('head-title', $job->title)
@section('css')
@endsection

@section('content')
<div class="container">
    <h1 class="mb-5 mt-2">{{ $job->title }}</h1>
    <div class="row">
        <div class="col-12">
            <div class="jumbotron">
                <p class="lead">{{ $job->description }}</p>
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

            @foreach ($bids as $bid)
            <div class="card my-3 shadow-sm">
                <div class="card-header">
                    {{ $bid->user->name() }}
                </div>
                <div class="card-body">
                    <h5 class="card-title">${{ $bid->amount }}</h5>
                    <p class="card-text">{{ $bid->description }}</p>
                    <a href="{{ route('jobs.show', $bid->id) }}" class="btn btn-primary">Show Upwork Profile</a>
                </div>
                <div class="card-footer text-muted">
                    {{$bid->created_at->diffForHumans()}}
                </div>
            </div>
            @endforeach

            {{ $bids->links() }}

        </div>
        @endcan

        @can('view-freelancer-bid', $job)
        <div class="col-12">

            <div class="card my-3 shadow border-success">
                <div class="card-header border-success">
                    {{ $bid->user->name() }}
                </div>
                <div class="card-body text-success">
                    <h5 class="card-title">${{ $bid->amount }}</h5>
                    <p class="card-text">{{ $bid->description }}</p>
                    <a href="{{ route('jobs.show', $bid->id) }}" class="btn btn-primary">Show Upwork Profile</a>
                </div>
                <div class="card-footer text-muted border-success">
                    {{$bid->created_at->diffForHumans()}}
                </div>
            </div>

        </div>
        @endcan

    </div>
</div>
@endsection
