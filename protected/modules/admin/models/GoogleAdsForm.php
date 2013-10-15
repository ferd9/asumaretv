<?php

/**
 * GoogleAdsForm class.
 */
class GoogleAdsForm extends CFormModel {

    public $GAD_728x90;
    public $GAD_336x280;
    public $GAD_728x15;

    /**
     * Declares the validation rules.
     */
    public function rules() {
        return array(
            array('GAD_728x90, GAD_336x280, GAD_728x15', 'safe'),
        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels() {
        return array(
            'GAD_728x90' => '728 x 90 - Leaderboard Text Ad',
            'GAD_336x280' => '336 x 280 - Large Rectangle Text Ad',
            'GAD_728x15' => '728 x 15 - Horizontal Large Link Ad',
        );
    }

    public function init() {
        parent::init();

        $this->GAD_728x90 = SiteVariable::model()->findByPk('GAD_728x90')->value;
        $this->GAD_336x280 = SiteVariable::model()->findByPk('GAD_336x280')->value;
        $this->GAD_728x15 = SiteVariable::model()->findByPk('GAD_728x15')->value;
    }

    public function save() {


            
            $ad1 = SiteVariable::model()->findByPk('GAD_728x90');
            $ad2 = SiteVariable::model()->findByPk('GAD_336x280');
            $ad3 = SiteVariable::model()->findByPk('GAD_728x15');

            $ad1->value = $this->GAD_728x90;
            $ad2->value = $this->GAD_336x280;
            $ad3->value = $this->GAD_728x15;
            
//            print_r($this);exit;

            $ad1->save(false);
            $ad2->save(false);
            $ad3->save(false);
    }

}
