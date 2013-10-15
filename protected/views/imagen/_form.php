<?php
/* @var $this ImagenController */
/* @var $model Imagen */
/* @var $form CActiveForm */

Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/notify/jquery.pnotify.min.js', CClientScript::POS_HEAD);
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/js/notify/jquery.pnotify.default.css','all');
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/jquery.fileupload-ui.css','all');

//The jQuery UI widget factory, can be omitted  jQuery UI is already included 
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/vendor/jquery.ui.widget.js', CClientScript::POS_END);
//The Iframe Transport is required for browsers without support for XHR file uploads -->
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/jquery.iframe-transport.js', CClientScript::POS_END);
//The basic File Upload plugin 
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/jquery.fileupload.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile('//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js', CClientScript::POS_END);

Yii::app()->clientScript->registerScript('upimg','
    
    "use strict";
    // Change this to the location of your server-side upload handler:
    var url = "'.$this->createUrl("imagen/upimagen").'";
    $("#fileupload").fileupload({
        url: url,
        dataType: "json",
        done: function (e, data) { 
           //alert(data.result.nameOriginal);
           $(".fieldnori").val(data.result.nameOriginal);
           $(".fieldalto").val(data.result.alto);
           $(".fieldancho").val(data.result.ancho);
            $.each(data.result.files, function (index, file) { 
            
               if(file.url != undefined)
               {
                  $("#idavatar").attr("src","'.Yii::app()->request->baseUrl.'"+file.thumbnailUrl);                  
                  $(".fieldimagen").val(file.url); 
                  $(".fieldnombre").val(file.name); 
                  $(".fieldext").val(file.type); 
                  $("#Imagen_thumbnail").val(file.thumbnailUrl);
                }
                
              if(file.error != undefined)
               {
                  $.pnotify({
                        title:"Error: Maximo 2 MB",
                        text: file.error,
                        type: "error",                        
                        styling: "jqueryui"
                        });              
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

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'imagen-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php  echo Yii::app()->user->getState("pk")."****";
        echo $form->errorSummary($model); ?>
        
        <div class="control-group">
            <ul class="thumbnails">
            <li class="span3">
                <a href="#" class="thumbnail">
                    <img id="idavatar" data-src="holder.js/150x120" src="<?php echo (is_null($model->thumbnail))?Yii::app()->request->baseUrl."/img/nophoto.gif":Yii::app()->request->baseUrl."/".$model->thumbnail?>" alt="">
                </a>
                <span class="btn btn-success fileinput-button">
                <i class="glyphicon glyphicon-plus"></i>
                <span>Seleccionar Una Imagen</span>
                <!-- The file input field used as target for the file upload widget -->
                <input id="fileupload" type="file" name="files[]" multiple>
                </span> 
            </li> 
            <li class="span4">
                	<?php echo $form->labelEx($model,'descripcion'); ?>
            <div class="controls">
                <div class="input-prepend">
                    <?php echo $form->hiddenField($model,'thumbnail'); ?>
                    <?php echo $form->hiddenField($model,'extension',array('class'=>'fieldext')); ?>
                    <?php echo $form->hiddenField($model,'nombre',array('class'=>'fieldnombre')); ?>
                     <?php echo $form->hiddenField($model,'ancho',array('class'=>'fieldancho')); ?>
                    <?php echo $form->hiddenField($model,'alto',array('class'=>'fieldalto')); ?>
                    <?php echo $form->hiddenField($model,'nombre_original',array('class'=>'fieldnori')); ?>
                     <?php echo $form->hiddenField($model,'url',array('class'=>'fieldimagen')); ?>
                     <?php echo $form->textArea($model,'descripcion',array('rows'=>3,'class'=>'field span5','placeholder'=>'agregale una descricpion a esta image')); ?>
                    <?php echo $form->labelEx($model,'idcategoria'); ?>
		<?php echo $form->dropDownList($model,'idcategoria',Categorias::model()->getIdAndName(),
                        array('class'=>'span3','empty'=>'Seleccione una categoria','style'=>'height:150px;', 'size'=>'9')); ?>
		<?php echo $form->error($model,'idcategoria'); ?>
                    
                    <?php echo $form->labelEx($model,'etiquetas'); ?>
                    <?php
                    // completar accion de etiquetas
                $this->widget('application.components.MultiComplete',array(
                'model'=>$model,
                'attribute'=>'etiquetas',
                'sourceUrl'=>array('tags'),
                'splitter'=>',',
	       // 'multiple'=>true,    
               // 'source'=>array('ac1','ac2','ac3'),
                // additional javascript options for the autocomplete plugin
                'options'=>array(
                    'minLength'=>'2',
                ),
                'htmlOptions'=>array(
                    'style'=>'height:20px;',  
                    'class'=>'span3'
                ),
            ));
               ?> 
                 </div>       
            </div>		
		<?php echo $form->error($model,'descripcion'); ?>
                 <button type="submit" class="btn btn-success"><?php echo $model->isNewRecord ? 'Publicar Imagen' : 'Grabar y Terminar';?></button>                
            </li>
            </ul>
	
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->