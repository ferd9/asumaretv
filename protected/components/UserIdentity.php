<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
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
                
                $user = Usuario::model()->find("username = '".$this->username."'");
                $ph = new PasswordHash(8, TRUE);                
                if(is_null($user))
                {
                   $this->errorCode=self::ERROR_USERNAME_INVALID; 
                   $this->id = $user->username;
                   
                }			
		elseif(!$ph->CheckPassword($this->password, $user->passwd))
                {
                  $this->errorCode=self::ERROR_PASSWORD_INVALID;  
                }			
		else
                {
                   $this->errorCode=self::ERROR_NONE;   
                   $this->setState("pk", $user->idusuario);
                }
			
		return !$this->errorCode;
	}
}