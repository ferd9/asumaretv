<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>

<legend>Indentificate</legend>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<div class="control-group">
		<?php echo $form->labelEx($model,'username'); ?>
            <div class="controls">
                <div class="input-prepend">
			<span class="add-on"><i class="icon-user"></i></span>                        
		<?php echo $form->textField($model,'username'); ?>
                       </div> 
		<?php echo $form->error($model,'username'); ?>
               </div> 
	</div>

	<div class="control-group">
		<?php echo $form->labelEx($model,'password'); ?>
            <div class="controls">
                 <div class="input-prepend">
		  <span class="add-on"><i class="icon-lock"></i></span>       
		<?php echo $form->passwordField($model,'password'); ?>
                  </div> 
		<?php echo $form->error($model,'password'); ?>
		<p class="hint">
			Hint: You may login with <kbd>demo</kbd>/<kbd>demo</kbd> or <kbd>admin</kbd>/<kbd>admin</kbd>.
		</p>
               </div> 
	</div>

	<div class="control-group">
            
            <div class="controls">               
                <div class="input-prepend">                   
                    <?php echo $form->checkBox($model,'rememberMe',array('style'=>'display:inline;')); ?> <?php echo $form->label($model,'rememberMe',array('style'=>'display:inline;')); ?>
                </div>                
            </div>			
		<?php echo $form->error($model,'rememberMe'); ?>
	</div>

	<div class="control-group">		
            <label class="control-label"></label>
          <div class="controls">
			 <button type="submit" class="btn btn-success">Ingresar</button>
		  </div>
            
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
