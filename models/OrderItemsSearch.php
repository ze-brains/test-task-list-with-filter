<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\OrderItems;

/**
 * OrderItemsSearch represents the model behind the search form of `app\models\OrderItems`.
 */
class OrderItemsSearch extends OrderItems
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_num', 'order_item', 'quantity'], 'integer'],
            [['prod_id'], 'safe'],
            [['item_price'], 'number'],
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
        $query = OrderItems::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' =>false,
            'pagination' => false,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'order_num' => $this->order_num,
            'order_item' => $this->order_item,
            'quantity' => $this->quantity,
            'item_price' => $this->item_price,
        ]);

        $query->andFilterWhere(['like', 'prod_id', $this->prod_id]);

        return $dataProvider;
    }
}
