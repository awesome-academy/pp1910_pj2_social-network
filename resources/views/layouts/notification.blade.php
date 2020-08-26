<li class="dropdown notification-list dropdown-notifications">
    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#notifications-panel">
        <i class="fa fa-bell noti-icon"></i>
        <div class="badge badge-danger badge-pill noti-icon-badge notification-count">0</div>
    </a>
    <div class="dropdown-menu dropdown-menu-right dropdown-lg notification" aria-labelledby="dropdownMenuLink">
        <div class="dropdown-item noti-title">
            <h6 class="m-0">
            <span class="pull-right">
                <a href="#" class="text-dark mark-all-as-read"><small>{{ __('Mark all as read') }}</small></a>
            </span>
                {{ __('Notification') }}
            </h6>
        </div>

        <div class="slimScrollDiv">
            <div class="slimscroll">
                <div id="Slim">
                    <ul class="notifications-list notification-block">
                    </ul>
                </div>
                <div class="slimScrollBar"></div>
                <div class="slimScrollRail"></div>
            </div>
        </div>
        <a href="{{ route('notifications.show_all') }}" class="dropdown-item text-center notify-all">{{ __('View all') }} <i class="fa fa-arrow-right"></i></a>
    </div>
</li>