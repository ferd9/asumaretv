<?php
$this->breadcrumbs = array(
    'Meme' => array('/admin/meme'),
);
?>

<div class="box">
    <div class="body">
        <header class="clearfix">
            <div class="icons"><i class="icon-picture"></i></div>
            <h5 class="pull-left">Memes List <small>(<?php echo $pages->getItemCount() ?> found)</small></h5>
        </header>

        <table class="table table-striped table-bordered table-condensed">
            <tr>
                <?php
                $table_head = array(
                    'Meme',
                    'meme.title' => 'Title',
                    'meme.likes_count' => 'Likes',
                    '{remix_order}' => 'Remixes',
                    '{flagged_order}' => 'Reported Times',
                    'user.username' => 'Username',
                    'meme.created_at' => 'Created At',
                );


                echo Utility::tableHead('admin/meme/index', $table_head);
                ?>
                <th>Action</th>
            </tr>
            <?php if ($memes): ?>
                <?php foreach ($memes as $meme): ?>
                    <tr>
                        <td style="width:150px;vertical-align: middle;text-align:center;">
                            <a data-toggle="modal" data-big-img='<?php echo $meme->url ?>' data-original-title="Meme" data-placement="bottom" rel="tooltip" class="preview-meme" href="#memeModal">
                                <img src="<?php echo $meme->thumb_url ?>" alt="<?php echo CHtml::encode($meme->title) ?>" />
                            </a>
                        </td>
                        <td style="vertical-align: middle;text-align:center;"><?php echo CHtml::encode($meme->title) ?></td>
                        <td style="vertical-align: middle;text-align:center;"><?php echo CHtml::encode($meme->likes_count) ?></td>
                        <td style="vertical-align: middle;text-align:center;"><?php echo CHtml::encode($meme->remixes_count) ?></td>
                        <td style="vertical-align: middle;text-align:center;"><?php echo CHtml::encode($meme->flagged_times) ?></td>
                        
                        <td style="vertical-align: middle;text-align:center;"><?php echo CHtml::encode($meme->user->username) ?></td>
                        <td style="vertical-align: middle;text-align:center;"><?php echo $meme->created_at ?></td>
                        <td style="vertical-align: middle;text-align:center;">
                            <a class="ttip" title="<?php echo $meme->is_featured ? 'click to unfeatured' : 'click to featured' ?>" href="<?php echo Yii::app()->createUrl('/admin/meme/featured', array('id' => $meme->meme_id, 'value' => !$meme->is_featured)) ?>"><i class="<?php echo $meme->is_featured ? 'icon-star' : 'icon-star-empty' ?>"></i></a>
                            <a class="ttip" title="<?php echo $meme->is_published ? 'click to unpublish' : 'click to publish' ?>" href="<?php echo Yii::app()->createUrl('/admin/meme/publish', array('id' => $meme->meme_id, 'value' => !$meme->is_published)) ?>"><i class="<?php echo $meme->is_published ? 'icon-eye-open' : 'icon-eye-close' ?>"></i></a>
                            <a class="ttip" title="<?php echo $meme->is_active ? 'click to inactivate' : 'click to activate' ?>" href="<?php echo Yii::app()->createUrl('/admin/meme/activate', array('id' => $meme->meme_id, 'value' => !$meme->is_active)) ?>"><i class="<?php echo $meme->is_active ? 'icon-check-sign' : 'icon-minus-sign-alt' ?>"></i></a>
                            <a class="ttip del-btn" title="delete" href="<?php echo Yii::app()->createUrl('/admin/meme/delete', array('id' => $meme->meme_id)) ?>"><i class="icon-remove"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7">No memes found!</td>
                </tr>
            <?php endif; ?>
        </table>

        <div class="clearfix">
            <div class="dataTables_paginate paging_bootstrap pagination pull-right">
                <?php
                $this->widget('CLinkPager', array(
                    'pages' => $pages,
                    'previousPageCssClass' => 'prev',
                    'selectedPageCssClass' => 'active',
                    'hiddenPageCssClass' => 'disabled',
                    'header' => '',
                    'htmlOptions' => array(
                        'class' => '',
                    ),
                ))
                ?>
            </div>
        </div>
    </div>
</div>

<div id="memeModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="memeModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="memeModalLabel"><i class="icon-picture"></i> Meme</h3>
    </div>
    <div class="modal-body">
        <p style="text-align:center;">
            <img src="" id="meme-image-big" />
        </p>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    </div>
</div>

<script>
    $('.preview-meme').click(function(){
        var bigImg = $(this).data('big-img');
        $('#meme-image-big').attr('src', bigImg);
        $('#memeModal').modal('show');
        return false;
    });
    
    $('#memeModal').modal({
        show: false
    });
</script>