<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Customers".
 *
 * @property string $cust_id
 * @property string $cust_name
 * @property string $cust_address
 * @property string $cust_city
 * @property string $cust_state
 * @property string $cust_zip
 * @property string $cust_country
 * @property string $cust_contact
 * @property string $cust_email
 *
 * @property Orders[] $orders
 */
class Customers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Customers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cust_id', 'cust_name'], 'required'],
            [['cust_id', 'cust_zip'], 'string', 'max' => 10],
            [['cust_name', 'cust_address', 'cust_city', 'cust_country', 'cust_contact'], 'string', 'max' => 50],
            [['cust_state'], 'string', 'max' => 5],
            [['cust_email'], 'string', 'max' => 255],
            [['cust_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cust_id' => 'Cust ID',
            'cust_name' => 'Cust Name',
            'cust_address' => 'Cust Address',
            'cust_city' => 'Cust City',
            'cust_state' => 'Cust State',
            'cust_zip' => 'Cust Zip',
            'cust_country' => 'Cust Country',
            'cust_contact' => 'Cust Contact',
            'cust_email' => 'Cust Email',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Orders::className(), ['cust_id' => 'cust_id']);
    }
}
