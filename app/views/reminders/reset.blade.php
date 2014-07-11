<div class="row">
	<div class="large-5 columns loginbox medium-6 small-centered">
	 {{ Form::open(array('url'=>'password/reset', 'class'=>'form-signin','data-abide'=>'')) }}
	 <h3>{{Lang::get('reminders.reset--title')}}</h3><br />
	 {{Lang::get('form.email')}}:<br /><br />
	 <div class="email-field">
		{{ Form::email('email', null, array('class'=>'', 'placeholder'=>Lang::get('form.emailaddress'), 'required' =>'required')) }}
		<small class="error">{{Lang::get('form.error--email')}}</small>
	</div>
	{{Lang::get('form.password--new')}}<br /><br />
            <div class="password-field">
                {{ Form::password('password', array('id'=>'password',  'placeholder'=>Lang::get('form.password--new'), 'pattern' => '(?=.*\d)(?=.*[a-zA-Z]).{4,8}$')) }}
                <small class="error">{{Lang::get('form.error--password')}}</small>
            </div>
            <div class="password_confirmation-field">
                {{ Form::password('password_confirmation', array('class'=>'', 'placeholder'=>Lang::get('form.password--repeat'), 'required' =>'required', 'data-equalto' => 'password')) }}
                <small class="error">{{Lang::get('form.error--passwordmatch')}}</small>
            </div>
              {{ Form::hidden('token', $token) }}
	{{ Form::submit(Lang::get('reminders.reset--title'), array('class'=>'button object--centered radius expand'))}}
	{{ Form::close() }}
</div>