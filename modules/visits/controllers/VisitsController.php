<?php

namespace app\modules\visits\controllers;

use Yii;
use app\modules\visits\models\Visits;
use app\modules\visits\models\VisitsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\base\Security;
use yii\data\SqlDataProvider;
use yii\web\UploadedFile;
use yii\base\ErrorException;

use yii\imagine\Image;
use Imagine\Gd;
use Imagine\Image\Box;
use Imagine\Image\BoxInterface;

class VisitsController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::classname(),
                'only'  => ['index','create','view','report_user','report_general','report_location','dailysummary','manager'],
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
        $searchModel = new VisitsSearch();
        // $searchModel->start_date = date('Y-m-d'); // current day
        // $searchModel->end_date = date('Y-m-d'); // current day
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionDailysummary()
    {
        $searchModel = new VisitsSearch();
        $searchModel->start_date = date('Y-m-d'); // current day
        $searchModel->end_date = date('Y-m-d'); // current day
        $dataProvider = $searchModel->searchbylocation(Yii::$app->request->queryParams);
            
        return $this->render('dailysummary', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }    

    public function actionReport_general()
    {
        $model = new Visits();

        return $this->render('report_general', [
            'model' => $model,    
        ]);
    }

    public function actionReport_user()
    {
        $model = new Visits();

        $thisyear  = date('Y');
        $thismonth = date('m');       

        $url = Yii::$app->getRequest()->getQueryParam('user_id');
        $user_id = isset($url) ? $url : Yii::$app->user->identity->id;

        $commandstats = Yii::$app->db->createCommand(
            "SELECT COUNT(v.id) as total_s, s.`name` as stats, s.hexcolor as color
            FROM visits v
            INNER JOIN visits_status s
            ON v.visits_status_id = s.id
            WHERE v.user_id LIKE $user_id
            GROUP BY stats
            ORDER BY total_s DESC"
                );
        $report_stats = $commandstats->queryAll();

        $total_s = array();
        $stats = array();
        $color = array();
 
        for ($i = 0; $i < sizeof($report_stats); $i++) {
           $stats[] = $report_stats[$i]["stats"];
           $color[] = $report_stats[$i]["color"];
           $total_s[] = (int) $report_stats[$i]["total_s"];
        }

        $commandfinality = Yii::$app->db->createCommand(
            "SELECT COUNT(v.id) as total_f, f.`name` as finality
            FROM visits v
            INNER JOIN visits_finality f
            ON v.visits_finality_id = f.id
            WHERE v.user_id LIKE $user_id
            GROUP BY finality
            ORDER BY total_f DESC"
                );
        $report_finality = $commandfinality->queryAll();      

        $total_f = array();
        $finality = array();
 
        for ($i = 0; $i < sizeof($report_finality); $i++) {
           $finality[] = $report_finality[$i]["finality"];
           $total_f[] = (int) $report_finality[$i]["total_f"];
        } 

        $commandTotal = Yii::$app->db->createCommand("SELECT COUNT(v.id) as fulltotal
                    FROM visits v WHERE v.user_id LIKE $user_id"
                    );
        $fulltotal = $commandTotal->queryScalar();   

        $commandEffect = Yii::$app->db->createCommand("SELECT COUNT(v.id) as totaleffect
                    FROM visits v WHERE v.user_id LIKE $user_id AND v.visits_status_id =3"
                    );
        $totaleffect = $commandEffect->queryScalar();  

        $commandImages = Yii::$app->db->createCommand("SELECT COUNT(i.id) as total_images
                    FROM visits_images i
                    INNER JOIN visits b
                    ON i.business_visits_id = b.id
                    WHERE b.user_id = $user_id "
            );
        $total_images = $commandImages->queryScalar();             

        return $this->render('report_user', [
            'model' => $model,  
            'total_s' => $total_s,
            'stats' => $stats,
            'color' => $color,
            'total_f' => $total_f,
            'finality' => $finality, 
            'fulltotal' => $fulltotal,
            'totaleffect'   => $totaleffect,
            'total_images' => $total_images
        ]);        
    }

    public function actionReport_location()
    {
        $model = new Visits();

        return $this->render('report_location', [
            'model' => $model,    
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
        $model = new Visits();

        $model->user_id = Yii::$app->user->id;
        $model->ip = '127.0.0.1';
        $model->created = date('Y-m-d');
               
        if ($model->load(Yii::$app->request->post())) {
            $file = $model->uploadImage();
 
            if ($model->save()) {

                if ($file !== false) {
                    if(!is_dir(\Yii::$app->getModule('visits')->params['visitAttachment'])){
                    mkdir(\Yii::$app->getModule('visits')->params['visitAttachment'], 0777, true);
                    }
                    $path = $model->getImageFile();
                    $file->saveAs($path);
                }
                Yii::$app->session->setFlash('visit-success', 'Registro de visita incluída com sucesso!');
                return $this->redirect(['view', 'id' => $model->id]);
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
        
        if ($model->user_id != Yii::$app->user->id){
            Yii::$app->session->setFlash('Visits-danger', 'Não é permitido alterar registros de outro usuário!');
            return $this->redirect(['view', 'id' => $model->id]);
        }        
        
        $model->ip = '127.0.0.1';
        $model->updated = date('Y-m-d'); 

        if ($model->load(Yii::$app->request->post())) {
            $file = $model->uploadImage();
 
            if ($model->save()) {

                if ($file !== false) {
                    if(!is_dir(\Yii::$app->getModule('visits')->params['visitAttachment'])){
                    mkdir(\Yii::$app->getModule('visits')->params['visitAttachment'], 0777, true);
                    }
                    $path = $model->getImageFile();
                    $file->saveAs($path);
                }
                Yii::$app->session->setFlash('visit-success', 'Registro de visita alterado com sucesso!');
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                // error in saving model
            }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionManager($id)
    {
        $model = $this->findModel($id);

        $model->approved_id = Yii::$app->user->id;
        $model->approvedin = date('Y-m-d');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
                Yii::$app->session->setFlash('visit-success', 'Registro de visita alterado com sucesso!');
                return $this->redirect(['index']);
        } else {
            return $this->render('manager', [
                'model' => $model,
            ]);
        }
    }       

    public function actionDelete($id)
    {
        $model= $this->findModel($id);
        if ($model->user_id != Yii::$app->user->id){
            throw new ErrorException('Não é permitido alterar registros de outro usuário!');
        }
        try {
             $model->delete();
             Yii::$app->session->setFlash('Visits-success', 'Registro excluído com sucesso!');
             return $this->redirect(['index']);
        } catch(\yii\db\IntegrityException $e) {
             //throw new \yii\web\ForbiddenHttpException('Could not delete this record.');
             Yii::$app->session->setFlash('Visits-danger', 'Não foi possível excluir! É necessário excluir todas as imagens vinculadas a este registro.');
             return $this->redirect(['index']);            
        }
    }

    protected function findModel($id)
    {
        if (($model = Visits::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('A pagina solicitada não existe ou você não possui permissão para visualizar!');
        }
    }
}
