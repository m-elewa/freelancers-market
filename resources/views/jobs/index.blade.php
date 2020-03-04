@extends('layouts.app')
@section('head-title', 'My Projects')
@section('css')
@endsection

@section('content')
<div class="container">
    <h1 class="mb-4">My Projects</h1>
    <div class="row">

      <div class="table-responsive border shadow">
            <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">Title</th>
                    <th scope="col">Date</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($jobs as $job)
                    <tr>
                        <th scope="row">
                            <a href="{{ route('jobs.show', $job->id) }}">{{Str::limit($job->title, 100, $end='...')}}</a>
                        </th>
                        <td>{{$job->created_at->diffForHumans()}}</td>
                        <td>
                            <button type="button" class="btn btn-secondary btn-sm">Archive</button>
                        </td>
                      </tr>
                    @endforeach
                </tbody>
              </table>
              <div class="col-12 justify-content-end d-flex">
                {{ $jobs->links() }}
              </div>
        </div>
                
    </div>
</div>
@endsection
