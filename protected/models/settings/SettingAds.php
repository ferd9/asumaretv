<?php

class SettingAds extends Settings {

    public $ad1;
    public $ad2;
    public $ad3;

    public function rules() {
        return array(
            array('ad1,ad2,ad3', 'safe')
        );
    }

    public function attributeLabels() {
        return array(
            'ad1' => 'Advertisement 1',
            'ad2' => 'Advertisement 2',
            'ad3' => 'Advertisement 3',
        );
    }

}