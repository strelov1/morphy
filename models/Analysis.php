<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "analysis".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $url
 * @property string $text
 * @property string $author
 * @property integer $count_all
 * @property integer $count_c
 * @property integer $count_p
 * @property integer $count_kr_pril
 * @property integer $count_infinitiv
 * @property integer $count_g
 * @property integer $count_deeprichastie
 * @property integer $count_prichastie
 * @property integer $count_kr_prichastie
 * @property integer $count_chisl_k
 * @property integer $count_chisl_p
 * @property integer $count_ms
 * @property integer $count_ms_pred
 * @property integer $count_ms_p
 * @property integer $count_narechie
 * @property integer $count_predikativ
 * @property integer $count_predlog
 * @property integer $count_souz
 * @property integer $count_megd
 * @property integer $count_chast
 * @property integer $count_vvodn
 * @property integer $count_fraz
 *
 * @property User $user
 */
    class Analysis extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'analysis';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'author'], 'required'],
            [['user_id', 'count_all', 'count_c', 'count_p', 'count_kr_pril', 'count_infinitiv', 'count_g', 'count_deeprichastie', 'count_prichastie', 'count_kr_prichastie', 'count_chisl_k', 'count_chisl_p', 'count_ms', 'count_ms_pred', 'count_ms_p', 'count_narechie', 'count_predikativ', 'count_predlog', 'count_souz', 'count_megd', 'count_chast', 'count_vvodn', 'count_fraz'], 'integer'],
            [['url', 'author'], 'string', 'max' => 255],
            ['text', 'string']
        ];
    }

    public $compare = [
        'С' => 'Существительное',
        'П' => 'Прилагательное',
        'КР_ПРИЛ' => 'Краткое-прилагательное',
        'ИНФИНИТИВ' => 'Инфинитив',
        'Г' => 'Глагол',
        'ДЕЕПРИЧАСТИЕ' => 'Деепричастие',
        'ПРИЧАСТИЕ' => 'Причастие',
        'КР_ПРИЧАСТИЕ' => 'Краткое-причастие',
        'ЧИСЛ' => 'Числительное-количественное',
        'ЧИСЛ-П' => 'Порядковое числительное',
        'МС' => 'Местоимение-существительное',
        'МС-ПРЕДК' => 'Местоимение-предикатив',
        'МС-П' => 'Местоименное-прилагательное',
        'Н' => 'Наречие',
        'ПРЕДК' => 'Предикатив',
        'ПРЕДЛ' => 'Предлог',
        'СОЮЗ' => 'Союз',
        'МЕЖД' => 'Междометие',
        'ЧАСТ' => 'Частица',
        'ВВОДН' => 'Вводное слово',
        'ФРАЗ' => 'Фразеологизм',
        'НЕОПРЕД' => 'Неопределено',
    ];

    public $toColumnName = [
        'С' => 'count_c',
        'П' => 'count_p',
        'КР_ПРИЛ' => 'count_kr_pril',
        'ИНФИНИТИВ' => 'count_infinitiv',
        'Г' => 'count_g',
        'ДЕЕПРИЧАСТИЕ' => 'count_deeprichastie',
        'ПРИЧАСТИЕ' => 'count_prichastie',
        'КР_ПРИЧАСТИЕ' => 'count_kr_prichastie',
        'ЧИСЛ' => 'count_chisl_k',
        'ЧИСЛ-П' => 'count_chisl_p',
        'МС' => 'count_ms',
        'МС-ПРЕДК' => 'count_ms_pred',
        'МС-П' => 'count_ms_p',
        'Н' => 'count_narechie',
        'ПРЕДК' => 'count_predikativ',
        'ПРЕДЛ' => 'count_predlog',
        'СОЮЗ' => 'count_souz',
        'МЕЖД' => 'count_megd',
        'ЧАСТ' => 'count_chast',
        'ВВОДН' => 'count_vvodn',
        'ФРАЗ' => 'count_fraz',
        'НЕОПРЕД' => 'count_neopred',
    ];

    public $color = [
        'С' => 'success',
        'П' => 'warning',
        'КР_ПРИЛ' => 'danger',
        'ИНФИНИТИВ' => 'aqua',
        'Г' => 'primary',
        'ДЕЕПРИЧАСТИЕ' => 'info',
        'ПРИЧАСТИЕ' => 'success',
        'КР_ПРИЧАСТИЕ' => 'warning',
        'ЧИСЛ' => 'danger',
        'ЧИСЛ-П' => 'aqua',
        'МС' => 'primary',
        'МС-ПРЕДК' => 'info',
        'МС-П' => 'success',
        'Н' => 'warning',
        'ПРЕДК' => 'danger',
        'ПРЕДЛ' => 'aqua',
        'СОЮЗ' => 'primary',
        'МЕЖД' => 'info',
        'ЧАСТ' => 'success',
        'ВВОДН' => 'warning',
        'ФРАЗ' => 'danger',
        'НЕОПРЕД' => 'info',
    ];

    public function set($gramWord, $count)
    {
        $this->setAttributes([
            'user_id' => Yii::$app->user->id,
            'count_all' => $count,
            'count_c' => count($gramWord['С']),
            'count_p' => count($gramWord['П']),
            'count_kr_pril' => count($gramWord['КР_ПРИЛ']),
            'count_infinitiv' => count($gramWord['ИНФИНИТИВ']),
            'count_g' => count($gramWord['Г']),
            'count_deeprichastie' => count($gramWord['ДЕЕПРИЧАСТИЕ']),
            'count_prichastie' => count($gramWord['ПРИЧАСТИЕ']),
            'count_kr_prichastie' => count($gramWord['КР_ПРИЧАСТИЕ']),
            'count_chisl_k' => count($gramWord['ЧИСЛ']),
            'count_chisl_p' => count($gramWord['ЧИСЛ-П']),
            'count_ms' => count($gramWord['МС']),
            'count_ms_pred' => count($gramWord['МС-ПРЕДК']),
            'count_ms_p' => count($gramWord['МС-П']),
            'count_narechie' => count($gramWord['Н']),
            'count_predikativ' => count($gramWord['ПРЕДК']),
            'count_predlog' => count($gramWord['ПРЕДЛ']),
            'count_souz' => count($gramWord['СОЮЗ']),
            'count_megd' => count($gramWord['МЕЖД']),
            'count_chast' => count($gramWord['ЧАСТ']),
            'count_vvodn' => count($gramWord['ВВОДН']),
            'count_fraz' => count($gramWord['ФРАЗ']),
            'count_neopred' => count($gramWord['НЕОПРЕД']),
        ]);
    }

    public function getCompare()
    {
        $result = [];
        $result[] = '<div class="progress-analisys">';
        foreach ($this->compare as $key => $attribute) {
            $result[] = '<div class="progress-bar progress-bar-'.$this->color[$key].'" role="progressbar" 
            style="width:'. 100 * $this->{$this->toColumnName[$key]} / $this->count_all .'%">
            '. round(100 * $this->{$this->toColumnName[$key]} / $this->count_all) .'</div>';
        }
        $result[] = '</div>';
        return implode("", $result);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'url' => 'Url',
            'text' => 'Текст',
            'author' => 'Автор / Ресурс',
            'count_all' => 'Всего',
            'count_c' => 'Count C',
            'count_p' => 'Count P',
            'count_kr_pril' => 'Count Kr Pril',
            'count_infinitiv' => 'Count Infinitiv',
            'count_g' => 'Count G',
            'count_deeprichastie' => 'Count Deeprichastie',
            'count_prichastie' => 'Count Prichastie',
            'count_kr_prichastie' => 'Count Kr Prichastie',
            'count_chisl_k' => 'Count Chisl K',
            'count_chisl_p' => 'Count Chisl P',
            'count_ms' => 'Count Ms',
            'count_ms_pred' => 'Count Ms Pred',
            'count_ms_p' => 'Count Ms P',
            'count_narechie' => 'Count Narechie',
            'count_predikativ' => 'Count Predikativ',
            'count_predlog' => 'Count Predlog',
            'count_souz' => 'Count Souz',
            'count_megd' => 'Count Megd',
            'count_chast' => 'Count Chast',
            'count_vvodn' => 'Count Vvodn',
            'count_fraz' => 'Count Fraz',
            'count_neopred' => 'Count Neopred',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
