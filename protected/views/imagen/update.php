<?php
/* @var $this ImagenController */
/* @var $model Imagen */

$this->breadcrumbs=array(
	'Imagens'=>array('index'),
	$model->idImagen=>array('view','id'=>$model->idImagen),
	'Update',
);

$this->menu=array(
	array('label'=>'List Imagen', 'url'=>array('index')),
	array('label'=>'Create Imagen', 'url'=>array('create')),
	array('label'=>'View Imagen', 'url'=>array('view', 'id'=>$model->idImagen)),
	array('label'=>'Manage Imagen', 'url'=>array('admin')),
);
?>

<h1>Update Imagen <?php echo $model->idImagen; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>