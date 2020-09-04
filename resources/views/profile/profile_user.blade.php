@extends('layouts.app')

@section('title', '')
@section('content')
    <section class="profile">
        <div class="container-fluid">
            <div class="row">
                <a class="profilebox"><img class="img-cover" src="{{ __('assets/img/cover.png') }}" alt="">
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
                            <img class="img-fluid img-circle" src="{{ getAvatar($user->avatar) }}" alt="Image">
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
                        <li class="current-menu-item">{{ __('Posts') }} <span>{{ $user->posts()->get()->count() }}</span></li>
                        <li>{{ __('Followers') }} <span>{{ $user->followers()->get()->count() }}</span></li>
                        <li>{{ __('Following') }} <span>{{ $user->followings()->get()->count() }}</span></li>
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
                        <a href="javascript:void(0)" data-toggle="modal">
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