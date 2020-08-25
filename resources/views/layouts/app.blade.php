<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>	
    
    <link rel="icon" href="{{ asset('assets/img/logo.jpg') }}">
    <link type="text/css" href="{{ asset('assets/css/demos/photo.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<body>
     @include('layouts.header')
    
     @yield('content')
	 
	<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
	<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('assets/js/base.js') }}"></script>
	<script src="{{ asset('assets/plugins/slimscroll/jquery.slimscroll.js') }}"></script>
    <script src="{{ asset('js/customs.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script type="text/javascript">
         var currentUserId = "{{ auth()->id() }}";
         var notificationCount = "{{ auth()->user()->notifications()->isNotReadCount() }}";
    </script>
	<script>
		$('#Slim,#Slim2').slimScroll({
				height:"auto",
				position: 'right',
				railVisible: true,
				alwaysVisible: true,
				size:"8px",
			});
        function errorMessage() {
            Swal.fire({
                icon: 'error',
                title: "@lang('Oops...')",
                text: "@lang('Something went wrong!')",
            });

            location.reload();
        }

        function errorEmptyContent() {
            Swal.fire({
                icon: 'question',
                text: "@lang('Content can\'t be empty!')",
            });
        }
	</script>
	@yield('script')
  </body>
</html>