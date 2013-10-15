<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-foto',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="control-group">
            <ul class="thumbnails">
            <li class="span4">
                <a href="#" class="thumbnail">
                    <img data-src="holder.js/300x200" src="<?php echo (is_null($model->avatar)?"img/nophoto.gif":$model->avatar);?>"  alt="">
                </a>
                <?php echo $form->fileField($model,'foto',array('class'=>'field span4')); ?>
            </li> 
            <li class="span4">
                	<?php echo $form->labelEx($model,'descripcion'); ?>
            <div class="controls">
                <div class="input-prepend">			
                     <?php echo $form->textArea($model,'descripcion',array('rows'=>3,'class'=>'field span8','placeholder'=>'Cuales son tus hobbies favoritos')); ?>
                 </div>       
            </div>		
		<?php echo $form->error($model,'descripcion'); ?>
            </li>
            </ul>
	
	</div>	

        <div class="control-group">
	    <label class="control-label"></label>
          <div class="controls">
              <button type="submit" class="btn btn-success"><?php echo $model->isNewRecord ? 'Grabar' : 'Grabar Avatar';?></button>
             </div>	
       </div>	

<?php $this->endWidget(); ?>
