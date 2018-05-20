<?php

namespace app\modules\productivity\controllers;

use Yii;
use app\modules\productivity\models\Dailyproductivity;
use app\modules\productivity\models\DailyproductivitySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\base\Security;
use yii\data\SqlDataProvider;


class DailyproductivityController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::classname(),
                'only'  => ['index','create','view','update','performance_user','performance_overview', 'ranking_user','ranking_location'],
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
        $searchModel = new DailyproductivitySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionRanking_user()
    {
        $model = new Dailyproductivity();

        $thisyear  = date('Y');
        $thismonth = date('m'); 

        $url = Yii::$app->getRequest()->getQueryParam('product_id');
        $product = isset($url) ? $url : '"%"';

        $dataProviderValor = new SqlDataProvider([
            'sql' => "SELECT user.id, avatar, fullname as seller,
                SUM(IF(daily_productivity.daily_productivity_status_id=1, companys_revenue, 0)) as unconfirmed,
                SUM(IF(daily_productivity.daily_productivity_status_id=2, companys_revenue, 0)) as confirmed
                    FROM daily_productivity
                    INNER JOIN `user` ON daily_productivity.seller_id = `user`.id
                    WHERE product_id LIKE $product AND YEAR(date) = $thisyear
                    GROUP BY seller_id
                    ORDER BY confirmed DESC",
            'totalCount' => 300,
            'sort' =>false,
            'key'  => 'seller',
            'pagination' => [
                'pageSize' => 300,
            ],
        ]);

        $dataProviderQtde = new SqlDataProvider([
            'sql' => "SELECT user.id, avatar, fullname as seller,
                SUM(IF(daily_productivity.daily_productivity_status_id=1, quantity, 0)) as unconfirmed,
                SUM(IF(daily_productivity.daily_productivity_status_id=2, quantity, 0)) as confirmed
                    FROM daily_productivity
                    INNER JOIN `user` ON daily_productivity.seller_id = `user`.id
                    WHERE product_id LIKE $product AND YEAR(date) = $thisyear
                    GROUP BY seller_id
                    ORDER BY confirmed DESC",
            'totalCount' => 300,
            'sort' =>false,
            'key'  => 'seller',
            'pagination' => [
                'pageSize' => 300,
            ],
        ]);

        return $this->render('ranking_user', [
            'model' => $model,
            'dataProviderValor' => $dataProviderValor,
            'dataProviderQtde' => $dataProviderQtde,        
        ]);
    }   

    public function actionRanking_location()
    {
        $model = new Dailyproductivity();

        $thisyear  = date('Y');
        $thismonth = date('m'); 

        $url = Yii::$app->getRequest()->getQueryParam('product_id');
        $product = isset($url) ? $url : '"%"';

       $dataProviderValor = new SqlDataProvider([
            'sql' => "SELECT shortname as sigla, fullname as local,
                SUM(IF(daily_productivity.daily_productivity_status_id=1, companys_revenue, 0)) as unconfirmed,
                SUM(IF(daily_productivity.daily_productivity_status_id=2, companys_revenue, 0)) as confirmed
                    FROM daily_productivity
                    INNER JOIN location ON daily_productivity.location_id = location.id
                    WHERE product_id LIKE $product AND YEAR(date) = $thisyear
                    GROUP BY location_id
                    ORDER BY confirmed DESC",
            'totalCount' => 50,
            'sort' =>false,
            'key'  => 'local',
            'pagination' => [
                'pageSize' => 50,
            ],
        ]);
        
        $dataProviderQtde = new SqlDataProvider([
            'sql' => "SELECT shortname as sigla, fullname as local,
                SUM(IF(daily_productivity.daily_productivity_status_id=1, quantity, 0)) as unconfirmed,
                SUM(IF(daily_productivity.daily_productivity_status_id=2, quantity, 0)) as confirmed            
                    FROM daily_productivity
                    INNER JOIN location ON daily_productivity.location_id = location.id
                    WHERE product_id LIKE $product AND YEAR(date) = $thisyear
                    GROUP BY location_id
                    ORDER BY confirmed DESC",
            'totalCount' => 30,
            'sort' =>false,
            'key'  => 'local',
            'pagination' => [
                'pageSize' => 30,
            ],
        ]);

        return $this->render('ranking_location', [
            'model' => $model,
            'dataProviderValor' => $dataProviderValor,
            'dataProviderQtde' => $dataProviderQtde,        
        ]);
    }   

    public function actionPerformance_user()
    {
        // $searchModel = new DailyproductivitySearch();
        // $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        // return $this->render('performance_user', [
        //     'searchModel' => $searchModel,
        //     'dataProvider' => $dataProvider,
        // ]);       

        $model = new Dailyproductivity();

        $thisyear  = date('Y');
        $thismonth = date('m');       

        $url = Yii::$app->getRequest()->getQueryParam('seller_id');
        $seller_id = isset($url) ? $url : Yii::$app->user->identity->id;

        $commandsell = Yii::$app->db->createCommand(
            "SELECT
                t2.NAME AS p,
                SUM(t1.quantity) AS q
            FROM
                daily_productivity AS t1
            LEFT JOIN product AS t2 ON t1.product_id = t2.id
            WHERE YEAR(date) = $thisyear AND daily_productivity_status_id = 2 AND seller_id = $seller_id
            GROUP BY p ORDER BY q DESC"
                );
        $report_sell = $commandsell->queryAll();

        $p = array();
        $q = array();
 
        for ($i = 0; $i < sizeof($report_sell); $i++) {
           $p[] = $report_sell[$i]["p"];
           $q[] = (int) $report_sell[$i]["q"];
        }

        $commandevolution = Yii::$app->db->createCommand("SELECT 
        SUM(IF(daily_productivity.daily_productivity_status_id=1, quantity, 0)) as pending,
        SUM(IF(daily_productivity.daily_productivity_status_id=2, quantity, 0)) as approved,
        MONTHNAME(date) as m 
        FROM daily_productivity WHERE seller_id = $seller_id AND YEAR(date) = $thisyear GROUP BY m ORDER BY MONTH(date)");
        $report_evolution = $commandevolution->queryAll();
        
        $m = array();
        $pending = array();
        $approved = array();
 
        for ($i = 0; $i < sizeof($report_evolution); $i++) {
           $m[] = $report_evolution[$i]["m"];
           $pending[] = (int) $report_evolution[$i]["pending"];
           $approved[] = abs((int) $report_evolution[$i]["approved"]);
        }

        return $this->render('performance_user', [
            'model' => $model,  
            'p' => $p,
            'q' => $q,
            'm' => $m,
            'pending' => $pending,
            'approved' => $approved,
        ]); 
    }     

    public function actionPerformance_overview()
    {
        $model = new Dailyproductivity();

        $thisyear  = date('Y');
        $thismonth = date('m');
        $lastmonth = date('m', strtotime('-1 months', strtotime(date('Y-m-d'))));    
        $url = Yii::$app->getRequest()->getQueryParam('mounth');
        $mounth = isset($url) ? $url : $thismonth;
        $model->mounth = $mounth;
        
        $command = Yii::$app->db->createCommand(
        "SELECT
            t2. NAME AS p,
            SUM(t1. companys_revenue) AS t,
            SUM(t1.quantity) AS q
        FROM
            daily_productivity AS t1
        LEFT JOIN product AS t2 ON t1.product_id = t2.id
        WHERE MONTH(date) = $mounth AND daily_productivity_status_id = 2
        GROUP BY
            p");
        $overview = $command->queryAll();

        $p = array();
        $t = array();
        $q = array();
 
        for ($i = 0; $i < sizeof($overview); $i++) {
           $p[] = $overview[$i]["p"];
           $t[] = (int) $overview[$i]["t"];
           $q[] = (int) $overview[$i]["q"];
        }

        return $this->render('performance_overview', [
            'model' => $model,
            'p' => $p,
            't' => $t,
            'q' => $q,
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
        $model = new Dailyproductivity();

        $model->daily_productivity_status_id = 1;
        $model->user_id = Yii::$app->user->id;
        $model->created = date('Y-m-d');
        $model->updated = date('Y-m-d');
        $model->quantity = 1;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash("dailyproductivity-success", "Registro gravado com sucesso. Aguarde o Gestor de Produtos efetiva-lo!");
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

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Dailyproductivity::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Pagina solicitada não foi encontrada');
        }
    }
}
