<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var \db\models\Counterparty $model */

$this->title = 'Update Counterparty: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Counterparties', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="counterparty-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
