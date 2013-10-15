<?php
Yii::app()->clientScript->scriptMap=array(
	'jquery.min.js'=>false,
);
?><!DOCTYPE html>
<html lang="en" xmlns:fb="http://ogp.me/ns/fb#">
    <head>
        <meta charset="utf-8">
        <meta name="author" content="Muhammad Mahad Azad">
		<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />  
		
		
        <!-- Le styles -->
        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap.css" rel="stylesheet">
        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap-responsive.css" rel="stylesheet">
        <link href='https://fonts.googleapis.com/css?family=Raleway:400,600|Oleo+Script' rel='stylesheet' type='text/css'>
        <link href='<?php echo Yii::app()->theme->baseUrl; ?>/css/cssm/corgi.css' rel='stylesheet' type='text/css'>
        <link href='<?php echo Yii::app()->theme->baseUrl; ?>/css/cssm/font-awesome.min.css' rel='stylesheet' type='text/css'>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jq/jquery-1.10.0.min.js" type="text/javascript"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/underscore-min.js" type="text/javascript"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/corgi.js" type="text/javascript"></script>
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/html5shiv.js"></script>
        <![endif]-->
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        
    </head>
    <body>
        <div id="fb-root"></div>
        <script>
        window.fbAsyncInit = function()
        {
            FB.init( {
                appId  : '<?php echo Yii::app()->params['hauth']['config']['providers']['Facebook']['keys']['id'] ?>',
                status : true,
                cookie : true,
                xfbml  : true
            } );
        };
    
        ( function( d )
        {
            var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
            if (d.getElementById(id)) {return;}
            js = d.createElement('script'); js.id = id; js.async = true;
            js.src = "//connect.facebook.net/en_US/all.js";
            ref.parentNode.insertBefore(js, ref);
        }( document ) );
        </script>
        <?php echo $content ?>

        <div class="container">
            