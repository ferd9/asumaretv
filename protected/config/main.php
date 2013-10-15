<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Web Application',
	'theme'=>'nasu',	
	'sourceLanguage'=>'es',
	'language'=>'es',		

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
                'application.models.configs.*',
                'application.models.settings.*',
                'ext.infiniteScroll.*',
                'ext.isotope.InfiniteScrollLinkPager',
                'ext.isotope.Isotope',               
                'ext.Utility',
                'ext.MyLinkPager', 
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		'meme',
                'admin',
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'123456',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		
	),

	// application components
	'components'=>array(
            'format'=>array(
            'class'=>'ext.yii-timeago.TimeagoFormatter',
            ),
            'thumb' => array(
            'class' => 'ext.yii-image.Thumbnailer',
            'wideImagePath' => 'wideimage-11.02.19-lib',
            'width' => 150,
            'height' => 150,
        ),
            'plugin' => array(
            'class' => 'application.components.PluginSystem',
            ),
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
                         'class' => 'WebUser',
		),
              'request'=>array(
            'enableCsrfValidation'=>true,
            ),
			//borrar en caso de problemas
			/*'clientScript'=>array(
					'packages'=>array(
							'jquery'=>array(
									'baseUrl'=>'//ajax.googleapis.com/ajax/libs/jquery/2.0.3/',
									'js'=>array('jquery.min.js'),
							),
							'jquery.ui'=>array(
									'baseUrl'=>'//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/',
									'js'=>array('jquery-ui.min.js'),
							),
					),
			),*/
		// uncomment the following to enable URLs in path-format
		
                
		'urlManager'=>array(
			'urlFormat'=>'path',
                        //'showScriptName'=>false,
			'rules'=>array(
                                'generate'=>'meme/generate/index',
				
                                'admin/login'=>'admin/account/login',
                                'admin/logout'=>'admin/account/logout',
                                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
			),
		),
	
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		// uncomment the following to use a MySQL database
		
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=nasu',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
		),
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				
				/*array(
				 'class'=>'CWebLogRoute',
				),*/
				
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
                'upload_dir' => 'uploads',
        'avatar_dir' => 'avatars',
        'hauth' => array(
            'allowedProviders' => array(),
            'config' => array(
                "base_url" => "http://example.com/site/socialLogin",
                "providers" => array(
                    "Google" => array(
                        "enabled" => true,
                        "keys" => array(
                            "id" => "",
                            "secret" => "",
                        ),
                        "scope" => "https://www.googleapis.com/auth/userinfo.profile " . "https://www.googleapis.com/auth/userinfo.email",
                        "access_type" => "online",
                    ),
                    "Facebook" => array(
                        "enabled" => true,
                        "keys" => array(
                            "id" => "",
                            "secret" => "",
                        ),
                        "scope" => "email"
                    ),
                    "Live" => array(
                        "enabled" => true,
                        "keys" => array(
                            "id" => "windows client id",
                            "secret" => "Windows Live secret",
                        ),
                        "scope" => "email"
                    ),
                    "Yahoo" => array(
                        "enabled" => true,
                        "keys" => array(
                            "key" => "yahoo client id",
                            "secret" => "yahoo secret",
                        ),
                    ),
                    "LinkedIn" => array(
                        "enabled" => true,
                        "keys" => array(
                            "key" => "linkedin client id",
                            "secret" => "linkedin secret",
                        ),
                    ),
                    "Twitter" => array(// 'key' is your twitter application consumer key
                        "enabled" => true,
                        "username" => '',
                        "keys" => array(
                            "key" => "",
                            "secret" => ""
                        ),
                    ),
                ),
                "debug_mode" => false,
                // to enable logging, set 'debug_mode' to true, then provide here a path of a writable file 
                "debug_file" => "",
            ),
        ),
        'version' => '2.0'
	),
);