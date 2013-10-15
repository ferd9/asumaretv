<?php
/* @var $this PerfilController */
/* @var $data Perfil */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('w_perfil')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->w_perfil), array('view', 'id'=>$data->w_perfil)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idusuario')); ?>:</b>
	<?php echo CHtml::encode($data->idusuario); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('portada')); ?>:</b>
	<?php echo CHtml::encode($data->portada); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hobbies')); ?>:</b>
	<?php echo CHtml::encode($data->hobbies); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fav_musica')); ?>:</b>
	<?php echo CHtml::encode($data->fav_musica); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fav_peliculas')); ?>:</b>
	<?php echo CHtml::encode($data->fav_peliculas); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fav_artistas')); ?>:</b>
	<?php echo CHtml::encode($data->fav_artistas); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('fav_libros')); ?>:</b>
	<?php echo CHtml::encode($data->fav_libros); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('colegio')); ?>:</b>
	<?php echo CHtml::encode($data->colegio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('instituto')); ?>:</b>
	<?php echo CHtml::encode($data->instituto); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('universidad')); ?>:</b>
	<?php echo CHtml::encode($data->universidad); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('trabajo')); ?>:</b>
	<?php echo CHtml::encode($data->trabajo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('puesto')); ?>:</b>
	<?php echo CHtml::encode($data->puesto); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lema_personal')); ?>:</b>
	<?php echo CHtml::encode($data->lema_personal); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('peor_enemigo')); ?>:</b>
	<?php echo CHtml::encode($data->peor_enemigo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fav_webs')); ?>:</b>
	<?php echo CHtml::encode($data->fav_webs); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idprivacidad')); ?>:</b>
	<?php echo CHtml::encode($data->idprivacidad); ?>
	<br />

	*/ ?>

</div>