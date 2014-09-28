<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * 
	 * @var idSystemUser
	 * Holds the id of the logged in User as it is in the Database
	 */
	private $idUser;
	/**
	 * Returns the id of the user as saved in the Database
	 * @see CUserIdentity::getId()
	 */
	public function getId() {
		return $this->idUser;
	}
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		//Get an instance of the users model
		$user = Users::model()->findByAttributes(array('username'=>$this->username));
		if($user === NULL){
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		}
		elseif ($user->password !== $this->password){
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		}
		else{
			//Authentication successful
			$this->errorCode=self::ERROR_NONE;
			//Set the idUser to the user id as it is in the database  
			$this->idUser=$user->id;
		}
		return !$this->errorCode;
	}
}