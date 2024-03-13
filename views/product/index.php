<?php

use app\db\models\Product;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var \db\models\search\ProductSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Product', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'slug',
            'created_at:datetime',
            'updated_at:datetime',
            [
                'class' => ActionColumn::class,
                'template' => '{view} {update} {delete} {price-retail} {price-counterparty}',
                'buttons' => [
                    'price-retail' => function (string $url, Product $model, $key) {
                        return Html::a("retail prices", ["/price-retail", "product_id" => $model->id]);
                    },
                    'price-counterparty' => function (string $url, Product $model, $key) {
                        return Html::a("counterparty prices", ["/price-counterparty", "product_id" => $model->id]);
                    }
                ],
                'urlCreator' => function ($action, Product $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>


</div>
