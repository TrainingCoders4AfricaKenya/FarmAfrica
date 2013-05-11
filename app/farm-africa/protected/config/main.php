<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
$base_config = array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'FarmAfrica',
    'theme' => 'abound',
    // preloading 'log' component
    'preload' => array('log'),
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
        'application.controllers.*',
        'application.libs.utils.*',
        'application.extensions.EActiveResource.*',
        'application.modules.API.controllers.*',
        'application.modules.API.models.*',
    ),
    'modules' => array(
        // uncomment the following to enable the Gii tool

        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => '*private123*',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => array('127.0.0.1', '::1'),
        ),
        'API',
    ),
    // application components
    'components' => array(
        'user' => array(
            // enable cookie-based authentication
            'allowAutoLogin' => true,
        ),
        // uncomment the following to enable URLs in path-format
        'urlManager' => array(
            'urlFormat' => 'path',
            'rules' => array(
                // REST patterns
                array(
                    'API/TestRest/list',
                    'pattern' => 'API/TestRest/<model:\w+>',
                    'verb' => 'GET'
                ),
                array(
                    'API/TestRest/view',
                    'pattern' => 'API/TestRest/<model:\w+>/<id:\d+>',
                    'verb' => 'GET'
                ),
                array(
                    'API/TestRest/update',
                    'pattern' => 'API/TestRest/<model:\w+>/<id:\d+>',
                    'verb' => 'PUT'
                ),
                array(
                    'API/TestRest/delete',
                    'pattern' => 'API/TestRest/<model:\w+>/<id:\d+>',
                    'verb' => 'DELETE'
                ),
                array(
                    'API/TestRest/create',
                    'pattern' => 'API/TestRest/<model:\w+>',
                    'verb' => 'POST'
                ),
                // Other controllers
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ),
        /*
         * original rules
          'rules' => array(
          '<controller:\w+>/<id:\d+>' => '<controller>/view',
          '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
          '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
          ),
         * 
         */
        ),
//        'db' => array(
//            'connectionString' => 'sqlite:' . dirname(__FILE__) . '/../data/testdrive.db',
//        ),
        // uncomment the following to use a MySQL database
        'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=farmAfrica',
            'emulatePrepare' => true,
            'username' => 'farmAfrica',
            'password' => 'r00t',
            'charset' => 'utf8',
        ),
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning, trace',
                    'enabled' => true,
                    'logFile' => 'YII.log',
                    'logPath' => '/var/log/applications/FarmAfrica/UI/',
                    'maxFileSize' => '100000',
                    'maxLogFiles' => '10',
                ),
                // uncomment the following to show log messages on web pages
//                array(
//                    'class' => 'CWebLogRoute',
//                    'levels' => 'trace',
//                ),
            ),
        ),
        //used by EActiveResource
        'activeresource' => array(
            'class' => 'EActiveResourceConnection',
            'site' => 'http://127.0.0.1/FarmAfrica/index.php/API/TestRest',
            'contentType' => 'application/json',
            'acceptType' => 'application/json',
//            'idProperty' => 'id',
//            'queryCacheId' => 'cache'
        )
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => CMap::mergeArray(
            require ('system.php'), require ('users.php')
    ),
);

return $base_config;