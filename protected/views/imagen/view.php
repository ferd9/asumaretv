<?php
/* @var $this ImagenController */
/* @var $model Imagen */
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/asucss.css','all');
$this->breadcrumbs=array(
	'Imagens'=>array('index'),
	$model->idImagen,
);

$this->menu=array(
	array('label'=>'List Imagen', 'url'=>array('index')),
	array('label'=>'Create Imagen', 'url'=>array('create')),
	array('label'=>'Update Imagen', 'url'=>array('update', 'id'=>$model->idImagen)),
	array('label'=>'Delete Imagen', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idImagen),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Imagen', 'url'=>array('admin')),
);
?>

<h1>View Imagen #<?php echo $model->idImagen; ?></h1>
<article>
                    <h1 class='title'><?php echo $model->nombre_original;?></h1>
                    
                        <div class="text-center">
                            <img class="img-rounded" src="<?php echo Yii::app()->request->baseUrl."/".CHtml::encode($model->url); ?>" alt="Winter in New York">
                        </div>
                    
                    <div class='blog-content'>
                        <div class='info'>
                            <a href="#">3 comments</a>,
                            <span class='date'>08/25/2012</span>, by
                            <a href="#">Aleks Ivic</a>, in
                            <a href="#" class='dark'>Weather</a>
                        </div>
                        <p>
                            <?php echo CHtml::encode($model->descripcion);?>
                        </p>
                       
                        <div class="tag-container">
                            <div class='tag-title'>Tags: </div>
                            <?php $tags = $model->getTags();
                            foreach ($tags as $tag) { ?>
                            <a class='tag' href="<?php echo $this->createUrl("tag", array('search'=>$tag))?>"><?php echo $tag;?></a>
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
                            </div>
                            <script type="text/javascript" src="../../../s7.addthis.com/js/300/addthis_widget.js#pubid=xa-5133cbfc3c9054b8"></script>
                            <!-- AddThis Button END -->
                        </div>
                    </div>
                </article>
 <div class="row">
    <div class='related-news span8'>
        <?php $imgRelacionados = $model->getPostRelacionados();?>
        <div class='inner-box'>
           <h1 class='title'>Imagenes Similares</h1>
        <?php foreach ($imgRelacionados as $relacionados) { ?>
           <div class="column">
                <div class='inner'>
                    <a href="<?php echo $this->createUrl("view", array('id'=>$relacionados->idImagen));?>" class="thumbnail">
                        <figure class="imgr">
                            <img data-src="<?php echo Yii::app()->request->baseUrl;?>/js/holder.js/150x120" src="<?php echo Yii::app()->request->baseUrl."/".$relacionados->thumbnail; ?>" alt="">
                        </figure>
                        <div class='title'><?php echo $relacionados->descripcion;?></div>
                        <div class='date'>September 10, 2012</div>
                    </a>
                </div>
            </div>        
        <?php } ?>
        </div>
    </div>
    </div>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'idImagen',
		'nombre',
		'idusuario',
		'nombre_original',
		'extension',
		'url',
		'tipo',
		'alto',
		'ancho',
		'thumbnail',
		'idcategoria',
		'etiquetas',
		'fecha',
		'eliminado',
	),
)); ?>
