@extends('layouts.app')

@section('title', 'Fluffs')
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
    <section class="profile-two">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3">
                    <aside id="leftsidebar" class="sidebar">
                        <ul class="list">
                            <li>
                                <div class="user-info">
                                    <div class="image">
                                        <a class="avatar_profile">
                                            <img src="{{ getAvatar($user->avatar) }}" class="img-responsive img-circle" alt="User">
                                            <a href="#" type="button" data-toggle="modal" data-target="#update_avatar" class="avatar_btn"><em class="fa fa-edit pull-right"></em></a>
                                        </a>
                                    </div>
                                    <div class="detail">
                                        <h4>{{ auth()->user()->name }}</h4>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <small class="text-muted"><a href="#">{{ $user->posts()->get()->count() }} Posts </a> </small><br/>
                                <small class="text-muted"><a href="#">{{ $user->followers()->get()->count() }} Followers </a> </small><br/>
                                <small class="text-muted"><a href="#">{{ $user->followings()->get()->count() }} Following </a> </small>
                                <hr>
                                <small class="text-muted">Birthday: </small>
                                <p>{{ auth()->user()->birthday }}</p>
                                <hr>
                                <small class="text-muted">Address: </small>
                                <p>{{ auth()->user()->address }}</p>
                                <hr>
                            </li>
                        </ul>
                    </aside>
                </div>

                <div class="col-lg-6">
                    @foreach($posts as $post)
                        @php
                            $images = json_decode($post->image);
                        @endphp
                        @foreach($images as $key => $postImage)
                            <div class="col-lg-6">
                                <a href="#" data-toggle="modal" data-target="#{{ $post->id }}">
                                    <div class="explorebox" >
                                        <img class="img-profile" src="{{ asset('storage/images/posts/' . $postImage) }}" alt="">
                                    </div>
                                </a>
                            </div>
                        @endforeach
                        <div id="{{ $post->id }}" class="modal fade">
                            @include('block.modals.post')
                        </div>
                    @endforeach
                </div>
                <div class="col-lg-3">
                    <div class="trending-box">
                        <div class="row">
                            <div class="col-lg-12">
                                <h4>{{ __('Photos') }}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="trending-box">
                        @if($postImages)
                            @foreach($postImages as $image)
                                <div class="col-lg-6">
                                    <a href="{{ asset('storage/images/posts/' . $image) }}"><img src="{{ asset('storage/images/posts/' . $image) }}" class="img-responsive" alt="Image"/></a>
                                </div>
                            @endforeach
                        @else
                        {{ __('No Photo') }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="update_avatar" tabindex="-1" role="dialog" aria-labelledby="update-header-avatar" aria-hidden="true">
        <div class="modal-dialog window-popup update-header-photo" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Upload Avatar') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('user.updateAvatar', auth()->user()->username) }}" enctype="multipart/form-data">
                        @csrf
                        <a href="#" class="upload-photo-item photo-item-margin">
                            <label for="upload-avatar" class="display-inline">
                                <em class="fa fa-desktop"></em>
                                <h6>{{ __('Upload Photo') }}</h6>
                            </label>
                        </a>
                        <input type="file" id="upload-avatar" name="avatar" style="display: none">
                        <hr>
                        <div id="image-holder-avatar" style="text-align: center;"></div>
                        <button class="btn btn-primary btn-avatar">{{ __('Upload') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
