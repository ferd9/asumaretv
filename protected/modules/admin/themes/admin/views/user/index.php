<?php
$this->breadcrumbs = array(
    'User' => array('/admin/user'),
);
?>

<div class="box">
    <div class="body">
        <header class="clearfix">
            <div class="icons"><i class="icon-user"></i></div>
            <h5 class="pull-left">Users List <small>(<?php echo $pages->getItemCount() ?> found)</small></h5>
            <a href="<?php echo $this->createUrl('user/export') ?>" class="btn btn-primary pull-right btn-top-right"><i class="icon-download icon-white"></i> Export</a>
        </header>

        <table class="table table-striped table-bordered table-condensed">
            <tr>
                <?php
                $table_head = array(
                    'user.username' => 'Username',
                    'user.first_name' => 'First Name',
                    'user.last_name' => 'Last Name',
                    'user.email' => 'E-mail',
                    'user.created_at' => 'Registered At',
                );


                echo Utility::tableHead('admin/user/index', $table_head);
                ?>
                <th>Action</th>
            </tr>
            <?php if ($users): ?>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?php echo CHtml::encode($user->username) ?></td>
                        <td><?php echo CHtml::encode($user->first_name) ?></td>
                        <td><?php echo CHtml::encode($user->last_name) ?></td>
                        <td><?php echo CHtml::encode($user->email) ?></td>
                        <td><?php echo $user->created_at ?></td>
                        <td>
                            <a class="ttip" title="<?php echo $user->is_active ? 'click to inactivate' : 'click to activate' ?>" href="<?php echo Yii::app()->createUrl('/admin/user/activate', array('id' => $user->user_id, 'value' => !$user->is_active)) ?>"><i class="<?php echo $user->is_active ? 'icon-check-sign' : 'icon-minus-sign-alt' ?>"></i></a>
                            <a class="ttip del-btn" title="delete" href="<?php echo Yii::app()->createUrl('/admin/user/delete', array('id' => $user->user_id)) ?>"><i class="icon-remove"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7">No users found!</td>
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