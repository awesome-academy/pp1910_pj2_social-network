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
    </div>
    <div id="{{ $post->id }}" class="modal fade">
        @include('block.modals.post')
    </div>
@endforeach