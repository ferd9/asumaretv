<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
	<div class="content span9"  id="content">
		<?php echo $content; ?>
	</div><!-- content -->

<aside class="span3 last">
        <?php if(Yii::app()->user->id == "ferd9"){?>
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
        <?php } ?>
        
        <div class="widget">
                        <h3>Consejos Para un buen Post</h3>
                        <ol class="custom-ordered-list">
                            <li>
                                <span class="number-style"><i class="icon-ok"></i></span>
                                <span class="text">
                                    Que sea descriptivo.
                                </span>
                            </li>
                            <li>
                                <span class="number-style"><i class="icon-remove"></i></span>
                                <span class="text">
                                    TODO EN MAYÚSCULA
                                </span>
                            </li>
                            <li>
                                <span class="number-style"><i class="icon-remove"></i></span>
                                <span class="text">
                                    Poca calidad (una imagen, texto pobre)
                                </span>
                            </li>
                            <li>
                                <span class="number-style"><i class="icon-remove"></i></span>
                                <span class="text">
                                    Insultos o malos modos.
                                </span>
                            </li>
                            <li>
                                <span class="number-style"><i class="icon-remove-sign"></i></span>
                                <span class="text">
                                    <span class="red-text">Completamente Prohibido!</span> Fotos de personas menores de edad.
                                </span>
                            </li>
                        </ol>
                    </div>
</aside>
<?php $this->endContent(); ?>