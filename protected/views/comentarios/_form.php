<?php
/* @var $this ComentariosController */
/* @var $model Comentarios */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'comentarios-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'comentario_thread_id'); ?>
		<?php echo $form->textField($model,'comentario_thread_id'); ?>
		<?php echo $form->error($model,'comentario_thread_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'padre_comentario_id'); ?>
		<?php echo $form->textField($model,'padre_comentario_id'); ?>
		<?php echo $form->error($model,'padre_comentario_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'c_user'); ?>
		<?php echo $form->textField($model,'c_user'); ?>
		<?php echo $form->error($model,'c_user'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'c_date'); ?>
		<?php echo $form->textField($model,'c_date'); ?>
		<?php echo $form->error($model,'c_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'c_body'); ?>
		<?php echo $form->textArea($model,'c_body',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'c_body'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'c_votos'); ?>
		<?php echo $form->textField($model,'c_votos'); ?>
		<?php echo $form->error($model,'c_votos'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'c_status'); ?>
		<?php echo $form->textField($model,'c_status',array('size'=>1,'maxlength'=>1)); ?>
		<?php echo $form->error($model,'c_status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'c_ip'); ?>
		<?php echo $form->textField($model,'c_ip',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'c_ip'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->