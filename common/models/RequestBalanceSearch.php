<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RequestBalance;

/**
 * RequestBalanceSearch represents the model behind the search form of `common\models\RequestBalance`.
 */
class RequestBalanceSearch extends RequestBalance
{
    public $created_at_from;
    public $created_at_to;
    public $total_amount;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'status'], 'integer'],
            [['amount'], 'number'],
            [['create_at','created_at_from','created_at_to','total_amount'], 'safe'],
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
    public function search($params,$getSums=false)
    {
        $query = RequestBalance::find();

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
            'amount' => $this->amount,
            'create_at' => $this->create_at,
        ]);

        if(!empty($this->created_at_from)) {
            $query->andFilterWhere(['>=', 'create_at',  $this->created_at_from]);
        }
        if(!empty($this->created_at_to)) {
            $query->andFilterWhere(['<=', 'create_at', $this->created_at_to]);
        }
        if($getSums) {
            $this->total_amount = $query->sum('amount');
        }

        return $dataProvider;
    }
}
