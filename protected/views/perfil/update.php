<?php
/* @var $this PerfilController */
/* @var $model Perfil */

$this->breadcrumbs=array(
	'Perfils'=>array('index'),
	$model->w_perfil=>array('view','id'=>$model->w_perfil),
	'Update',
);

$this->menu=array(
	array('label'=>'List Perfil', 'url'=>array('index')),
	array('label'=>'Create Perfil', 'url'=>array('create')),
	array('label'=>'View Perfil', 'url'=>array('view', 'id'=>$model->w_perfil)),
	array('label'=>'Manage Perfil', 'url'=>array('admin')),
);
?>

<h1>Update Perfil <?php echo $model->w_perfil; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>