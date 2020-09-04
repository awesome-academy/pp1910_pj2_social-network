<div class="suggestion-box full-width">
    <div class="suggestions-list activity-list">
        @foreach($activities as $activity)
            @if($activity->isUpload())
                <div class="activity-body">
                    <img class="img-responsive img-circle" src="{{ getAvatar($activity->user->avatar) }}" alt="{{ $activity->user->name }}">
                    <div class="name-box">
                        <a href="{{ route('user.profile', $activity->user->username) }}">
                            {{ $activity->user->name }}
                        </a>
                        {{ __('uploaded a') }}
                        <a href="{{ route('posts.show', $activity->post->id) }}">{{ __('photo') }}</a><br>
                        <span>{{ getCreatedFromTime($activity) }}</span>
                    </div>
                </div>
            @else
                <div class="activity-body">
                    <img class="img-responsive img-circle" src="{{ getAvatar($activity->user->avatar) }}" alt="{{ $activity->user->name }}">
                    <div class="name-box">
                        <a href="{{ route('user.profile', $activity->user->username) }}">
                            {{ $activity->user->name }}
                        </a>
                        @if($activity->isLike())
                            @if($activity->post->user->id == auth()->id())
                                {!! __('activity.to_present_user.like', ['post_id' => $activity->post->id]) !!}
                            @else
                                {!! __('activity.to_others.like', ['user_name' => $activity->post->user->name, 'post_id' => $activity->post->id]) !!}
                            @endif
                        @elseif($activity->isComment())
                            @if ($activity->post->user->id == auth()->id())
                                {!! __('activity.to_present_user.comment', ['post_id' => $activity->post->id]) !!}
                            @else
                                {!! __('activity.to_others.comment', ['user_name' => $activity->post->user->name, 'post_id' => $activity->post->id]) !!}
                            @endif
                        @endif
                        <br><span>{{ getCreatedFromTime($activity) }}</span>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</div>