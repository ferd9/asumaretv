<?php
/* @var $this PerfilController */
/* @var $model Perfil */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'w_perfil'); ?>
		<?php echo $form->textField($model,'w_perfil',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idusuario'); ?>
		<?php echo $form->textField($model,'idusuario',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'portada'); ?>
		<?php echo $form->textArea($model,'portada',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hobbies'); ?>
		<?php echo $form->textArea($model,'hobbies',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fav_musica'); ?>
		<?php echo $form->textArea($model,'fav_musica',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fav_peliculas'); ?>
		<?php echo $form->textArea($model,'fav_peliculas',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fav_artistas'); ?>
		<?php echo $form->textArea($model,'fav_artistas',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fav_libros'); ?>
		<?php echo $form->textArea($model,'fav_libros',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'colegio'); ?>
		<?php echo $form->textField($model,'colegio',array('size'=>60,'maxlength'=>120)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'instituto'); ?>
		<?php echo $form->textField($model,'instituto',array('size'=>60,'maxlength'=>120)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'universidad'); ?>
		<?php echo $form->textField($model,'universidad',array('size'=>60,'maxlength'=>120)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'trabajo'); ?>
		<?php echo $form->textField($model,'trabajo',array('size'=>60,'maxlength'=>120)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'puesto'); ?>
		<?php echo $form->textField($model,'puesto',array('size'=>60,'maxlength'=>120)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'lema_personal'); ?>
		<?php echo $form->textArea($model,'lema_personal',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'peor_enemigo'); ?>
		<?php echo $form->textField($model,'peor_enemigo',array('size'=>60,'maxlength'=>180)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fav_webs'); ?>
		<?php echo $form->textArea($model,'fav_webs',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idprivacidad'); ?>
		<?php echo $form->textField($model,'idprivacidad'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->