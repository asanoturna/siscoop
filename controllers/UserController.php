<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ResetPasswordForm;
use app\models\Useradmin;
use app\models\UseradminSearch;
use app\models\SignupForm;


class UserController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::classname(),
                'only'  => ['profile','changeprofile','resetpassword'],
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

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionProfile()
    {
        $userModel = Yii::$app->user->identity;

        return $this->render('profile', [
            'userModel' => $userModel
        ]);
    }     

    public function actionChangeprofile()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }        
        $id = Yii::$app->user->id;
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())) {
            $model->save();
            return $this->redirect(['profile']);
        } else {
            return $this->render('changeprofile', [
                    'model' => $model,
            ]);
        }
    }   

    public function actionChangeavatar()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }        
        $id = Yii::$app->user->id;
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())) {
            $model->image = \yii\web\UploadedFile::getInstance($model, 'image');
            $model->avatar = str_pad($model->id, 6, "0", STR_PAD_LEFT) . '.jpg';
            if ($model->save()) 
            {
                return $this->redirect(['profile']);
            }
        } else {
            return $this->render('changeavatar', [
                    'model' => $model,
            ]);
        }
    }            

    public function actionResetpassword()
    {
        $userModel = Yii::$app->user->identity;
        $resetPasswordForm = new ResetPasswordForm($userModel);

        if ($resetPasswordForm->load(Yii::$app->request->post()) && $resetPasswordForm->resetPassword()) {
            Yii::$app->session->setFlash('resetpassword-success', 'Senha alterada com sucesso!');
            return $this->redirect(['profile']);
        }

        return $this->render('resetpassword', [
            'resetPasswordForm' => $resetPasswordForm,
            'userModel' => $userModel
        ]);
    }    

    protected function findModel($id)
    {
        if (($model = Useradmin::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }     
}