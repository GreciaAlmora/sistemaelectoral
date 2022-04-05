<?php

namespace app\controllers;

use app\models\CatNacional;
use app\models\CatNacionalSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CatNacionalController implements the CRUD actions for CatNacional model.
 */
class CatNacionalController extends Controller
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
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all CatNacional models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new CatNacionalSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CatNacional model.
     * @param int $nac_id Id
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($nac_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($nac_id),
        ]);
    }

    /**
     * Creates a new CatNacional model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new CatNacional();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'nac_id' => $model->nac_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing CatNacional model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $nac_id Id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($nac_id)
    {
        $model = $this->findModel($nac_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'nac_id' => $model->nac_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing CatNacional model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $nac_id Id
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($nac_id)
    {
        $this->findModel($nac_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the CatNacional model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $nac_id Id
     * @return CatNacional the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($nac_id)
    {
        if (($model = CatNacional::findOne(['nac_id' => $nac_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
