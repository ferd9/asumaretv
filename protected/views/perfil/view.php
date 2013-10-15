<?php
/* @var $this PerfilController */
/* @var $model Perfil */

$this->breadcrumbs=array(
	'Perfils'=>array('index'),
	$model->w_perfil,
);

$this->menu=array(
	array('label'=>'List Perfil', 'url'=>array('index')),
	array('label'=>'Create Perfil', 'url'=>array('create')),
	array('label'=>'Update Perfil', 'url'=>array('update', 'id'=>$model->w_perfil)),
	array('label'=>'Delete Perfil', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->w_perfil),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Perfil', 'url'=>array('admin')),
);
?>

<h1>View Perfil #<?php echo $model->w_perfil; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'w_perfil',
		'idusuario',
		'portada',
		'hobbies',
		'fav_musica',
		'fav_peliculas',
		'fav_artistas',
		'fav_libros',
		'colegio',
		'instituto',
		'universidad',
		'trabajo',
		'puesto',
		'lema_personal',
		'peor_enemigo',
		'fav_webs',
		'idprivacidad',
	),
)); ?>
