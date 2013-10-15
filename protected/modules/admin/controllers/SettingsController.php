<?php

class SettingsController extends AdminController {

    public function actionSocial() {
        $model = new ConfigSocial();

        if(isset($_POST['ConfigSocial'])) {
            $model->attributes = $_POST['ConfigSocial'];
            if ($model->validate()) {
                $model->save();
                Utility::setFlash('Social settings saved.', 'success');
                $this->refresh();
            }
        }

        $this->render('social', array(
            'model' => $model,
        ));
    }
    
    public function actionAds() {
        $model = new SettingAds();
        
        if(isset($_POST['SettingAds'])) {
            $model->attributes = $_POST['SettingAds'];
            if ($model->validate()) {
                $model->save();
                Utility::setFlash('Ads settings saved.', 'success');
                $this->refresh();
            }
        }
        
        $this->render('ads', array(
            'model' => $model,
        ));
    }
    
    public function actionWatermark() {
        $model = new SettingWatermark();
        if($model->watermark_size <= 0) {
           $model->watermark_size = 18; 
        }
        if($model->watermark_color == '') {
           $model->watermark_color = '#c8dce1';
        }
        
        if(isset($_POST['SettingWatermark'])) {
            $model->attributes = $_POST['SettingWatermark'];
            if ($model->validate()) {
                $model->save();
                Utility::setFlash('Watermark settings saved.', 'success');
                $this->refresh();
            }
        }
        
        $this->render('watermark', array(
            'model' => $model,
        ));
    }

}