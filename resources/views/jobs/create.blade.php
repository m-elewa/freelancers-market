@extends('layouts.app')
@section('title', 'Post a Project')
@push('css')
<x-app-layouts.background/>
@endpush
@section('javascript')
<x-jobs.textarea />
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-10">
            <h1 class="mb-3">Post a Project</h1>
        </div>
        <div class="col-10 card">
            <div class="card-body">
                <form method="POST" action="{{ route('jobs.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="title">Project Title</label>
                        <input name="title" type="text" class="form-control @error('title') is-invalid @enderror"
                            value="{{ old('title') }}" id="title" required autofocus>
                        @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="title">{{ config("setting.freelance_website_name") }} Job Link</label>

                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">{{ config("setting.freelance_website_domain") }}</div>
                            </div>

                            <input name="job_link" type="text"
                                class="form-control @error('job_link') is-invalid @enderror"
                                value="{{ old('job_link') }}" id="job_link" required>
                        </div>
                        @error('job_link')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                            id="description" rows="3" required>{{ old('description') }}</textarea>
                        @error('description')
                        <span class="invalid-feedback" id="editor-error-message" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary shadow">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
