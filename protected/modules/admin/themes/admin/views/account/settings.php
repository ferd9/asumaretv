<?php
$this->pageTitle = Yii::app()->name . ' - General Settings';
$this->breadcrumbs = array(
    'General Settings',
);
?>

<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'general-settings',
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
    <legend>General Settings</legend>
    
    <?php $error = $form->error($formModel, 'DEFAULT_SORT', array('class' => 'help-block')); ?>
    <div class="control-group <?php echo strip_tags($error) ? 'error' : '' ?>">
        <?php echo $form->labelEx($formModel, 'DEFAULT_SORT', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->dropdownList($formModel, 'DEFAULT_SORT', array('t.created_at' => 'Submission date', 't.rating' => 'Rating'), array('class' => 'input-xlarge')); ?>
            <?php echo $error; ?>
        </div>
    </div>

    <?php $error = $form->error($formModel, 'DEFAULT_ORDER', array('class' => 'help-block')); ?>
    <div class="control-group <?php echo strip_tags($error) ? 'error' : '' ?>">
        <?php echo $form->labelEx($formModel, 'DEFAULT_ORDER', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->dropdownList($formModel, 'DEFAULT_ORDER', array('asc' => 'Ascending order', 'desc' => 'Descending order'), array('class' => 'input-xlarge')); ?>
            <?php echo $error; ?>
        </div>
    </div>

    <legend>Bitly Info</legend>
    <?php $error = $form->error($formModel, 'BITLY_LOGIN', array('class' => 'help-block')); ?>
    <div class="control-group <?php echo strip_tags($error) ? 'error' : '' ?>">
        <?php echo $form->labelEx($formModel, 'BITLY_LOGIN', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->textField($formModel, 'BITLY_LOGIN', array('class' => 'input-xlarge')); ?>
            <?php echo $error; ?>
        </div>
    </div>
    
    <?php $error = $form->error($formModel, 'BITLY_API_KEY', array('class' => 'help-block')); ?>
    <div class="control-group <?php echo strip_tags($error) ? 'error' : '' ?>">
        <?php echo $form->labelEx($formModel, 'BITLY_API_KEY', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->textField($formModel, 'BITLY_API_KEY', array('class' => 'input-xlarge')); ?>
            <?php echo $error; ?>
        </div>
    </div>
    
    <?php $error = $form->error($formModel, 'BITLY_USE', array('class' => 'help-block')); ?>
    <div class="control-group <?php echo strip_tags($error) ? 'error' : '' ?>">
        <?php echo $form->labelEx($formModel, 'BITLY_USE', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->checkbox($formModel, 'BITLY_USE'); ?>
            <?php echo $error; ?>
        </div>
    </div>
    
    <div class="form-actions">
        <?php echo CHtml::submitButton('Save', array('class' => 'btn btn-primary')); ?>
    </div>
</fieldset>
<?php $this->endWidget(); ?>
