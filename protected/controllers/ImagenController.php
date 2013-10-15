<?php

class ImagenController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','tag'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','tags','upimagen'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin','ferd9'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
            $this->layout = '//layouts/columnblog';
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Imagen;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Imagen']))
		{
			$model->attributes=$_POST['Imagen'];
                        $model->tipo = "subido";
			if($model->save())
				$this->redirect(array('view','id'=>$model->idImagen));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Imagen']))
		{
			$model->attributes=$_POST['Imagen'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->idImagen));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
            $this->layout = '//layouts/columnimagenes';
		$dataProvider=new CActiveDataProvider('Imagen');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Imagen('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Imagen']))
			$model->attributes=$_GET['Imagen'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Imagen the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Imagen::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Imagen $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='imagen-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
         public function actionTags()
	{
            if(isset($_GET['term']) && ($keyword=trim($_GET['term']))!=='')
            {
                    $tags=  Etiquetas::model()->suggestTags($keyword);
                    //if($tags!==array())
                            echo CJSON::encode($tags);
              
            }
	}
        
        public function actionUpimagen()
        {
            //print_r($_FILES);
            $upload_handler = new AsuUploadHandler(array(
                    'max_file_size' => 2000000,
                    //'min_file_size' => 1,
                    // The maximum number of files for the upload directory:
                    //'max_number_of_files' => 1,
                    'accept_file_types' => '/\.(gif|jpe?g|png)$/i',
                    'upload_dir' => Yii::getPathOfAlias('webroot')."/images/up/imagenes/",
                    'upload_url' => "/images/up/imagenes/",
                    ));
            
        }
        
        public function actionTag($search)
        {
            if(is_string($search))
            {
                $pr = new CHtmlPurifier(); 
                $text = $pr->purify($search);
                $dataProvider=new CActiveDataProvider('Imagen',array('criteria'=>Imagen::model()->getByTags($text)));
                 $this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
            }
            
            
        }
}
