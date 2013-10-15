<?php

class GenerateController extends Controller {

    public function actionIndex() {
        $model = new MemeForm();
        $remixMeme = null;
        $remixMemeId = Yii::app()->request->getParam('meme', 0);
        if($remixMemeId) {
            $remixMeme = Meme::model()->findByPk($remixMemeId);
        }
        if($remixMeme && !is_file($remixMeme->absolute_path)) {
            $remixMeme = null;
        }
        
        $memeData = array();
        
        if(isset($_POST['MemeForm'])) {
            $memeData = $_POST['MemeForm'];
            $model->attributes = $_POST['MemeForm'];
        }
        
        if((isset($_POST['MemeForm']) && $model->validate()) || ($memeData = Meme::popMemeFromSession())) {
            if(!Yii::app()->user->isGuest) {
                // save the image
                $name = uniqid();
                
                
                $meme = new Meme();
                $meme->attributes = $memeData;
                $meme->file = "$name.png";
                $meme->user_fk = Yii::app()->user->getState('pk');
                $meme->is_published = isset($_POST['MemeForm']['publish']) ? $_POST['MemeForm']['publish'] : 0;
                $meme->remix_id = $remixMemeId;

                $file = $meme->absolute_path;
                $file2 = $meme->absolute_path_orignal;
                $file_thumb = $meme->absolute_path_thumb;
                
                if($meme->validate()) {
                    $data = str_replace('data:image/png;base64,', '', $memeData['image']);
                    $data = base64_decode($data);
                    $e = new CEvent($this);
                    $im = imagecreatefromstring($data);
                    $e->params['meme_image'] = $im;
                    Yii::app()->plugin->onMemeImage($e);
                    imagepng($e->params['meme_image'], $file);
                    imagepng($e->params['meme_image'], $file2);
                    
                    $meme->generateThumb();
                    $meme->putWatermark();
                    
                    
                    $meme->save();
                    Utility::setFlash(Yii::t('yii', 'Your meme will be avialable once approved!'), 'success');
                    Yii::app()->request->redirect(Yii::app()->createUrl("/meme/default/index"));
                }
            }
            else {
                Yii::app()->user->setReturnUrl(array('generate/index'));
                Meme::saveMemeInSession($_POST['MemeForm']);
                $this->redirect('site/login');
            }
        }
        
        $this->render('index', array(
            'remixMeme' => $remixMeme,
            'model' => $model,
        ));
    }
    

    public function actionUpload_bg() {
        $upload_handler = new AsuUploadHandler(array(
            'file_name' => uniqid(),
            'upload_dir' => Yii::getPathOfAlias('webroot.' . Yii::app()->params['upload_dir']) . DIRECTORY_SEPARATOR,
            'upload_url' => Yii::app()->request->baseUrl."/".Yii::app()->params['upload_dir']. '/',
            'image_versions' => array(
                '' => array(
                    'max_width' => 450,
                    'max_height' => 450,
                    'jpeg_quality' => 100
                ),
                'medium' => array(
                    'max_width' => 150,
                    'max_height' => 150,
                    'jpeg_quality' => 100
                ),
                'thumbnail' => array(
                    // Uncomment the following to force the max
                    // dimensions and e.g. create square thumbnails:
                    //'crop' => true,
                    'max_width' => 80,
                    'max_height' => 80
                )
            ),
        ));
    }

}