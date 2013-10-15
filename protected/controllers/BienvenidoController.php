<?php
class BienvenidoController extends Controller{
    public $layout='//layouts/bienvenido';
    public function beforeAction($action) {        
        if(Yii::app()->user->isGuest)
        {
            throw new CHttpException("404","La pagina solicitada no existe");
        }
        return parent::beforeAction($action);
    }
    
    public function actionIndex()
    {
        $this->render("index");
    }
    
    public function actionAvatar()
    {
         $model = Usuario::model()->findByPk(Yii::app()->user->getState("pk"));
         if(isset($_POST['Usuario']))
        {
            $model->attributes = $_POST['Usuario'];
            if($model->validate())
            {
                if($model->save())
                {
                    $this->redirect($this->createUrl("perfil/view",array('id'=>Yii::app()->user->getState("pk"))));
                }
            }            
        }
        $this->render("foto",array('model'=>$model));
    }
    
    public function actionInfo()
    {
        $model = Perfil::model()->find('idusuario='.Yii::app()->user->getState("pk"));
        if(isset($_POST['Perfil']))
        {
            $model->attributes = $_POST['Perfil'];
            if($model->validate())
            {
                if($model->save())
                {
                    $this->redirect($this->createUrl("bienvenido/avatar"));
                }
            }            
        }
        $this->render("iperfil",array('model'=>$model));
    }
    
    public function actionUpavatar()
    {
        $upload_handler = new UploadHandler(array(
                    'accept_file_types' => '/\.(gif|jpe?g|png)$/i',
                    'upload_dir' => Yii::getPathOfAlias('webroot')."/images/user/avatar/",
                    'upload_url' => "/images/user/avatar/",
                    ));
    }
   
    
    
    
	
}