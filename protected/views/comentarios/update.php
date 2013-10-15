<?php
/* @var $this ComentariosController */
/* @var $model Comentarios */

$this->breadcrumbs=array(
	'Comentarioses'=>array('index'),
	$model->cid=>array('view','id'=>$model->cid),
	'Update',
);

$this->menu=array(
	array('label'=>'List Comentarios', 'url'=>array('index')),
	array('label'=>'Create Comentarios', 'url'=>array('create')),
	array('label'=>'View Comentarios', 'url'=>array('view', 'id'=>$model->cid)),
	array('label'=>'Manage Comentarios', 'url'=>array('admin')),
);
?>

<h1>Update Comentarios <?php echo $model->cid; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>