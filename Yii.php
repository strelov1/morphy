<?php
/**
 * Yii bootstrap file.
 *
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

require(__DIR__ . '/vendor/yiisoft/yii2/BaseYii.php');


class Yii extends \yii\BaseYii
{
    /**
     * @var WebApplication the application instance
     */
    public static $app;
}

spl_autoload_register(['Yii', 'autoload'], true, true);
Yii::$classMap = require(__DIR__ . '/vendor/yiisoft/yii2/classes.php');
Yii::$container = new yii\di\Container();

/**
 * Class WebApplication
 * Include only Web application related components here
 *
 * @property \app\components\MorphyComponent $morphy The response component. This property is read-only. Extended component.
 * @property \app\components\ParserComponent $parser The response component. This property is read-only. Extended component.
 */
class WebApplication extends yii\web\Application
{
}