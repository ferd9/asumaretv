<?php
/* @var $this PerfilController */
/* @var $model Perfil */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'perfil-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'idusuario'); ?>
		<?php echo $form->textField($model,'idusuario',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'idusuario'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'portada'); ?>
		<?php echo $form->textArea($model,'portada',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'portada'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'hobbies'); ?>
		<?php echo $form->textArea($model,'hobbies',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'hobbies'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fav_musica'); ?>
		<?php echo $form->textArea($model,'fav_musica',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'fav_musica'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fav_peliculas'); ?>
		<?php echo $form->textArea($model,'fav_peliculas',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'fav_peliculas'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fav_artistas'); ?>
		<?php echo $form->textArea($model,'fav_artistas',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'fav_artistas'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fav_libros'); ?>
		<?php echo $form->textArea($model,'fav_libros',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'fav_libros'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'colegio'); ?>
		<?php echo $form->textField($model,'colegio',array('size'=>60,'maxlength'=>120)); ?>
		<?php echo $form->error($model,'colegio'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'instituto'); ?>
		<?php echo $form->textField($model,'instituto',array('size'=>60,'maxlength'=>120)); ?>
		<?php echo $form->error($model,'instituto'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'universidad'); ?>
		<?php echo $form->textField($model,'universidad',array('size'=>60,'maxlength'=>120)); ?>
		<?php echo $form->error($model,'universidad'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'trabajo'); ?>
		<?php echo $form->textField($model,'trabajo',array('size'=>60,'maxlength'=>120)); ?>
		<?php echo $form->error($model,'trabajo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'puesto'); ?>
		<?php echo $form->textField($model,'puesto',array('size'=>60,'maxlength'=>120)); ?>
		<?php echo $form->error($model,'puesto'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'lema_personal'); ?>
		<?php echo $form->textArea($model,'lema_personal',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'lema_personal'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'peor_enemigo'); ?>
		<?php echo $form->textField($model,'peor_enemigo',array('size'=>60,'maxlength'=>180)); ?>
		<?php echo $form->error($model,'peor_enemigo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fav_webs'); ?>
		<?php echo $form->textArea($model,'fav_webs',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'fav_webs'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idprivacidad'); ?>
		<?php echo $form->textField($model,'idprivacidad'); ?>
		<?php echo $form->error($model,'idprivacidad'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->