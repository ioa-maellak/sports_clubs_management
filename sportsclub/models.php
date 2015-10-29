<?php

namespace app;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\RefAddress;

/**
 * models represents the model behind the search form about `app\models\RefAddress`.
 */
class models extends RefAddress
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'street number'], 'integer'],
            [['street name', 'town', 'region', 'postcode', 'area'], 'safe'],
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
            'street number' => $this->street number,
        ]);

        $query->andFilterWhere(['like', 'street name', $this->street name])
            ->andFilterWhere(['like', 'town', $this->town])
            ->andFilterWhere(['like', 'region', $this->region])
            ->andFilterWhere(['like', 'postcode', $this->postcode])
            ->andFilterWhere(['like', 'area', $this->area]);

        return $dataProvider;
    }
}
