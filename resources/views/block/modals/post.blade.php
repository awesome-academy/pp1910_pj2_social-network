@php
    $images = json_decode($post->image);
@endphp
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-body">
            <div class="row">
                <div class="col-md-8 modal-image">
                    @if(count($images) == 1)
                        @foreach ($images as $key => $postImage)
                            <img class="img-responsive" src="{{ asset('storage/images/posts/' . $postImage) }}" alt="Image">
                        @endforeach
                    @elseif(count($images) > 1)
                        <div class="w3-content w3-section">
                            @foreach($images as $key => $postImage)
                                <img class="mySlides mySlides1 w3-animate-fading" src="{{ asset('storage/images/posts/' . $postImage) }}">
                            @endforeach
                        </div>
                    @endif
                </div>
                <div class="col-md-4 modal-meta">
                    <div class="modal-meta-top">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            <span aria-hidden="true">×</span><span class="sr-only">Close</span>
                        </button>
                        <div class="img-poster clearfix">
                            <a href="">
                                <img class="img-responsive img-circle" src="{{ getAvatar($post->user->avatar) }}" alt="{{ $post->user->name }}"/>
                            </a>
                            <strong>
                                <a href="{{ route('user.profile', $post->user->username) }}">{{ $post->user->name }}</a>
                            </strong>
                            <span>{{ getCreatedFromTime($post) }}</span><br/>
                            <span>{{ $post->title }}</span>
                        </div>

                        @php
                            $lastParentComment = $post->parentComments()->latest()->first();
                        @endphp

                        <ul class="img-comment-list">
                            @include('block.comment-list')
                        </ul>
                        <div class="modal-meta-bottom">
                            <ul>
                                <li><a class="modal-like"><i class="fa fa-heart"></i></a><span class="modal-one"> {{ $post->likes()->count() }}</span> |
                                    <a class="modal-comment" href="#"><i class="fa fa-comments"></i></a><span> {{ $post->allComments()->get()->count() }}</span> </li>
                                <li>
                                    <form class="post-{{ $post->id }}">
                                        <span class="thumb-xs">
                                            <img class="img-responsive img-circle" src="{{ getAvatar(auth()->user()->avatar) }}" alt="{{ auth()->user()->name }}">
                                        </span>
                                        <div class="comment-body">
                                            <input class="form-control input-sm comment-content" placeholder="{{ __('Write your comment...') }}">
                                            <button class="btn btn-md-2 btn-primary store-comment" data-post_id="{{ $post->id }}">{{ __('Comment') }}</button>
                                        </div>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>