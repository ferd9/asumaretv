<?php
/* @var $this ComentariosController */
/* @var $data Comentarios */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('cid')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->cid), array('view', 'id'=>$data->cid)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('comentario_thread_id')); ?>:</b>
	<?php echo CHtml::encode($data->comentario_thread_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('padre_comentario_id')); ?>:</b>
	<?php echo CHtml::encode($data->padre_comentario_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('c_user')); ?>:</b>
	<?php echo CHtml::encode($data->c_user); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('c_date')); ?>:</b>
	<?php echo CHtml::encode($data->c_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('c_body')); ?>:</b>
	<?php echo CHtml::encode($data->c_body); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('c_votos')); ?>:</b>
	<?php echo CHtml::encode($data->c_votos); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('c_status')); ?>:</b>
	<?php echo CHtml::encode($data->c_status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('c_ip')); ?>:</b>
	<?php echo CHtml::encode($data->c_ip); ?>
	<br />

	*/ ?>

</div>