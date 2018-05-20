<?php

namespace app\modules\campaign\controllers;

use Yii;
use app\modules\campaign\models\Recovery;
use app\modules\campaign\models\Recoveryadmin;
use app\modules\campaign\models\RecoverySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\data\SqlDataProvider;

class RecoveryController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::classname(),
                'only'  => ['index','create','view','update','regulation','ranking'],
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

    public function actionRegulation()
    {
        return $this->render('regulation');
    }  

    public function actionIndex()
    {
        $searchModel = new RecoverySearch();
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
        $model = new Recovery();
        $model->scenario = 'create';

        $model->status = 0;

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
        $model->scenario = 'update';

        $model->updated = date('Y-m-d');
        //$model->status = 0;
        $model->negotiator_id = Yii::$app->user->id;    

        $randomString = Yii::$app->request->post('referencevalue');     

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'randomString' => $randomString,
            ]);
        }
    }

    public function actionManager($id)
    {
        $model = $this->findModeladmin($id);

        $model->approvedby = Yii::$app->user->id;
        $model->approvedin = date('Y-m-d');

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

        return $this->redirect(['index']);
    }

    public function actionRanking()
    {
        $model = new Recovery();

        $dataRankingUser = new SqlDataProvider([
            'sql' => "SELECT user.id, avatar, fullname, 
                SUM(if(campaign_recovery.status = 1, campaign_recovery.value_traded, NULL)) as  value_traded,
                SUM(if(campaign_recovery.status = 1, campaign_recovery.value_input, NULL)) as  value_input
                FROM campaign_recovery
                INNER JOIN `user` 
                ON campaign_recovery.negotiator_id = `user`.id
                GROUP BY `user`.id
                ORDER BY value_input DESC",
            'totalCount' => 100,
            'sort' =>false,
            'key'  => 'fullname',
            'pagination' => [
                'pageSize' => 100,
            ],
        ]);      

        $dataRankingLocation = new SqlDataProvider([
            'sql' => "SELECT location.id, shortname, fullname, 
                SUM(if(campaign_recovery.status = 1, campaign_recovery.value_traded, NULL)) as  value_traded,
                SUM(if(campaign_recovery.status = 1, campaign_recovery.value_input, NULL)) as  value_input
                FROM campaign_recovery
                INNER JOIN `location` 
                ON campaign_recovery.location_id = location.id
                GROUP BY `location`.id
                ORDER BY value_input DESC",
            'totalCount' => 100,
            'sort' =>false,
            'key'  => 'fullname',
            'pagination' => [
                'pageSize' => 100,
            ],
        ]); 

        $commandoverview = Yii::$app->db->createCommand(
        "SELECT
        SUM(r. referencevalue) AS d,
        SUM(r.value_traded) AS n
        FROM
        campaign_recovery AS r");
        $overview = $commandoverview->queryAll();

        $d = array(); //divida
        $n = array(); // negociado
 
        for ($i = 0; $i < sizeof($overview); $i++) {
           $d[] = (float) $overview[$i]["d"];
           $n[] = (float) $overview[$i]["n"];
        }

        $commandtypeofdebt = Yii::$app->db->createCommand(
        "SELECT
        SUM(IF(r.typeofdebt=0, referencevalue, 0)) as typeofdebt1,
        SUM(IF(r.typeofdebt=1, referencevalue, 0)) as typeofdebt2,
        SUM(IF(r.typeofdebt=2, referencevalue, 0)) as typeofdebt3,
        SUM(IF(r.typeofdebt=3, referencevalue, 0)) as typeofdebt4
        FROM
        campaign_recovery as r");
        $typeofdebt = $commandtypeofdebt->queryAll();

        // $typeofdebt1 = array(); //divida
        // $typeofdebt2 = array(); //divida
        // $typeofdebt3 = array(); //divida
        // $typeofdebt4 = array(); //divida
 
        for ($i = 0; $i < sizeof($typeofdebt); $i++) {
           $typeofdebt1[] = (float) $typeofdebt[$i]["typeofdebt1"];
           $typeofdebt2[] = (float) $typeofdebt[$i]["typeofdebt2"];
           $typeofdebt3[] = (float) $typeofdebt[$i]["typeofdebt3"];
           $typeofdebt4[] = (float) $typeofdebt[$i]["typeofdebt4"];
        }

        return $this->render('ranking', [
            'model' => $model,
            'dataRankingUser' => $dataRankingUser,
            'dataRankingLocation' => $dataRankingLocation,
            'd' => $d,
            'n' => $n,
            'typeofdebt1' => $typeofdebt1,
            'typeofdebt2' => $typeofdebt2,
            'typeofdebt3' => $typeofdebt3,
            'typeofdebt4' => $typeofdebt4,  
        ]);
    }      

    protected function findModel($id)
    {
        if (($model = Recovery::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findModeladmin($id)
    {
        if (($model = Recoveryadmin::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}