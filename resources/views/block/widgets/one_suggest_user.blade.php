<div class="suggestion-body follows-suggestion-{{ $user->id }}">
    <img class="img-responsive img-circle" src="{{ getAvatar($user->avatar) }}" alt="Image">
    <div class="name-box">
        <a href="{{ route('user.profile', $user->username) }}"><h4>{{ $user->name }}</h4></a>
        <span>{{ '@'.$user->username }}</span>
    </div>
    <span class="action-follow" data-id="{{ $user->id }}">
        @if(auth()->user()->isFollowing($user))
            <i class="fa fa-window-close" title="{{ __('UnFollow this user') }}"></i>
        @else
            <i class="fa fa-plus" title="{{ __('Follow this user') }}"></i>
        @endif
    </span>
</div>