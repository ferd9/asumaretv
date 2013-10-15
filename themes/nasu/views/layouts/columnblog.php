<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="content span9 blog-page" id="content">
	<?php echo $content; ?>
</div><!-- content -->
<aside class="span3 last">
	<div id="sidebar" class="widget">
	<?php
		$this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'Operations',
                        'htmlOptions'=>array('class'=>'widget'),
		));
		$this->widget('zii.widgets.CMenu', array(
			'items'=>$this->menu,
			'htmlOptions'=>array('class'=>'widget'),
		));
		$this->endWidget();
	?>
	</div><!-- sidebar -->
</aside>
<?php $this->endContent(); ?>
