<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="content span8" id="content">
	<?php echo $content; ?>
</div><!-- content -->
<aside class="span4">
	<div class="widget">
                    <div class="inner inner-sides">
                        <div class="social-counter">
                        <div class="counter first-child">
                            <a class="facebook" href="http://www.facebook.com/asumaretvoficial"><div class="inner-counter"><i></i> 432k</div></a>
                        </div>
                        <div class="counter">
                            <a class="twitter" href="http://twitter.com/asumaretv"><div class="inner-counter"><i></i> 64k</div></a>
                        </div>
                        <div class="counter last-child">
                            <a class="rss" href="#"><div class="inner-counter"><i></i> 128k</div></a>
                        </div>
                        </div>
                    </div>
                </div>
    <div class="widget">
        <div class='inner'>
            <h3>Follow us on Facebook</h3>
            <div class="follow-us">
                <iframe src="http://www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2Fasumaretvoficial&amp;width=292&amp;height=258&amp;show_faces=true&amp;colorscheme=light&amp;stream=false&amp;border_color=%23fff&amp;header=false&amp;appId=384801171631260" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:292px; height:258px;" allowTransparency="true"></iframe>
            </div>
        </div>
      </div>
    <div class='widget'>
        <div class='inner'>
            <h3>News in Pictures</h3>
            <div class='photo-list'>
                <?php $criteria = new CDbCriteria();
                       $criteria->condition = "eliminado = 0 and featured=1" ;
                       $criteria->order = "fecha desc";
                       $criteria->limit = 15;
                       $imgDestacdas = Imagen::model()->findAll($criteria);
                       foreach ($imgDestacdas as $destacado) {
                        ?>
                <div class='photo'>
                    <a href="<?php echo Yii::app()->request->baseUrl."/".$destacado->url;?>" rel='prettyPhoto[news-in-pictures]' data-toggle="tooltip" title="iPhone 5 released by Apple">
                        <img src="<?php echo Yii::app()->request->baseUrl."/".$destacado->thumbnail;?>" alt="News in pictures" />
                    </a>
                </div>
                
                
                <?php } ?>
            </div>             
        </div>
    </div>
    
     <div class='widget'>
        <div class='inner'>
            <h3>Featured video</h3>
            <div class="featured-video">
                <iframe width="560" height="315" src="http://www.youtube.com/embed/nKIu9yen5nc" frameborder="0" allowfullscreen></iframe>
            </div>
        </div>
    </div>
</aside><!-- content -->
<?php $this->endContent(); ?>