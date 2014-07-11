@section('scripts')
    {{ HTML::script('assets/js/foundation/foundation.abide.js') }}
@stop<div class="row">
	<div class="large-5 columns loginbox medium-6 small-centered">
		{{ Form::open(array('url'=>'user/signin', 'class'=>'form-signin','data-abide'=>'')) }}
		<h3 class="form-signin-heading">{{Lang::get('form.login')}}</h3>
	<div class="email-field">
		{{ Form::text('email', null, array('class'=>'', 'placeholder'=>Lang::get('form.email_or_username'), 'required' =>'required')) }}
		<small class="error">{{Lang::get('form.error--email_or_username')}}</small>
	</div>
	<div class="password-field">
		{{ Form::password('password', array('class'=>'', 'placeholder'=>'Password', 'required' =>'required', 'id'=>'password', 'pattern' => '(?=.*\d)(?=.*[a-zA-Z]).{4,8}$')) }}
		<small class="error">{{Lang::get('form.error--password')}}</small>
	</div>
	<div class="persistent-field">
		{{ Form::label('persistent', Lang::get('form.password--persistent'), array('class' => 'element--inline')) }}
		<span class="left">{{ Form::checkbox('persistent', 1 ) }}&nbsp;</span>
		
	</div>
	
	<div class="submit-field">
		{{ Form::submit(Lang::get('form.login'), array('class'=>'button radius expand'))}}
	</div>
	<br />
		{{ Form::close() }}
			
		{{ HTML::link('user/register', Lang::get('form.account--new'))}}<br /><br />
		{{ HTML::link('password/remind',  Lang::get('reminders.title--forgot')) }}<br /><br />
		<div class="line__separator line--small object--centered"><span></span></div>
		<a href="{{ url('user/facebookauth')}}" title="{{Lang::get('form.login--facebook')}}" class="block--centered">
			<img src="{{asset('assets/img/user/facebook-login-button.png')}}" alt="{{Lang::get('form.login--facebook')}}" class="
			facebook__button--small"/>
		</a>
	</div>
</div>