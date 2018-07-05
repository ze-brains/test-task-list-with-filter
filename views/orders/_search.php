<?php

use yii\helpers\Html;
use kartik\field\FieldRange;
use kartik\form\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\OrdersSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="orders-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= 
        FieldRange::widget([
            'form' => $form,
            'model' => $model,
            'label' => 'Сумма заказа',
            'separator' => '← До →',
            'attribute1' => 'total_from',
            'attribute2' => 'total_to',
            'type' => FieldRange::INPUT_HTML5_INPUT,
        ]);    
    ?>
    
    <?= 
        FieldRange::widget([
            'form' => $form,
            'model' => $model,
            'label' => 'Дата заказа',
            'separator' => '← До →',
            'attribute1' => 'date_from',
            'attribute2' => 'date_to',
            'type' => FieldRange::INPUT_WIDGET,
            'widgetClass' => DatePicker::classname(),
            'widgetOptions1' => [
                'pluginOptions' => [
                    'format' => 'yyyy-mm-dd',
                    'todayHighlight' => true
                ]                
            ],
            'widgetOptions2' => [
                 'pluginOptions' => [
                    'format' => 'yyyy-mm-dd',
                    'todayHighlight' => true
                ]                
            ],                     
        ]);    
    ?>


    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
