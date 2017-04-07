<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'SIMOKU',
    'name' => 'SIMOKU',
    'language' => 'id',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', 'app\components\Aliases'],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '8Qf-Jc3T76ls4DQo0FpkLAeOHnY8nT5M',
        ],
        // you can set your theme here - template comes with: 'light' and 'dark'
        'view' => [
            'theme' => [
                'pathMap' => ['@app/views' => '@webroot/themes/light/views'],
                'baseUrl' => '@web/themes/light',
            ],
        ],
        'assetManager' => [
            'bundles' => [
                // we will use bootstrap css from our theme
                'yii\bootstrap\BootstrapAsset' => [
                    'css' => [], // do not use yii default one
                ],
            ],
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            // 'rules' => [
            //     '<alias:\w+>' => 'site/<alias>',
            // ],
        ],
        'user' => [
            'identityClass' => 'app\models\UserIdentity',
            'enableAutoLogin' => true,
        ],
        'session' => [
            'class' => 'yii\web\Session',
            'savePath' => '@app/runtime/session'
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'cache' => 'cache',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. 
            // You have to set 'useFileTransport' to false and configure a transport for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/translations',
                    'sourceLanguage' => 'en',
                ],
                'yii' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/translations',
                    'sourceLanguage' => 'en'
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
		'dbsispedap' => \yii\helpers\ArrayHelper::merge(
			[
				'class' => 'yii\db\Connection',
				'charset' => 'utf8',
				'enableSchemaCache' => true,
			],
			require(__DIR__ . '/db-sispedap-local.php')
		),	        
    ],
	'modules' => [
		'gridview' =>  [
			'class' => '\kartik\grid\Module'
		],
		'pdfjs' => [
			'class' => '\yii2assets\pdfjs\Module',
			'waterMark'=>[
				'text'=> 'SIMOKU-BPKP',
				'color'=> 'red',
				'alpha'=>'0.3'
            ],		
		],		
        'parameter' => [
            'class' => 'app\modules\parameter\bidang',
        ],
        'transaksi' => [
            'class' => 'app\modules\transaksi\transaksi',
        ],	
        'laporan' => [
            'class' => 'app\modules\laporan\module',
        ],					
	],
    // this class use for force login to all controller. Usefull quiet enough
    // this function work only in login placed in site controller. FOr other login controller/action, change denyCallback access
	// 'as beforeRequest' => [
	// 		    'class' => 'yii\filters\AccessControl',
	// 		    'rules' => [
	// 		        [
	// 		            'allow' => true,
	// 		            'actions' => ['login'],
	// 		        ],
	// 		        [
	// 		            'allow' => true,
	// 		            'roles' => ['@'],
	// 		        ],
	// 		    ],
	// 		    'denyCallback' => function () {
	// 		        return Yii::$app->response->redirect(['site/login']);
	// 		    },
	// 		],	        
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = ['class' => 'yii\debug\Module'];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = ['class' => 'yii\gii\Module'];
}

return $config;
