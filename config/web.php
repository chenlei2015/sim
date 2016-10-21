<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'defaultRoute'=>'index/index',
    'bootstrap' => ['log'],
//    'modules' => [
//        'admin' => [
//            'class' => 'mdm\admin\Module',
//        ],
//    ],
//    'as access' => [
//        'class' => 'mdm\admin\components\AccessControl',
//        'allowActions' => [
//            'site/*',
//            'avatar/index',
//            'rbac/*',
//        ]
//    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '123456789',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'loginUrl' => ['rbac/user/login'],
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'authManager' => [
            'class' =>  'yii\rbac\DbManager',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            //'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,//一定要设置成flase;
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.yeah.net',
                'username' => 'chenlei2015@yeah.net',
                'password' => 'nantou123',
                'port' => '25',
                'encryption' => 'tls',
            ],
            'messageConfig'=>[
                'charset'=>'UTF-8',
                'from'=>['chenlei2015@yeah.net'=>'陈磊']
            ],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 2 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning','info','profile'],
                    //全局变量只在debug模式下进行记录，正式环境不进行记录
                    'logVars'=> YII_DEBUG ? ['_SESSION','_COOKIE','_SERVER','_FILES','_GET','_POST']:[],
                ],
                [
                    //应用日志，与系统日志分开
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning','info','trace'],
                    'categories' => [APP_LOG],
                    'logVars'=> [],
                    'logFile' => '@app/runtime/logs/'.APP_LOG.'.log',
                    'maxFileSize' => 1024 * 10,
                    'maxLogFiles' => 20,
//                    //对用户的id进行记录,根据这个找到用户
//                    'prefix' => function ($message) {
//                        $user = Yii::$app->has('user', true) ? Yii::$app->get('user') : null;
//                        $userID = $user ? $user->getId(false) : '-';
//                        return "[$userID]";
//                    },
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                 '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
				 '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
            ],
        ],
    ],
    'params' => $params,
];

if (YII_ENV === 'dev') {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [        'class' => 'yii\debug\Module',    ];
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [        'class' => 'yii\gii\Module',    ];
}

return $config;
