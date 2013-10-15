<?php

/**
 * @todo 
 *      - admin menu
 *      - filters
 *      - actions
 */
class PluginSystem extends CApplicationComponent {

    public $menu = array();
    
    protected $_blocks = array();
    protected $_block_regions = array();
    protected $_block_keys = array();

    /**
     * 
     * @param CEvent $event
     */
    public function onBeforeActions($event) {
        $this->raiseEvent('onBeforeActions', $event);
    }

    /**
     * 
     * @param CEvent $event
     */
    public function onBeforeAccessRules($event) {
        $this->raiseEvent('onBeforeAccessRules', $event);
    }

    /**
     * 
     * @param CEvent $event
     *   - params:
     *      - bool is_front
     */
    public function onBeforeMenuRender($event) {
        $this->raiseEvent('onBeforeMenuRender', $event);
    }

    /**
     * 
     * @param CEvent $event
     *   - params:
     *     - Image meme_image
     */
    public function onMemeImage($event) {
        $this->raiseEvent('onMemeImage', $event);
    }

    /**
     * 
     * @param CEvent $event
     *   - params:
     *     - string post_url
     */
    public function onMemePostUrl($event) {
        $this->raiseEvent('onMemePostUrl', $event);
    }

    /**
     * 
     * @param CEvent $event
     *   - params:
     *     - string text
     *       text from admin
     */
    public function onMemeWatermark($event) {
        $this->raiseEvent('onMemeWatermark', $event);
    }

    /**
     * 
     * @param CEvent $event
     */
    public function onMemeDelete($event) {
        $this->raiseEvent('onMemeDelete', $event);
    }

    /**
     * 
     * @param CEvent $event
     */
    public function onMemeActivated($event) {
        $this->raiseEvent('onMemeActivated', $event);
    }

    /**
     * 
     * @param CEvent $event
     */
    public function onMemePublished($event) {
        $this->raiseEvent('onMemePublished', $event);
    }

    /**
     * 
     * @param CEvent $event
     */
    public function onMemeFeatured($event) {
        $this->raiseEvent('onMemeFeatured', $event);
    }

    /**
     * 
     * @param CEvent $event
     */
    public function onMemeDownload($event) {
        $this->raiseEvent('onMemeDownload', $event);
    }

    /**
     * 
     * @param CEvent $event
     *   - params
     *     - MemeLike meme_like
     */
    public function onMemeLike($event) {
        $this->raiseEvent('onMemeLike', $event);
    }

    /**
     * 
     * @param CEvent $event
     *   - params
     *     - MemeLike meme_like
     */
    public function onMemeUnLike($event) {
        $this->raiseEvent('onMemeUnLike', $event);
    }

    /**
     * 
     * @param CEvent $event
     */
    public function onUserRegister($event) {
        $this->raiseEvent('onUserRegister', $event);
    }

    /**
     * 
     * @param CEvent $event
     */
    public function onUserDelete($event) {
        $this->raiseEvent('onUserDelete', $event);
    }

    /**
     * 
     * @param CEvent $event
     */
    public function onUserActivated($event) {
        $this->raiseEvent('onUserActivated', $event);
    }

    /**
     * 
     * @param CEvent $event
     */
    public function onUserLogin($event) {
        $this->raiseEvent('onUserLogin', $event);
    }
    
    public function addMenuItem($menu, $item) {
        Yii::app()->plugin->menu[$menu] = isset(Yii::app()->plugin->menu[$menu]) ? Yii::app()->plugin->menu[$menu] : array();
        Yii::app()->plugin->menu[$menu]['items'][] = $item;
    }
    
    public function renderMenu($menu, $options = array()) {
        $e = new CEvent();
        $e->params['menu'] = $menu;
        
        Yii::app()->plugin->menu[$menu] = array_merge(Yii::app()->plugin->menu[$menu], $options);
        
        Yii::app()->plugin->onBeforeMenuRender($e);
        Yii::app()->controller->widget('zii.widgets.CMenu', Yii::app()->plugin->menu[$menu]);
    }
    
 
    public function addBlock($region, $content, $key = null) {
        $this->_blocks[$region] = isset($this->_blocks[$region]) ? $this->_blocks[$region] : array();
        
        if($key !== null) {
            $this->_blocks[$region][$key] = $content;
        }
        else {
            $this->_blocks[$region][] = $content;
        }
        
        return $this;
    }
 
    public function renderRegion($region) {
        if(isset($this->_blocks[$region])) {
            echo implode('', $this->_blocks[$region]);
        }
    }
    
    public function getBlock($region, $key) {
        if(isset($this->_blocks[$region][$key])) {
            return $this->_blocks[$region][$key];
        }
        
        return false;
    }
    
    public function beginBlock($region, $key = null) {
        $this->_blocks[$region] = isset($this->_blocks[$region]) ? $this->_blocks[$region] : array();
        $this->_block_regions[] = $region;
        $this->_block_keys[] = $key !== null ? $key : count($this->_blocks[$region]);
        
        
        Yii::app()->controller->beginClip('_block');
    }
    
    public function endBlock() {
        $region = array_pop($this->_block_regions);
        $key = array_pop($this->_block_keys);
        Yii::app()->controller->endClip();
        $content = Yii::app()->controller->clips['_block'];
        $this->addBlock($region, $content, $key);
    }

}