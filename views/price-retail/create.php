<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var \db\models\PriceRetail $model */

$this->title = 'Create Price Retail';
$this->params['breadcrumbs'][] = ['label' => 'Price Retails', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="price-retail-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
