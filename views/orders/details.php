<?php

use yii\grid\GridView;

?>
<div class="order_items-index">

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'layout' => '{items}',
        'columns' => [
            'product_title',
            'order_items_total'
        ],
    ]);
    ?>

</div>
