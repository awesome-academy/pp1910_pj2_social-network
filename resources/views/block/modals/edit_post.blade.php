<div class="modal fade edit-post-modal" id="confirmEditModal{{ $post->id }}" tabindex="-1" aria-labelledby="editPostModalLabel" aria-hidden="true" data-post-id="{{ $post->id }}">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPostModalLabel">{{ __('Edit Post') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="ui-block">
                    <div class="news-feed-form single-post">
                        <div class="tab-content">
                            <form method="POST" class="edit-post-form" action="{{ route('posts.update', $post->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="author-thumb">
                                    <img class="avatar default-avatar" src="{{ getAvatar(auth()->user()->avatar) }}" alt="{{ auth()->user()->name }}">
                                </div>
                                <div class="form-group with-icon label-floating is-empty">
                                    <textarea class="edit-post-textarea form-control @error('content') is-invalid @enderror" name="title" placeholder="">{{ $post->title }}</textarea>

                                    @error('content')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div id="image-holder" class="edit-image edit-image-holder post-{{ $post->id }}">
                                    @include('block.modals.image_edit')
                                </div>
                                <div class="add-options-message edit-image-message">
                                    <a href="#" class="options-message edit-image-message" data-toggle="tooltip" data-placement="top" data-original-title="@lang('ADD PHOTOS')" data-post-id="{{ $post->id }}">
                                        <label class="display-inline" for="upload-image">
                                            <i class="fa fa-image"></i>
                                            <input id="upload-image" class="edit-image-input post-{{ $post->id }} form-control @error('image') is-invalid @enderror" style="display: none" data-post-id="{{ $post->id }}" type="file" name="image[]" accept="image/*" multiple>
                                        </label>
                                    </a>
                                    <a href="#" class="remove-image display-none post-{{ $post->id }}" data-post-id="{{ $post->id }}" data-toggle="tooltip" title="@lang('REMOVE ALL IMAGES')">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    <button type="submit" class="btn btn-primary btn-md-2 edit-post-button"> {{ __('Accept Changes') }} </button>

                                    @error('image.*')
                                    <span class="image-error" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>