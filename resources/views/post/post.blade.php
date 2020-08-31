@foreach($posts as $post)
    <div class="cardbox">
        <div class="cardbox-heading">
            <div class="dropdown pull-right">
                <button class="btn btn-secondary btn-flat btn-flat-icon" type="button" data-toggle="dropdown" aria-expanded="false">
                    <em class="fa fa-ellipsis-h"></em>
                </button>
                <div class="dropdown-menu dropdown-scale dropdown-menu-right drop-right" role="menu">
                    @if(auth()->id() == $post->user->id)
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#confirmEditModal{{ $post->id }}">{{ __('Edit post') }}</a>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#confirmDeleteModal{{ $post->id }}">{{ __('Delete post') }}</a>
                    @else
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#unfollowUser">{{ __('Stop following') }}</a>
                    @endif
                </div>
                @include('block.modals.edit_post')
                @include('block.modals.delete_post')
            </div>
            <div class="media m-0">
                <div class="d-flex mr-3">
                    <a href="#"><img class="img-responsive img-circle" src="{{ getAvatar($post->user->avatar) }}" alt="User"></a>
                </div>
                <div class="media-body">
                    <a href="{{ route('user.profile', $post->user->username) }}"><p class="m-0">{{ $post->user->name }}</p></a>
                    <small><a href="{{ route('posts.show', $post->id) }}"><span>{{ getCreatedFromTime($post) }}</span></a></small>
                </div>
            </div>
            <span>{{ $post->title }}</span>
        </div>
        @include('block.widgets.post_image')
        <div class="cardbox-like">
            <ul>
                <li>
                    <a href="#" class="btn-react-post-like" data-post-id="{{ $post->id }}">
                        @if($post->likes()->where('user_id', auth()->id())->exists())
                            <i class="fas fa-thumbs-up not-like-post" aria-hidden="true"></i>
                        @else
                            <i class="far fa-thumbs-up like-post" aria-hidden="true"></i>
                        @endif
                    </a>
                    <span class="react-this-post-{{ $post->id }} count-reacts"> {{ $post->likes()->count() }}</span>
                </li>
                <li>
                    <a title="" class="com">
                        <i class="fa fa-comments"></i>
                    </a>
                    <span class="span-last"> {{ $post->allComments()->get()->count() }}</span>
                </li>
            </ul>
        </div>
        @php
            $lastParentComment = $post->latestComment();
        @endphp

        @if ($post->allComments()->count() > config('post.comment.max'))
            <a href="#" class="more-comments post-{{ $post->id }}" data-post-id="{{ $post->id }}" data-page="1">{{ __('View more comment') }}</a>
        @endif
        <ul class="comments-list post-{{ $post->id }}">
            @include('block.comment-list')
        </ul>
        <form class="comment-form inline-items post-{{ $post->id }}">
            <div class="post__author author vcard inline-items">
                <img src="{{ getAvatar(auth()->user()->avatar) }}" alt="{{ auth()->user()->name }}">
                <div class="form-group with-icon-right ">
                    <input class="form-control comment-content" placeholder="{{ __('Write your comment...') }}">
                </div>
            </div>
            <button class="btn btn-md-2 btn-primary store-comment" data-post_id="{{ $post->id }}"> @lang('Post Comment') </button>
        </form>
    </div>
@endforeach