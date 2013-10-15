<?php
/* @var $this ComentariosController */
/* @var $model Comentarios */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'cid'); ?>
		<?php echo $form->textField($model,'cid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'comentario_thread_id'); ?>
		<?php echo $form->textField($model,'comentario_thread_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'padre_comentario_id'); ?>
		<?php echo $form->textField($model,'padre_comentario_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'c_user'); ?>
		<?php echo $form->textField($model,'c_user'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'c_date'); ?>
		<?php echo $form->textField($model,'c_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'c_body'); ?>
		<?php echo $form->textArea($model,'c_body',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'c_votos'); ?>
		<?php echo $form->textField($model,'c_votos'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'c_status'); ?>
		<?php echo $form->textField($model,'c_status',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'c_ip'); ?>
		<?php echo $form->textField($model,'c_ip',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->