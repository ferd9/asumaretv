<?php
Yii::app()->clientScript
        ->registerScriptFile(Yii::app()->theme->baseUrl . '/CLEditor1_4_1/jquery.cleditor.min.js')
        ->registerCssFile(Yii::app()->theme->baseUrl . '/CLEditor1_4_1/jquery.cleditor.css')
;

$form = $this->beginWidget('CActiveForm', array(
    'id' => 'page-pageForm-form',
//    'enableClientValidation' => true,
//    'clientOptions' => array(
//        'validateOnSubmit' => true,
//    ),
    'htmlOptions' => array(
        'class' => 'form-horizontal',
    ),
        ));
?>

<div class="box">
    <header class="dark">
        <div class="icons"><i class="icon-file-text-alt"></i></div>
        <h5><?php echo ucfirst($mode) ?> Page</h5>
    </header>

    <div class="alert">
        <button class="close" data-dismiss="alert">×</button>
        Fields with <span class="required">*</span> are required.
    </div>

    <?php $error = $form->error($model, 'page_position_fk'); ?>
    <div class="control-group <?php echo strip_tags($error) ? 'error' : '' ?>">
        <?php echo $form->labelEx($model, 'page_position_fk', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->dropDownList($model, 'page_position_fk', CHtml::listData(PagePosition::model()->findAll(), 'page_position_id', 'position'), array('class' => 'input-xlarge')); ?>
            <p class="help-block"><?php echo $error; ?></p>
        </div>
    </div>

    <?php $error = $form->error($model, 'title'); ?>
    <div class="control-group <?php echo strip_tags($error) ? 'error' : '' ?>">
        <?php echo $form->labelEx($model, 'title', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->textField($model, 'title', array('class' => 'input-xlarge', 'id' => 'title-field')); ?>
            <p class="help-block"><?php echo $error; ?></p>
        </div>
    </div>

    <?php $error = $form->error($model, 'slug'); ?>
    <div class="control-group <?php echo strip_tags($error) ? 'error' : '' ?>">
        <?php echo $form->labelEx($model, 'slug', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->textField($model, 'slug', array('class' => 'input-xlarge', 'id' => 'slug-field')); ?>
            <p class="help-block"><?php echo $error; ?></p>
        </div>
    </div>

    <?php $error = $form->error($model, 'weight'); ?>
    <div class="control-group <?php echo strip_tags($error) ? 'error' : '' ?>">
        <?php echo $form->labelEx($model, 'weight', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->textField($model, 'weight', array('class' => 'input-xlarge')); ?>
            <p class="help-block"><?php echo $error; ?></p>
        </div>
    </div>

    <div class="control-group">
        <?php echo $form->labelEx($model, 'content', array('class' => 'control-label')); ?>
        <div class="controls">
            <p class="help-block"><?php echo $form->error($model, 'content'); ?></p>
            <div class="rteDiv">
                <?php echo $form->textArea($model, 'content', array('class' => 'rte',)); ?>
            </div>
        </div>
    </div>

    <div class="form-actions no-margin-bottom">
        <?php echo CHtml::submitButton('Save', array('class' => 'btn btn-primary')); ?>
    </div>
<?php $this->endWidget(); ?>
</div>

<script>

    /*----------- BEGIN cleditor CODE -------------------------*/
    editor = $(".rte").cleditor({width: "98%", height: "100%"})[0].focus();
    $(window).resize();

    $(window).resize(function() {
        var $win = $('.rteDiv');
        $(".rte").width($win.width() - 100).height($win.height() - 24).offset({
            left: 15,
            top: 15
        });
        editor.refresh();
    });
    /*----------- END cleditor CODE -------------------------*/
    
    $('#title-field').keyup(function(){
        var string = $(this).val();
        string = string.toLowerCase();
        string = string.replace(/[^a-z0-9_\s-]/g, "", string);
        string = string.replace(/[\s-]+/g, " ", string);
        string = string.replace(/[\s_]+/g, "-", string);
        $('#slug-field').val(string);
    });

</script>