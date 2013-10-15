<div class="box">
    <header class="dark">
        <div class="icons"><i class="icon-cogs"></i></div>
        <h5>Social Settings</h5>
    </header>
<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'social-config-form',
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
        <?php echo $form->labelEx($model, 'allowedProviders', array('class' => 'control-label')); ?>

        <div class="controls form-inline">
            <?php echo $form->checkBoxList($model, 'allowedProviders', array('facebook' => 'Facebook', 'google' => 'Google'), array('separator' => ' ',)); ?>
            <?php echo $form->error($model, 'allowedProviders'); ?>
        </div>
    </div>
    
    <div class="control-group">
        <?php echo $form->labelEx($model, 'base_url', array('class' => 'control-label')); ?>
        <div class="controls form-inline">
            <?php echo $form->textField($model, 'base_url', array('class' => 'input-xxlarge')); ?>
            <?php echo $form->error($model, 'base_url'); ?>
        </div>
    </div>

    <div class="control-group">
        <?php echo $form->labelEx($model, 'facebook_id', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->textField($model, 'facebook_id', array('class' => 'input-xxlarge')); ?>
            <?php echo $form->error($model, 'facebook_id'); ?>
        </div>
    </div>

    <div class="control-group">
        <?php echo $form->labelEx($model, 'facebook_secret', array('class' => 'control-label')); ?>

        <div class="controls">
            <?php echo $form->textField($model, 'facebook_secret', array('class' => 'input-xxlarge')); ?>
            <?php echo $form->error($model, 'facebook_secret'); ?>
        </div>
    </div>

    <div class="control-group">
        <?php echo $form->labelEx($model, 'google_id', array('class' => 'control-label')); ?>

        <div class="controls">
            <?php echo $form->textField($model, 'google_id', array('class' => 'input-xxlarge')); ?>
            <?php echo $form->error($model, 'google_id'); ?>
        </div>
    </div>

    <div class="control-group">
        <?php echo $form->labelEx($model, 'google_secret', array('class' => 'control-label')); ?>

        <div class="controls">
            <?php echo $form->textField($model, 'google_secret', array('class' => 'input-xxlarge')); ?>
            <?php echo $form->error($model, 'google_secret'); ?>
        </div>
    </div>

    <div class="control-group">
        <label class="control-label">Google callback URL</label>
        <div class="controls">
            <input class="input-xxlarge" type="text" value="<?php echo $model->base_url ?>?hauth.done=Google" />
        </div>
    </div>

    
    <div class="form-actions no-margin-bottom">
        <?php echo CHtml::submitButton('Save', array('class' => 'btn btn-primary')); ?>
    </div>



<?php $this->endWidget() ?>

</div>