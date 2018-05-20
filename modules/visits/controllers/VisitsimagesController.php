<?php

namespace app\modules\visits\controllers;

use Yii;
use app\modules\visits\models\Visitsimages;
use app\modules\visits\models\VisitsimagesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\base\Security;
use yii\imagine\Image;
use Imagine\Gd;
use Imagine\Image\Box;
use Imagine\Image\BoxInterface;


class VisitsimagesController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::classname(),
                'only'  => ['index','create','view','index'],
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
        $searchModel = new VisitsimagesSearch();
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
        $model = new Visitsimages();
               
        if ($model->load(Yii::$app->request->post())) {
            
            $file = $model->uploadImage();
            if ($model->save()) {
                if ($file !== false) {
                    if(!is_dir(\Yii::$app->getModule('visits')->params['visitImages'].$model->business_visits_id.'/')){
                    mkdir(\Yii::$app->getModule('visits')->params['visitImages'].$model->business_visits_id.'/', 0777, true);
                    }
                    $path = $model->getImageFile();
                    $file->saveAs($path);
                    // optimize image (path, border width, color, transp)
                    Image::frame($path, 5, '#0d4549', 100)
                    ->thumbnail(new Box(1200, 1200))
                    ->save($path, ['quality' => 60]);                    
                }
                Yii::$app->session->setFlash('img-success', 'Imagem enviada com sucesso');
                return $this->redirect(['create', 'id' => $model->business_visits_id]);
            } else {
                // error in saving model
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        if (!Yii::$app->request->isAjax) {
            return $this->redirect(['index']);
        }
    }

    protected function findModel($id)
    {
        if (($model = Visitsimages::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
