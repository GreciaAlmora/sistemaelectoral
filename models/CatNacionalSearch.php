<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\CatNacional;

/**
 * CatNacionalSearch represents the model behind the search form of `app\models\CatNacional`.
 */
class CatNacionalSearch extends CatNacional
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nac_id', 'nac_fkestado', 'nac_fkmunicipio'], 'integer'],
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
        $query = CatNacional::find();

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
            'nac_id' => $this->nac_id,
            'nac_fkestado' => $this->nac_fkestado,
            'nac_fkmunicipio' => $this->nac_fkmunicipio,
        ]);

        return $dataProvider;
    }
}
