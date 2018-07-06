<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Orders".
 *
 * @property int $order_num
 * @property string $order_date
 * @property string $cust_id
 *
 * @property OrderItems[] $orderItems
 * @property Customers $cust
 * 
 */
class Orders extends \yii\db\ActiveRecord
{

    public $total_amount;
    public $order_items_count;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Orders';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_num', 'order_date', 'cust_id'], 'required'],
            [['order_num'], 'integer'],
            [['order_date', 'order_total', 'order_items_count'], 'safe'],
            [['cust_id'], 'string', 'max' => 10],
            [['order_num'], 'unique'],
            [['cust_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customers::className(), 'targetAttribute' => ['cust_id' => 'cust_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'order_num' => 'ID',
            'order_date' => 'Дата',
            'cust_id' => 'Cust ID',
            'total_amount' => 'Сумма',
            'order_items_count' => 'Кол-ство товаров',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItems()
    {
        return $this->hasMany(OrderItems::className(), ['order_num' => 'order_num']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCust()
    {
        return $this->hasOne(Customers::className(), ['cust_id' => 'cust_id']);
    }

    public function afterFind()
    {
        $this->order_date = date('d-m-Y H:m', strtotime($this->order_date));

        parent::afterFind();
    }

    public static function find()
    {
        $query = parent::find();
        $query->select([
            '`Orders`.*',
            'sum(`OrderItems`.`quantity` * `OrderItems`.`item_price`) as `total_amount`',
            'count(`OrderItems`.`prod_id`) as `order_items_count`'
        ]);
        $query->leftJoin('OrderItems', '`Orders`.`order_num` = `OrderItems`.`order_num`');
        $query->groupBy('`Orders`.`order_num`');

        return $query;
    }

}
