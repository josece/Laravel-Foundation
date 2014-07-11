<div class="row">
	<div class="large-5 columns loginbox medium-6 small-centered">
		{{ Form::open(array('url'=>'password/remind', 'class'=>'form-signin','data-abide'=>'')) }}
		<h3 class="form-signin-heading">{{Lang::get('reminders.title--forgot');}}</h3>
		<p>{{Lang::get('reminders.info--link');}}</p>
<div class="email-field">
		{{ Form::email('email', null, array('class'=>'', 'placeholder'=>Lang::get('form.emailaddress'), 'required' =>'required')) }}
		<small class="error">{{Lang::get('form.error--email')}}</small>
	</div>
		{{ Form::submit(Lang::get('reminders.send--link'), array('class'=>'button radius expand'))}}
		{{ Form::close() }}
		<div class="margin--top">
			{{Lang::get('reminders.remembered');}} {{ HTML::link('user/login', Lang::get('form.login')) }}.
		</div>
	</div>
</div>