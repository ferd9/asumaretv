<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
    
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	        
        /**
     * @var array context menu items. This property will be assigned to {@link CMenu::items}.
     */
    public $menu = array();

    /**
     * @var array the breadcrumbs of the current page. The value of this property will
     * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
     * for more details on how to specify this property.
     */
    public $breadcrumbs = array();
    public $data = array();
    public $pageKeywords = '';
    public $pageDescription = '';
    public $og_url = '';
    public $og_title = '';
    public $og_description = '';
    public $og_image = '';
    public $extra = '';
    public $plugins = array();
    public $actions = array();
    public $accessRules = array();
    public $isBackend = false;
    
    public function init() {

        $plugins = glob(Yii::getPathOfAlias('ext.plugins') . '/*', GLOB_ONLYDIR);
        if ($plugins) {
            foreach ($plugins as $plugin) {
                $plugin_name = basename($plugin);
                $plugin_class = ucfirst($plugin_name) . 'Plugin';
                if (file_exists($plugin . "/$plugin_class.php")) {
                    Yii::import("ext.plugins.$plugin_name.$plugin_class");
                    $this->plugins[$plugin_name] = new $plugin_class;
                }
            }
        }
        
        parent::init();
    }

    public function accessRules() {
        Yii::app()->plugin->onBeforeAccessRules(new CEvent($this));
        return $this->accessRules;
    }

    public function actions() {
        Yii::app()->plugin->onBeforeActions(new CEvent($this));
        return $this->actions;
    }
}