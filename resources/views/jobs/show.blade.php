@extends('layouts.app')
@section('title', $job->title)
@push('css')
@endpush
@section('javascript')
<x-jobs.textarea />
@endsection

@section('content')
<div class="container">
    <h1 class="mb-5 mt-3">{{ $job->title }}</h1>
    <div class="row">
        <div class="col-12">
            <div class="jumbotron shadow">
                <p class="lead">{!! $job->description !!}</p>
                <hr class="my-4">
                <div class="d-flex justify-content-between">
                    <div>
                        <p>{{ $job->created_at->diffForHumans() }} | {{ $job->bids_count }}
                            {{ Str::plural('bid', $job->bids_count) }}</p>
                    </div>
                    <div><a href="{{ $job->freelanceWebsiteLink() }}" target="_blank" class="btn btn-primary">{{ config("setting.freelance_website_name") }} Link</a>
                    </div>
                </div>
            </div>
        </div>

        @can('create-bid', $job)
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
                        <div>
                            <strong>${{ $bid->amount }}</strong> | {{ $bid->user->name() }} |
                            {{ $bid->created_at->diffForHumans() }}
                            @if(!$bid->user->profile_link) | <span class="badge badge-danger">Invalid {{ config("setting.freelance_website_name") }} profile
                                link</span>@endif
                        </div>
                        <div><a href="{{ $bid->user->freelanceWebsiteLink() }}" class="btn btn-primary btn-sm stretched-link"
                                target="_blank">Show {{ config("setting.freelance_website_name") }} Profile</a></div>
                    </div>
                </div>

            </div>
            @else

            <div class="col-12">
                <div class="card my-4 shadow">
                    @if(Auth::user()->profile_link)
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
                    @else

                    <div class="card-body">
                        <h5 class="card-title">Add {{ config("setting.freelance_website_name") }} profile link</h5>

                        <form method="POST" action="{{ route('setting.update-profile-link') }}">
                            @csrf
                            <div class="form-group">
                                <label for="profile_link">You have to add your {{ config("setting.freelance_website_name") }} profile link first to add bids.
                                    You can edit it later from <a href="{{ route('setting.edit') }}">your setting
                                        page.</a></label>

                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">{{ config("setting.freelance_website_domain") }}</div>
                                    </div>

                                    <input name="profile_link" type="text"
                                        class="form-control @error('profile_link') is-invalid @enderror"
                                        value="{{ old('profile_link') }}" id="profile_link" required>
                                </div>

                                @error('profile_link')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>

                    </div>
                    @endif
                </div>
            </div>
            @endcan
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

            @forelse ($bids as $bid)
            <div class="card my-3 shadow-sm mx-3">
                <div class="card-body">
                    <p class="card-text">{!! $bid->description !!}</p>
                </div>
                <div class="card-footer text-muted d-flex justify-content-between">
                    <div>
                        <strong>${{ $bid->amount }}</strong> | {{ $bid->user->name() }} |
                        {{ $bid->created_at->diffForHumans() }}
                        @if(!$bid->user->profile_link) | <span class="badge badge-danger">Invalid {{ config("setting.freelance_website_name") }} profile
                            link</span>@endif
                    </div>
                    <div><a href="{{ $bid->user->freelanceWebsiteLink() }}" class="btn btn-primary btn-sm stretched-link"
                            target="_blank">Show {{ config("setting.freelance_website_name") }} Profile</a></div>
                </div>
            </div>

            @empty
                <x-jobs.nodata/>
            @endforelse

            <div class="col-12 pt-3 justify-content-end d-flex">
                {{ $bids->links() }}
            </div>
        </div>
        @endcan
    </div>
</div>
@endsection
