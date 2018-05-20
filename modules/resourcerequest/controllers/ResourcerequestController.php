<?php

namespace app\modules\resourcerequest\controllers;

use Yii;
use app\modules\resourcerequest\models\Resourcerequest;
use app\modules\resourcerequest\models\ResourcerequestSearch;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\base\Security;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class ResourcerequestController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::classname(),
                'only'  => ['index','create','view','manager'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@']
                    ],
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new ResourcerequestSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $model = new Resourcerequest();

        $model->user_id = Yii::$app->user->id;
        $model->created = date('Y-m-d');   
        $model->resource_status_id = 1;       

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('visit-success', 'Solicitação incluída com sucesso!');
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->user_id != Yii::$app->user->id){
            Yii::$app->session->setFlash('Visits-danger', 'Não é permitido alterar registros de outro usuário!');
            return $this->redirect(['view', 'id' => $model->id]);
        }          

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionManager($id)
    {
        $model = $this->findModel($id);

        $model->manager_id = Yii::$app->user->id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('manager', [
                'model' => $model,
            ]);
        }
    }    

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Resourcerequest::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
