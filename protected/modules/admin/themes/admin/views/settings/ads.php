<div class="box">
    <header class="dark">
        <div class="icons"><i class="icon-cogs"></i></div>
        <h5>Ads Settings</h5>
    </header>
<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'ads-setting-form',
    'enableClientValidation' => true,
    'clientOptions' => array(
        'validateOnSubmit' => true,
    ),
    'htmlOptions' => array(
         'class' => 'form-horizontal',
    ),
        ));
?>
    <div class="control-group">
        <?php echo $form->labelEx($model, 'ad1', array('class' => 'control-label')); ?>
        <div class="controls form-inline">
            <?php echo $form->textArea($model, 'ad1'); ?>
            <?php echo $form->error($model, 'ad1'); ?>
        </div>
    </div>

    <div class="control-group">
        <?php echo $form->labelEx($model, 'ad2', array('class' => 'control-label')); ?>

        <div class="controls">
            <?php echo $form->textArea($model, 'ad2'); ?>
            <?php echo $form->error($model, 'ad2'); ?>
        </div>
    </div>

    <div class="control-group">
        <?php echo $form->labelEx($model, 'ad3', array('class' => 'control-label')); ?>

        <div class="controls">
            <?php echo $form->textArea($model, 'ad3'); ?>
            <?php echo $form->error($model, 'ad3'); ?>
        </div>
    </div>

    
    <div class="form-actions no-margin-bottom">
        <?php echo CHtml::submitButton('Save', array('class' => 'btn btn-primary')); ?>
    </div>



<?php $this->endWidget() ?>

</div>