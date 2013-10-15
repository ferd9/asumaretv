<?php

class ConfigSocial extends Config {
    public $allowedProviders;
    public $facebook_id;
    public $facebook_secret;
    public $google_id;
    public $google_secret;
    public $base_url;
    
    public function init() {
        parent::init();
        
        if(!($this->base_url)) {
            $this->base_url = Yii::app()->getBaseUrl(TRUE) . '/site/socialLogin';
        }
    }
    
    protected $_config = array(
        'params' => array(
            'hauth' => array(
                'allowedProviders' => array('facebook' => 'Facebook', ),
                'config' => array(
                    "base_url" => "",
                    "providers" => array(
                        "Google" => array(
                            "enabled" => true,
                            "keys" => array(
                                "id" => "",
                                "secret" => "",
                            ),
                        ),
                        "Facebook" => array(
                            "enabled" => true,
                            "keys" => array(
                                "id" => "",
                                "secret" => "",
                            ),
                        ),
                    ),
                ),
            )
        )
    );
    
    public function rules() {
        return array(
            array('base_url,allowedProviders,facebook_id,facebook_secret,google_id,google_secret', 'required'),
            array('base_url', 'check_base_url'),
        );
    }
    
    public function check_base_url($attribute,$params) {
        if(strpos($this->base_url, Yii::app()->request->hostInfo) === 0) {
            return true;
        }
        $this->addError('base_url', 'Base url is invalid!');
    }

        public function setConfigBase_url($value) {
        $this->_config['params']['hauth']['config']['base_url'] = $value;
    }

    public function setConfigAllowedProviders($value) {
        $this->_config['params']['hauth']['allowedProviders'] = $value;
    }
    
    public function setConfigFacebook_id($value) {
        $this->_config['params']['hauth']['config']['providers']['Facebook']['keys']['id'] = $value;
    }
    
    public function setConfigFacebook_secret($value) {
        $this->_config['params']['hauth']['config']['providers']['Facebook']['keys']['secret'] = $value;
    }
    
    public function setConfigGoogle_id($value) {
        $this->_config['params']['hauth']['config']['providers']['Google']['keys']['id'] = $value;
    }
    
    public function setConfigGoogle_secret($value) {
        $this->_config['params']['hauth']['config']['providers']['Google']['keys']['secret'] = $value;
    }
    
    public function getConfigBase_url() {
        return $this->_config['params']['hauth']['config']['base_url'];
    }

    public function getConfigAllowedProviders() {
        return $this->_config['params']['hauth']['allowedProviders'];
    }
    
    public function getConfigFacebook_id() {
        return $this->_config['params']['hauth']['config']['providers']['Facebook']['keys']['id'];
    }
    
    public function getConfigFacebook_secret() {
        return $this->_config['params']['hauth']['config']['providers']['Facebook']['keys']['secret'];
    }
    
    public function getConfigGoogle_id() {
        return $this->_config['params']['hauth']['config']['providers']['Google']['keys']['id'];
    }
    
    public function getConfigGoogle_secret() {
        return $this->_config['params']['hauth']['config']['providers']['Google']['keys']['secret'];
    }

}