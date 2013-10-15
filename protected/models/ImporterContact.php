<?php

/**
 * Description of ImporterContact
 *
 * @author Elaprendiz - asumaretv http://www.youtube.com/user/JleoD7
 */
class ImporterContact extends CFormModel{
    public $email;
    public $pass;
    
    public function rules()
	{
		return array(
			// name, email, subject and body are required
			array('pass, email', 'required'),
			// email has to be a valid email address
			array('email', 'email'),
			// verifyCode needs to be entered correctly
			//array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements()),
		);
	}

	/**
	 * Declares customized attribute labels.
	 * If not declared here, an attribute would have a label that is
	 * the same as its name with the first letter in upper case.
	 */
	public function attributeLabels()
	{
		return array(
			'email'=>'Correo',
                        'pass'=>'Contraseña',
		);
	}
}


?>
