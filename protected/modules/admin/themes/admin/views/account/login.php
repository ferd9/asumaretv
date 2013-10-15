<?php
$this->pageTitle = Yii::app()->name . ' - Admin Login';
$this->breadcrumbs = array(
    'Admin Login',
);
?>

<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'login-form',
    'enableClientValidation' => true,
    'clientOptions' => array(
        'validateOnSubmit' => true,
    ),
    'htmlOptions' => array(
        'class' => 'form-horizontal',
    ),
        ));
?>
<fieldset>
    <legend>Admin Login</legend>
    <div class="alert">
        <button class="close" data-dismiss="alert">×</button>
        Fields with <span class="required">*</span> are required.
    </div>

    <?php $error = $form->error($model, 'username'); ?>
    <div class="control-group <?php echo strip_tags($error) ? 'error' : '' ?>">
        <?php echo $form->labelEx($model, 'username', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->textField($model, 'username', array('class' => 'input-xlarge')); ?>
            <p class="help-block"><?php echo $error; ?></p>
        </div>
    </div>

    <?php $error = $form->error($model, 'password'); ?>
    <div class="control-group <?php echo strip_tags($error) ? 'error' : '' ?>" style="margin-bottom: 0;">
        <?php echo $form->labelEx($model, 'password', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->passwordField($model, 'password', array('class' => 'input-xlarge')); ?>
            <p class="help-block"><?php echo $error; ?></p>
        </div>
    </div>

    <?php $error = $form->error($model, 'rememberMe'); ?>
    <div class="control-group <?php echo strip_tags($error) ? 'error' : '' ?>">
        <div class="controls">
            <div class="checkbox">
                <?php echo $form->checkBox($model, 'rememberMe', array('class' => 'input-xlarge')); ?> Remember me
                <p class="help-block"><?php echo $error ?></p>
            </div>
        </div>
    </div>

    <div class="form-actions">
        <?php echo CHtml::submitButton('Login', array('class' => 'btn btn-primary')); ?>
    </div>

</fieldset>
<?php $this->endWidget(); ?>
