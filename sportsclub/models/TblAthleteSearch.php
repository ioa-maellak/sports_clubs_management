<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TblChildAthlete;


/**
 * TblAthleteSearch represents the model behind the search form about `app\models\TblChildAthlete`.
 */
class TblAthleteSearch extends TblChildAthlete
{
   // add the public attribute that will be used to store the data to be search
    public $school;
    
   public function attributes()
{
    // add related fields to searchable attributes
    return array_merge(parent::attributes(), ['school.school_name']);
}

    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
             [['school'], 'safe'],
            [['id', 'school_id'], 'integer'],
            [['surname', 'first_name', 'dob', 'photo', 'school.school_name', 'athlete_card_id', 'athlete_card_id_expire', 'admission_date', 'email', 'comments'], 'safe'],
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
        $query = TblChildAthlete::find();
        $query->joinWith(['school']);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        $dataProvider->sort->attributes['school'] = [
           'asc' => ['ref_school.school_name' => SORT_ASC],
           'desc' => ['ref_school.school_name' => SORT_DESC],
        ];
 
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
 
        $query->andFilterWhere([
           // 'id' => $this->id,
           'dob' => $this->dob,
          // 'athlete_card_id_expire' => $this->athlete_card_id_expire,
           // 'admission_date' => $this->admission_date,
         
        ]);

        $query->andFilterWhere(['like', 'surname', $this->surname])
            ->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'photo', $this->photo])
            ->andFilterWhere(['like', 'athlete_card_id', $this->athlete_card_id])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'ref_school.school_name', $this->school])
            ->andFilterWhere(['like', 'comments', $this->comments]);
            
        return $dataProvider;
    }
}
