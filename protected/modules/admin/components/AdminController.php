<?php

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class AdminController extends Controller {

    /**
     * @var string the default layout for the controller view. Defaults to '//layouts/column1',
     * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
     */
    public $layout = '//layouts/main';

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

    /*
     * top menu pages
     */
    public $pages = array();
    public $mad_updates = array();
    
    public $isBackend = true;

    public function addDefaultCriteria($criteria, $params = array()) {
        if($criteria instanceof CDbCriteria) {
            $params = array_merge(array(
                'limit' => 20,
            ), $params);
            
            $page = (int)Yii::app()->request->getQuery('page');
            $offset = (max($page, 1) - 1) * $params['limit'];
            $order = Yii::app()->request->getQuery('order');
            $sort = Yii::app()->request->getQuery('sort');
            
            if($order) {
                $params['order'] = isset($params['holders'][$order]) ? $params['holders'][$order] : $order;
                
                if($sort) {
                    $params['sort'] = $sort;
                }
                else {
                    $params['sort'] = 'ASC';
                }
            }
            
            
            
            $criteria->limit = $params['limit'];
            $criteria->offset = $offset;
            
            if(isset($params['order'])  && isset($params['sort'])) {
                $criteria->order = $params['order'] . ' ' . $params['sort'];
            }
        }
    }

}