<?php
Yii::app()->clientScript
        ->registerScriptFile(Yii::app()->theme->baseUrl . '/js/lib/bootstrap-colorpicker.js')
        ->registerCssFile(Yii::app()->theme->baseUrl . '/css/colorpicker.css')
        ;
?>
<div class="box">
    <header class="dark">
        <div class="icons"><i class="icon-cogs"></i></div>
        <h5>Watermark Settings</h5>
    </header>
<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'watermark-setting-form',
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
        <?php echo $form->labelEx($model, 'watermark_enable', array('class' => 'control-label')); ?>
        <div class="controls form-inline">
            <?php echo $form->checkBox($model, 'watermark_enable'); ?>
            <?php echo $form->error($model, 'watermark_enable'); ?>
        </div>
    </div>

    <div class="control-group">
        <?php echo $form->labelEx($model, 'watermark_size', array('class' => 'control-label')); ?>

        <div class="controls">
            <?php echo $form->textField($model, 'watermark_size'); ?>
            <?php echo $form->error($model, 'watermark_size'); ?>
        </div>
    </div>

    <div class="control-group">
        <?php echo $form->labelEx($model, 'watermark_text', array('class' => 'control-label')); ?>

        <div class="controls">
            <?php echo $form->textField($model, 'watermark_text'); ?>
            <?php echo $form->error($model, 'watermark_text'); ?>
        </div>
    </div>

    <div class="control-group">
        <?php echo $form->labelEx($model, 'watermark_color', array('class' => 'control-label')); ?>

        <div class="controls">
            <?php echo $form->textField($model, 'watermark_color', array('class' => 'cpicker')); ?>
            <?php echo $form->error($model, 'watermark_color'); ?>
        </div>
    </div>
    
    <div class="form-actions no-margin-bottom">
        <?php echo CHtml::submitButton('Save', array('class' => 'btn btn-primary')); ?>
    </div>



<?php $this->endWidget() ?>

</div>

<script>
    $('.cpicker').colorpicker({
//        format: 'hex'
    });
</script>
    