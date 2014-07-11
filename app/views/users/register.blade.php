@section('scripts')
    {{ HTML::script('assets/js/foundation/foundation.abide.js') }}
@stop<div class="row">
	<div class="large-5 columns loginbox medium-6 small-centered">
		{{ Form::open(array('url'=>'user/create', 'class'=>'form-signup' ,'data-abide'=>'') ) }}
		<h3 class="form-signup-heading">{{Lang::get('form.signup')}}</h3>
		<div class="errors-field">
			@foreach($errors->all() as $error)
				<div data-alert class="alert-box alert">{{ $error }}<a href="#" class="close">&times;</a></div>
			@endforeach
		</div>
		<div class="username-field">
			{{ Form::text('username', null , array('required' =>'required', 'placeholder'=> Lang::get('form.username') .'*', 'pattern'=> '[a-zA-Z0-9-_]+')) }}
			<small class="error">{{Lang::get('form.error--username')}}</small>
		</div>
		<div class="firstname-field">
			{{ Form::text('firstname', null, array('class'=>'', 'placeholder'=>Lang::get('form.firstname').'*', 'required' =>'required')) }}
			<small class="error">{{Lang::get('form.error--firstname')}}</small>
		</div>
		<div class="lastname-field">
			{{ Form::text('lastname', null, array('class'=>'', 'placeholder'=>Lang::get('form.lastname'))) }}
		</div>
		<div class="email-field">
			{{ Form::email('email', null, array('class'=>'', 'placeholder'=>Lang::get('form.emailaddress').'*', 'required' =>'required')) }}
			<small class="error">{{Lang::get('form.error--email')}}</small>
		</div>
		<div class="password-field">
			{{ Form::password('password', array('class'=>'', 'placeholder'=>Lang::get('form.password').'*', 'required' =>'required', 'id'=>'password', 'pattern' => '(?=.*\d)(?=.*[a-zA-Z]).{4,8}$')) }}
			<small class="error">{{Lang::get('form.error--password')}}</small>
		</div>
		<div class="password_confirmation-field">
			{{ Form::password('password_confirmation', array('class'=>'', 'placeholder'=>Lang::get('form.password--repeat').'*', 'required' =>'required', 'data-equalto' => 'password')) }}
			<small class="error">{{Lang::get('form.error--passwordmatch')}}</small>
		</div>
		<small class="right">{{Lang::get('form.requiredfields')}}</small><br />
		<div class="submit-field">
			{{ Form::submit(Lang::get('form.signup'), array('class'=>'button radius expand'))}}
		</div><br />
		{{ Form::close() }}
		{{Lang::get('form.account--already')}} {{ HTML::link('user/login', Lang::get('form.login')) }}.<br /><br />
		<div class="line__separator line--small object--centered"></div>
		<a href="{{ url('user/facebookauth')}}" title="{{Lang::get('form.login--facebook')}}" class="block--centered">
			<img src="{{asset('assets/img/user/facebook-login-button.png')}}" alt="{{Lang::get('form.login--facebook')}}" class="
			facebook__button--small"/>
		</a>
	</div>
</div>