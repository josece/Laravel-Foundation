<?php

class RemindersController extends \BaseController  {
	protected $layout = "layouts.main";
	
	public function __construct(){
		$appname = Lang::get('global.appname');
        view::share('appname', $appname);
    }

	/**
	 * Display the password reminder view.
	 *
	 * @return Response
	 */
	public function getRemind()
	{
		//return View::make('password.remind');
		$this->layout->title = Lang::get('reminders.title--forgot');
	 	$this->layout->scripts = array('assets/js/foundation/foundation.abide.js');
		$this->layout->content = View::make('reminders.forgot');
	}

	/**
	 * Handle a POST request to remind a user of their password.
	 *
	 * @return Response
	 */
	public function postRemind()
	{
		$validation = Validator::make(Input::all(), User::$validemail);
		
		switch ($response = Password::remind(Input::only('email'), function($message){
			$message->subject(Lang::get('reminders.email--subject')); 
		}))
		{
			case Password::INVALID_USER:
				return Redirect::back()->with('alert', Lang::get($response));

			case Password::REMINDER_SENT:
				return Redirect::back()->with('success', Lang::get($response));
		}
	}

	/**
	 * Display the password reset view for the given token.
	 *
	 * @param  string  $token
	 * @return Response
	 */
	public function getReset($token = null)
	{
		if (is_null($token)) App::abort(404);
		$this->layout->title = Lang::get('reminders.title--reset');
	 	$this->layout->scripts = array('assets/js/foundation/foundation.abide.js');
		$this->layout->content = View::make('reminders.reset')->with('token',$token);
		//return View::make('reminders.reset')->with('token', $token);
	}

	/**
	 * Handle a POST request to reset a user's password.
	 *
	 * @return Response
	 */
	public function postReset()
	{
		$credentials = Input::only(
			'email', 'password', 'password_confirmation', 'token'
		);

		$response = Password::reset($credentials, function($user, $password)
		{
			$user->password = Hash::make($password);

			$user->save();
		});

		switch ($response)
		{
			case Password::INVALID_PASSWORD:
			case Password::INVALID_TOKEN:
			case Password::INVALID_USER:
				return Redirect::back()->with('alert', Lang::get($response));

			case Password::PASSWORD_RESET:
				return Redirect::to('/');
		}
	}
}