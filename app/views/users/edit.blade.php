@section('scripts')
    {{ HTML::script('assets/js/foundation/foundation.abide.js') }}
@stop<div class="row">
    {{ Form::open(array('url'=>'user/edit/', 'class'=>'form-signin','data-abide'=>'', 'files' => true)) }}
    <div class="large-12 medium-12 small-12 columns loginbox">
        <h3>{{Lang::get('global.editinfo')}}</h3>
        <div class="errors-field">
            @foreach($errors->all() as $error)
                <div data-alert class="alert-box alert">{{ $error }}<a href="#" class="close">&times;</a></div>
            @endforeach
        </div>
        <hr />
        <div class="large-5 medium-6 columns ">
            {{Lang::get('global.profilepic') }}
            <div class="small-6 large-12 columns small-centered margin--top">
                <?php $profilepic = !empty($user->photo) ? $user->photo: Config::get('configuration.picture--default'); ?>
                {{HTML::image($profilepic, Lang::get('global.profilepic'), array('class' => 'left '))}}
            </div>
            <div class="small-6 large-12 columns margin--top">
                {{ Form::file('image')}}
            </div>
            <div class="small-12 columns margin--top">
               {{ Form::submit(Lang::get('form.change--picture'), array('class' => 'button small')) }}
               <br />
               <hr class="hide-for-medium-up"/>
               <br />
           </div>
        </div>
        <div class="large-7 medium-6 columns ">
             <div class="username-field">
                {{ Form::label('username', Lang::get('form.username').':') }}
                {{ Form::text('username', $user->username , array('required' =>'required', 'placeholder'=> Lang::get('form.username'), 'pattern'=> '[a-zA-Z0-9-_]+')) }}
                <small class="error">{{Lang::get('form.error--username')}}</small>
            </div>
            <div class="email-field">
                {{ Form::label('email', Lang::get('form.email').':') }}
                {{ Form::email('email', $user->email , array('required' =>'required', 'placeholder'=> Lang::get('form.emailaddress'))) }}
                <small class="error">{{Lang::get('form.error--email')}}</small>
            </div>
            <div class="firstname-field">
                {{ Form::label('firstname',  Lang::get('form.firstname').':') }}
                {{ Form::text('firstname', $user->firstname, array('required' =>'required',  'placeholder'=> Lang::get('form.firstname'))) }}
                <small class="error">{{Lang::get('form.error--firstname')}}</small>
            </div>
            <div class="lastname-field">
                {{ Form::label('lastname',  Lang::get('form.lastname').':') }}
                {{ Form::text('lastname', $user->lastname , array( 'placeholder'=>Lang::get('form.lastname'))) }}
            </div>
            <div class="submit-field">
                {{ Form::submit(Lang::get('form.change--save'), array('class' => 'button small')) }}
            </div>
            <hr />
            {{Lang::get('form.change--yourpassword')}}:<br /><br />
            <div class="password-field">
                {{ Form::password('password', array('id'=>'password',  'placeholder'=>Lang::get('form.password--new'), 'pattern' => '(?=.*\d)(?=.*[a-zA-Z]).{4,8}$')) }}
                <small class="error">{{Lang::get('form.error--password')}}</small>
            </div>
            <div class="password_confirmation-field">
                {{ Form::password('password_confirmation', array('class'=>'', 'placeholder'=>Lang::get('form.password--repeat'), 'data-equalto' => 'password')) }}
                <small class="error">{{Lang::get('form.error--passwordmatch')}}</small>
            </div>
                {{ Form::submit(Lang::get('form.change--password'), array('class' => 'button small')) }}
        </div>
    </div>
    {{ Form::close() }}
</div>