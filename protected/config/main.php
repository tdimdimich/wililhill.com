<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return [
	'basePath' => dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name' => 'wililhill',
	
	'params' => [
		'version' => '0.4.3',
	],
		
	// preloading 'log' component
	'preload' => ['log'],

	// autoloading model and component classes
	'import' => [
		'application.models.*',
		'application.components.*',
		'application.api.*',
	],

	'modules' => [],

	// application components
	'components' => [
		'user' => [
			'class' => 'WebUser',
			'loginUrl' => '/login',
			'allowAutoLogin' => true,
		],
		'urlManager' => [
			'urlFormat' => 'path',
			'showScriptName' => false,
			'rules' => [
				/* root */
				'/' => 'fork/compact',
				
				/*  */
				
				/* user */
				'/login' => 'user/login',
				'/logout' => 'user/logout',
				
				/* default */
				'<controller:\w+>/<id:\d+>' => '<controller>/view',
				'<controller:\w+>/<id:\d+>/<action:\w+>' => '<controller>/<action>',
				'<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
				'<controller:\w+>/<action:\w+>' => '<controller>/<action>',
			],
		],
		'clientScript' => [
			'class' => 'ClientScript',
		],
		
		// database settings are configured in database.php
		'db' => require(dirname(__FILE__).'/database.php'),

		'errorHandler' => [
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		],

		'log' => [
			'class' => 'CLogRouter',
			'routes' => [
				[
					'class' => 'CFileLogRoute',
					'levels' => 'error, warning',
				],
				[
					'class'=>'CWebLogRoute',
					'levels' => 'error, warning, info',
					'enabled' => YII_DEBUG,
					'categories'=>'commands.*',
				],
				[
					'class'=>'CWebLogRoute',
					'levels' => 'error, warning',
					'enabled' => YII_DEBUG,
				],
				[
					'class' => 'CProfileLogRoute',
					'levels' => 'profile',
					'enabled' => YII_DEBUG,
				],
			],
		],
		
		'settings' => [
			'class' => 'Settings',
		],
	],
	
//	'onBeginRequest'	=> ['Statistics', 'beforeRequest'],
	'onEndRequest'		=> ['Statistics', 'afterRequest'],

];
