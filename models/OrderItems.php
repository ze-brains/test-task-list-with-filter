<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "OrderItems".
 *
 * @property int $order_num
 * @property int $order_item
 * @property string $prod_id
 * @property int $quantity
 * @property string $item_price
 *
 * @property Orders $orderNum
 * @property Products $prod
 */
class OrderItems extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'OrderItems';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_num', 'order_item', 'prod_id', 'quantity', 'item_price'], 'required'],
            [['order_num', 'order_item', 'quantity'], 'integer'],
            [['item_price'], 'number'],
            [['prod_id'], 'string', 'max' => 10],
            [['order_num', 'order_item'], 'unique', 'targetAttribute' => ['order_num', 'order_item']],
            [['order_num'], 'exist', 'skipOnError' => true, 'targetClass' => Orders::className(), 'targetAttribute' => ['order_num' => 'order_num']],
            [['prod_id'], 'exist', 'skipOnError' => true, 'targetClass' => Products::className(), 'targetAttribute' => ['prod_id' => 'prod_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'order_num' => 'Order Num',
            'order_item' => 'Order Item',
            'prod_id' => 'Prod ID',
            'quantity' => 'Quantity',
            'item_price' => 'Item Price',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderNum()
    {
        return $this->hasOne(Orders::className(), ['order_num' => 'order_num']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProd()
    {
        return $this->hasOne(Products::className(), ['prod_id' => 'prod_id']);
    }
}
