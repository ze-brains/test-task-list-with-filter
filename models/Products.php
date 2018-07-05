<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Products".
 *
 * @property string $prod_id
 * @property string $vend_id
 * @property string $prod_name
 * @property string $prod_price
 * @property string $prod_desc
 *
 * @property OrderItems[] $orderItems
 * @property Vendors $vend
 */
class Products extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Products';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['prod_id', 'vend_id', 'prod_name', 'prod_price'], 'required'],
            [['prod_price'], 'number'],
            [['prod_desc'], 'string'],
            [['prod_id', 'vend_id'], 'string', 'max' => 10],
            [['prod_name'], 'string', 'max' => 255],
            [['prod_id'], 'unique'],
            [['vend_id'], 'exist', 'skipOnError' => true, 'targetClass' => Vendors::className(), 'targetAttribute' => ['vend_id' => 'vend_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'prod_id' => 'Prod ID',
            'vend_id' => 'Vend ID',
            'prod_name' => 'Prod Name',
            'prod_price' => 'Prod Price',
            'prod_desc' => 'Prod Desc',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItems()
    {
        return $this->hasMany(OrderItems::className(), ['prod_id' => 'prod_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVend()
    {
        return $this->hasOne(Vendors::className(), ['vend_id' => 'vend_id']);
    }
}
