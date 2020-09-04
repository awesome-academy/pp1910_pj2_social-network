<li class="comment-item comment-item-{{ $comment->id }}">
    <div class="post__author author vcard inline-items">
        <img src="{{ getAvatar($comment->user->avatar) }}" alt="{{ $comment->user->name }}">
        <div class="author-date">
            <div class="comment__content">
                <a class="h6 post__author-name fn" href="{{ route('user.profile', $comment->user->username) }}"><strong>{{ $comment->user->name }}</strong></a>
                <span class="comment-content-{{ $comment->id }}">{{ $comment->content ?? ''}}</span>
            </div>
        </div>
        @if(auth()->id() == $comment->user->id)
            <div class="dropdown pull-right drop-comment">
                <button class="btn btn-secondary btn-flat btn-flat-icon button-comment" type="button" data-toggle="dropdown" aria-expanded="false">
                    <em class="fa fa-ellipsis-h"></em>
                </button>
                <div class="dropdown-menu dropdown-scale dropdown-menu-right drop-right" role="menu">
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#confirmDeleteCommentModal{{ $comment->id }}">{{ __('Delete comment') }}</a>
                </div>
            </div>
        @endif
    </div>
    @include('block.modals.delete_comment')
    <div class="post__date">
        <time class="published" datetime="2004-07-24T18:18">{{ getCreatedFromTime($comment) }}</time>
    </div>
</li>
