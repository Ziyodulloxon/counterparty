<?php

namespace app\controllers;

use app\db\models\Counterparty;
use app\db\models\PriceCounterparty;
use app\db\models\search\PriceCounterpartySearch;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * PriceCounterpartyController implements the CRUD actions for PriceCounterparty model.
 */
class PriceCounterpartyController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::class,
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all PriceCounterparty models.
     *
     * @return string
     */
    public function actionIndex(int $product_id): string
    {
        $searchModel = new PriceCounterpartySearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'product_id' => $product_id
        ]);
    }

    /**
     * Displays a single PriceCounterparty model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView(int $id): string
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new PriceCounterparty model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @param int $product_id
     * @return string|Response
     */
    public function actionCreate(int $product_id): Response|string
    {
        $model = new PriceCounterparty();
        $model->product_id = $product_id;

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['index', 'product_id' => $model->product_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        $counterparties = Counterparty::find()
            ->select("name")
            ->indexBy("id")
            ->column();

        return $this->render('create', [
            'model' => $model,
            'product_id' => $product_id,
            'counterparties' => $counterparties
        ]);
    }

    /**
     * Updates an existing PriceCounterparty model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate(int $id): Response|string
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['index', 'product_id' => $model->product_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing PriceCounterparty model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete(int $id): Response
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the PriceCounterparty model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return PriceCounterparty the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel(int $id): PriceCounterparty
    {
        if (($model = PriceCounterparty::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
