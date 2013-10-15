<?php
/* @var $this UsuarioController */
/* @var $model Usuario */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'idusuario'); ?>
		<?php echo $form->textField($model,'idusuario',array('size'=>11,'maxlength'=>11)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>35,'maxlength'=>35)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sessionid'); ?>
		<?php echo $form->textField($model,'sessionid',array('size'=>60,'maxlength'=>80)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'avatar'); ?>
		<?php echo $form->textField($model,'avatar',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nombre'); ?>
		<?php echo $form->textField($model,'nombre',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'apellido_p'); ?>
		<?php echo $form->textField($model,'apellido_p',array('size'=>60,'maxlength'=>120)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'apellido_m'); ?>
		<?php echo $form->textField($model,'apellido_m',array('size'=>60,'maxlength'=>120)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'passwd'); ?>
		<?php echo $form->passwordField($model,'passwd',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'salt'); ?>
		<?php echo $form->textField($model,'salt',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sexo'); ?>
		<?php echo $form->textField($model,'sexo',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'descripcion'); ?>
		<?php echo $form->textArea($model,'descripcion',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hobbies'); ?>
		<?php echo $form->textArea($model,'hobbies',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nivel'); ?>
		<?php echo $form->textField($model,'nivel'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'strikes'); ?>
		<?php echo $form->textField($model,'strikes'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'confirmado'); ?>
		<?php echo $form->textField($model,'confirmado'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'word_comfirm'); ?>
		<?php echo $form->textField($model,'word_comfirm',array('size'=>60,'maxlength'=>160)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dir_files'); ?>
		<?php echo $form->textField($model,'dir_files',array('size'=>60,'maxlength'=>120)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'last_login'); ?>
		<?php echo $form->textField($model,'last_login'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fec_login'); ?>
		<?php echo $form->textField($model,'fec_login'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fechareg'); ?>
		<?php echo $form->textField($model,'fechareg'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'activo'); ?>
		<?php echo $form->textField($model,'activo'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->