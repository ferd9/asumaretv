<?php
/* @var $this ComentariosController */
/* @var $model Comentarios */

$this->breadcrumbs=array(
	'Comentarioses'=>array('index'),
	$model->cid,
);

$this->menu=array(
	array('label'=>'List Comentarios', 'url'=>array('index')),
	array('label'=>'Create Comentarios', 'url'=>array('create')),
	array('label'=>'Update Comentarios', 'url'=>array('update', 'id'=>$model->cid)),
	array('label'=>'Delete Comentarios', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->cid),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Comentarios', 'url'=>array('admin')),
);
?>

<h1>View Comentarios #<?php echo $model->cid; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'cid',
		'comentario_thread_id',
		'padre_comentario_id',
		'c_user',
		'c_date',
		'c_body',
		'c_votos',
		'c_status',
		'c_ip',
	),
)); ?>
