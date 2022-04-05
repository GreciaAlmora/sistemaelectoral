<?php

namespace app\controllers;

use app\models\SePresidentemunicipal;
use app\models\SePresidentemunicipalSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SePresidentemunicipalController implements the CRUD actions for SePresidentemunicipal model.
 */
class SePresidentemunicipalController extends Controller
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
     * Lists all SePresidentemunicipal models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new SePresidentemunicipalSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SePresidentemunicipal model.
     * @param int $pre_id Id
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($pre_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($pre_id),
        ]);
    }

    /**
     * Creates a new SePresidentemunicipal model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new SePresidentemunicipal();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'pre_id' => $model->pre_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing SePresidentemunicipal model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $pre_id Id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($pre_id)
    {
        $model = $this->findModel($pre_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'pre_id' => $model->pre_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing SePresidentemunicipal model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $pre_id Id
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($pre_id)
    {
        $this->findModel($pre_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the SePresidentemunicipal model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $pre_id Id
     * @return SePresidentemunicipal the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($pre_id)
    {
        if (($model = SePresidentemunicipal::findOne(['pre_id' => $pre_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');

        
    }
}
