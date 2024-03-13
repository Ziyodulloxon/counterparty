<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var \db\models\PriceCounterparty $model */
/** @var yii\widgets\ActiveForm $form */
/** @var int $product_id */
/** @var array $counterparties */
?>

<div class="price-counterparty-form">

    <?php $form = ActiveForm::begin(['action' => ['create', 'product_id' => $product_id]]); ?>

    <?= $form->field($model, 'price_date')->textInput() ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'counterparty_id')->dropDownList($counterparties) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
