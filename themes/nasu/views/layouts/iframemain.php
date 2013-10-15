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

<body style="background: #FFFFFF;">
<div id="main">
	<div class="container" style="">
		<div class="row">
			<?php echo $content; ?>
		</div>
	</div>
</div><!-- page -->

</body>
</html>

