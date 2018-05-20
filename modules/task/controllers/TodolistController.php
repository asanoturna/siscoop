<?php

namespace app\modules\task\controllers;

use Yii;
use app\modules\task\models\Todolist;
use app\modules\task\models\TodolistSearch;
use app\models\User;
use app\models\Department;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\base\ErrorException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\base\Security;
use yii\web\UploadedFile;
use app\models\MailQueue;

class TodolistController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::classname(),
                'only'  => ['index','create','view','calendar','performance','responsible','doc'],
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

    public function actionDocumentation()
    {
        return $this->render('documentation');
    }

    public function actionPerformance()
    {
        return $this->render('performance');
    }

    public function actionIndex()
    {
        $searchModel = new TodolistSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCalendar()
    {

    $events = Todolist::find()->all();

    $tasks = [];
    foreach ($events as $todolist)
    {
    $event = new \yii2fullcalendar\models\Event();
    
    $event->className = 'btn btn-xs';
    $event->backgroundColor = $todolist->department->hexcolor;
    $event->borderColor = $todolist->department->hexcolor;
    $event->id = $todolist->id;
    $event->title = $todolist->name;
    $event->start = $todolist->deadline;

    $tasks[] =  $event;
    }
    return $this->render('calendar',[
        'events' => $tasks,
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
        $model = new Todolist();
        
        // if ($model->responsible_id != Yii::$app->user->id){
        //     throw new NotFoundHttpException("Você não é responsável por essa atividade!");
        // }

        $model->owner_id = Yii::$app->user->id;
        $model->priority_id = 0;
        $model->status_id = 1;
        $model->created = date('Y-m-d');
        $model->updated = date('Y-m-d'); 

        if ($model->load(Yii::$app->request->post())) {

            $file = $model->uploadImage();
 
            if ($model->save()) {

                if ($file !== false) {

                    $idfolder = Yii::$app->user->identity->id;

                    if(!is_dir(\Yii::$app->getModule('task')->params['taskAttachment'])){
                    mkdir(\Yii::$app->getModule('task')->params['taskAttachment'], 0777, true);
                    }
                    $path = $model->getImageFile();
                    $file->saveAs($path);
                }
                // save in MailQueue list
                $queue = new MailQueue();
                $queue->to_email = $model->responsible->email;
                $queue->subject = 'Nova Atividade #'.$model->id;
                $queue->from_email = 'gugoan@uol.com.br';
                $queue->from_name =  'Intranet';
                $queue->date_published = date("Y-m-d");
                $queue->max_attempts = 3;  //No of try to send this mail
                $queue->attempts = 0;
                $queue->success = 1;  //will be set to 0 on send.
                $queue->message = $model->name;
                $queue->save();
                Yii::$app->session->setFlash("task-success", "Atividade incluída com sucesso!");
                return $this->redirect(['index']);
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

        $oldFile = $model->getImageFile();
        $oldattachment = $model->attachment;
        $oldFileName = $model->filename;
 
        if ($model->load(Yii::$app->request->post())) {

            $file = $model->uploadImage();
 
            if ($file === false) {
                $model->attachment = $oldattachment;
                $model->filename = $oldFileName;
            }
 
            if ($model->save()) {

                if ($file !== false && unlink($oldFile)) {
                    $path = $model->getImageFile();
                    $file->saveAs($path);
                }
                Yii::$app->session->setFlash("task-success", "Atividade Alterada com sucesso!");
                return $this->redirect(['index']);
            } else {
                // error in saving model
            }
        }
        return $this->render('update', [
            'model'=>$model,
        ]);
    }

    public function actionResponsible($id)
    {
        $model = $this->findModel($id);

        if ($model->responsible_id != Yii::$app->user->id){
            throw new NotFoundHttpException("Você não é responsável por essa atividade!");
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('responsible', [
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
        if (($model = Todolist::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
