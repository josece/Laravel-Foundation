{{Lang::get('confirmation.email--hello')}} {{$firstname}}, 
{{Lang::get('confirmation.email--text')}} 
{{ URL::to('user/verify', array($confirmation_code)) }}
