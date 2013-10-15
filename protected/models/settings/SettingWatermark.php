<?php

class SettingWatermark extends Settings {

    public $watermark_enable;
    public $watermark_text;
    public $watermark_size;
    public $watermark_color;

    public function rules() {
        return array(
            array('watermark_enable,watermark_size,watermark_text,watermark_color', 'safe'),
            array('watermark_size', 'numerical', 'min' => 7, 'max' => 30),
            array('watermark_color', 'check_color'),
        );
    }
    
    public function check_color() {
        if(preg_match('/^#[0-9a-zA-Z]{6}$/', $this->watermark_color)) {
            return true;
        }
        $this->addError('watermark_color', 'color is invalid');
    }

    public function attributeLabels() {
        return array(
            'watermark_enable' => 'Enable?',
            'watermark_text' => 'Watermark Text',
            'watermark_size' => 'Text Size',
            'watermark_color' => 'Text Color',
        );
    }

}