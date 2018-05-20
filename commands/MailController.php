<?php

namespace app\commands;

use yii\console\Controller;

use Yii;
use app\models\MailQueue;
use app\modules\task\models\Todolist;


/*
 * usage:
 * 
 * yii mail/send
 * or
 * php yii mail/send
 * 

by controller:
     \Yii::$app->mailer->compose('@app/mail/task')
    ->setFrom('intranet@sicoobcrediriodoce.com.br')
    ->setTo($model->responsible->email)
    ->setCc($model->coresponsible->email)
    ->setSubject(Yii::$app->params['appname'].' - '.\Yii::$app->getModule('task')->params['taskModuleName']. ' - Nova Tarefa : #'. $model->id)
    //->setTextBody('Nova Ocorrencia registrada')
    //->setHtmlBody('<b>Nova Ocorrencia registrada</b>')
    ->send();
*/

class MailController extends Controller
{
	// Send mail on new task created
    public function actionNew()
    {
    $today = date('Y-m-d');
    $mails=Todolist::find()
        ->where('status_id=1')
        ->andWhere('notification_created=0')
        ->all();
    foreach($mails as $mail)
        {
        $message =\Yii::$app->mailer->compose('@app/mail/task_new', ['model' => $mail->id]);
            $message->setFrom('intranet@sicoobcrediriodoce.com.br')
                    ->setTo($mail->responsible->email)
                    //->setCc($mail->coresponsible->email)
                    ->setCc([$mail->coresponsible->email, $mail->department->email])
                    ->setSubject('Lembrete: '.$mail->name);
            if($message->send())
                {
                 $mail->notification_created = 1;
                 $mail->notification_created_date = date("Y-m-d H:i:s");
                }
            $mail->save();
        }
    }

    // Send mail on deadline task date
    public function actionDeadline()
    {
    $today = date('Y-m-d');
    $mails=Todolist::find()
    	->where('status_id=1')
    	->andWhere(['=', 'deadline', $today])
        ->andWhere('notification_deadline=0')
    	->all();
    foreach($mails as $mail)
        {
        $message =\Yii::$app->mailer->compose('@app/mail/task_deadline', ['model' => $mail->id]);
            $message->setFrom('intranet@sicoobcrediriodoce.com.br')
                    ->setTo($mail->responsible->email)
                    ->setCc([$mail->coresponsible->email, $mail->department->email])
                    ->setSubject('Lembrete: '.$mail->name);
            if($message->send())
                {
                 $mail->notification_deadline = 1;
                 $mail->notification_deadline_date = date("Y-m-d H:i:s");
                }
            $mail->save();
        }
    }

    // public function actionSend()
    // {
    // $mails=MailQueue::find()->all();
    // foreach($mails as $mail)
    //     {
    //     if($mail->success==1)
    //     {
    //     if($mail->attempts<=$mail->max_attempts)
    //         {
    //         $message =\Yii::$app->mail->compose();
    //             $message->setHtmlBody($mail->message,'text/html')
    //                     ->setFrom($mail->from_email)
    //                     ->setTo($mail->to_email)
    //                     ->setSubject($mail->subject);
    //         if($message->send())
    //             {
    //              $mail->success=0;.
    //              $mail->date_sent=date("Y-m-d H:i:s");
    //             }
    //          $mail->attempts=$mail->attempts + 1;
    //          $mail->last_attempt= date("Y-m-d H:i:s");
    //          $mail->save();
    //         }
    //     }
    //     }
    // }

    protected function findModel($id)
    {
        if (($model = MailQueue::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Página solicitada não pode ser encontrada!');
        }
    }
}
