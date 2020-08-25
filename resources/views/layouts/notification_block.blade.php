@if($notifications->isEmpty())
    <p class="notify-details">{{ __('There\'s noting here...') }}</p>
@else
    @foreach($notifications as $notification)
        <li @if($notification->isRead()) class="notification-background" @endif>
            <a href="javascript:void(0);" class="dropdown-item notify-item">
                <div class="notify-icon bg-success">
                    <img src="{{ getAvatar($notification->sender->avatar) }}" class="img-resonsive img-circle" width="36px" height="36px" alt="avatar">
                </div>
                <div class="notification-event">
                    <div>
                        <p class="notify-details">{{ $notification->sender->name }}
                            @if($notification->isComment())
                                {!! __('commented on your photo', ['post_id' => $notification->post_id]) !!}
                            @elseif($notification->isLike())
                                {!! __('liked your photo', ['post_id' => $notification->post_id]) !!}
                            @endif
                            <small class="text-muted">{{ getCreatedFromTime($notification) }}</small>
                        </p>
                    </div>
                </div>
            </a>
        </li>
    @endforeach
@endif
