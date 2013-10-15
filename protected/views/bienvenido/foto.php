<?php 
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/jquery.fileupload-ui.css','all');

//The jQuery UI widget factory, can be omitted  jQuery UI is already included 
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/vendor/jquery.ui.widget.js', CClientScript::POS_END);
//The Iframe Transport is required for browsers without support for XHR file uploads -->
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/jquery.iframe-transport.js', CClientScript::POS_END);
//The basic File Upload plugin 
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/jquery.fileupload.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile('//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js', CClientScript::POS_END);


Yii::app()->clientScript->registerScript('ravatare','
    
    "use strict";
    // Change this to the location of your server-side upload handler:
    var url = "'.$this->createUrl("bienvenido/upavatar").'";
    $("#fileupload").fileupload({
        url: url,
        dataType: "json",
        done: function (e, data) { 
            $.each(data.result.files, function (index, file) { 
               if(file.url != undefined)
               {
                  $("#idavatar").attr("src","'.Yii::app()->request->baseUrl.'"+file.url);                  
                  $(".fieldavatar").val("'.Yii::app()->request->baseUrl.'"+file.url);                  
                }
                 
            });
           
        },
        progressall: function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $("#progress .progress-bar").css(
                "width",
                progress + "%"
            );
        }
    }).prop("disabled", !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : "disabled");

');




?>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-foto',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="control-group">
            <ul class="thumbnails">
            <li class="span3">
                <a href="#" class="thumbnail">
                    <img id="idavatar" data-src="holder.js/150x120" src="<?php echo (is_null($model->avatar)?"img/nophoto.gif":$model->avatar);?>"  alt="">
                </a>
                <span class="btn btn-success fileinput-button">
                <i class="glyphicon glyphicon-plus"></i>
                <span>Insertar Imagen</span>
                <!-- The file input field used as target for the file upload widget -->
                <input id="fileupload" type="file" name="files[]" multiple>
                </span> 
            </li> 
            <li class="span4">
                	<?php echo $form->labelEx($model,'descripcion'); ?>
            <div class="controls">
                <div class="input-prepend">	
                     <?php echo $form->hiddenField($model,'avatar',array('class'=>'fieldavatar')); ?>
                     <?php echo $form->textArea($model,'descripcion',array('rows'=>3,'class'=>'field span5','placeholder'=>'Describete un poco...')); ?>
                 </div>       
            </div>		
		<?php echo $form->error($model,'descripcion'); ?>
                 <button type="submit" class="btn btn-success"><?php echo $model->isNewRecord ? 'Grabar' : 'Grabar y Terminar';?></button>
                 <a href="<?php echo $this->createUrl("perfil/view",array('id'=>Yii::app()->user->getState("pk")));?>" class="btn btn-blue">Omitir y Terminar</a>
            </li>
            </ul>
	
	</div>	       	

<?php $this->endWidget(); ?>

