<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AnalysisSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Анализ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="analysis-index">

    <p>
        <?= Html::a('Создать анализ', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
                'headerOptions' => ['width' => '10'],
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'headerOptions' => ['width' => '10'],
                'template' => '{view}',
            ],
            [
                'attribute'=>'author',
                'headerOptions' => ['width' => '10'],
            ],
            [
                'attribute'=>'Сравнение',
                'format' => 'raw',
                'value' => function ($model) {
                    return $model->getCompare();
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'headerOptions' => ['width' => '10'],
                'template' => '{delete}',
            ],
        ],
    ]); ?>

</div>
