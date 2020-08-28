<li class="comment-item comment-item-{{ $comment->id }}">
    <div class="post__author author vcard inline-items">
        <img src="{{ getAvatar($comment->user->avatar) }}" alt="{{ $comment->user->name }}">
        <div class="author-date">
            <div class="comment__content">
                <a class="h6 post__author-name fn" href="{{ route('user.profile', $comment->user->username) }}"><strong>{{ $comment->user->name }}</strong></a>
                <span class="comment-content-{{ $comment->id }}">{{ $comment->content ?? ''}}</span>
            </div>
        </div>
    </div>
    <div class="post__date">
        <time class="published" datetime="2004-07-24T18:18">{{ getCreatedFromTime($comment) }}</time>
    </div>
</li>
