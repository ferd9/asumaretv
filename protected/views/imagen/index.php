<?php
/* @var $this ImagenController */
/* @var $dataProvider CActiveDataProvider */
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/colorbox.css');
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/colorbox/jquery.colorbox-min.js', CClientScript::POS_HEAD);
/*
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/masonry.pkgd.js', CClientScript::POS_HEAD);

*/
//corregir porque se habilita con 2 click cuando solo deberia ser uno
Yii::app()->clientScript->registerScript('efecmri','
    $(document).ready(function(){
        $("a.cblink").live("click",function(event,reTrigger){
        $("a.cblink").colorbox({transition:"none", width:"100%", height:"100%"});
        
        return false;
     }).colorbox({transition:"none", width:"100%", height:"100%"});
    });     
     
');

$this->breadcrumbs=array(
	'Imagens',
);

$this->menu=array(
	array('label'=>'Create Imagen', 'url'=>array('create')),
	array('label'=>'Manage Imagen', 'url'=>array('admin')),
);
?>

<h1>Imagens</h1>

<?php /*$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
        'itemsCssClass'=>'row cntr',
        'template' => '{items} {pager}',
        //'itemsTagName'=>'ul',
        'pager' => array(
                    'class' => 'IasPager', 
                    'rowSelector'=>'.cntr', 
                    'listViewId' => 'VideoList', 
                    'header' => '',
                    'loaderText'=>'Loading...',
                    'options' => array('history' => false, 'triggerPageTreshold' => 2, 'trigger'=>'Load more'),
                  )
)); */

$this->widget('ext.isotope.Isotope',array(
    'dataProvider'=>$dataProvider,
    'itemView'=>'_view',
    'template' => '{items}{pager}',
    'itemSelectorClass'=>'item-thumb',
    'options'=>array(
       // 'layoutMode' => 'fitRows',
        'resizesContainer' => true,
        'animationEngine' => 'jQuery'
    ), // options for the isotope jquery
    'infiniteScroll'=>true, // default to true
    'infiniteOptions'=>array(
        'loading' => array(
            'msgText' => 'Mostrando Imagenes',
            'finishedMsg' => 'Llegaste al final XD'
        )
    ), // javascript options for infinite scroller
    'id'=>'wall',
));
?>
