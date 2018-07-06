<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Orders;

/**
 * OrdersSearch represents the model behind the search form of `app\models\Orders`.
 */
class OrdersSearch extends Orders
{

    public $total_from;
    public $total_to;
    public $date_from;
    public $date_to;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_num'], 'integer'],
            [['order_date', 'cust_id'], 'safe'],
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
        $query = Orders::find();

        $dataProviderParams = [
            'query' => $query,
            'sort' => false,
        ];

        if (!isset($params['page-size']) || $params['page-size'] !== 'all') {
            $dataProviderParams['pagination'] = [
                'pageSize' => 2,
            ];
        }

        $dataProvider = new ActiveDataProvider($dataProviderParams);
        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        if (!empty($params['OrdersSearch']['total_from'])) {
            $this->total_from = $params['OrdersSearch']['total_from'];
            $query->andHaving(['>=', 'total_amount', $this->total_from]);
        }

        if (!empty($params['OrdersSearch']['total_to'])) {
            $this->total_to = $params['OrdersSearch']['total_to'];
            $query->andHaving(['<=', 'total_amount', $this->total_to]);
        }

        if (!empty($params['OrdersSearch']['date_from'])) {
            $this->date_from = $params['OrdersSearch']['date_from'];
            $query->andFilterWhere(['>=', 'order_date', $this->date_from]);
        }

        if (!empty($params['OrdersSearch']['date_to'])) {
            $this->date_to = $params['OrdersSearch']['date_to'];
            $query->andFilterWhere(['<=', 'order_date', $this->date_to]);
        }

        if (isset($params['vendors'])) {
            $query->leftJoin('Products', '`Products`.`prod_id` = `OrderItems`.`prod_id`');
            $query->andFilterWhere(['IN', '`Products`.`vend_id`', $params['vendors']]);
        }

        if (isset($params['countries'])) {
            $query->leftJoin('Customers', '`Customers`.`cust_id` = `Orders`.`cust_id`');
            $query->andFilterWhere(['IN', '`Customers`.`cust_country`', $params['countries']]);
        }

        return $dataProvider;
    }

}
