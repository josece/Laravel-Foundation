<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {
	
	public function getRoles(){
		$roles = array(
			0 => 'guest',
			1 => 'basic',
			2 => 'medium',
			3 => 'admin'
		);
		return $roles;
	}

	public static $rules = array(
			'firstname'=>'required|alpha|min:2',
			'lastname'=>'alpha|min:2',
			'email'=>'required|email|unique:users',
			'username'=>'required|alpha_dash|unique:users',
			'password'=>'required|alpha_num|between:6,12|confirmed',
			'password_confirmation'=>'required|alpha_num|between:6,12'
		);
	
	public static $validemail = array('email'=>'required|email|exists:users');

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}


	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}

	public function profiles()
	{
		return $this->hasMany('Profile');
	}
	public function getRememberToken()
	{
	    return $this->remember_token;
	}

	public function setRememberToken($value)
	{
	    $this->remember_token = $value;
	}

	public function getRememberTokenName()
	{
	    return 'remember_token';
	}
	public function hasRole($rolename){
		/*
		$currentrole = $this->role_id; // returns a number 0, 1, 2, 3
		$key = array_search($rolename, $this->getRoles()); //returns the key of the role
		return $currentrole == $key;
		Aqui abajo ya va resumido.
		*/
		return $this->role_id == array_search($rolename, $this->getRoles());
	}

	public function getRole(){
		$roles = $this->getRoles();
		$role_id = $this->role_id;
		return $roles[$role_id];
	}
	public function isConfirmed(){
		return $this->confirmed;
	}
	

}