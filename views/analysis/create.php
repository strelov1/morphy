<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Tabs;

/* @var $this yii\web\View */
/* @var $model app\models\Analysis */

$this->title = 'Анализ';
$this->params['breadcrumbs'][] = ['label' => 'Analyses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="analysis-create">

    <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
    <?= $form->field($model, 'url')->textInput(['autofocus' => true]) ?>
    <?= $form->field($model, 'text')->textArea(['rows' => 6]) ?>
    <?= $form->field($model, 'author')->textInput(['autofocus' => true]) ?>
    <div class="form-group">
        <?= Html::submitButton('Обработать', ['class' => 'btn btn-primary']) ?>
        <?= Html::submitButton('Сохранить результат', ['class' => 'btn btn-primary', 'name' => 'save']) ?>
    </div>
    <?php ActiveForm::end(); ?>

    <?php if (isset($result)): ?>
        <div class="row">
            <div class="col-lg-8">
                <?= Tabs::widget([
                    'items' => [
                        [
                            'label' => 'График',
                            'content' => '<canvas id="myChart"></canvas>',
                            'active' => true
                        ],
                        [
                            'label' => 'Диаграмма',
                            'content' => '<canvas id="myPieChart"></canvas>'
                        ],
                        [
                            'label' => 'Результат',
                            'content' => $this->render('_result', [
                                'model' => $model,
                                'result' => $result,
                            ])
                        ],
                    ]
                ]);
                ?>
            </div>

            <div class="col-lg-4">
                <p>Всего: <b><?= $count ?></b></p>
                <?php foreach ($result as $type => $words) : ?>
                    <p><?= $model->compare[$type] ?>: <b><?= count($words) ?></b> / <b><?= round(100 * count($words) / $count) ?>%</b></p>
                    <div class="progress xs">
                        <div class="progress-bar progress-bar-aqua" style="width: <?= round(100 * count($words) / $count) ?>%"
                             role="progressbar" aria-valuenow="<?= round(100 * count($words) / $count) ?>" aria-valuemin="0"
                             aria-valuemax="100">
                            <span class="sr-only"><?= $count * count($words)/100 ?>% Complete</span>
                        </div>
                    </div>
                    </p>
                <?php endforeach; ?>
            </div>
        </div>
        <script>
            var ctx = document.getElementById("myChart");
            var ctx2 = document.getElementById("myPieChart");
            var randomColorFactor = function () {
                return Math.round(Math.random() * 255);
            };
            var randomColor = function () {
                return 'rgba(' + randomColorFactor() + ',' + randomColorFactor() + ',' + randomColorFactor() + ',.8)';
            };
            var data = {
                labels: [
                    <?php foreach ($result as $type => $words) : ?>
                    "<?= $model->compare[$type] ?>",
                    <?php endforeach; ?>
                ],
                datasets: [
                    {
                        data: [
                            <?php foreach ($result as $type => $words) : ?>
                            <?= count($words) ?>,
                            <?php endforeach; ?>
                        ],
                        backgroundColor: [
                            <?php foreach ($result as $type => $words) : ?>
                            randomColor(),
                            <?php endforeach; ?>
                        ],
                        hoverBorderColor: "rgba(255,99,132,1)",
                    }]
            };

            var myChart = new Chart(ctx, {
                type: 'bar',
                data: data,
            });

            var myPieChart = new Chart(ctx2, {
                type: 'doughnut',
                data: data,
            });
        </script>
    <?php endif; ?>

</div>
