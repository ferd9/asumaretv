<?php
/* @var $this PostController */
/* @var $model Post */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'post_id'); ?>
		<?php echo $form->textField($model,'post_id',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'post_user'); ?>
		<?php echo $form->textField($model,'post_user'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'post_category'); ?>
		<?php echo $form->textField($model,'post_category'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'post_thumb'); ?>
		<?php echo $form->textField($model,'post_thumb',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'post_descripcion'); ?>
		<?php echo $form->textField($model,'post_descripcion',array('size'=>60,'maxlength'=>300)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'post_title'); ?>
		<?php echo $form->textField($model,'post_title',array('size'=>60,'maxlength'=>60)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'post_body'); ?>
		<?php echo $form->textArea($model,'post_body',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'post_date'); ?>
		<?php echo $form->textField($model,'post_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'post_update'); ?>
		<?php echo $form->textField($model,'post_update'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'post_tags'); ?>
		<?php echo $form->textField($model,'post_tags',array('size'=>60,'maxlength'=>128)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'post_comments'); ?>
		<?php echo $form->textField($model,'post_comments'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'post_shared'); ?>
		<?php echo $form->textField($model,'post_shared'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'post_favoritos'); ?>
		<?php echo $form->textField($model,'post_favoritos'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'post_cache'); ?>
		<?php echo $form->textField($model,'post_cache'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'post_ip'); ?>
		<?php echo $form->textField($model,'post_ip',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'post_visitantes'); ?>
		<?php echo $form->textField($model,'post_visitantes'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'post_status'); ?>
		<?php echo $form->textField($model,'post_status'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'post_link'); ?>
		<?php echo $form->textField($model,'post_link',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'post_type'); ?>
		<?php echo $form->textArea($model,'post_type',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->