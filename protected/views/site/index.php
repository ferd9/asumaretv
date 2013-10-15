<?php
/* @var $this SiteController */
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl."/js/jquery.flexslider.js", CClientScript::POS_HEAD);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl."/js/jquery.prettyPhoto.js", CClientScript::POS_HEAD);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl."/js/tinynav.min.js", CClientScript::POS_HEAD);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl."/js/jquery.placeholder.min.js", CClientScript::POS_HEAD);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl."/js/main.js", CClientScript::POS_HEAD);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl."/js/jquery.ticker.js", CClientScript::POS_HEAD);
$this->pageTitle=Yii::app()->name;
?>
<div class="row">   
<div class="span8 article-showcase hidden-phone">
    <div class="inner-border">
        <div class="half">
            <?php for($i=0;$i<count($models);$i++){?>
            <div rel="<?php echo $i+1; ?>" class="big-article <?php echo ($i == count($models)-1?"active":"");?>" style="display: <?php echo ($i == count($models)-1?"block;":"none;");?>;">
                <div class="title">
                    <span><a href="blog.html"><?php echo $models[$i]->post_title;?></a></span>
                </div>
                <figure>                   
                    <?php echo CHtml::image($models[$i]->post_thumb);?>
                </figure>
                <div class="main-text">
                    <div class="inner">
                        <span class="article-info">32 comments, 07/23/2012, by Aleks Ivic</span>
                        <p>
                            <?php echo $models[$i]->post_descripcion;?>
                            <a href="#">Read more...</a></p>
                    </div>
                </div>
            </div>
            <?php } ?>   
        </div>
        <div class="half">
            <div class="inner-left-border">
                <?php for($i=0;$i<count($models);$i++){?>
                <article rel="<?php echo $i+1; ?>" class="<?php echo ($i == 0?"first-child":"");?> <?php echo ($i == count($models)-1?"active":"");?>">
                    <figure>
                        <?php echo CHtml::image($models[$i]->post_thumb);?>
                    </figure>
                    <div class="text">
                        <h3><?php echo $models[$i]->post_title;?></h3>
                        <span class="info">06/05/2012, 16 comments</span>
                    </div>
                </article>
                <?php } ?>                  
            </div>
        </div>
    </div>
</div>
<div class="span4 article-box">
    <div class="box-title">
        <h2>Latest News </h2>
        <div class="title-line"></div>
    </div>
    <?php for($i=0;$i<count($models);$i++){?>
    <article <?php echo ($i == 0?"class = 'first-child'":'');?>>
        <figure>
            <?php echo CHtml::image($models[$i]->post_thumb);?>
        </figure>
        <div class="text">
            <h3><a href="blog.html"><?php echo $models[$i]->post_title;?></a></h3>
            <span class="info">06/05/2012, 16 comments</span>
        </div>
    </article>
    <?php } ?>
</div>
<div class='span4 article-box'>
    <div class='box-title'>
        <h2>Entertainment</h2>
        <div class='title-line'></div>
    </div>
    <div class='articles-slider' id="entertainment-slider">
        <ul class='slides'>
           <?php for($i=0;$i<count($models);$i+=3){?> 
           <li> 
                   <div class='main-article'>
                       <div class='title'>
                           <span><a href="blog.html"><?php echo $models[$i]->post_title;?></a></span>
                       </div>
                       <figure>
                           <?php echo CHtml::image($models[$i]->post_thumb);?>
                       </figure>
                       <div class='main-text'>
                            <div class='inner'>
                                <span class='article-info'>32 comments, 07/23/2012, by Aleks Ivic</span>
                                <p>
                                    <?php echo $models[$i]->post_descripcion;?>
                                    <a href='blog.html'>Read more...</a></p>
                            </div>
                       </div>
                   </div>   
                   <?php if(isset($models[$i+1])) { ?>
                   <article>
                       <figure>
                           <?php echo CHtml::image($models[$i+1]->post_thumb);?>
                       </figure>
                       <div class='text'>
                           <h3><a href="blog.html"><?php echo $models[$i+1]->post_title;?></a></h3>
                           <span class='info'>06/05/2012, 16 comments</span>
                       </div>
                   </article> 
                   <?php } ?>
                  <?php if(isset($models[$i+2])) { ?>
                   <article>
                       <figure>
                           <?php echo CHtml::image($models[$i+2]->post_thumb);?>
                       </figure>
                       <div class='text'>
                           <h3><a href="blog.html"><?php echo $models[$i+2]->post_title;?></a></h3>
                           <span class='info'>06/05/2012, 16 comments</span>
                       </div>
                   </article>  
                   <?php } ?>
               </li> 
           <?php } ?>
           
        </ul>
    </div>
</div>

</div>

