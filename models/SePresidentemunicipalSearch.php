<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SePresidentemunicipal;

/**
 * SePresidentemunicipalSearch represents the model behind the search form of `app\models\SePresidentemunicipal`.
 */
class SePresidentemunicipalSearch extends SePresidentemunicipal
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pre_id', 'pre_fkpartidopolitico', 'pre_fkmunicipio'], 'integer'],
            [['pre_nombre', 'pre_paterno', 'pre_materno', 'pre_anioinicio', 'pre_aniotermino'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = SePresidentemunicipal::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'pre_id' => $this->pre_id,
            'pre_anioinicio' => $this->pre_anioinicio,
            'pre_aniotermino' => $this->pre_aniotermino,
            'pre_fkpartidopolitico' => $this->pre_fkpartidopolitico,
            'pre_fkmunicipio' => $this->pre_fkmunicipio,
        ]);

        $query->andFilterWhere(['like', 'pre_nombre', $this->pre_nombre])
            ->andFilterWhere(['like', 'pre_paterno', $this->pre_paterno])
            ->andFilterWhere(['like', 'pre_materno', $this->pre_materno]);

        return $dataProvider;
    }
}
