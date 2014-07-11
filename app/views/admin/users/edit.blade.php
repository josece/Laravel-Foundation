@section('scripts')
    {{ HTML::script('assets/js/foundation/foundation.abide.js') }}
@stop<div class="row">
    <div class="large-5 medium-6 columns small-centered loginbox"><h3>{{Lang::get('global.editinfo')}}</h3>
        {{ Form::open(array('url'=>'admin/usersedit/'.$user->id, 'class'=>'form-signin','data-abide'=>'')) }}

        <ul class="no-bullet">

            <li>
                <div class="email-field">
                {{ Form::label('email', Lang::get('form.email').':') }}
                {{ Form::email('email', $user->email , array('required' =>'required', 'placeholder'=> Lang::get('form.emailaddress'))) }}
                <small class="error">{{Lang::get('form.error--email')}}</small>
                </div>
            </li>
            <div class="firstname-field">
        
        
    </div>
            <li>
                {{ Form::label('firstname',  Lang::get('form.firstname').':') }}
                {{ Form::text('firstname', $user->firstname, array('required' =>'required',  'placeholder'=> Lang::get('form.firstname'))) }}
                <small class="error">{{Lang::get('form.error--firstname')}}</small>
            </li>
            <li>
                {{ Form::label('lastname',  Lang::get('form.lastname').':') }}
                {{ Form::text('lastname', $user->lastname , array( 'placeholder'=>Lang::get('form.lastname'))) }}
            </li>
           
        </ul>
        <hr>
        
    <?php 
    $useraccess = "";
    switch ($user->role_id) {
    case 0: $useraccess = Lang::get('global.permissions--guest'); break;
    case 1: $useraccess = Lang::get('global.permissions--basic'); break;
    case 2: $useraccess = Lang::get('global.permissions--medium'); break;
    case 3: $useraccess = Lang::get('global.permissions--admin'); break;
}?>
        
        
        {{Lang::get('form.change--accesslevel')}}<br /><br />
        <label>This user is currently set to {{$useraccess}}.</label>

        {{Form::select('accesslevel', array('0' => Lang::get('global.permissions--guest'), 
                                        '1' => Lang::get('global.permissions--basic'),
                                        '2' => Lang::get('global.permissions--medium'),
                                        '3' => Lang::get('global.permissions--admin')), $user->role_id);}}
        
         <div>
                {{ Form::submit(Lang::get('form.change--save'), array('class' => 'button')) }}

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
           
                {{ Form::submit(Lang::get('form.change--password'), array('class' => 'button')) }}

           
        {{ Form::close() }}
    </div>
</div>