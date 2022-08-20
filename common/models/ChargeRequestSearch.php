<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ChargeRequest;

/**
 * ChargeRequestSearch represents the model behind the search form of `common\models\ChargeRequest`.
 */
class ChargeRequestSearch extends ChargeRequest
{
    public $created_at_from;
    public $created_at_to;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'status', 'fields_type', 'created_at', 'updated_at', 'updated_by', 'created_by'], 'integer'],
            [['field_name', 'field_email', 'field_password', 'field_id', 'field_phone_number','amount','created_at_from','created_at_to'], 'safe'],
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
        $query = ChargeRequest::find();

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
            'id' => $this->id,
            'user_id' => $this->user_id,
            'status' => $this->status,
            'fields_type' => $this->fields_type,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
            'created_by' => $this->created_by,
        ]);

        $query->andFilterWhere(['like', 'field_name', $this->field_name])
            ->andFilterWhere(['like', 'field_email', $this->field_email])
            ->andFilterWhere(['like', 'field_password', $this->field_password])
            ->andFilterWhere(['like', 'field_id', $this->field_id])
            ->andFilterWhere(['like', 'field_phone_number', $this->field_phone_number]);
        if(!empty($this->created_at_from))
        {

            $query->andFilterWhere(['>=', 'created_at', strtotime( $this->created_at_from)]);
        }
        if(!empty($this->created_at_to))
        {
            $query->andFilterWhere(['<=', 'created_at', strtotime( $this->created_at_to)]);
        }
        return $dataProvider;
    }
}
