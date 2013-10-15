<?php
$this->pageTitle = Yii::app()->name . ' - Google Ads';
$this->breadcrumbs = array(
    'Google Ads',
);
?>

<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'google-ads',
    'enableClientValidation' => true,
    'clientOptions' => array(
        'validateOnSubmit' => true,
    ),
    'htmlOptions' => array(
        'class' => 'form-horizontal'
    ),
        ));
?>

<fieldset>
    <legend>Google Ads</legend>

    <?php $error = $form->error($formModel, 'GAD_728x90', array('class' => 'help-block')); ?>
    <div class="control-group <?php echo strip_tags($error) ? 'error' : '' ?>">
        <?php echo $form->labelEx($formModel, 'GAD_728x90', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->textarea($formModel, 'GAD_728x90', array('class' => 'input-xlarge')); ?>
            <?php echo $error; ?>
        </div>
    </div>

    <?php $error = $form->error($formModel, 'GAD_336x280', array('class' => 'help-block')); ?>
    <div class="control-group <?php echo strip_tags($error) ? 'error' : '' ?>">
        <?php echo $form->labelEx($formModel, 'GAD_336x280', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->textarea($formModel, 'GAD_336x280', array('class' => 'input-xlarge')); ?>
            <?php echo $error; ?>
        </div>
    </div>

    <?php $error = $form->error($formModel, 'GAD_728x15', array('class' => 'help-block')); ?>
    <div class="control-group <?php echo strip_tags($error) ? 'error' : '' ?>">
        <?php echo $form->labelEx($formModel, 'GAD_728x15', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->textarea($formModel, 'GAD_728x15', array('class' => 'input-xlarge')); ?>
            <?php echo $error; ?>
        </div>
    </div>

    <div class="form-actions">
        <?php echo CHtml::submitButton('Submit', array('class' => 'btn btn-primary')); ?>
    </div>
</fieldset>
<?php $this->endWidget(); ?>
