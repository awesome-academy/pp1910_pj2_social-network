@extends('layouts.app')

@section('title', '')
@section('content')
    <section class="single-post">
        <div class="container">
            <div class="row">
                <div class="col-lg-2"></div>
                <div class="col-lg-8">
                    @include('post.single_post')
                </div>
                <div class="col-lg-2"></div>
            </div>
        </div>
    </section>
@endsection