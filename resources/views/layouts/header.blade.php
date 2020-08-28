<header class="tr-header">
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                <span class="sr-only"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ route('home') }}"><i class="fab fa-instagram"></i>{{ __('Fluffs') }}</a>
            </div>
            <div class="navbar-left">
                <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav">
                </ul>
            </div>
            </div>
            <div class="navbar-right">
                <ul class="nav navbar-nav">
                    <li>
                        <div class="search-dashboard">
                            <form>
                                <input placeholder="Search here" type="text">
                                <button type="submit"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                    </li>

                    @include('layouts.notification')
                    <li class="dropdown mega-avatar">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                        <span class="avatar w-32"><img src="{{ getAvatar(auth()->user()->avatar) }}" class="img-resonsive img-circle" width="25" height="25" alt="avatar" onerror="this.src='{{ asset('assets/img/avatar.png') }}'"></span>
                            <span class="hidden-xs">{{auth()->user()->name}}</span>
                        </a>
                        <div class="dropdown-menu w dropdown-menu-scale pull-right">
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
                                {{ __('Sign out') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
<section class="nav-sec">
    <div class="d-flex justify-content-between">
        <div class="p-2 nav-icon-lg mint-green">
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
            <a class="nav-icon" href="{{ route('user.profile', auth()->user()->username) }}"><em class="fa fa-user"></em>
                <span>{{ __('Profile') }}</span>
            </a>
        </div>
        <div class="p-2 nav-icon-lg dark-black">
            <a class="nav-icon" href="{{ route('user.getProfile') }}"><em class="fa fa-align-justify"></em>
                <span>{{ __('Setting') }}</span>
            </a>
        </div>
    </div>
</section>
