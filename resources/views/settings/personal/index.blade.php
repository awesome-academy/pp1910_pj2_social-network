@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row setting-page">
            @include('settings.menu')
            @include('settings.personal.main')
        </div>
    </div>
@endsection
