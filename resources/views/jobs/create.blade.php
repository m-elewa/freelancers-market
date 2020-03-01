@extends('layouts.app')
@section('head-title', 'Post a Project')
@section('css')
@endsection

@section('content')
<div class="container">
    <h1 class="mb-3">Post a Project</h1>
    <div class="row">
        <div class="col">
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
                    <label for="description">Description</label>
                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description" rows="3"
                        required>{{ old('description') }}</textarea>
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
@endsection
