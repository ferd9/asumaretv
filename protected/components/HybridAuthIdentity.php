<?php

class HybridAuthIdentity extends CUserIdentity {

    const VERSION = '2.1.2';

    /**
     * 
     * @var Hybrid_Auth
     */
    public $hybridAuth;

    /**
     * 
     * @var Hybrid_Provider_Adapter
     */
    public $adapter;

    /**
     * 
     * @var Provider
     */
    public $provider;

    /**
     * 
     * @var Hybrid_User_Profile
     */
    public $userProfile;
    public $allowedProviders;
    protected $config;

    function __construct() {
        $this->allowedProviders = Yii::app()->params['hauth']['allowedProviders'];
        $path = Yii::getPathOfAlias('ext.HybridAuth');
        require_once $path . '/hybridauth-' . self::VERSION . '/hybridauth/Hybrid/Auth.php';  //path to the Auth php file within HybridAuth folder

        $this->config = Yii::app()->params['hauth']['config'];

        $this->hybridAuth = new Hybrid_Auth($this->config);
    }

    /**
     *
     * @param string $provider
     * @return bool 
     */
    public function validateProviderName($provider) {
        if (!is_string($provider))
            return false;
        if (!in_array($provider, $this->allowedProviders))
            return false;

        return true;
    }

    public function login() {
        $this->username = $this->userProfile->email ? $this->userProfile->email : $this->userProfile->displayName;  //CUserIdentity
        Yii::app()->user->login($this, 0);
        Yii::app()->user->profile = $this->userProfile;
        SocialLogin::model()->saveLogin($this);
        
        User::loadLikesToSession();
    }

    public function authenticate() {
        return true;
    }

}