<?php
/* @var $this ImagenController */
/* @var $data Imagen */
?>

<div class="span3 item-thumb" style="margin-left: 10px;">
    <div class="thumbnail">
      <img class="imgbox img-rounded" data-src="holder.js/300x200" src="<?php echo Yii::app()->request->baseUrl."/".CHtml::encode($data->thumbnail); ?>" alt="...">
      <div class="caption">
        <h5><?php echo CHtml::encode($data->nombre); ?></h5>
        <p><?php echo CHtml::encode($data->descripcion); ?></p>
        <p><a href="<?php echo Yii::app()->request->baseUrl.CHtml::encode($data->url); ?>" class="btn btn-mini cblink" title="test demos"><i class="icon-zoom-in"></i></a><a href="<?php echo $this->createAbsoluteUrl("view",array('id'=>$data->idImagen)); ?>" class="btn btn-mini" title="test demos" target="_blank"><i class="icon-eye-open"></i></a></p>
      </div>
    </div>
  </div>


<?php /*

	<b><?php echo CHtml::encode($data->getAttributeLabel('idImagen')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idImagen), array('view', 'id'=>$data->idImagen)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombre')); ?>:</b>
	<?php echo CHtml::encode($data->nombre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idusuario')); ?>:</b>
	<?php echo CHtml::encode($data->idusuario); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombre_original')); ?>:</b>
	<?php echo CHtml::encode($data->nombre_original); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('extension')); ?>:</b>
	<?php echo CHtml::encode($data->extension); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('url')); ?>:</b>
	<?php echo CHtml::encode($data->url); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tipo')); ?>:</b>
	<?php echo CHtml::encode($data->tipo); ?>
	<br />

	
	<b><?php echo CHtml::encode($data->getAttributeLabel('alto')); ?>:</b>
	<?php echo CHtml::encode($data->alto); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ancho')); ?>:</b>
	<?php echo CHtml::encode($data->ancho); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('thumbnail')); ?>:</b>
	<?php echo CHtml::encode($data->thumbnail); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idcategoria')); ?>:</b>
	<?php echo CHtml::encode($data->idcategoria); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('etiquetas')); ?>:</b>
	<?php echo CHtml::encode($data->etiquetas); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha')); ?>:</b>
	<?php echo CHtml::encode($data->fecha); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('eliminado')); ?>:</b>
	<?php echo CHtml::encode($data->eliminado); ?>
	<br />

	*/ ?>

