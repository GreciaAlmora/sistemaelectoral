<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\CatMunicipio;

/**
 * CatMunicipioSearch represents the model behind the search form of `app\models\CatMunicipio`.
 */
class CatMunicipioSearch extends CatMunicipio
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mun_id'], 'integer'],
            [['mun_nombre'], 'safe'],
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
        $query = CatMunicipio::find();

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
            'mun_id' => $this->mun_id,
        ]);

        $query->andFilterWhere(['like', 'mun_nombre', $this->mun_nombre]);

        return $dataProvider;
    }
}
