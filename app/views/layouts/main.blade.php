<!doctype html>
<html class="no-js" lang="en">
	<head>
		<meta charset="utf-8" />
		{{--<meta name="viewport" content="width=device-width, initial-scale=1.0" />--}}
		<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
		<title><?php $appname = Config::get('configuration.appname');?>
			{{$appname}}
			@if(isset($title)) 
			/ {{$title}}
			@endif
		</title>
		{{ HTML::style('assets/css/app.css') }}
	</head>
	<body>
		<div class="off-canvas-wrap site__wrap" data-offcanvas>
			<div class="inner-wrap">
				@include('layouts.navigation', array('user' => $user))
				<article class="main-content">
					@include('layouts.notifications')
					{{$content}}
					@include('layouts.footer')
				</article>
				<a class="exit-off-canvas"></a>
			</div> <!--close inner wrap -->
		</div><!--close offcanvas -->
		{{ HTML::script('assets/js/vendor/jquery.js') }}
		{{ HTML::script('assets/js/vendor/modernizr.js') }}
		{{ HTML::script('assets/js/foundation/foundation.js') }}
		{{ HTML::script('assets/js/foundation/foundation.alert.js') }}
		{{ HTML::script('assets/js/foundation/foundation.topbar.js') }}
		{{ HTML::script('assets/js/foundation/foundation.offcanvas.js') }}
		{{ HTML::script('assets/js/vendor/jquery.mobile.custom.min.js')}}
		{{ HTML::script('assets/js/script.js') }}
		{{ HTML::script('assets/js/vendor/stickyfooter.js') }}
		{{--If the array of custom script files exist, we print it--}}
		@yield('scripts')
		<script>
		$(document).foundation();
		@yield('scriptsverbose')
		</script>
	</body>
</html>