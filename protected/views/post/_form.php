<?php
/* @var $this PostController */
/* @var $model Post */
/* @var $form CActiveForm */

Yii::app()->clientScript->registerScriptFile('//tinymce.cachefly.net/4.0/tinymce.min.js', CClientScript::POS_HEAD);
//Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/mlugin.js', CClientScript::POS_HEAD);
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/jquery.fileupload-ui.css','all');

//The jQuery UI widget factory, can be omitted  jQuery UI is already included 
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/vendor/jquery.ui.widget.js', CClientScript::POS_END);
//The Iframe Transport is required for browsers without support for XHR file uploads -->
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/jquery.iframe-transport.js', CClientScript::POS_END);
//The basic File Upload plugin 
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/jquery.fileupload.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile('//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js', CClientScript::POS_END);

Yii::app()->clientScript->registerScript('rgmce','
    tinymce.init({
    selector: "textarea.txtarea",
    menubar: false,
    external_plugins: {
        "youtube": "'.Yii::app()->request->baseUrl.'/js/youtube/plugin.js"        
    },
    relative_urls: false,
    plugins:"image media youtube preview",
    toolbar: "insertfile | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist | link image youtube media  preview"

   });
   
    "use strict";
    // Change this to the location of your server-side upload handler:
    var url = "'.$this->createUrl("post/imagen").'";
    $("#fileupload").fileupload({
        url: url,
        dataType: "json",
        done: function (e, data) { 
            $.each(data.result.files, function (index, file) { 
               if(file.url != undefined)
               {
               tinyMCE.execCommand("mceInsertRawHTML",false,"<img src=\''."".'"+file.url+"\'/>");
                  if($(".thumb").val().length==0)
                  {
                    $(".thumb").val("'.Yii::app()->request->baseUrl.'"+file.url);
                  }
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
        
  var enviar = false;      
jQuery(window).bind("beforeunload", function(event) {  
 //mostrar aviso si titulo o contenido tienen texto
 //alert(event.target.id);
    if($("#Post_post_title").val().length > 0 || tinyMCE.editors[0].getContent() != "")
    {           
        event.stopPropagation();
        event.returnValue = "Todos los que no haya guardado se perderan. Desea salir?";
        return event.returnValue;
    }
    
});

$("#bsend").click(function(){
    $(window).unbind();
});


');


?>

<div class="form">


<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'post-form',
        'htmlOptions'=>array('class'=>'form-vertical'),
	'enableAjaxValidation'=>false,
        'enableClientValidation'=>true,
        'clientOptions'=> array('validateOnSubmit'=>true),
)); ?>
    
    <legend>Crear Nuevo Post</legend>
	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
                
        <div class="control-group">
		<?php echo $form->labelEx($model,'post_title',array('class'=>"control-label")); ?>
		<div class="controls">
			<div class="input-prepend">
			<span class="add-on"><i class="icon-text-height"></i></span>
			<?php echo $form->textField($model,'post_title',array('placeholder'=>'Titulo del Post','class'=>"input-xlarge span8",'rel'=>'tooltip','title'=>"Ingresa el nombre que quieras para poder Ingresar.",'size'=>35,'maxlength'=>60)); ?>
			
			</div>
			<?php echo $form->error($model,'post_title',array('class'=>'help-inline')); ?>
		</div>
		
	</div>
                

	<div class="control-group">
		<?php echo $form->labelEx($model,'post_body',array('class'=>"control-label")); ?>
                <span class="btn btn-success fileinput-button">
                <i class="glyphicon glyphicon-plus"></i>
                <span>Insertar Imagen</span>
                <!-- The file input field used as target for the file upload widget -->
                <input id="fileupload" type="file" name="files[]" multiple>
                </span> 
		<?php echo $form->textArea($model,'post_body',array('class'=>'txtarea','rows'=>20, 'cols'=>50)); ?>
		<?php echo $form->error($model,'post_body'); ?>
	</div>

        <div class="span-5">
            <div class="control-group">
		<?php echo $form->labelEx($model,'post_category',array('class'=>"control-label")); ?>
		<?php echo $form->dropDownList($model,'post_category',  Categorias::model()->getIdAndName(),
                        array('class'=>'span4','empty'=>'Seleccione una categoria','style'=>'height:180px;', 'size'=>'9')); ?>
		<?php echo $form->error($model,'post_category'); ?>
            </div>
        </div>
	
        <div class="span-5 last">
            <div class="control-group">
                <?php echo $form->labelEx($model,'post_tags',array('class'=>"control-label")); ?>
                <div class="controls">
                    <div class="input-prepend">
                <span class="add-on"><i class="icon-tags"></i></span>		
                <?php
                $this->widget('application.components.MultiComplete',array(
                'model'=>$model,
                'attribute'=>'post_tags',
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
                    'class'=>'span4'
                ),
            ));
               ?> 
                </div>  
                <?php echo $form->error($model,'post_tags'); ?>
                </div>                
	  </div>
        </div>
	<div class="clearfix"></div>
        
        <div class="control-group">
	    <label class="control-label"></label>
          <div class="controls">
			 <button type="submit" class="btn btn-success" id="bsend"><?php echo $model->isNewRecord ? 'Publicar Post' : 'Save';?></button>
		  </div>	
		</div>	

<?php $this->endWidget(); ?>

</div><!-- form -->