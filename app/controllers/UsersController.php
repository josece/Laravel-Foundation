<?php
/*
 * @author Jose Calleja Esnal
 * 
 * sesiones de facebook basado en:
 * https://github.com/msurguy/laravel-facebook-login
 *

getIndex
getRegister
getVerify($code)
getLogin
getFacebookauth
getFacebookcallback
getEdit
getHome
getLogout

postEdit
postSignin
postCreate

getEditadmin
destroy

 */

class UsersController extends \BaseController {
	 

	protected $layout = "layouts.main";
	
	/**
	 * Builds object user
	 *
	 */

  	public function __construct(){
        $this->beforeFilter('auth', 
        	array('except' =>  
        		array('getLogin' ,
        			'getRegister',
        			'postSignin',
        			'postCreate',
					'getFacebookauth',
					'getFacebookcallback',
					'getVerify'
        		)
        	)
        );
        /*$appname =  Lang::get('global.appname');
        
        view::share('appname', $appname);*/
    }


    public function getIndex() {
    	return Redirect::to('user/home');
    }
	
	 public function getRegister() {
	 	//si tienen ya una sesion iniciada, no se puede ver el formulario de login
	 	 if (Auth::check()) {
	 	 	return Redirect::to('user/home');
	 	 }
	 	 $this->layout->title =  Lang::get('form.signup');
		 $this->layout->content = View::make('users.register');
	 }
	 
	
	
	
	/**
	 * Gets Facebook object
	 *
	 * @param  
	 * @return redirect
	 */
	public function getFacebookauth()
	{
	    $facebook = new Facebook(Config::get('facebook'));
	    $params = array('redirect_uri' => url('/user/facebookcallback'),'scope' => 'email',);
	    return Redirect::away($facebook->getLoginUrl($params));
	}
	
	public function getEditadmin($id = null){
		if(empty($id)){
			$user = Auth::user();
			$id = $user->id;
		}
		$id = Auth::user()->id;
		$user = User::find($id);
		$this->layout->title =  Lang::get('global.editinfo');
		$this->layout->content = View::make('admin.users.edit')->withUser($user);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getEdit() {
		$id = Auth::user()->id;
		$user = User::find($id);
		$this->layout->title =  Lang::get('global.editinfo');
		$this->layout->content = View::make('users.edit')->withUser($user);
	}


	/**
	 * Update the specified resource in storage.
	 * if the call comes with an ajax state a json object is retun, instead of a redirection.
	 * @param  int  $id
	 * @return Response
	 */
	public function postEdit() {
		//$id = is_null($id) ? Auth::user()->id :$id;
		$id = Auth::user()->id;
		$input = Input::all();
		
		$validation = Validator::make($input, array(
			'email' => 'required|unique:users,email,' . $id,
			'username' => 'required|alpha_dash|unique:users,username,' . $id)
		);
		if ($validation->passes()) {
			$user = User::find($id);
			$user->email = Input::get('email');
			$user->username = Input::get('username');
			$user->firstname = Input::get('firstname');
			$user->lastname = Input::get('lastname');

			if (Input::hasFile('image')){
				$validation = Validator::make($input, array('image' => 'image'));
				if($validation->passes()) {
					$file = Input::file('image');
					$path = Config::get('configuration.picture--folder') . $id.'/';
					//create folder if it doesn't exist yet
					if (!File::isDirectory($path)) 
						$result = File::makeDirectory($path, 0700, true);
					//new name for the uploaded image
					$filename = str_random(20) .'.' . $file->getClientOriginalExtension();
					//save image to permanent location
					$file->move($path,$filename);
					$finalpath = Config::get('configuration.picture--url') . '/'. $id . '/' . $filename;
					$user->photo = $finalpath;
				}else{
					return  Redirect::to('user/edit/')->withInput()->withErrors($validation);//->with('alert', Lang::get('form.error--image'));
				}
			}
			if(Input::get('password')!= '' )
				$user->password = Hash::make(Input::get('password'));
			$user->save();

			$response = array('success' => Lang::get('form.success--update'));
			if(Input::get('kind')!='ajax')
				return Redirect::to('user/edit/')->with('success', Lang::get('form.success--update'));
		}else{
			
			$response = array('alert' =>  $validation->messages());
		}
		
		if(Input::get('kind')!='ajax')
			return Redirect::to('user/edit/')->withInput()->withErrors($validation);//->withErrors($validation)->with('alert', Lang::get('form.error--validation'));
		return $response;
	}

	/**
	 * Gets the data from the Create User Form, creates user and stores to database 
	 * @return redirect
	 */
	public function postCreate() {
		$validator = Validator::make(Input::all(), User::$rules);
		if ($validator->passes()) {
			$user = new User;
			$firstname = Input::get('firstname');
			$email = Input::get('email');

			$user->firstname = $firstname;
			$user->email = $email;
			$user->lastname = Input::get('lastname');
			$user->username = Input::get('username');
			$user->password = Hash::make(Input::get('password'));
			/* Create confirmation code */
			$confirmationcode = str_random(40);
			$user->confirmation_code = $confirmationcode;
			/* Send code to user */
			$data = array(
				'firstname' => $firstname,
				'confirmation_code' => $confirmationcode
			);
			Mail::send(array('emails.auth.confirm', 'emails.auth.confirm-plain'), $data, function($message) use ($firstname, $email){
				 $message->to($email, $firstname)->subject(Lang::get('confirmation.email--subject'));
			});

			$user->save();
			return Redirect::to('user/login')->with('success', Lang::get('form.success--signup'));
		} else {
			return Redirect::to('user/register')->with('alert', Lang::get('form.error--something'))->withErrors($validator)->withInput();
		}
	}
	/**
	* Verify email account
	* @param $code confirmation_code
	*/
	public function getVerify($code = null){
		if (is_null($code)) App::abort(404);
		$user = User::where('confirmation_code','=', $code)->first();
		if($user->confirmed) {
			//do nothing
			$message = Lang::get('confirmation.verify--already');
		} else {
			//change confirmed status
			$user->confirmed = 1;
			$user->save();
			//auto login
			Auth::login($user);
			$message = Lang::get('confirmation.verify--confirmed');
		}
		return Redirect::to('user/')->with('message', $message);

	}

	/**
	 * Sets the layout content with the login view. 
	 */
	public function getLogin() {
		//si tienen ya una sesion iniciada, no se puede ver el formulario de login
		if (Auth::check()) {
			return Redirect::to('user/home');
		}
		$this->layout->title = Lang::get('form.login');
		$this->layout->content = View::make('users.login');
	}

	/**
	 * Gets the sign in data and attempts to login. 
	 * @return Redirect
	 */
	public function postSignin() {
		$usernameinput = Input::get('email');
		$password = Input::get('password');
		$persistent = Input::get('persistent');
		$field = filter_var($usernameinput, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
		//load everything in an array, fancy ah?
		$credentials = array(
			$field => $usernameinput,
			'password' => $password
			);
		if(Auth::attempt($credentials)){
			//ya que se validaron las credenciales, reviso si el usuario está confirmado
			if(Auth::user()->isConfirmed()){
				if(Auth::user()->hasRole('admin'))
					return Redirect::to('admin/');
				return Redirect::to('user/');
			}else{
				//destruyo la sesión y mando error manual
				Auth::logout();
				return Redirect::to('user/login')
				->with('alert', Lang::get('form.error--not_confirmed'))
				->withInput();
			}

			
		}else{
			return Redirect::to('user/login')
				->with('alert', Lang::get('form.error--login'))
				->withInput();
		}
	}
	/**
	 * Sets the layout content with the login view. 
	 */
	public function getHome() {
		$this->layout->content = View::make('users.home');
	}
	/**
	 * Logouts user
	 */
	public function getLogout() {
		Auth::logout();
		return Redirect::to('user/login');//->with('message', 'Your are now logged out!');
	}
		

	/*
	 * Facebook Auth Callback
	 */
	public function getFacebookcallback() {
		$code = Input::get('code');
		if (strlen($code) == 0) return Redirect::to('/')->with('message', Lang::get('form.error--facebook'));

		$facebook = new Facebook(Config::get('facebook'));
		$uid = $facebook->getUser();

		if ($uid == 0) return Redirect::to('/')->with('message', Lang::get('form.error--something'));

		$me = $facebook->api('/me');
			/*
			Los valores que recibimos de Facebook son un arreglo $me: 
			array(11) { ["id"],
				 		["email"]
						["first_name"]
						["gender"]
						["last_name"]
						["link"]
						["locale"] "en_US" 
						["name"]
				 		["timezone"]=> int(-5) 
						["updated_time"] 
						["verified"]=> bool(true) 
			}
		 */
			//dd($me); //equivalente a un var_dump
			$profile = Profile::whereUid($uid)->first();
			if (empty($profile)) {

				$user = new User;
				$user->firstname = $me['first_name'];
				$user->lastname = $me['last_name'];
		        //$user->name = $me['first_name'].' '.$me['last_name'];
				$user->email = $me['email'];
				$user->photo = 'https://graph.facebook.com/'.$uid.'/picture?type=large';
				$user->confirmed = 1;
				$user->save();

				$profile = new Profile();
				$profile->uid = $uid;
				$profile->username = $uid;
				$profile = $user->profiles()->save($profile);
			}

			$profile->access_token = $facebook->getAccessToken();
			$profile->save();

			$user = $profile->user;

			Auth::login($user);
			if(Auth::user()->hasRole('admin'))
				return Redirect::to('admin/');
			return Redirect::to('user/');
		}

		/*
		 * Show the form for creating a new resource.
		 *
		 * @return Response
		 *
		public function create()
		{
			//
			 return View::make('users.create');
		}


		/*
		 * Store a newly created resource in storage.
		 *
		 * @return Response
		 *
		public function store()
		{
			//
		    $input = Input::all();
		           $validation = Validator::make($input, User::$rules);

		           if ($validation->passes())
		           {
		               User::create($input);

		               return Redirect::route('users.index');
		           }

		           return Redirect::route('users.create')
		               ->withInput()
		               ->withErrors($validation)
		               ->with('message', Lang::get('form.error--validation'));
		}


		/**
		 * Display the specified resource.
		 *
		 * @param  int  $id
		 * @return Response
		 *
		public function getShow($id)
		{
			//
		
		
		}*/

		/**
		 * Remove the specified resource from storage.
		 *
		 * @param  int  $id
		 * @return Response
		 */
		public function destroy($id)
		{
			//
		    User::find($id)->delete();
		           return Redirect::route('users.index');
		}
}
