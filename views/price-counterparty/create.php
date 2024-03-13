<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var \db\models\PriceCounterparty $model */
/** @var int $product_id */
/** @var array $counterparties */

$this->title = 'Create Price Counterparty';
$this->params['breadcrumbs'][] = ['label' => 'Price Counterparties', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="price-counterparty-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'product_id' => $product_id,
        'counterparties' => $counterparties
    ]) ?>

</div>
