<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>{{Lang::get('reminders.reset--title')}}</h2>

		<div>
			{{Lang::get('reminders.reset--email')}}
			 {{ URL::to('password/reset', array($token)) }}.<br/>
			 {{Lang::get('reminders.reset--expire')}}
			 {{Config::get('auth.reminder.expire', 60)}} {{Lang::choice('global.minutes', Config::get('auth.reminder.expire', 60))}}.
		</div>
	</body>
</html>