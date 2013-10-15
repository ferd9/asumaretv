<?php

class AccountController extends AdminController {

    public function init() {
        $this->actions['change_password'] = 'application.controllers.ChangePasswordAction';
        
        parent::init();
    }


    public function actionIndex() {
        $recent_5_users = Usuario::model()->findAll(array(
            'condition' => 'idusuario <> 1',
            'order' => 'idusuario desc',
            'limit' => 5,
        ));
        
        $unpublished = Meme::model()->countByAttributes(array('is_published' => 0));
        $unapproved = Meme::model()->countByAttributes(array('is_active' => 0));
        $total_memes = Meme::model()->count();
        
        $inactive_users = Usuario::model()->countByAttributes(array('activo' => 0));
        $total_users = Usuario::model()->count();

        $this->render('index', array(
            'recent_5_users' => $recent_5_users,
            'total_memes' => $total_memes,
            'unapproved_memes' => $unapproved,
            'unpublished_memes' => $unpublished,
            'total_users' => $total_users,
            'inactive_users' => $inactive_users,
        ));
    }
    
    public function registerFlot() {
         Yii::app()->clientScript
                ->registerCssFile(Yii::app()->theme->baseUrl . '/flot/jquery.flot.js')
                ->registerCssFile(Yii::app()->theme->baseUrl . '/flot/jquery.flot.pie.js')
                ->registerCssFile(Yii::app()->theme->baseUrl . '/flot/jquery.flot.selection.js')
                ->registerCssFile(Yii::app()->theme->baseUrl . '/flot/jquery.flot.resize.js');
    }

    /**
     * Displays the login page
     */
    public function actionLogin() {
        $model = new AdminLoginForm;

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'admin-login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['AdminLoginForm'])) {
            $model->attributes = $_POST['AdminLoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login()) {
                Yii::app()->plugin->onUserLogin(new CEvent($model));
                $this->redirect($this->createUrl('index'));
            }
        }
        // display the login form
        $this->render('login', array('model' => $model));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout() {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        $view = Yii::app()->errorHandler->error['code'] == 404 ? 'error404' : 'error';
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest) {
                echo $error['message'];
            } else {
                $this->render($view, $error);
            }
        }
    }

}