<?php

class MemeModule extends CWebModule
{
	public function init()
	{
             Yii::app()->theme='classic';
            
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'meme.models.*',
			'meme.components.*',
		));
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
                  $controller->layout = 'main';
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}
}
