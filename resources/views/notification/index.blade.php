@extends('layouts.app')

@section('title', __('Notification'))
@section('content')

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
                                            <a class="user-name" href="{{ route('user.profile', $notification->user->username) }}">{{ $notification->sender->name }}</a>
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