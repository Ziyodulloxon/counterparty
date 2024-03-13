<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\db\models\Order $model */
/** @var array $counterparties */
/** @var array $products */
/** @var \app\db\forms\OrderItemForm[] $orderItemModels */

$this->title = 'Create Order';
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'counterparties' => $counterparties,
        'products' => $products,
        'orderItemModels' => $orderItemModels
    ]) ?>

</div>
