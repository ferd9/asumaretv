<?php
/* @var $this ImagenController */
/* @var $model Imagen */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'idImagen'); ?>
		<?php echo $form->textField($model,'idImagen',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nombre'); ?>
		<?php echo $form->textField($model,'nombre',array('size'=>60,'maxlength'=>180)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idusuario'); ?>
		<?php echo $form->textField($model,'idusuario',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nombre_original'); ?>
		<?php echo $form->textField($model,'nombre_original',array('size'=>60,'maxlength'=>180)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'extension'); ?>
		<?php echo $form->textField($model,'extension',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'url'); ?>
		<?php echo $form->textField($model,'url',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tipo'); ?>
		<?php echo $form->textField($model,'tipo',array('size'=>6,'maxlength'=>6)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'alto'); ?>
		<?php echo $form->textField($model,'alto'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ancho'); ?>
		<?php echo $form->textField($model,'ancho'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'thumbnail'); ?>
		<?php echo $form->textField($model,'thumbnail',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idcategoria'); ?>
		<?php echo $form->textField($model,'idcategoria'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'etiquetas'); ?>
		<?php echo $form->textField($model,'etiquetas',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fecha'); ?>
		<?php echo $form->textField($model,'fecha'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'eliminado'); ?>
		<?php echo $form->textField($model,'eliminado'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->