<div class="selectize-dropdown-content">
    @foreach($searchData as $user)
        <div class="inline-items">
            <div class="author-thumb">
                <img class="default-avatar" src="{{ getAvatar($user->avatar) }}" alt="{{$user->name}}">
            </div>
            <div class="notification-event">
                <a href="{{ route('user.profile', $user->username) }} " class="h6 notification-friend sender"><strong>{{ $user->name }}</strong></a>
            </div>
        </div>
    @endforeach
</div>
