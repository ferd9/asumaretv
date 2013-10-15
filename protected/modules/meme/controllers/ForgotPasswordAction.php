<?php

class ForgotPasswordAction extends CAction {

    public function run() {

        $token = Yii::app()->request->getQuery('token');
        $email = Yii::app()->request->getQuery('email');


        if($email && $token) {
            $user = User::model()->findByAttributes(array('email' => $email, 'token' => $token));
            if($user) {
                $model = new ChangePasswordForm('forgot');
                if(isset($_POST['ChangePasswordForm'])) {
                    $model->attributes = $_POST['ChangePasswordForm'];
                    if($model->validate('forgot')) {
                        $user->password = md5($model->password);
                        $user->token = md5(uniqid());
                        $user->save(false);
                        Utility::setFlash(Yii::t('yii', 'Success! Please login with your new password.'), 'success');
                    Yii::app()->request->redirect('/site/login');
                    }
                    else {
                        Utility::setFlash(Yii::t('yii', 'Please correct the following errors.'));
                    }
                }
                
                $this->getController()->render('change_password', array('formModel' => $model, 'mode' => 'forgot'));
            }
        } else {
            $model = new ForgotPasswordForm();

            if (isset($_POST['ForgotPasswordForm'])) {
                $model->attributes = $_POST['ForgotPasswordForm'];
                if ($model->validate()) {
                    $user = User::model()->findByEmail($model->email);
                    $user->token = md5($model->email . uniqid());
                    $user->save(false);

                    $message = new MyYiiMailMessage();
                    $message->view = 'forgot_password';

                    //userModel is passed to the view
                    $message->setBody(array(
                        'model' => $user,
                        'forgot_url' => $this->getController()->createAbsoluteUrl('site/forgot_password', array('token' => $user->token, 'email' => $user->email))
                            ), 'text/html');


                    $message->addTo($user->email);
                    $message->setFrom(array(Yii::app()->params['adminEmail'] => Yii::app()->name));
                    $message->setSubject('Forgot password.');
                    Yii::app()->mail->send($message);

                    Utility::setFlash(Yii::t('yii', 'An e-mail sent to your address.'), 'success');
                }
            }

            $this->getController()->render('forgot_password', array('model' => $model));
        }
    }

}