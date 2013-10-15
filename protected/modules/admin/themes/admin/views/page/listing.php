<div class="box">
    <header class="dark">
        <div class="icons"><i class="icon-file-text-alt"></i></div>
        <h5>Pages <small>(<?php echo count($pages) ?> found)</small></h5>
        <a href="<?php echo $this->createUrl('page/add') ?>" class="pull-right btn btn-primary pull-right"><i class="icon-white icon-plus"></i> Add New</a>
    </header>

    <table class="table table-striped table-bordered table-condensed">
        <tr>
            <?php
            $table_head = array(
                'page.id' => 'ID',
                'page.title' => 'Title',
                'page.slug' => 'Slug',
                'position',
                'page.weight' => 'Weight',
                'page.created_at' => 'Created At',
            );

            echo Utility::tableHead('admin/page/index', $table_head);
            ?>
            <th>Action</th>
        </tr>
        <?php foreach ($pages as $page): ?>
            <tr>
                <td><?php echo $page->page_id ?></td>
                <td><?php echo CHtml::encode($page->title) ?></td>
                <td><?php echo CHtml::encode($page->slug) ?></td>
                <td><?php echo CHtml::encode($page->position->position) ?></td>
                <td class="center"><?php echo $page->weight ?></td>
                <td class="center"><?php echo $page->created_at ?></td>
                <td>
                    <a class="ttip" data-original-title="edit" href="<?php echo $this->createUrl('page/edit', array('id' => $page->page_id)) ?>"><i class="icon-pencil"></i></a>
                    <a class="ttip" data-original-title="click to <?php echo $page->is_active ? 'deactivate' : 'activate' ?>" href="<?php echo $this->createUrl('page/' . ($page->is_active ? 'deactivate' : 'activate'), array('id' => $page->page_id)) ?>"><i class="<?php echo $page->is_active ? 'icon-eye-open' : 'icon-eye-close' ?>"></i></a>
                    <a class="ttip" data-original-title="delete" href="<?php echo $this->createUrl('page/delete', array('id' => $page->page_id)) ?>"><i class="icon-remove"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

