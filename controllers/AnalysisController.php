<?php

namespace app\controllers;

use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use app\models\AnalysisSearch;
use app\models\Analysis;
use yii\web\Controller;
use Yii;

/**
 * AnalysisController implements the CRUD actions for Analysis model.
 */
class AnalysisController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'view', 'create', 'delete'],
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Analysis models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AnalysisSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Analysis model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $gramInfo = Yii::$app->morphy->getPartOfSpeech($model->text);
        $gramWord = [];
        foreach ($gramInfo as $value) {
            foreach ($value as $word => $type) {
                $gramWord[$type][] = $word;
            }
        }
        arsort($gramWord);
        $count = 0;
        foreach ($gramWord as $value) {
            $count += count($value);
        }
        if ($model->load(Yii::$app->request->post())) {
            $model->set($gramWord, $count);
            if (array_key_exists('save', Yii::$app->request->post())) {
                $model->save();
            }
        }
        return $this->render('create', [
            'model' => $model,
            'result' => isset($gramWord) ? $gramWord : null,
            'count' => isset($count) ? $count : null,
        ]);

    }

    /**
     * Creates a new Analysis model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Analysis();
        if (Yii::$app->request->isPost) {
            if ($model->load(Yii::$app->request->post())) {
                if ($model->url) {
                    $model->text = Yii::$app->parser->load($model->url);
                }
                $gramInfo = Yii::$app->morphy->getPartOfSpeech($model->text);
                $gramWord = [];
                foreach ($gramInfo as $value) {
                    foreach ($value as $word => $type) {
                        $gramWord[$type][] = $word;
                    }
                }
                arsort($gramWord);
                $count = 0;
                foreach ($gramWord as $value) {
                    $count += count($value);
                }
                $model->set($gramWord, $count);
                if (array_key_exists('save', Yii::$app->request->post())) {
                    $model->save();
                }
            }
        }
        
        return $this->render('create', [
            'model' => $model,
            'result' => isset($gramWord) ? $gramWord : null,
            'count' => isset($count) ? $count : null,
        ]);
    }
    

    /**
     * Deletes an existing Analysis model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Analysis model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Analysis the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Analysis::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
