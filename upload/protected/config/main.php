<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'比比价',
            'defaultController' => 'Index',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		'swordfish',
		'backend',
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		// uncomment the following to enable URLs in path-format
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'search'=>'index/search',
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		/*
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		*/
		// uncomment the following to use a MySQL database
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=swordfish',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '32100321',
			'charset' => 'utf8',
			'tablePrefix' => '',
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
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
		'sites' => array(
			1 => array(
				'name' => '当当',
				'alias' => 'dangdang'
			),
			2 => array(
				'name' => '亚马逊',
				'alias' => 'amazon'
			),
			3 => array(
				'name' => '京东',
				'alias' => 'jd'
			),
			4 => array(
				'name' => '一号店',
				'alias' => '1mall'
			),
			5 => array(
				'name' => '新蛋',
				'alias' => 'newegg'
			),
			6 => array(
				'name' => '苏宁',
				'alias' => 'suning'
			),
			7 => array(
				'name' => '易讯',
				'alias' => 'yixun'
			),
		),
		'siteUrls' => array(
			'dangdang' => 'http://www.dangdang.com/',
			'amazon' => 'http://www.amazon.cn/',
			'jd' => 'http://www.jd.com/',
			'1mall' => 'http://www.1mall.com/',
			'newegg' => 'http://www.newegg.com.cn/',
			'suning' => 'http://www.suning.com/',
			'yixun' => 'http://www.yixun.com/',
		),
	),
);
