@extends('layouts.app')

@section('title', '')
@section('content')
    <section class="nav-sec">
        <div class="d-flex justify-content-between">
            <div class="p-2 nav-icon-lg dark-black">
                <a class="nav-icon" href="{{ route('home') }}"><em class="fa fa-home"></em>
                    <span>{{ __('Home') }}</span>
                </a>
            </div>
            <div class="p-2 nav-icon-lg clean-black">
                <a class="nav-icon" href="#"><em class="fa fa-crosshairs"></em>
                    <span>{{ __('Explore') }}</span>
                </a>
            </div>
            <div class="p-2 nav-icon-lg dark-black">
                <a class="nav-icon" href="#"><em class="fab fa-instagram"></em>
                    <span>{{ __('Upload') }}</span>
                </a>
            </div>
            <div class="p-2 nav-icon-lg clean-black">
                <a class="nav-icon" href="#"><em class="fa fa-align-left"></em>
                    <span>{{ __('Stories') }}</span>
                </a>
            </div>
            <div class="p-2 nav-icon-lg mint-green">
                <a class="nav-icon" href="{{ route('user.profile', auth()->user()->username) }}"><em class="fa fa-user"></em>
                    <span>{{ __('Profile') }}</span>
                </a>
            </div>
        </div>
    </section>
    <section class="profile">
        <div class="container-fluid">
            <div class="row">
                <a class="profilebox"><img class="img-cover" src="assets/img/posts/12.jpg" alt="">
                </a>
            </div>
        </div>
    </section>
    <section class="user-profile">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="post-content">
                        <div class="author-post text-center">
                            <a href="#"><img class="img-fluid img-circle" src="{{ getAvatar($user->avatar) }}" alt="Image"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="details">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="details-box row">
                        <div class="col-lg-9">
                            <div class="content-box">
                                <h4>{{ $user->name }}</h4>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="follow-box action-follow" data-id="{{ $user->id }}">
                                @if(auth()->user()->isFollowing($user))
                                    <a href="" class="kafe-btn kafe-btn-mint"><i class="fa fa-check"></i> {{ __('Following') }}</a>
                                @else
                                    <a href="" class="kafe-btn kafe-btn-mint"> {{ __('Follow') }}</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="home-menu">
        <div class="container">
            <div class="row">
                <div class="menu-category">
                    <ul class="menu">
                        <li class="current-menu-item"><a href="#">{{ __('Posts') }} <span>{{ $user->posts()->get()->count() }}</span></a></li>
                        <li><a href="#">{{ __('Followers') }} <span>{{ $user->followers()->get()->count() }}</span></a></li>
                        <li><a href="#">{{ __('Following') }} <span>{{ $user->followings()->get()->count() }}</span></a></li>
                    </ul>
                </div>

            </div>
        </div>
    </section>
    <section class="newsfeed">
        <div class="container">
            @foreach($posts as $post)
                @php
                    $images = json_decode($post->image);
                @endphp
                @foreach($images as $key => $image)
                    <div class="col-lg-4">
                        <a href="#myModal" data-toggle="modal">
                            <div class="explorebox">
                                <img class="img-box" src="{{ asset('storage/images/posts/' . $image) }}" alt="">
                            </div>
                        </a>
                    </div>
                @endforeach
            @endforeach
        </div>
    </section>
@endsection