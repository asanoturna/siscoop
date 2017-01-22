<?php

namespace app\modules\campaign\controllers;

use Yii;
use app\modules\campaign\models\Sicoobcard;
use app\modules\campaign\models\SicoobcardSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\data\SqlDataProvider;


class SicoobcardController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::classname(),
                'only'  => ['index','create','view','update','performance'],
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
        $searchModel = new SicoobcardSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionPerformance()
    {
        $model = new Sicoobcard();

        $dataPerformanceUser = new SqlDataProvider([
            'sql' => "SELECT user.id, avatar, fullname, 
                COUNT(if(campaign_sicoobcard.status = 0, campaign_sicoobcard.id, NULL)) as  unconfirmed,
                COUNT(if(campaign_sicoobcard.status = 1, campaign_sicoobcard.id, NULL)) as  confirmed
                FROM campaign_sicoobcard
                INNER JOIN `user` ON campaign_sicoobcard.user_id = `user`.id
                GROUP BY user_id
                ORDER BY confirmed DESC",
            'totalCount' => 300,
            'sort' =>false,
            'key'  => 'fullname',
            'pagination' => [
                'pageSize' => 300,
            ],
        ]);      

        $dataPerformanceLocation = new SqlDataProvider([
            'sql' => "SELECT location.id, fullname, 
                COUNT(if(campaign_sicoobcard.status = 0, campaign_sicoobcard.id, NULL)) as  unconfirmed,
                COUNT(if(campaign_sicoobcard.status = 1, campaign_sicoobcard.id, NULL)) as  confirmed
                FROM campaign_sicoobcard
                INNER JOIN `location` ON campaign_sicoobcard.location_id = `location`.id
                GROUP BY location_id
                ORDER BY confirmed DESC",
            'totalCount' => 300,
            'sort' =>false,
            'key'  => 'fullname',
            'pagination' => [
                'pageSize' => 300,
            ],
        ]); 

        $commandActivation = Yii::$app->db->createCommand("
                        SELECT count(campaign_sicoobcard.id) as reativacao
                        FROM campaign_sicoobcard
                        WHERE campaign_sicoobcard.product_type = 1"
                    );
        $totalActivation = $commandActivation->queryScalar();   

        $commandReactivation  = Yii::$app->db->createCommand("
                        SELECT count(campaign_sicoobcard.id) as reativacao
                        FROM campaign_sicoobcard
                        WHERE campaign_sicoobcard.product_type = 0"
                    );
        $totalReactivation = $commandReactivation->queryScalar();

        return $this->render('performance', [
            'model' => $model,
            'dataPerformanceUser' => $dataPerformanceUser,
            'dataPerformanceLocation' => $dataPerformanceLocation,
            'totalActivation'   => $totalActivation,
            'totalReactivation' => $totalReactivation            
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
        $model = new Sicoobcard();

        $model->created = date('Y-m-d');
        $model->user_id = Yii::$app->user->id;                

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('campaign-success', 'Registro incluído com sucesso!');
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
        
        $model->updated = date('Y-m-d');        

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('campaign-success', 'Registro alterado com sucesso!');
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionManager($id)
    {
        $model = $this->findModel($id);

        $model->approved_by = Yii::$app->user->id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('campaign-success', 'Registro alterado com sucesso!');
            return $this->redirect(['index']);
        } else {
            return $this->render('manager', [
                'model' => $model,
            ]);
        }
    }      

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

            Yii::$app->session->setFlash('campaign-warning', 'Registro excluído com sucesso!');
            return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Sicoobcard::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
