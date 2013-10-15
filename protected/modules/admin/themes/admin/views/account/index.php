<?php
$this->breadcrumbs = array(
    $this->module->id,
);
$this->registerFlot();
?>
<div class="box">
    <div class="tac">
        <ul class="stats_box">
            <li>
                <div class="sparkline pie_approved"></div>
                <div class="stat_text">
                    <strong><?php echo $total_memes - $unapproved_memes ?></strong>Memes Approved
                    <span class="percent"> <?php echo $total_memes - $unapproved_memes ?>/<?php echo $total_memes ?></span>
                </div>
            </li>
            <li>
                <div class="sparkline pie_published"></div>
                <div class="stat_text">
                    <strong><?php echo $total_memes - $unpublished_memes ?></strong>Memes Published
                    <span class="percent"> <?php echo $total_memes - $unpublished_memes ?>/<?php echo $total_memes ?></span>
                </div>
            </li>
            <li>
                <div class="sparkline pie_users"></div>
                <div class="stat_text">
                    <strong><?php echo $total_users - $inactive_users ?></strong>Verified Users
                    <span class="percent"> <?php echo $total_users - $inactive_users ?>/<?php echo $total_users ?></span>
                </div>
            </li>
        </ul>
    </div>

    <hr />


    <header>
        <h5>Recent 5 Users:</h5>
    </header>
    <table class="table table-striped">
        <tr>
            <th>Username</th>
            <th>First name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Registered on</th>
        </tr>
        <?php if ($recent_5_users): ?>
            <?php foreach ($recent_5_users as $user): ?>
                <tr>
                    <td><?php echo CHtml::encode($user->username) ?></td>
                    <td><?php echo CHtml::encode($user->apellido_p) ?></td>
                    <td><?php echo CHtml::encode($user->apellido_m) ?></td>
                    <td><?php echo CHtml::encode($user->email) ?></td>
                    <td><?php echo CHtml::encode($user->fechareg) ?></td>
                </tr>
            <?php endforeach ?>
        <?php else: ?>
            <tr>
                <td colspan="5">No registered user</td>
            </tr>
        <?php endif ?>
    </table>
</div>


<script>
    $(".sparkline.pie_approved").sparkline([<?php echo $total_memes - $unapproved_memes ?>, <?php echo $unapproved_memes ?>], {
        type: 'pie',
        width: '40',
        height: '40',
        sliceColors: ['#539E47','#FB392F'],
        tooltipFormatter: function(a,b,c){
            return c.value + ' memes ' + (['approved', 'unapproved'][c.offset]);
        }
    });
    $(".sparkline.pie_published").sparkline([<?php echo $total_memes - $unpublished_memes ?>, <?php echo $unpublished_memes ?>], {
        type: 'pie',
        width: '40',
        height: '40',
        sliceColors: ['#539E47','#FB392F'],
        tooltipFormatter: function(a,b,c){
            return c.value + ' memes ' + (['published', 'unpublished'][c.offset]);
        }
    });
    $(".sparkline.pie_users").sparkline([<?php echo $total_users - $inactive_users ?>, <?php echo $inactive_users ?>], {
        type: 'pie',
        width: '40',
        height: '40',
        sliceColors: ['#539E47','#FB392F'],
        tooltipFormatter: function(a,b,c){
            return c.value + ([' verified', ' unverified'][c.offset]) + ' users ';
        }
    });
</script>