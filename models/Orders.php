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
    public $order_total;
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
            'order_total' => 'Сумма',
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
        $orderItems = $this->getOrderItems()->asArray()->all();
        $this->order_items_count = count($orderItems);
        foreach($orderItems as $orderItem){
            $this->order_total += $orderItem['quantity'] * $orderItem['item_price'];
            $this->order_date = date('d-m-Y H:m', strtotime($this->order_date));
        }
        
        parent::afterFind();
    }
}
