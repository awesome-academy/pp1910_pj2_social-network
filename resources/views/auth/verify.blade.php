<!DOCTYPE html>
<html lang="en">
  <head>
		<meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">  
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ __('Login') }}</title>	
		<link rel="icon" href="{{asset('assets/img/logo.jpg')}}">
        <link type="text/css" href="{{asset('assets/css/demos/photo.css')}}" rel="stylesheet" />
  </head>

<body>
    <section class="login">
        <div class="container">
            <div class="banner-content">
                <h1><i class="fa fa-smile"></i> {{ __('Fluffs') }}</h1>
                <form class="form-signin" method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                    <h3 class="form-signin-heading">{{ __('Verify Your Email Address') }}</h3>
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif
                    <h4 class="form-signin-heading">
                        {{ __('Before proceeding, please check your email for a verification link.') }}
                        {{ __('If you did not receive the email') }},
                    </h4>
                    <button class="kafe-btn kafe-btn-mint btn-block" type="submit">{{ __('click here to request another') }}</button>
                </form>
            </div>
        </div>
    </section> 
  
	<script src="{{asset('assets/js/jquery.min.js')}}"></script>
	<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('assets/js/base.js')}}"></script>

  </body>
</html>
