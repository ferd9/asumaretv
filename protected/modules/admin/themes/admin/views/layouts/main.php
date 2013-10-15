<?php
/* @var $this Controller */
?>
<!DOCTYPE html>
<!--[if lt IE 7]>       <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>          <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>          <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->  <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <meta name="description" content="Metis: Bootstrap Responsive Admin Theme">
        <meta name="viewport" content="width=device-width">

        <?php
        Yii::app()->clientScript
                ->registerCoreScript('jquery')
                ->registerCssFile(Yii::app()->theme->baseUrl . '/css/bootstrap.min.css')
                ->registerCssFile(Yii::app()->theme->baseUrl . '/css/bootstrap-responsive.min.css')
                ->registerCssFile(Yii::app()->theme->baseUrl . '/Font-awesome/css/font-awesome.min.css')
                ->registerCssFile(Yii::app()->theme->baseUrl . '/css/style.css')
                ->registerCssFile(Yii::app()->theme->baseUrl . '/css/theme.css')
                ->registerScriptFile(Yii::app()->theme->baseUrl . '/js/vendor/modernizr-2.6.2-respond-1.1.0.min.js')
                ->registerScriptFile(Yii::app()->theme->baseUrl . '/js/lib/jquery.tablesorter.min.js')
                ->registerScriptFile(Yii::app()->theme->baseUrl . '/js/lib/jquery.mousewheel.js')
                ->registerScriptFile(Yii::app()->theme->baseUrl . '/js/lib/jquery.sparkline.min.js')
                ->registerScriptFile(Yii::app()->theme->baseUrl . '/js/vendor/bootstrap.min.js')
        ?>


        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
        <!--[if IE 7]>
        <link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl ?>/module-assests/admin/Font-awesome/css/font-awesome-ie7.min.css"/>
        <![endif]-->
    </head>
    <body class="<?php echo!Yii::app()->user->is_admin ? 'wide hide-sidebar' : '' ?>"><!-- class="mini-sidebar" for compact sidebar -->
        <!-- #wrap -->
        <div id="wrap">
            <!-- #top -->
            <div id="top">
                <!-- .navbar -->
                <div class="navbar navbar-inverse navbar-static-top">
                    <div class="navbar-inner">
                        <div class="container-fluid">
                            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </a>
                            <a class="brand" href="<?php echo Yii::app()->createUrl('admin') ?>">Admin - <?php echo Yii::app()->name ?></a> <!-- .topnav -->
                            <div class="btn-toolbar topnav">
                                <!--                                <div class="btn-group">
                                                                    <a class="btn btn-inverse" rel="tooltip" data-original-title="E-mail" data-placement="bottom">
                                                                        <i class="icon-envelope"></i>
                                                                        <span class="label label-warning">5</span>
                                                                    </a>
                                                                    <a class="btn btn-inverse" rel="tooltip" href="#" data-original-title="Messages"
                                                                       data-placement="bottom">
                                                                        <i class="icon-comments"></i>
                                                                        <span class="label label-important">4</span>
                                                                    </a>
                                                                </div>-->
                                <?php if (Yii::app()->user->is_admin): ?>
                                    <div class="btn-group">
                                        <a class="btn btn-inverse" data-placement="bottom" data-original-title="Logout" rel="tooltip"
                                           href="<?php echo Yii::app()->createUrl('/admin/account/logout') ?>"><i class="icon-off"></i></a>
                                    </div>
                                <?php endif ?>
                            </div>
                            <!-- /.topnav -->
                            <div class="nav-collapse collapse">
                                <!-- .nav -->
                                <ul class="nav">
                                    <li><a href="<?php echo Yii::app()->homeUrl ?>">Visit Home</a></li>
                                </ul>
                                <!-- /.nav -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.navbar -->
            </div>
            <!-- /#top -->
            <!-- .head -->
            <header class="head">
                <!-- ."main-bar -->
                <div class="main-bar">
                    <div class="container-fluid">
                        <div class="row-fluid">
                            <div class="span12">
                                <?php
                                if (Utility::hasFlash('error')) {
                                    foreach (Utility::getFlash('error') as $message) {

                                        echo '<div class="alert alert-error" style="margin-bottom:0;margin-top:7px;">
                                                <button class="close" data-dismiss="alert">??</button>
                                                ' . $message . '
                                            </div>';
                                    }
                                }
                                ?>
                                <?php
                                if (Utility::hasFlash('success')) {
                                    foreach (Utility::getFlash('success') as $message) {

                                        echo '<div class="alert alert-success" style="margin-bottom:0;margin-top:7px;">
                                                        <button class="close" data-dismiss="alert">??</button>
                                                        ' . $message . '
                                                    </div>';
                                    }
                                }
                                ?>
                            </div>
                        </div>
                        <!-- /.row-fluid -->
                    </div>
                    <!-- /.container-fluid -->
                </div>
                <!-- /.main-bar -->
            </header>
            <!-- /.head -->

            <!-- #left -->
            <?php if (Yii::app()->user->is_admin): ?>
                <div id="left">
                    <!-- #menu -->
                    <?php
                    Yii::app()->plugin->addMenuItem('admin-menu', array(
                        'visible' => Yii::app()->user->is_admin,
                        'label' => '<i class="icon-dashboard icon-large"></i> Dashboard',
                        'url' => array('/admin/account/index'),
                    ));
                    Yii::app()->plugin->addMenuItem('admin-menu', array(
                        'visible' => Yii::app()->user->is_admin,
                        'label' => '<i class="icon-picture icon-large"></i> Manage Meme <span class="label label-inverse pull-right">' . (($mc = Meme::model()->countByAttributes(array('is_active' => 0))) ? $mc : '') . '</span>',
                        'itemOptions' => array('class' => 'accordion-group'),
                        'linkOptions' => array(
                            'data-target' => '#meme-nav',
                            'class' => 'accordion-toggle',
                            'data-parent' => '#menu',
                            'data-toggle' => 'collapse',
                        ),
                        'submenuOptions' => array(
                            'class' => 'collapse',
                            'id' => 'meme-nav',
                        ),
                        'items' => array(
                            array('label' => '<i class="icon-angle-right"></i> All memes', 'url' => array('/admin/meme/index'),),
                            array('label' => '<i class="icon-angle-right"></i> Inactive memes', 'url' => array('/admin/meme/index', array('mode' => 'inactive')),),
                        ),
                        'url' => '#',
                    ));
                    Yii::app()->plugin->addMenuItem('admin-menu', array(
                        'visible' => Yii::app()->user->is_admin,
                        'label' => '<i class="icon-user icon-large"></i> Manage Users',
                        'url' => array('/admin/user/index'),
                    ));
                    Yii::app()->plugin->addMenuItem('admin-menu', array(
                        'visible' => Yii::app()->user->is_admin,
                        'label' => '<i class="icon-file-text-alt icon-large"></i> Pages',
                        'itemOptions' => array('class' => 'accordion-group'),
                        'linkOptions' => array(
                            'data-target' => '#pages-nav',
                            'class' => 'accordion-toggle',
                            'data-parent' => '#menu',
                            'data-toggle' => 'collapse',
                        ),
                        'submenuOptions' => array(
                            'class' => 'collapse',
                            'id' => 'pages-nav',
                        ),
                        'items' => array(
                            array('label' => '<i class="icon-list"></i> List all', 'url' => array('/admin/page/index'),),
                            array('label' => '<i class="icon-plus-sign"></i> Add new', 'url' => array('/admin/page/add'),),
                        ),
                        'url' => '#',
                    ));
                    Yii::app()->plugin->addMenuItem('admin-menu', array(
                        'visible' => Yii::app()->user->is_admin,
                        'label' => '<i class="icon-cogs icon-large"></i> Settings',
                        'itemOptions' => array('class' => 'accordion-group'),
                        'linkOptions' => array(
                            'data-target' => '#settings-nav',
                            'class' => 'accordion-toggle',
                            'data-parent' => '#menu',
                            'data-toggle' => 'collapse',
                        ),
                        'submenuOptions' => array(
                            'class' => 'collapse',
                            'id' => 'settings-nav',
                        ),
                        'items' => array(
                            array('label' => '<i class="icon-facebook-sign"></i> Social settings', 'url' => array('/admin/settings/social'),),
                            array('label' => '<i class="icon-barcode"></i> Watermark settings', 'url' => array('/admin/settings/watermark'),),
                            array('label' => '<i class="icon-code"></i> Ads settings', 'url' => array('/admin/settings/ads'),),
                        ),
                        'url' => '#',
                    ));
                    Yii::app()->plugin->addMenuItem('admin-menu', array(
                        'visible' => Yii::app()->user->is_admin,
                        'label' => '<i class="icon-off icon-large"></i> Logout',
                        'url' => array('/admin/account/logout'),
                    ));

                    Yii::app()->plugin->renderMenu('admin-menu', array(
                        'encodeLabel' => false,
                        'activateParents' => true,
                        'id' => 'menu',
                        'htmlOptions' => array(
                            'class' => 'unstyled accordion collapse in',
                        ),
                    ));
                    ?>
                    <!-- /#menu -->

                </div>
            <?php endif ?>
            <!-- /#left -->

            <!-- #content -->
            <div id="content" class="">
                <!-- .outer -->
                <div class="container-fluid outer">
                    <div class="row-fluid">
                        <!-- .inner -->
                        <div class="span12 inner">
                            <?php echo $content ?>
                        </div>
                        <!-- /.inner -->
                    </div>
                    <!-- /.row-fluid -->
                </div>
                <!-- /.outer -->
            </div>
            <!-- /#content -->
            <!-- #push do not remove -->
            <div id="push"></div>
            <!-- /#push -->
        </div>
        <!-- /#wrap -->

        <div class="clearfix"></div>
        <div id="footer">
            <p><?php echo date('Y') ?> &copy; <?php echo Yii::app()->name ?></p>
        </div>


        <!-- #helpModal -->
        <div id="helpModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="helpModalLabel"
             aria-hidden="true">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">??</button>
                <h3 id="helpModalLabel"><i class="icon-external-link"></i> Help</h3>
            </div>
            <div class="modal-body">
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                </p>
            </div>
            <div class="modal-footer">

                <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
            </div>
        </div>
        <!-- /#helpModal -->

        <script>
            $('.ttip').tooltip();
            $('.del-btn').click(function() {
                return confirm('Are you sure you want to delete?');
            });
        </script>
    </body>
</html>