<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TblMember;

/**
 * TblMemberSearch represents the model behind the search form about `app\models\TblMember`.
 */
class TblMemberSearch extends TblMember
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['surname', 'profession_id', 'active_member', 'first_name', 'dob', 'email', 'national_id', 'admission_date', 'admission_receipt'], 'safe'],
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
        $query = TblMember::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->joinWith('profession');
        
        
        $query->andFilterWhere([
            'id' => $this->id,
            'dob' => $this->dob,
            //'profession_id' => $this->profession_id,
            //'active_member' => $this->active_member,
        ]);
        
        if ($this->active_member == 'ι' || $this->active_member == 'Ι')
        {
            $activemembervalue = "";
        }
        elseif (stripos('ναι', mb_strtolower($this->active_member)) !== FALSE)
        {
            $activemembervalue = 1;
        }
        elseif (stripos('όχι', mb_strtolower($this->active_member)) !== FALSE )
        {
            $activemembervalue = 0;
        }
        else 
        {
            $activemembervalue = $this->active_member;
        }

        $query->andFilterWhere(['like', 'surname', $this->surname])
            ->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'national_id', $this->national_id])
            ->andFilterWhere(['like', 'admission_date', $this->admission_date])
            ->andFilterWhere(['like', 'profession_name', $this->profession_id])
            ->andFilterWhere(['like', 'active_member', $activemembervalue]);

        return $dataProvider;
    }
}
