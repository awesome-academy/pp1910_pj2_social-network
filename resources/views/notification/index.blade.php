@extends('layouts.app')

@section('title', __('Notification'))
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

    <section class="notifications">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <ul>
                        @foreach($notifications as $notification)
                            <li>
                                <div class="media first_child">
                                    <img src="{{ getAvatar($notification->sender->avatar) }}" alt="avatar" class="img-responsive img-circle" onerror="this.src='{{ asset('assets/img/avatar.png') }}'">
                                    <div class="media_body">
                                        <p>
                                            <a href="{{ route('user.profile', $notification->user->username) }}"><b>{{ $notification->sender->name }}</b></a>
                                            @if($notification->isComment())
                                                {!! __('commented on your', ['post_id' => $notification->post_id]) !!}
                                            @elseif($notification->isLike())
                                                {!! __('liked your', ['post_id' => $notification->post_id]) !!}
                                            @endif
                                            <a href="{{ route('posts.show', $notification->post->id) }}"><span class="emp">{{ __('photo') }}</span>.</a>
                                        </p>
                                        <h6>{{ getCreatedFromTime($notification) }}</h6>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                            {{ $notifications->render('pagination.default') }}
                    </ul>
                </div>
            </div>
        </div>
    </section>
@endsection