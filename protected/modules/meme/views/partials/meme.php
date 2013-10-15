<?php $memeUrl = $meme->post_url ?>
<div class="corgi_feed_well">
    <div class="feed_stacked">
        <div class="feed_item meme">
            <div class="feed_body">
                <div class="row">
                    <div class="feed_profile_pic">
                        <a href="<?php echo Yii::app()->createUrl('meme/default/profile', array('profile' => $meme->user->username)) ?>"><img src="<?php echo Yii::app()->user->getAvatar_url($meme->user_fk) ?>" alt="<?php echo CHtml::encode("{$meme->user->apellido_p} {$meme->user->apellido_m}") ?>" title="<?php echo CHtml::encode("{$meme->user->apellido_p} {$meme->user->apellido_m}") ?>" class="meta_image ttip" /></a>
                    </div>
                    <span class="timesago"><?php echo Yii::app()->format->formatTimeago($meme->created_at) ?></span>
                    <div class="feed_text text-center">
                        <h3><a href="<?php echo $memeUrl ?>"><?php echo CHtml::encode($meme->title) ?></a></h3>
                        <a href="<?php echo $memeUrl ?>"><img class="meme-img" src="<?php echo $meme->url ?>" alt="<?php echo CHtml::encode($meme->title) ?>" /></a>
                    </div>
                </div>
            </div>
            <hr class="feed_hr">
            <div class="meme-menu">
                <div class="social-share clearfix" data-url="<?php echo $memeUrl ?>" data-text="<?php echo CHtml::encode($meme->title) ?>" data-title="share"></div>
                <a class="meme-menu-btn ttip like-btn <?php echo Meme::hasLiked($meme) ? 'liked' : '' ?>  <?php echo Yii::app()->user->isGuest ? 'login-modal" data-toggle="modal" data-target="#login-modal"' : '"' ?> title="<span style='white-space:nowrap;'><?php echo $meme->likes_count . ' ' . Yii::t('yii', 'like(s)') ?></span>" data-meme-id="<?php echo $meme->meme_id ?>" href="javascript:;"><i class="icon-heart-empty"></i></a>
                <a class="fb-comment-btn meme-menu-btn" data-meme-id="<?php echo $meme->meme_id ?>" href="<?php echo $memeUrl ?>"><i class="icon-comments"></i></a>
                <a class="meme-menu-btn ttip" title="<span style='white-space:nowrap;'><?php echo Yii::t('yii', 'Remix this') ?></span>" data-meme-id="<?php echo $meme->meme_id ?>" href="<?php echo Yii::app()->createUrl('/meme/generate/index', array('meme' => $meme->meme_id)) ?>"><i class="icon-random"></i></a>
                <?php if($meme->user_fk == Yii::app()->user->id): ?>
                    <a class="delete-meme-btn meme-menu-btn ttip" title="<?php echo Yii::t('yii', 'delete') ?>" data-meme-id="<?php echo $meme->meme_id ?>" href="<?php echo Yii::app()->createUrl('site/delete', array('id' => $meme->meme_id)) ?>"><i class="icon-trash"></i></a>
                <?php endif ?>
            </div>
            <?php if(!Yii::app()->user->isGuest && !Meme::hasFlagged($meme->meme_id)): ?>
                <a class="ttip mark-flag no-underline" title="<?php echo Yii::t('yii', 'mark as inappropriate') ?>" href="<?php echo Yii::app()->createUrl('meme/default/flag', array('id' => $meme->meme_id)) ?>"><i class="icon-flag"></i> Report</a>
            <?php endif ?>
        </div>
    </div>
</div>

<div id="login-modal" class="modal hide fade">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    </div>
    <div class="modal-body" id="login-modal-content" style="margin-left:45px;">

    </div>
    <div class="modal-footer">
        <a href="#" data-dismiss="modal" class="btn">Close</a>
    </div>
</div>

<?php 
    $js = <<<JS
    $('.fb-comment-btn').click(function(){
        if(!$(this).hasClass('fb-comments-init')) {
            var href = $(this).attr('href');
            var uniqid = 'fb-comments-' + _.uniqueId();
            $(this).parent().parent().append('<div id="'+ uniqid +'"><div class="fb-comments" data-href="' + href + '" data-width="620" data-num-posts="10"></div></div>');
            FB.XFBML.parse(document.getElementById(uniqid));
            $(this).addClass('fb-comments-init');
        }
        else {
            $(this).parent().parent().find('.fb-comments').toggle();
        }
        var comments = $(this).parent().parent().find('.fb-comments');   
        $("html, body").animate({ scrollTop: comments.offset().top - 100}, 400);
            
        return false;
    });
JS;
    Yii::app()->clientScript->registerScript('fb-comment-btn', $js, CClientScript::POS_END);
    
    if($single) {
    
    	$this->extra[] = '<link rel="image_src" href="' . $meme->url . '" />';
    	$this->og_image = $meme->url;
    	$this->og_url = $memeUrl;
    	$this->og_title = CHtml::encode($meme->title);
    
        Yii::app()->clientScript->registerScript('fb-comment-btn-click', <<<JS
                $('.fb-comment-btn').parent().parent().append('<div id="fb-comments-1"><div class="fb-comments" data-href="' + $('.fb-comment-btn').attr('href') + '" data-width="620" data-num-posts="10"></div></div>');
                $('.fb-comment-btn').addClass('fb-comments-init');
JS
    , CClientScript::POS_END);
    }
    
    $url = Yii::app()->createUrl('/meme/default');
    
    if(!Yii::app()->user->isGuest) {
        $js = <<<JS
        $('.like-btn').click(function(){
            if($(this).hasClass('liking')) {
                return false;
            }

            $(this).addClass('liking');
            var self = this;
            var isLiked = $(this).hasClass('liked');
            var meme_id = $(this).data('meme-id');
            var url =  '$url' + (isLiked ? '/memeunlike' : '/memelike');

            $.get(url, {id: meme_id}, function() {
                $(self).removeClass('liking');
            }, 'json');

            if(isLiked) {
                $(this).removeClass('liked');
            }
            else {
                $(this).addClass('liked');
            }
        });
JS;
        Yii::app()->clientScript->registerScript('like-btn', $js, CClientScript::POS_END);
    }
    else {
        Yii::app()->clientScript->registerScript('login-modal', <<<JS
                $.get('$url/login', function(content){
                    $('#login-modal-content').html(content);
                });
JS
        , CClientScript::POS_END);
    }
    
    
    Yii::app()->clientScript->registerScript('mark-flag', <<<JS
        $('.mark-flag').click(function(){
            var href = $(this).attr('href');
            var self = this;
            $.get(href,function(){
                $(self)
                    .fadeOut();
            });
            return false;
        });
JS
    , CClientScript::POS_END);
?>