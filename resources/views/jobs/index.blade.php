@extends('layouts.app')
@section('title', 'My Projects')
@push('css')
@endpush
@section('content')
<div class="container">
    <h1 class="mb-4">My Projects</h1>
    <div class="row">

      <div class="table-responsive border shadow">
            <table class="table table-striped mb-0">
                <thead>
                  <tr>
                    <th scope="col">Title</th>
                    <th scope="col">Bids Count</th>
                    <th scope="col">Date</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($jobs as $job)
                    <tr>
                        <th scope="row">
                          <a href="{{ route('jobs.show', ['job' => $job->id, 'title' => Str::slug($job->title)]) }}">{{Str::words($job->title, 15)}}</a>
                        </th>
                        <td>
                          {{ $job->bids_count }} {{ Str::plural('bid', $job->bids_count) }}
                        </td>
                        <td>{{$job->created_at->diffForHumans()}}</td>
                        <td>
                          <a href="{{ $job->freelanceWebsiteLink() }}" target="_blank" class="btn btn-primary btn-sm">{{ config("setting.freelance_website_name") }} Link</a>
                        </td>
                      </tr>
                    @endforeach
                </tbody>
              </table>

              @if(!$jobs->count())
              <x-jobs.nodata/>
              @endif

              @if ($jobs->hasPages())
              <div class="col-12 justify-content-end d-flex border-top pt-3">
                {{ $jobs->links() }}
              </div>
              @endif
        </div>
                
    </div>
</div>
@endsection
