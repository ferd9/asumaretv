<?php

/**
 * SettingsForm class.
 */
class SettingsForm extends CFormModel {

    public $DEFAULT_SORT;
    public $DEFAULT_ORDER;
    public $BITLY_LOGIN;
    public $BITLY_API_KEY;
    public $BITLY_USE;

    /**
     * Declares the validation rules.
     */
    public function rules() {
        return array(
            array('DEFAULT_SORT', 'in', 'range' => array('t.rating', 't.created_at')),
            array('DEFAULT_ORDER', 'in', 'range' => array('asc', 'desc')),
            array('BITLY_LOGIN, BITLY_API_KEY', 'validate_bitly', 'on' => 'validate_bitly'),
            array('BITLY_USE', 'safe'),
        );
    }
    
    /**
     * Declares attribute labels.
     */
    public function attributeLabels() {
        return array(
            'DEFAULT_SORT' => 'Sorting By',
            'DEFAULT_ORDER' => 'Order By',
        );
    }

    public function init() {
        parent::init();

        foreach($this->getAttributes() as $prop => $value) {
            if($attr = SiteVariable::model()->findByPk($prop))
                $this->$prop = $attr->value;
        }
    }

    public function save() {
        foreach($this->getAttributes() as $prop => $value) {
            $setting = SiteVariable::model()->findByPk($prop);
            if(!$setting) {
                $setting = new SiteVariable();
                $setting->variable = $prop;
                $setting->title = $this->getAttributeLabel($prop);
            }
            $setting->value = $this->$prop;
//            print_r($this);exit;
            $setting->save(false);
        }
    }

}
