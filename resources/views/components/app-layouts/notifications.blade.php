<li id="notifications-dropdown" class="nav-item dropdown" style="margin-top:-9px;height: 48px;">
    <a class="nav-link pr-0" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

        <span id="notifications-count" class="p1 fa-stack fa-lg has-badge" 
            @if(Auth::user()->unreadNotifications->count())
                data-count="{{ Auth::user()->unreadNotifications->count() }} 
            @endif">
          <i class="p2 fa fa-circle fa-stack-2x"></i>
          <i class="p3 fa fa-bell fa-stack-1x xfa-inverse text-light" data-count="4b"></i>
        </span>


    </a>
      <ul class="dropdown-menu">
        <li class="head text-light bg-dark">
          <div class="row">
            <div class="col-lg-12 col-sm-12 col-12">
              <span>Notifications</span>
              <a href="{{ route('notifications.mark-all-as-read') }}" class="float-right text-light">Mark all as read</a>
            </div>
        </li>

        <div id="notifications-menu">
        @forelse(Auth::user()->notifications->take(5) as $notification)
            
        <li class="notification-message notification-box border-bottom @if($notification->read_at) bg-gray @endif">
          <div class="row">
            <div class="offset-1 col-10">
                <a href="
                @if ($notification->type == \App\Notifications\BidPostedNotification::class)
                    {{ $notification->data['job']['url'] }}?read={{ $notification->id }}
                @else
                    #
                @endif
                " class="stretched-link text-decoration-none">
              <strong class="text-info">
                  @if ($notification->type == \App\Notifications\BidPostedNotification::class)
                    You have new bid!
                  @else
                    You have new notification!
                  @endif
                </strong>
            </a>
              <div>
                {{ $notification->data['description'] }}
              </div>
              <small class="text-muted">
                  {{ $notification->data['created_at'] }}
                </small>
            </div>    
          </div>
        </li>

        @empty
        <li class="notification-box" id="no-notifications">
            <div class="row">
              <div class="offset-1 col-10 my-2">
                  There are no notifications!
              </div>    
            </div>
          </li>
        @endforelse
    </div>

        <li class="footer bg-dark text-center">
          <a href="{{ route('notifications.index') }}" class="text-light">View All</a>
        </li>
      </ul>
  </li>
