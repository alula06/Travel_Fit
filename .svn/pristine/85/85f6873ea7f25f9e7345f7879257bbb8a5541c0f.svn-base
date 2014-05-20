<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';
        
        
        /**
         * Set whether or not to automatically update timestamps
         */
        public $timestamps = FALSE;
        
        /**
         * Black list: which attributes of Model are not mass-assignable
         * 
         * @var array 
         */
        protected $guarded = array('id', 'password', 'roles');

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password','roles');

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
        
        
        /********************************************************/
        /* RELATIONSHIPS */

        public function roles()
        {
            return $this->belongsToMany('Roles','users_roles');
        }
        
        public function userRatings(){
            return $this->hasMany('UsersRatings','users_id');
        }

}