<?php

use app\db\models\PriceCounterparty;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var \db\models\search\PriceCounterpartySearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var int $product_id */

$this->title = 'Price Counterparties';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="price-counterparty-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Price Counterparty', ['create', 'product_id' => $product_id], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'product_id',
            'price_date',
            'price',
            'counterparty_id',
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, PriceCounterparty $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
