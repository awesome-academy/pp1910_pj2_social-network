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
    <script src="{{ asset('assets/js/jquery.magnific-popup.js') }}"></script>
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

            //location.reload();
        }
        function successFollow() {
            swal.fire({
                title: "Successfully!",
                icon: 'success',
            });

            location.reload();
        }

        function errorEmptyContent() {
            Swal.fire({
                icon: 'question',
                text: "@lang('Content can\'t be empty!')",
            });
        }

        function zoomImage() {
            $(".zoom-image").magnificPopup({
                type: "image",
                removalDelay: 500,
                callbacks: {
                    beforeOpen: function() {
                        this.st.image.markup = this.st.image.markup.replace("mfp-figure", "mfp-figure mfp-with-anim"), this.st.mainClass = "mfp-zoom-in"
                    }
                },
                closeOnContentClick: !0,
                midClick: !0
            });
        }

        function zoomGallery() {
            $(".zoom-gallery").each(function() {
                $(this).magnificPopup({
                    delegate: "a",
                    type: "image",
                    gallery: {
                        enabled: !0
                    },
                    removalDelay: 500,
                    callbacks: {
                        beforeOpen: function() {
                            this.st.image.markup = this.st.image.markup.replace("mfp-figure", "mfp-figure mfp-with-anim"), this.st.mainClass = "mfp-zoom-in"
                        }
                    },
                    closeOnContentClick: !0,
                    midClick: !0
                })
            });
        }

        zoomImage();
        zoomGallery();
	</script>
	@yield('script')
  </body>
</html>