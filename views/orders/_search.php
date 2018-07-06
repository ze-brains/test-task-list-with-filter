<?php

use yii\helpers\Html;
use kartik\field\FieldRange;
use kartik\form\ActiveForm;
use kartik\date\DatePicker;
use kartik\select2\Select2;

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
    
    <div class="form-group">
        <label class="control-label">Производитель</label>
        <?= 
            Select2::widget([
                'name' => 'vendors',
                'value' => $selectedVendors,
                'data' => $vendors,
                'toggleAllSettings' => [
                    'selectLabel' => 'Выбрать всех',
                    'unselectLabel' => 'Снять выделение со всех',
                ],
                'options' => ['multiple' => true, 'placeholder' => 'Выбрать производителя ...']
            ]); 
        ?>        
    </div>    
    
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
        <label class="control-label">Страна заказчика</label>
        <?= 
            Select2::widget([
                'name' => 'countries',
                'value' => $selectedCountries,
                'data' => $countries,
                'toggleAllSettings' => [
                    'selectLabel' => 'Выбрать всех',
                    'unselectLabel' => 'Снять выделение со всех',
                ],
                'options' => ['multiple' => true, 'placeholder' => 'Выбрать страну ...']
            ]); 
        ?>        
    </div>    
    
    <div class="form-group">
        <?= Html::submitButton('Поиск', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
