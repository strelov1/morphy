<?php
/**
 * Created by PhpStorm.
 * User: elios
 * Date: 18.05.2016
 * Time: 19:40
 */

namespace app\components;

use yii\base\Component;
use DiDom\Document;
use Yii;

class ParserComponent extends Component
{
    public function load($url)
    {
        $document = new Document($url, true);
        return $document->find('body')[0]->text();
    }
}