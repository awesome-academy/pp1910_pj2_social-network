@extends('layouts.app')

@section('title', 'Fluffs')
@section('content')
    <section class="newsfeed">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3">
                    <div class="trending-box">
                        <div class="row">
                            <div class="col-lg-12">
                                <h4>{{ __('Activity') }}</h4>
                            </div>
                        </div>
                    </div>
                    @include('block.widgets.activity_list')
                </div>
                <div class="col-lg-6">
                    <div class="box">
                        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input class="form-control no-border" rows="3" name="title" placeholder="{{ __('Type something...' )}}">
                            <div class="box-footer clearfix">
                                <ul class="nav nav-pills nav-sm">
                                    <li class="nav-item">
                                        <a href="#" class="options-message" data-toggle="tooltip" data-placement="top" data-original-title="{{ __('ADD PHOTOS') }}">
                                            <label for="upload-image" class="display-inline">
                                                <i class="fa fa-camera text-muted"></i>
                                            </label>
                                            <input class="input-image form-control @error('image') is-invalid @enderror" type="file" id="upload-image" style="display: none" name="image[]" accept="image/*" multiple>
                                        </a>
                                    </li>
                                </ul>
                                <button type="submit" class="kafe-btn kafe-btn-mint-small pull-right btn-sm">{{ __('Upload') }}</button>
                            </div>
                            <div id="dvPreview"></div>
                        </form>
                    </div>
                    @include('post.post')
                </div>
                <div class="col-lg-3">
                    <div class="trending-box">
                        <div class="row">
                            <div class="col-lg-12">
                                <h4>{{ __('Suggest User') }}</h4>
                            </div>
                        </div>
                    </div>
                    @include('block.suggest_user')
                    <div class="trending-box">
                        <div class="row">
                            <div class="col-lg-12">
                                <form action="{{ route('language') }}" method="post">
                                    @csrf
                                    <label><h4>{{ __('Language') }}</h4></label>
                                    <select name="language" class="language" onchange='this.form.submit()'>
                                        <option value="{{ config('user.language.en') }}" {{ auth()->user()->language == config('user.language.en') ? 'selected' : '' }}>{{ __('English') }}</option>
                                        <option value="{{ config('user.language.vi') }}" {{ auth()->user()->language == config('user.language.vi') ? 'selected' : '' }}>{{ __('Vietnamese') }}</option>
                                    </select>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script type="text/javascript">
        var slideIndex = 1;
        showDivs(slideIndex);

        function plusDivs(n) {
            showDivs(slideIndex += n);
        }

        function showDivs(n) {
            var i;
            var x = document.getElementsByClassName("mySlides");
            if (n > x.length) {slideIndex = 1}
            if (n < 1) {slideIndex = x.length}
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";
            }
            x[slideIndex-1].style.display = "block";
        }
    </script>
@endsection