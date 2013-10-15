<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'perfil-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="control-group">
		<?php echo $form->labelEx($model,'hobbies'); ?>
            <div class="controls">
                <div class="input-prepend">			
                     <?php echo $form->textArea($model,'hobbies',array('rows'=>5,'class'=>'field span8','placeholder'=>'Cuales son tus hobbies favoritos')); ?>
                 </div>       
            </div>		
		<?php echo $form->error($model,'hobbies'); ?>
	</div>
	<div class="control-group">
		<?php echo $form->labelEx($model,'lema_personal'); ?>
            <div class="controls">
                <div class="input-prepend">			
                     <?php echo $form->textArea($model,'lema_personal',array('rows'=>5,'class'=>'field span8','placeholder'=>'Una frase que te identifique o que suelas usar')); ?>
                 </div>       
            </div>		
		<?php echo $form->error($model,'lema_personal'); ?>
	</div>

        <div class="control-group">
	    <label class="control-label"></label>
          <div class="controls">
			 <button type="submit" class="btn btn-success"><?php echo $model->isNewRecord ? 'Grabar' : 'Grabar y Continuar';?></button>
                         <a href="<?php echo $this->createUrl('avatar');?>" class="btn btn-red">Omitir y Continuar</a>
		  </div>	
		</div>	

<?php $this->endWidget(); ?>
