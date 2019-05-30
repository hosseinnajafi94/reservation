<?php
$modules_names = scandir(dirname(__DIR__) . '/modules/');
$modules = [];
$translations = [
    'app' => [
        'class'    => 'yii\i18n\PhpMessageSource',
        'fileMap'  => 'app.php',
        'basePath' => '@app/config/translations'
    ],
];
foreach ($modules_names as $module_name) {
    if ($module_name != '.' && $module_name != '..') {
        $translations[$module_name] = [
            'class'    => 'yii\i18n\PhpMessageSource',
            'fileMap'  => $module_name . '.php',
            'basePath' => '@app/modules/' . $module_name . '/translations'
        ];
        $modules[$module_name] = ['class' => 'app\modules\\' . $module_name . '\Module'];
    }
}
$db = require 'db.php';
$config = [
    'id'         => 'reservation',
    'language'   => 'fa-IR',
    'timeZone'   => 'Asia/Tehran',
    'components' => [
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName'  => false,
            'rules'           => [
                //''      => 'users/auth/login',
                //'site/login' => 'users/auth/login',
                //
                ''           => 'site/default/index',
                'info'       => 'site/default/info',
                'pay'        => 'site/default/pay',
                'start-pay'  => 'site/default/start-pay',
                'callback'   => 'site/default/callback',
                //'pay-result' => 'site/default/pay-result',
                //'factor'     => 'site/default/factor',
                'pay-result/<id:\d+>/<ref:\d+>' => 'site/default/pay-result',
                'factor/<id:\d+>/<ref:\d+>'     => 'site/default/factor',
                //
                'login'      => 'users/auth/login',
                'site/login' => 'users/auth/login',
                'logout'     => 'users/auth/logout',
                //
                'upgrade'    => 'upgrade/default/index',
                'coding/tcoding/index/<idnoe:\d+>' => 'coding/tcoding/index',
                'coding/tcoding/create/<idnoe:\d+>' => 'coding/tcoding/create',
                'coding/reservations/index/<idp1:\d+>' => 'coding/reservations/index',
                '<module>/<controller>/<action>/<id:\d+>' => '<module>/<controller>/<action>',
            ],
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager'
        ],
        'request' => [
            'cookieValidationKey' => 'reservation',
            'csrfParam'           => '_reservation_csrf',
            'csrfCookie' => [
                'httpOnly' => true,
                'secure'   => true,
                'path'     => '/;sameSite=Strict',
            ],
        ],
        'user' => [
            'identityClass'   => 'app\modules\users\models\DAL\User',
            'loginUrl'        => ['/users/auth/login'],
            'enableAutoLogin' => true,
            'identityCookie'  => [
                'name'     => '_reservation_identity',
                'httpOnly' => true,
                'secure'   => true,
                'path'     => '/;sameSite=Strict',
            ],
        ],
        'session' => [
            'name'         => '_reservation_phpsessid',
            'cookieParams' => [
                'httpOnly' => true,
                'secure' => true,
                'path'     => '/;sameSite=Strict',
            ],
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache'
        ],
        'errorHandler' => [
            'errorAction' => 'site/default/error'
        ],
        'db' => $db,
        'i18n' => [
            'translations' => $translations
        ],
    ],
    'layout'     => 'admin',
    'layoutPath' => '@app/layouts',
    'params'     => [],
    'modules'    => $modules,
    'basePath'   => dirname(__DIR__),
    'bootstrap'  => ['log'],
    'aliases'    => [
        '@bower' => '@vendor/bower-asset',
    ],
];

$config['bootstrap'][]    = 'gii';
$config['modules']['gii'] = [
    'class'      => 'app\config\gii\Module',
    'allowedIPs' => ['127.0.0.1', '::1'],
    'generators' => [
        'module' => [
            'class'     => 'app\config\gii\generators\module\Generator',
            'templates' => ['custom' => '@app/config/gii/generators/module/custom'],
        ],
        'model'  => [
            'class'     => 'app\config\gii\generators\model\Generator',
            'templates' => ['custom' => '@app/config/gii/generators/model/custom'],
        ],
        'crud'   => [
            'class'     => 'app\config\gii\generators\crud\Generator',
            'templates' => ['custom' => '@app/config/gii/generators/crud/custom'],
        ],
    ],
];
return $config;
