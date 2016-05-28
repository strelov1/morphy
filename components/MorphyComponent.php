<?php
/**
 * Created by PhpStorm.
 * User: elios
 * Date: 28.02.2016
 * Time: 21:48
 */

namespace app\components;

use yii\base\Component;
use Yii;

require_once( __DIR__ . '/../extensions/morphy/src/common.php');

class MorphyComponent extends Component
{
    public $morphy;
   
    public function init() {
        $dir =  __DIR__ . '/../extensions/morphy/dicts/';
        $opts = array(
            'storage' => PHPMORPHY_STORAGE_FILE,
            'predict_by_suffix' => true,
            'predict_by_db' => true,
            'graminfo_as_text' => true,
        );

        $dict_bundle = new \phpMorphy_FilesBundle($dir, 'rus');
        try {
            $this->morphy = new \phpMorphy($dict_bundle, $opts);
        } catch(\phpMorphy_Exception $e) {
            die('Error occured while creating phpMorphy instance: ' . $e->getMessage());
        }
    }

    public function __call($name, array $params)
    {
        $string =  mb_convert_case($params[0], MB_CASE_UPPER, "UTF-8");
        $array = explode(' ', $string);
        $array = $this->clean($array);

        $result = [];
        foreach ($array as $word) {
            $result[][$word] = isset($this->morphy->$name($word)[0]) ? $this->morphy->$name($word)[0] : [$word => "НЕОПРЕД"];
        }
        return $result;
    }

    private function clean(array $array)
    {
        $result = [];
        foreach ($array as $word) {
            preg_match('/[ая-АЯ]+/', $word, $match);
            if ($match) {
                $result[] = str_replace(["«", "»"], '', $match[0]);
            }
        }
        return $result;
    }

}