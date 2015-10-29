<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\RefAddress;

/**
 * RefAddressSearch represents the model behind the search form about `app\models\RefAddress`.
 */
class RefAddressSearch extends RefAddress
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'streetnumber'], 'integer'],
            [['streetname', 'town', 'region', 'postcode', 'area'], 'safe'],
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
        $query = RefAddress::find();

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
            'streetnumber' => $this->streetnumber,
        ]);

        $query->andFilterWhere(['like', 'streetname', $this->streetname])
            ->andFilterWhere(['like', 'town', $this->town])
            ->andFilterWhere(['like', 'region', $this->region])
            ->andFilterWhere(['like', 'postcode', $this->postcode])
            ->andFilterWhere(['like', 'area', $this->area]);

        return $dataProvider;
    }
}
