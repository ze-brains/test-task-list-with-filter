<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Vendors".
 *
 * @property string $vend_id
 * @property string $vend_name
 * @property string $vend_address
 * @property string $vend_city
 * @property string $vend_state
 * @property string $vend_zip
 * @property string $vend_country
 *
 * @property Products[] $products
 */
class Vendors extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Vendors';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['vend_id', 'vend_name'], 'required'],
            [['vend_id', 'vend_zip'], 'string', 'max' => 10],
            [['vend_name', 'vend_address', 'vend_city', 'vend_country'], 'string', 'max' => 50],
            [['vend_state'], 'string', 'max' => 5],
            [['vend_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'vend_id' => 'Vend ID',
            'vend_name' => 'Vend Name',
            'vend_address' => 'Vend Address',
            'vend_city' => 'Vend City',
            'vend_state' => 'Vend State',
            'vend_zip' => 'Vend Zip',
            'vend_country' => 'Vend Country',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Products::className(), ['vend_id' => 'vend_id']);
    }
}
