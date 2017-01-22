<?php

namespace app\modules\campaign\controllers;

use Yii;
use app\modules\campaign\models\Sipag;
use app\modules\campaign\models\SipagSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\base\Security;
use yii\data\SqlDataProvider;


class SipagController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::classname(),
                'only'  => ['index','create','view','update','manager'],
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
        $searchModel = new SipagSearch();
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
        $model = new Sipag();

        $model->user_id = Yii::$app->user->id;
        $model->created = date('Y-m-d');
       
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
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
        $model->user_id = Yii::$app->user->id;        

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

        $model->checkedby_id = Yii::$app->user->id;
        $model->situation = 1;

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

public function actionRanking()
    {
        $model = new Sipag();

        $dataRankingUser = new SqlDataProvider([
            'sql' => "SELECT user.id, avatar, fullname, 
            COUNT(if(campaign_sipag.status = 1, campaign_sipag.id, NULL)) as  aprovado,
            COUNT(if(campaign_sipag.status = 0, campaign_sipag.id, NULL)) as  pendente
            FROM campaign_sipag
            INNER JOIN `user` 
            ON campaign_sipag.user_id = `user`.id
            GROUP BY `user`.id
            ORDER BY aprovado DESC",
            'totalCount' => 100,
            'sort' =>false,
            'key'  => 'fullname',
            'pagination' => [
                'pageSize' => 100,
            ],
        ]);

        $commandNo = Yii::$app->db->createCommand("SELECT COUNT(v.id) as totalno FROM campaign_sipag v WHERE situation = 0");
        $totalno = $commandNo->queryScalar();   

        $commandYes = Yii::$app->db->createCommand("SELECT COUNT(v.id) as totalyes FROM campaign_sipag v WHERE situation = 1");
        $totalyes = $commandYes->queryScalar();

        return $this->render('ranking', [
            'model' => $model,
            'dataRankingUser' => $dataRankingUser,
            'totalno' => $totalno,
            'totalyes'   => $totalyes,
        ]);
    }         

    protected function findModel($id)
    {
        if (($model = Sipag::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
