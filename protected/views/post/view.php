<?php
/* @var $this PostController */
/* @var $model Post */
Yii::app()->clientScript->registerScriptFile('//tinymce.cachefly.net/4.0/tinymce.min.js', CClientScript::POS_HEAD);
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/mlugin.js', CClientScript::POS_HEAD);
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
if(!Yii::app()->user->isGuest){
Yii::app()->clientScript->registerScript('comt25','
tinymce.init({
    selector: "textarea.txtcoment",
    language_url : "'.Yii::app()->request->baseUrl.'/js/langs/es.js",
   extended_valid_elements : "iframe[src|title|width|height|allowfullscreen|frameborder]",
   // valid_elements : "iframe[src|width|height|name|align]",
    menubar: false,
    relative_urls: false,
    plugins:"legacyoutput code image media mlugin emoticons preview",
    toolbar: "insertfile mlugin | link image media | emoticons preview",
    setup: function(editor){
            editor.addButton("mlugin",{
                text: "Subir Imagen",
                image : "'.Yii::app()->request->baseUrl.'/img/icon_upload.gif",
                icon: false,
                onclick:function(){                
                  $("#mydialog").dialog("open");
                }
            });
        }

   });    
   
    "use strict";
    // Change this to the location of your server-side upload handler:
    var url = "'.$this->createUrl("comentarios/imagen").'";
    $("#fileupload").fileupload({
        url: url,
        dataType: "json",
        done: function (e, data) { 
            $.each(data.result.files, function (index, file) { 
               if(file.url != undefined)
               {
                tinyMCE.execCommand("mceInsertRawHTML",false,"<img src=\''.Yii::app()->request->baseUrl.'"+file.thumbnailUrl+"\'/>");
                $("#mydialog").dialog("close");
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
        

    $("#comentarios-form").submit(function(e) {
             e.preventDefault();
             
             if(tinyMCE.editors[0].getContent().length > 300)
             {
                $.pnotify({
                        title:"Comentario Muy Largo",
                        text: "Tu comentario contiene "+tinyMCE.editors[0].getContent().length+" caracteres y lo maximo es 300",
                        type: "error",                        
                        styling: "jqueryui"
                        });
               return false;
             }

             if(tinyMCE.editors[0].getContent() == "")
             {
               return false;
             }
            
             $(".txtcoment").val(tinyMCE.editors[0].getContent());
             var datas = $("#comentarios-form").serialize();
             $(":submit").attr("disabled", true);
             $.ajax({
                  type: "POST",
                  url: "'.$this->createUrl("comentarios/acreate").'",
                  data: datas,
                  dataType: "json",
                  success: function(data) {
                        //data;
                        //alert(data.c_body);
                        $.pnotify({
                        title:"Comentario agregado",
                        text: "Tu comentario fue agregado correctamente",
                        type: "success",                        
                        styling: "jqueryui"
                        });                        
                        $("#comentarios-form")[0].reset();
                        $.fn.yiiListView.update("lcmt");
                        $(":submit").removeAttr("disabled");
                        return false;
                        //tinyMCE.editors[0].setContent(""); 
                        
                    }
                });
            return false;
        });    
');
}
$this->breadcrumbs=array(
	'Posts'=>array('index'),
	$model->post_id,
);

$this->menu=array(
	array('label'=>'List Post', 'url'=>array('index')),
	array('label'=>'Create Post', 'url'=>array('create')),
	array('label'=>'Update Post', 'url'=>array('update', 'id'=>$model->post_id)),
	array('label'=>'Delete Post', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->post_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Post', 'url'=>array('admin')),
);
?>

<?php 
$model2=new Comentarios;
$ch = ComentarioHilo::model()->find("w_idthreads=".$model->post_id);
?>

    <article>
        <h1 class='title'><?php echo $model->post_title; ?></h1>
        <figure>
        <?php echo CHtml::link(CHtml::image($model->post_thumb, "Winter in New York"),'#',array('rel'=>'prettyPhoto'));?>
    </figure>
    <div class='blog-content'>
        <div class='info'>
            <a href="#"><?php echo Comentarios::model()->count("comentario_thread_id='".$model->comentariohilo->nombre_thread."'");?> Comentarios </a>,
            <span class='date'><?php echo date('d/m/Y', $model->post_date);?></span>, por
            <a href="#"><?php echo $model->usuario->username?></a>, en
            <a href="#" class='dark'><?php echo $model->categoria->c_nombre; ?></a>
        </div>
        <?php echo $model->post_body; ?>
         <div class="tag-container">
            <div class='tag-title'>Tags: </div>
            <?php $tg = $model->getTags();
                for($i=0;$i<count($tg);$i++){
            ?>
            <?php echo CHtml::link($tg[$i], '#',array('class'=>'tag'))?>           
            <?php } ?>
        </div>
    </div>
    <div class='blog-bottom'>
        <div class='share-title'>Share</div>
        <div class='share-content'>
            <!-- AddThis Button BEGIN -->
            <div class="addthis_toolbox addthis_default_style ">
            <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
            <a class="addthis_button_tweet"></a>
            <a class="addthis_button_pinterest_pinit"></a>
            <a class="addthis_counter addthis_pill_style"></a>
            <!--<a href="#">Favoritos</a>
            <a href="#">Visitas</a>
            <a href="#">Comentarios <?php echo $model->post_visitantes;?></a>
            <a href="#">Denunciar</a>-->
            </div>
            <script type="text/javascript" src="../../../s7.addthis.com/js/300/addthis_widget.js#pubid=xa-5133cbfc3c9054b8"></script>
            <!-- AddThis Button END -->
        </div>
    </div>
    </article>    
 <div class='row'>
    <div class='span8 author-box'>
        <div class='box-title'>
            <h2>About the author </h2>
            <div class='title-line'></div>
        </div>
        <div class='author'>
            <?php $autor = $model->getUser();?>
            <figure>
                <img src="<?php echo (is_null($autor->avatar)?"img/nophoto.gif":$autor->avatar)?>" alt="">
            </figure>
            <div class='author-links'>
                <a href="#" class='twitter author-social'>Twitter</a>
                <a href="#" class='facebook author-social'>Facebook</a>
                <a href="#" class='googleplus author-social'>Googleplus</a>
            </div>
            <div class='description'>
                <span class='name'><?php echo $autor->username;?></span> 
                <?php echo (is_null($autor->descripcion)?"sin descripcion...":$autor->descripcion); ?>
            </div>
        </div>
    </div>
</div>
 <div class="row">
    <div class='related-news span8'>
        <?php $postRelacionados = $model->getPostRelacionados();?>
        <div class='inner-box'>
           <h1 class='title'>Related News</h1>
        <?php foreach ($postRelacionados as $relacionados) { ?>
           <div class="column">
                <div class='inner'>
                    <a href="#">
                        <figure>
                            <img src="<?php echo $relacionados->post_thumb ?>" alt="">
                        </figure>
                        <div class='title'><?php echo $relacionados->post_title?></div>
                        <div class='date'>September 10, 2012</div>
                    </a>
                </div>
            </div>        
        <?php } ?>
        </div>
    </div>
    </div>


<?php if(!Yii::app()->user->isGuest){?>
<div class='row'>
    <div class='span8'>
        <div class='box-title'>
            <h2>Leave a comment</h2>
            <span class='sub-title'>Your email address will not be published, all the fields are required.</span>
        </div>
        <div class='comments-form'>
            
            <?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'comentarios-form',
	'enableAjaxValidation'=>false,
)); ?>
	<?php echo $form->errorSummary($model2); ?>

	<div class="row">
		<?php echo $form->labelEx($model2,'c_body'); ?>
                <?php echo $form->hiddenField($model2,'comentario_thread_id',array('value'=>$ch->nombre_thread)); ?>
		<?php echo $form->textArea($model2,'c_body',array('rows'=>6, 'cols'=>50,'class'=>'txtcoment span8 comment-input','placeholder'=>'Your message ...')); ?>
		<?php echo $form->error($model2,'c_body'); ?>
	</div>          
            
	<div class="row buttons">
		<?php echo CHtml::submitButton($model2->isNewRecord ? 'Enviar Comentario' : 'Save',array('class'=>'btn btn-custom btn-red btn-medium btn-large-text')); ?>
	</div>

<?php $this->endWidget(); ?>
          </div>
    </div>
</div>
<?php
    $this->beginWidget('zii.widgets.jui.CJuiDialog',array(
         'id'=>'mydialog',
         // additional javascript options for the dialog plugin
         'options'=>array(
             'title'=>'Subir Imagen',
            'autoOpen'=>false,             
         ),
     ));
    ?>
   <span class="btn btn-success fileinput-button">
   <i class="glyphicon glyphicon-plus"></i>
   <span>Seleccionar Imagen</span>
   <!-- The file input field used as target for the file upload widget -->   
   <?php echo CHtml::beginForm($this->createUrl("comentarios/imagen"),"POST",array('enctype'=>"multipart/form-data")); ?> 
    <input id="fileupload" type="file" name="files[]" multiple> 
    <?php echo CHtml::endForm(); ?>
   </span> 
   <?php 
     $this->endWidget('zii.widgets.jui.CJuiDialog');     
     ?>
<?php }else{ ?>
<div class="buttons-container">
 <?php echo CHtml::link("Para comentar debes registrarte", $this->createAbsoluteUrl("usuario/create"), array('class'=>'btn btn-custom btn-red btn-custom-large'));?>
    <?php echo CHtml::link("Si ya tienes una cuenta Ingresa", $this->createAbsoluteUrl("site/login"), array('class'=>'btn btn-custom btn-teal btn-custom-large'));?>
</div>
<?php } ?>
<!-- comentarios -->
<?php $citerio = new CDbCriteria(array(
                'order'=>'c_date desc',
                'condition'=>"padre_comentario_id IS NULL and comentario_thread_id = '".$model->comentariohilo->nombre_thread."'"
            ));
 $dataProvider=new CActiveDataProvider('Comentarios',array('criteria'=>$citerio));
?>
<?php $this->widget('zii.widgets.CListView', array(
        'id'=>'lcmt',
	'dataProvider'=>$dataProvider,
        'htmlOptions'=>array('class'=>'comments row'),
        'template'=>'{summary}{pager}{sorter}{items}<div style="clear:both;"></div>{pager}',
        'itemsCssClass'=>'span8',
	'itemView'=>'_coments',
)); ?>


