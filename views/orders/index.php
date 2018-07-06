<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OrdersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заказы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php  echo $this->render('_search', [
            'model' => $searchModel,
            'vendors' => $vendors,
            'countries' => $countries,
            'selectedVendors' => $selectedVendors,
            'selectedCountries' => $selectedCountries,
        ]); 
    ?>

    <?php
        Modal::begin([
            'id' => 'modal',
            'header' => '<h2>Детали заказа</h2>',
        ]);
        Modal::end();
    ?>    

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'order_num',
            'order_date',
            'total_amount',
            'order_items_count' => [
                'attribute' => 'order_items_count',
                'format' => 'raw',
                'value' => function ($data) {

                    return Html::a($data->order_items_count, [
                                'details', 
                                'id' => $data->order_num,
                            ], [
                                'class' => 'popupModal',
                            ]
                    );
                },
            ],
        ],
    ]);
    ?>

    <?php
        echo Html::a('Показать все заказы', [
                                'index', 
                                'page-size' => 'all',
                            ], [
                                'class' => 'btn btn-success',
                            ]
                    );
    ?>
</div>
