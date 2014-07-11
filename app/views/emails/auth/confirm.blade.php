<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>{{Lang::get('confirmation.email--title')}}</h2>

		<div>
			{{Lang::get('confirmation.email--hello')}} {{$firstname}}<br />
			<p>
			{{Lang::get('confirmation.email--text')}}<br />
			{{ URL::to('user/verify', array($confirmation_code)) }}
			</p>
			<p>
			{{Lang::get('confirmation.email--bye')}}
		</p>
		</div>
	</body>
</html>