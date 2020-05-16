@extends('layouts.app')
@section('title', 'My Bids')
@push('css')
@endpush
@section('content')
<div class="container">
    <h1 class="mb-4">My Bids</h1>
    <div class="row">

        <div class="table-responsive border shadow">
            <table class="table table-striped mb-0">
                <thead>
                  <tr>
                    <th scope="col">Job Title</th>
                    <th scope="col">Bids Count</th>
                    <th scope="col">Bid Date</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($bids as $bid)
                    <tr>
                        <th scope="row">
                            <a href="{{ route('jobs.show', ['job' => $bid->job->id, 'title' => Str::slug($bid->job->title)]) }}">{{Str::words($bid->job->title, 15)}}</a>
                        </th>
                        <td>
                          {{ $bid->job->bids_count }} {{ Str::plural('bid', $bid->job->bids_count) }}
                        </td>
                        <td>
                          {{  $bid->created_at->diffForHumans() }}
                        </td>
                        <td>
                          <a href="{{ $bid->job->freelanceWebsiteLink() }}" target="_blank" class="btn btn-primary btn-sm">{{ config("setting.freelance_website_name") }} Link</a>
                        </td>
                      </tr>
                    @endforeach
                </tbody>
              </table>

              @if(!$bids->count())
              <x-jobs.nodata/>
              @endif

              @if ($bids->hasPages())
              <div class="col-12 justify-content-end d-flex border-top pt-3">
                {{ $bids->links() }}
              </div>
              @endif
              
        </div>
                
    </div>
</div>
@endsection
