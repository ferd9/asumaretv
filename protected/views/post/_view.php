<?php
/* @var $this PostController */
/* @var $data Post */
?>

<article>
    <div class='inner'>
        <figure>
              <?php echo CHtml::link(CHtml::image($data->post_thumb))?>
        </figure>
        <div class='text'>
            <div class='inner-border'>
                <div class="title"><?php echo CHtml::link($data->post_title,$this->createUrl("post/view", array('categoria'=>$data->categoria->c_seo,'id'=>$data->post_id,'t'=>  Util::eliminarSignos($data->post_title))));?></div>
                <div class='description'>
                    <div class='date'><?php                     
                    echo Comentarios::model()->count("comentario_thread_id='".$data->comentariohilo->nombre_thread."'");?> comentarios, <?php echo date('d/m/Y', $data->post_date);?>, Por <?php echo $data->usuario->username?></div>
                    <div class='excerpt'>
                        <p>
                            <?php echo $data->post_descripcion; ?>&nbsp;<a href="<?php echo $this->createUrl("post/view", array('categoria'=>$data->categoria->c_seo,'id'=>$data->post_id,'t'=>  Util::eliminarSignos($data->post_title)));?>">Leer Mas...</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
       
    </div>
</article>