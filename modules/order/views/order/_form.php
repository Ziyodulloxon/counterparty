<?php

use app\db\forms\OrderItemForm;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\db\models\Order $model */
/** @var yii\widgets\ActiveForm $form */
/** @var array $counterparties */
/** @var array $products */
/** @var OrderItemForm[] $orderItemModels */

$js = <<<JS
$(document).ready(function () {
    $("#add-product").click(function (e) {
        var prototype = $(".product-item:last-child").clone();
        prototype.find(".dynamic-input").each(function () {
            var index = $(this).attr("data-index");
            var newName = $(this).attr("name").replace(/\d+/, ++index);
            $(this).attr("name", newName);
        });
        console.log(prototype);
        prototype.appendTo(".container-products");
    });
});
JS;

$this->registerJs($js);

?>

<div class="order-form">

    <?php $form = ActiveForm::begin(["id" => "dynamic-form"]); ?>

    <?= $form->field($model, 'counterparty_id')->dropDownList($counterparties, ['prompt' => '']) ?>

    <button type="button" id="add-product" class='pull-right btn btn-success btn-xs'>
        add product
    </button>

    <div class="container-products">
        <div class="product-item row">
            <div class="col-md-10">
                <?= $form->field($model, "order_items[0][product_id]")->dropDownList($products, [
                    "class" => "dynamic-input form-control",
                    "data-index" => 0
                ]); ?>
            </div>

            <div class="col-md-2">
                <?= $form->field($model, "order_items[0][quantity]")->textInput([
                    "class" => "dynamic-input form-control",
                    "data-index" => 0
                ]); ?>
            </div>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
