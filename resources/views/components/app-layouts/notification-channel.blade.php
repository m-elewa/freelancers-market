@auth
<script>
  //subscribe to the user channel
  Echo.private('App.User.{{ Auth::id() }}')
    .notification((notification) => { 
         
      // Show Notification Toaster
      showNotificationToaster(notification);

      // Show On Notifications Drop Down
      showOnNotificationsDropDown(notification);
    });

  function showNotificationToaster(notification) {
    // create notification toaster
    $('#notifications-list').prepend(`
        <div class="toast show" style="min-width: 350px;" id="${notification.id}">
          <div class="toast-header text-primary d-flex justify-content-between">
            <div>
              <i class="fas fa-bullhorn mr-2"></i>
              <a href="${notificationUrl(notification)}" class="text-decoration-none">
                <strong class="mr-auto">You have new bid!</strong>
              </a>
            </div>
            <div>
                <small class="text-muted">${notification.created_at}</small>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast">
                  <span>&times;</span>
                </button>
            </div>
          </div>
          <div class="toast-body">
            ${notification.description}
          </div>
        </div>
      `);

    // show with animation
    $('#' + notification.id).hide().show('slow');

    // close on click the close button
    $('#' + notification.id).on("click", '.close', function () {
        $('#' + notification.id).hide('slow');
    });

    // hide toaster after 10s
    setTimeout(function () {
        $('#' + notification.id).hide('slow');
    }, 10000);
  }

  function showOnNotificationsDropDown(notification) {
    // increase notifications count by one
    var notificationsCount = parseInt($('#notifications-count').attr('data-count'));
    if (notificationsCount >= 1) {
        $('#notifications-count').attr('data-count', notificationsCount + 1);
    } else {
        $('#notifications-count').attr('data-count', 1);
    }

    // remove no data element if exist
    if ($('#no-notifications').length) {
        $('#no-notifications').remove();
    }

    // remove last notification from the list is they are more than 5
    if ($('.notification-message').length >= 5) {
        $('#notifications-menu li:last-child').remove();
    }

    // create notification menu element
    $('#notifications-menu').prepend(`
      <li class="notification-message notification-box border-bottom">
        <div class="row">
          <div class="offset-1 col-10">
              <a href="${notificationUrl(notification)}" class="stretched-link text-decoration-none">
            <strong class="text-info">
                  You have new bid!
              </strong>
          </a>
            <div>
              ${notification.description}
            </div>
            <small class="text-muted">
              ${notification.created_at}
              </small>
          </div>    
        </div>
      </li>
    `);
  }

  function notificationUrl(notification) {
    return notification.job.url + '?read=' + notification.id;
  }
</script>

<div id="notifications-list" style="position: fixed; top: 80px; right: 20px;"></div>
@endauth
