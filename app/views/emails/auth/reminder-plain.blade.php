{{Lang::get('reminders.reset--email')}}
			 {{ URL::to('password/reset', array($token)) }}.
			 {{Lang::get('reminders.reset--expire')}}
{{Config::get('auth.reminder.expire', 60)}} {{Lang::choice('global.minutes', Config::get('auth.reminder.expire', 60))}}.