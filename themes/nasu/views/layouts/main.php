<?php /* @var $this Controller */ ?>
<?php

$cs=Yii::app()->clientScript;
$cs->coreScriptPosition=CClientScript::POS_HEAD;
$cs->scriptMap=array();
//$baseUrl=Yii::app()->request->baseUrl;
$cs->registerCoreScript('jquery');

Yii::app()->clientScript->registerScriptFile("http://twitter.github.com/bootstrap/assets/js/bootstrap-button.js", CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/bootstrap.min.js', CClientScript::POS_HEAD);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
    <link rel="icon" type="image/png" href="<?php echo Yii::app()->theme->baseUrl;?>/img/favicon.png" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl;?>/css/bootstrap.css">
    <link rel=stylesheet href="<?php echo Yii::app()->theme->baseUrl;?>/css/bootstrap-responsive.css">
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl;?>/css/flexslider.css">
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl;?>/css/prettyPhoto.css">
    <link rel=stylesheet href="<?php echo Yii::app()->theme->baseUrl;?>/css/style.css">
    <!--[if lt IE 9]>
    <link href="css/ie8.css" rel="stylesheet" type="text/css" />
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
	
</head>

<body>
<header>
    <div class="container">
        <div class="row menu-line">
            <div class="span7">
                <nav>
                    <ul>
                        <li class="active"><?php echo CHtml::link("Home", Yii::app()->getController()->createUrl("site/index"));?></li>
                        <?php if(!Yii::app()->user->isGuest){?>
                        <li><?php echo CHtml::link("Crear post", Yii::app()->getController()->createUrl("post/create"));?></li>
                        <li><a href="<?php echo Yii::app()->getController()->createUrl("Imagen/create")?>">Subir Image</a></li>
                        <?php } ?>
                        <li><a href="<?php echo Yii::app()->createUrl("meme/default");?>">Meme</a></li>
                        <li><a href="<?php echo Yii::app()->createUrl("Imagen/index");?>">Imagenes</a></li>
                        <li><a href="<?php echo Yii::app()->createUrl("post/index");?>">Publicaciones</a></li>
                        
                    </ul>
                </nav>
            </div>
            <div class="span3 social-links">
                <ul>
                    <li><a class="facebook" href="https://www.facebook.com/asumaretvoficial">Facebook</a></li>
                    <li><a class="twitter" href="https://twitter.com/asumaretv">Twitter</a></li>
                    <li><a class="pinterest" href="#">Pinterest</a></li>
                    <li><a class="googleplus" href="#">Google+</a></li>
                </ul>
            </div>
            <div class="span2 search-form">
                <form action="http://teothemes.com/html/Voxis/blog-search.html">
                    <input type="text" placeholder="Search..." name="search" class="span2">
                    <input type="submit" value="Search" name="submit">
                </form>
            </div>
        </div>
        <div class='row breaking-news'>
            <div class='span2 title'>
               <span>Breaking News</span>
            </div>
            <div class='span10 header-news'>
                <ul id="js-news" class="js-hidden">
                    <li class="news-item"><a href="#">Chrysler-Fiat CEO's Warning: Europe's Car Market Is Broken</a></li>
                    <li class="news-item">Trance lovers, head on here! Trance Light Night 2013 </li>
                    <li class="news-item">Taco Bell pulls beef from UK outlets after horse meat discovery </li>
                    <li class="news-item">Bersani leads Berlusconi in polls as Italy votes for new parliament </li>
                </ul>
            </div>
        </div>
        <div class="row logo-line">
            <div class="span3 logo">
                <a href="index-2.html">
                    <figure>
                        <img alt="" src="<?php echo Yii::app()->request->baseUrl;?>/images/logo.png">
                    </figure>
                </a>
            </div>
            <div class="span5 offset4 advertising hidden-phone">
                <a href="#">
                    <img alt="" src="img/advert.png" class="pull-right">
                </a>
            </div>
        </div>
        <div class="row main-nav">  
            <div class="span12">
                <nav>
                 <?php $this->widget('zii.widgets.CMenu',array(
                 		'id'=>'nav',
                 		'firstItemCssClass'=>'first-child',
                 		'itemTemplate'=>'<div class="inner">{menu}</div>',
                 		//'lastItemCssClass'=>'last-child',
                 		'htmlOptions'=>array('class'=>'l_tinynav1 hidden-phone'),
			'items'=>array(
				array('label'=>'Inicio', 'url'=>array('/site/index')),
                                array('label'=>'Noticias', 'url'=>array('/site/noticias')),
                                array('label'=>'Entretenimiento', 'url'=>array('/site/entretenimiento')),
                                array('label'=>'Tutoriales', 'url'=>array('/site/tutoriales')),
				array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about'),
				//'items'=>array(array('Subitem 1'=>"test",'url'=>'#'),),
				),
				array('label'=>'Contact', 'url'=>array('/site/contact')),
				array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
			),
		)); ?>
                <select id="tinynav1" class="tinynav tinynav1 visible-phone"><option>Navigation</option><option value="http://teothemes.com/">Home</option><option value="homepage-blog.html">Blog</option><option value="blog-category.html">Category</option><option value="blog-category.html">- Internet</option><option value="blog-category.html">- Social Media</option><option value="blog-category.html">- - Internet</option><option value="blog-category.html">- - Social Media</option><option value="#">- - - Internet</option><option value="blog-category.html">- - - Social Media</option><option value="blog-category.html">- - - IT</option><option value="blog-category.html">- - IT</option><option value="blog-category.html">- IT</option><option value="shortcodes-buttons.html">Shortcodes</option><option value="shortcodes-buttons.html">- Buttons</option><option value="shortcodes-tabs.html">- Tabs</option><option value="shortcodes-texts.html">- Texts</option><option value="blog-search.html">Search</option><option value="blog-author.html">Author</option><option value="blog.html">Single post</option><option value="404.html">404</option><option value="contact.html">Contact</option></select>
                </nav>
            </div>
        </div>
    </div>
</header>

<div id="main">
	<div class="container" style="">
		<div class="row">
			<?php echo $content; ?>
		</div>
	</div>

	

</div><!-- page -->

<footer>
    <div class="container">
        <div class="row">
           dasdfdfasdfsf
        </div>
    </div>
</footer>
<div class="sub-footer">
    <div class="container">
        <div class="row">
            <div class="span9 copyright">
                Copyright &copy; <?php echo date('Y'); ?> Por Asumaretv.com All Rights Reserved..
            </div>
            <div class="span3 social-links">
                <ul>
                    <li><a class="facebook" href="#">Facebook</a></li>
                    <li><a class="twitter" href="#">Twitter</a></li>
                    <li><a class="pinterest" href="#">Pinterest</a></li>
                    <li><a class="googleplus" href="#">Google+</a></li>
                </ul>
            </div>
        </div>
        <a class="back-to-top" href="#" style="display: inline;">Scroll Top</a>
    </div>
</div>
</body>
</html>
