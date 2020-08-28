@extends('layouts.app')

@section('title', 'Fluffs')
@section('content')
    <section class="newsfeed">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3">
                    <a href="#">
                        <div class="storybox">
                            <div class="story-body text-center">
                                <div class=""><img class="img-circle" src="assets/img/users/10.jpg" alt="user"></div>
                                <h4>Clifford Graham</h4>
                                <p>2 hours ago</p>
                            </div>
                        </div>
                    </a>

                    <a href="#">
                        <div class="storybox">
                            <div class="story-body text-center">
                                <div class=""><img class="img-circle" src="assets/img/users/13.jpeg" alt="user"></div>
                                <h4>Eleanor Harper</h4>
                                <p>4 hours ago</p>
                            </div>
                        </div>
                    </a>

                    <a href="#">
                        <div class="storybox">
                            <div class="story-body text-center">
                                <div class=""><img class="img-circle" src="assets/img/users/12.jpg" alt="user"></div>
                                <h4>Sean Coleman</h4>
                                <p>5 hours ago</p>
                            </div>
                        </div>
                    </a>

                    <a href="#">
                        <div class="storybox">
                            <div class="story-body text-center">
                                <div class=""><img class="img-circle" src="assets/img/users/15.jpg" alt="user"></div>
                                <h4>Vanessa Wells</h4>
                                <p>5 hours ago</p>
                            </div>
                        </div>
                    </a>

                    <div class="trending-box hidden-xs hidden-md">
                        <div class="row">
                            <div class="col-lg-12">
                                <a href="photo_stories.html"><h4>More stories</h4></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="box">
                        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input class="form-control no-border" rows="3" name="title" placeholder="Type something...">
                            <div class="box-footer clearfix">
                                <ul class="nav nav-pills nav-sm">
                                    <li class="nav-item">
                                        <a href="#" class="options-message" data-toggle="tooltip" data-placement="top" data-original-title="@lang('ADD PHOTOS')">
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