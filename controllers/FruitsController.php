<?php

namespace app\controllers;

use app\models\Fruits;
use app\models\FruitsSearch;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\Cookie;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FruitsController implements the CRUD actions for Fruits model.
 */
class FruitsController extends Controller
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
     * Lists all Fruits models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new FruitsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Fruits model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Fruits model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Fruits();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Fruits model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Fruits model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionFavourite($id)
    {
        try {
            $model = $this->findModel($id);
            if ($model) {
                $cookies = \Yii::$app->request->cookies;
                $likedFruits = $cookies->getValue('fav');
                if (is_null($likedFruits)) {
                    \Yii::$app->response->cookies->add(
                        new Cookie([
                            'name' => 'fav',
                            'value' =>$id
                        ])
                    );
                } else {
//                    var_dump($likedFruits); die;
                    $likedFruits[] = $id;
                    $likedFruitsArray = array_unique($likedFruits);
                    \Yii::$app->response->cookies->add(
                        new Cookie([
                            'name' => 'fav',
                            'value' => $likedFruitsArray
                        ])
                    );
                }
                \Yii::$app->session->setFlash('success', "Favourite {$model->name} saved successfully");
            }
        } catch (NotFoundHttpException $e) {
            \Yii::warning("Fruit id:$id not found");
            \Yii::$app->session->setFlash(
                'danger',
                'An error occurred adding your favourite fruit please contact the admin'
            );
        }
        return $this->redirect('index');
    }


    /**
     * Finds the Fruits model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Fruits the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Fruits::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
