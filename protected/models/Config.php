<?php

class Config extends CFormModel {
    const FILE = 'custom.php';
    protected $_customConfigPath = '';


    // set in every child config
//    protected $_config = array();
    
    public function init() {
        $this->_customConfigPath = Yii::getPathOfAlias('application.config') . DIRECTORY_SEPARATOR . self::FILE;
        
        $custom_config = json_decode(file_get_contents($this->_customConfigPath), true);
        $custom_config = $custom_config ? $custom_config : array();
        
        $this->_config = CMap::mergeArray(
                $this->_config,
                $custom_config
        );
        
        
        foreach (array_keys($this->getAttributes()) as $attribute) {
            $method = 'getConfig' . ucfirst($attribute);
            if(method_exists($this, $method)) {
                $this->$attribute = $this->$method();
            }
        }
           
        parent::init();
    }
    
    public function save() {
        if($this->validate()) {
            foreach (array_keys($this->getAttributes()) as $attribute) {
                $method = 'setConfig' . ucfirst($attribute);
                if(method_exists($this, $method)) {
                    $this->$method($this->$attribute);
                }
            }
//            print_r($this->allowedProviders);
            $config = json_encode($this->_config);
            file_put_contents($this->_customConfigPath, $config);
            return true;
        }
        
        return false;
    }
}