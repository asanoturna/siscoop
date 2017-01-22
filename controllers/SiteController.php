<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }   

    public function actionAdministration()
    {
        // if (Yii::$app->user->isGuest) {
        //     return $this->goHome();
        // }        
        return $this->render('administration');
    }

    public function actionLocations()
    {        
        return $this->render('locations');     
    }

    public function actionBirthdate()
    {        
        return $this->render('birthdate');        
    }    

    public function actionPhones()
    {        
        return $this->render('phones');     
    }

    public function actionEmails()
    {        
        return $this->render('emails');     
    }      

    public function actionMap()
    {
        return $this->render('map');
    }    

    public function actionLinks()
    {
        $searchModel = new \app\modules\administrator\models\LinksSearch();
        $dataProvider = $searchModel->site(Yii::$app->request->queryParams);

        return $this->render('links', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }   

    public function actionArchives()
    {
        $searchModel = new \app\models\ArchiveSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('archives', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }         

    public function actionUsers()
    {
        $searchModel = new \app\modules\administrator\models\UseradminSearch();
        $dataProvider = $searchModel->searchbylocation(Yii::$app->request->queryParams);

        return $this->render('users', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }    

    public function actionUserdetail()
    {
        $model = new \app\models\UseradminSearch();

        return  $this->renderAjax('userdetail', [ 
            'model' => $model,
        ]);
    }                  
}