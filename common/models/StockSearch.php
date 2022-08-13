<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Stock;

/**
 * StockSearch represents the model behind the search form of `common\models\Stock`.
 */
class StockSearch extends Stock
{
    public $sum_count;
    public $sum_price;
    public $sum_amount;
    public $reservation_date_range;
    public $total_profit;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'card_id', 'status'], 'integer'],
            [['user_id'], 'number'],
            [['reservation_date_range', 'serial_number','sum_count','sum_count','sum_price','sum_amount',
                'total_profit'], 'safe'],
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
        $query = Stock::find();

        // add conditions that should always apply here
        $query->joinWith('card');

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
        ]);

        if(!empty($this->status))
        {

            $query->andFilterWhere(['stock.status' => $this->status]);
        }
        if(!empty($this->user_id))
        {

            $query->andFilterWhere(['user_id' => $this->user_id,]);
        }
        if(!empty($this->card_id))
        {

            $query->andFilterWhere(['card_id' => $this->card_id]);
        }
        if(!empty($this->reservation_date_range))
        {

            $date = explode(" - ", $this->reservation_date_range);
            if(!empty($date[1]))
                $query->andFilterWhere(['<=', 'reservation_date', $date[1]]);

            if(!empty($date[0]))
                $query->andFilterWhere(['>=', 'reservation_date', $date[0]]);
        }

        $query->andFilterWhere(['like', 'serial_number', $this->serial_number]);

        if($getSums)
        {
            $this->sum_count = $query->sum('stock.id');

            $this->sum_price = $query->sum('card.price');
            $this->sum_amount = $query->sum('amount');

            $this->total_profit =  $this->sum_amount-$this->sum_price;



        }

//        print_r($query->createCommand()->getRawSql());die;
        return $dataProvider;
    }
}
