<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Analysis;

/**
 * AnalysisSearch represents the model behind the search form about `app\models\Analysis`.
 */
class AnalysisSearch extends Analysis
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'count_all', 'count_c', 'count_p', 'count_kr_pril', 'count_infinitiv', 'count_g', 'count_deeprichastie', 'count_prichastie', 'count_kr_prichastie', 'count_chisl_k', 'count_chisl_p', 'count_ms', 'count_ms_pred', 'count_ms_p', 'count_narechie', 'count_predikativ', 'count_predlog', 'count_souz', 'count_megd', 'count_chast', 'count_vvodn', 'count_fraz'], 'integer'],
            [['url', 'text', 'author'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Analysis::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'count_all' => $this->count_all,
            'count_c' => $this->count_c,
            'count_p' => $this->count_p,
            'count_kr_pril' => $this->count_kr_pril,
            'count_infinitiv' => $this->count_infinitiv,
            'count_g' => $this->count_g,
            'count_deeprichastie' => $this->count_deeprichastie,
            'count_prichastie' => $this->count_prichastie,
            'count_kr_prichastie' => $this->count_kr_prichastie,
            'count_chisl_k' => $this->count_chisl_k,
            'count_chisl_p' => $this->count_chisl_p,
            'count_ms' => $this->count_ms,
            'count_ms_pred' => $this->count_ms_pred,
            'count_ms_p' => $this->count_ms_p,
            'count_narechie' => $this->count_narechie,
            'count_predikativ' => $this->count_predikativ,
            'count_predlog' => $this->count_predlog,
            'count_souz' => $this->count_souz,
            'count_megd' => $this->count_megd,
            'count_chast' => $this->count_chast,
            'count_vvodn' => $this->count_vvodn,
            'count_fraz' => $this->count_fraz,
        ]);

        $query->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'text', $this->text])
            ->andFilterWhere(['like', 'author', $this->author]);
        
        return $dataProvider;
    }
}
