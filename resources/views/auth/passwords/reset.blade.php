<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{__('Register')}}</title>
    <link rel="icon" href="{{ asset('assets/img/logo.jpg')}}">
    <link type="text/css" href="{{ asset('assets/css/demos/photo.css')}}" rel="stylesheet" />
    <script src="{{ asset('assets/js/modernizr-custom.js')}}"></script>
</head>
<body>
    <section class="login">
        <div class="container">
            <div class="banner-content">
                <h1><i class="fa fa-smile"></i> {{ __('Fluffs') }}</h1>
                <form method="post" class="form-signin"  action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                    <h3 class="form-signin-heading">{{ __('Reset Password') }}</h3>
                    <div class="form-group">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" placeholder="Email">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name='password' required placeholder="Password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control form-control-user" name='password_confirmation' required placeholder="Confirm Password">
                    </div>
                    <button class="kafe-btn kafe-btn-mint btn-block" type="submit" name="subm">{{ __('Reset Password') }}</button>
                </form>
            </div>
        </div>
    </section>
	<script src="{{ asset('assets/js/jquery.min.js')}}"></script>
	<script src="{{ asset('assets/js/bootstrap.min.js')}}"></script>
	<script src="{{ asset('assets/js/base.js')}}"></script>
  </body>
</html>

