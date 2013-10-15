<?php

class AdminModule extends CWebModule {

    public function init() {
        // this method is called when the module is being created
        // you may place code here to customize the module or the application
        // import the module-level models and components
        $this->setImport(array(
            'admin.models.*',
            'admin.components.*',
        ));

        // set theme
        $theme_name = 'admin';
        Yii::app()->themeManager->setBaseUrl(Yii::app()->request->baseUrl . '/' . 'module-assets/');
        $theme_path = 'application.modules.admin.themes';
        Yii::app()->themeManager->basePath = Yii::getPathOfAlias($theme_path);
        Yii::app()->theme = $theme_name;


        // set view path
        $vPath = Yii::getPathOfAlias($theme_path . '.' . $theme_name . '.views');
        $this->setViewPath($vPath);

        Yii::app()->errorHandler->errorAction = 'admin/account/error';
    }

    public function beforeControllerAction($controller, $action) {
        
        if (parent::beforeControllerAction($controller, $action)) {
            if (
                    // establecer stado is_admin a user
                    !($controller->id == 'account' && ($action->id == 'login' || $action->id == 'logout'))
                    && Yii::app()->user->getState('is_admin') == false
            ) {
                Yii::app()->request->redirect(Yii::app()->createUrl('admin/login'));
            }
            return true;
        }
        else
            return false;
    }

}
