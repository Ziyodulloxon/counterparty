<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var \db\models\Counterparty $model */

$this->title = 'Create Counterparty';
$this->params['breadcrumbs'][] = ['label' => 'Counterparties', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="counterparty-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
