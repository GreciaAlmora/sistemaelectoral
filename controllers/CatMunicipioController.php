<?php

namespace app\controllers;

use app\models\CatMunicipio;
use app\models\CatMunicipioSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CatMunicipioController implements the CRUD actions for CatMunicipio model.
 */
class CatMunicipioController extends Controller
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
     * Lists all CatMunicipio models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new CatMunicipioSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CatMunicipio model.
     * @param int $mun_id Id
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($mun_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($mun_id),
        ]);
    }

    /**
     * Creates a new CatMunicipio model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new CatMunicipio();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'mun_id' => $model->mun_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing CatMunicipio model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $mun_id Id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($mun_id)
    {
        $model = $this->findModel($mun_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'mun_id' => $model->mun_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing CatMunicipio model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $mun_id Id
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($mun_id)
    {
        $this->findModel($mun_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the CatMunicipio model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $mun_id Id
     * @return CatMunicipio the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($mun_id)
    {
        if (($model = CatMunicipio::findOne(['mun_id' => $mun_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
