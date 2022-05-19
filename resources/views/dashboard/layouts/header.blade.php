<!-- BEGIN: Header-->
<nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow">
    <div class="navbar-container d-flex content">
        <div class="bookmark-wrapper d-flex align-items-center">
            <ul class="nav navbar-nav d-xl-none">
                <li class="nav-item"><a class="nav-link menu-toggle" href="javascript:void(0);"><i
                            class="ficon" data-feather="menu"></i></a></li>
            </ul>

        </div>
        <ul class="nav navbar-nav align-items-center ml-auto">

            <li class="nav-item dropdown dropdown-notification dropdown-notifications mr-25">
                <a class="nav-link" href="javascript:void(0);" data-toggle="dropdown">
                    <i class="ficon" data-feather="bell"></i>
                    <span data-count="0" class="badge badge-pill badge-danger badge-up notif-count">0</span></a>
                <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                    <li class="dropdown-menu-header">
                        <div class="dropdown-header d-flex">
                            <h4 class="notification-title mb-0 mr-auto">Notifications</h4>
                            <span data-count="0" class="badge badge-pill badge-light-primary notif-count">new 0</span>
                        </div>
                    </li>
                    <li class="scrollable-container media-list">
                        <a class="d-flex test" href="javascript:void(0)">
                            <div class="media d-flex align-items-start">
                                <div class="media-body">
                                    <p class="media-heading mnm"><span class="font-weight-bolder"></span></p>
                                </div>
                            </div>
                        </a>
                    </li>


                    <li class="dropdown-menu-footer"><a class="btn btn-primary btn-block" href="javascript:void(0)">Read
                            all notifications</a></li>
                </ul>
            </li>
            </li>
            <li class="nav-item dropdown dropdown-user"><a class="nav-link dropdown-toggle dropdown-user-link"
                    id="dropdown-user" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">

                    <div class="user-nav d-sm-flex d-none"><span
                            class="user-name font-weight-bolder">{{ \Illuminate\Support\Facades\Auth::user()->firstname }}</span><span
                            class="user-status">{{ \Illuminate\Support\Facades\Auth::user()->role->name ?? '' }}</span>
                    </div><span class="avatar"><img class="round"
                            src="{{ asset('app-assets/images/portrait/small/avatar-s-11.jpg') }}" alt="avatar"
                            height="40" width="40"><span class="avatar-status-online"></span></span>

                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-user"><a class="dropdown-item"
                        href="{{ route('user.profile', auth()->id()) }}"><i class="mr-50"
                            data-feather="user"></i> Profile</a>
                    <div class="dropdown-divider"></div>

                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        <i class="mr-50" data-feather="power"></i> Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
        <!-- Responsive Settings Options -->
    </div>
</nav>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script>
    var notificationsWrapper = $('.dropdown-notifications');
    var notificationsCountElem = notificationsWrapper.find('span[data-count]');
    var notificationsCount = parseInt(notificationsCountElem.data('count'));
    var notifications = notificationsWrapper.find('test.p');


    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('cf550f657368de7463f8', {
        cluster: 'mt1'
    });
    var channel = pusher.subscribe('my-channel');
    channel.bind('App\\Events\\myEvent', function(event) {
        var existingNotifications = notifications.html();
        var newNotificationHtml = `<span class="font-weight-bolder">`+event.project_name`+</span>`;
        notifications.html(newNotificationHtml + existingNotifications);
        notificationsCount += 1;
        notificationsCountElem.attr('data-count', notificationsCount);
        notificationsWrapper.find('.notif-count').text(notificationsCount);
        notificationsWrapper.show();
    });
</script>
<!-- END: Header-->
