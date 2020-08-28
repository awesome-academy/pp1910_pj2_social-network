@if (!isset($moreComments))
    @if ($post->allComments()->count() > config('post.comment.max'))
        @include('block.comment', ['comment' => $lastParentComment])
    @else
        @foreach ($post->parentComments as $comment)
            @include('block.comment', ['comment' => $comment])
        @endforeach
    @endif
@else
    @foreach ($moreComments as $comment)
        @include('block.comment', ['comment' => $comment])
    @endforeach
@endif

