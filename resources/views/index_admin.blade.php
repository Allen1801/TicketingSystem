@extends('layouts.admin_app')

@section('content')
<button class="btn float-start" data-bs-toggle="offcanvas" data-bs-target="#offcanvas" role="button">
    <i class="bi bi-arrow-right-square-fill fs-3" data-bs-toggle="offcanvas" data-bs-target="#offcanvas"></i>
</button>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{__('Notification')}}</div>
                <div class="card-body ">
                    @forelse($notifications as $notification)
                        <div class="alert alert-success" role="alert">
                            [{{ $notification->created_at }}] User {{ $notification->data['id'] }} {{ $notification->data['message'] }}
                            <a href="{{url('/markasread')}}" class="float-right mark-as-read" data-id="{{ $notification->id }}">Mark as read</a>
                        </div>
                        @if($loop->last)
                            <a href="{{url('/markasread')}}" id="mark-all">Mark all as read</a>
                        @endif
                        @empty
                            There are no new notifications
                    @endforelse   
                </div>
            </div>
        </div>
    </div>
</div>
<br>
@endsection
@section('bottom-js')
<script>

TODO://NOTIFICATION
  $(document).ready(function () {
    toastr.options = {
  "closeButton": true,
  "debug": false,
  "newestOnTop": true,
  "progressBar": true,
  "positionClass": "toast-top-right",
  "toastClass": "toast-info",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "500",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}
  });

    var notificationsWrapper   = $('.dropdown-notifications');
    var notificationsToggle    = notificationsWrapper.find('a[data-toggle]');
    var notificationsCountElem = notificationsToggle.find('i[data-count]');
    var notificationsCount     = parseInt(notificationsCountElem.data('count'));
    var notifications          = notificationsWrapper.find('div.dropdown-menu');

Pusher.logToConsole = true;

var pusher = new Pusher('d2bb2b51e17bf488dfb1', {
  cluster: 'ap1'
});
var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(message) {
        var existingNotifications = notifications.html();
        var newNotificationHtml = `
        <li class="dropdown-item">`+message+`</>
        `;
        notifications.html(newNotificationHtml + existingNotifications);

        notificationsCount += 1;
        notificationsCountElem.attr('data-count', notificationsCount);
        notificationsWrapper.find('.notif-count').text(notificationsCount);
        notificationsWrapper.show();
        
        // alert(JSON.stringify(data));
        toastr.info(JSON.stringify(message));
        // notify()success(JSON.stringify(data));
    });

    setInterval(function() {
    location.reload();
}, 60000);
</script>

@endsection