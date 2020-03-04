@extends('layouts.app')
@section('head-title', 'My Bids')
@section('css')
@endsection

@section('content')
<div class="container">
    <h1 class="mb-3">My Bids</h1>
    <div class="row">

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">Job Title</th>
                    <th scope="col">Bid Description</th>
                    <th scope="col">Bid Date</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($bids as $bid)
                    <tr>
                        <th scope="row">
                            <a href="{{ route('jobs.show', $bid->job->id) }}">{{Str::limit($bid->job->title, 100, $end='...')}}</a>
                        </th>
                        <td>
                          {{ Str::limit($bid->description, 80, $end='...') }}
                        </td>
                        <td>
                          {{  $bid->created_at->diffForHumans() }}
                        </td>
                      </tr>
                    @endforeach
                </tbody>
              </table>
        </div>

        {{ $bids->links() }}
                
    </div>
</div>
@endsection
