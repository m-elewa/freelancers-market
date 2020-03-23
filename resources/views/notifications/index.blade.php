@extends('layouts.app')
@section('title', 'Notifications')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-12 d-flex justify-content-between border-bottom mb-3">
            <h1>Notifications</h1>
            <a href="{{ route('notifications.mark-all-as-read') }}" class="align-self-center">Mark all as read</a>
        </div>

        @forelse ($notifications as $notification)
        <div class="col-lg-8 col-md-12">
            <div class="card my-2 shadow @if($notification->read_at) text-white bg-secondary @endif">
            <div class="card-body">
                <a href="
                @if ($notification->type == \App\Notifications\BidPostedNotification::class)
                    {{ $notification->data['job']['url'] }}?read={{ $notification->id }}
                @else
                    #
                @endif
                " class="stretched-link @if($notification->read_at) text-white @endif"><h5 class="card-title">
                    @if ($notification->type == \App\Notifications\BidPostedNotification::class)
                    You have new bid!
                  @else
                    You have new notification!
                  @endif
                </h5></a>
                <p class="card-text">{{ $notification->data['description'] }}</p>
            </div>

            <div class="card-footer">
                <div>{{$notification->data['created_at']}}</div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-8">
        <x-jobs.nodata/>
    </div>
    @endforelse

    <div class="col-8 my-3">
        {{ $notifications->links() }}
    </div>
    

</div>
</div>
@endsection
