<?php

namespace app\models;

use Yii;

class MailQueue extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'email_queue';
    }

    public function rules()
    {
        return [
            [['from_email', 'to_email', 'subject', 'message'], 'required'],
            [['message'], 'string'],
            [['max_attempts', 'attempts', 'success'], 'integer'],
            [['date_published', 'last_attempt', 'date_sent'], 'safe'],
            [['from_name'], 'string', 'max' => 64],
            [['from_email', 'to_email'], 'string', 'max' => 128],
            [['subject'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'from_name' => 'From Name',
            'from_email' => 'From Email',
            'to_email' => 'To Email',
            'subject' => 'Subject',
            'message' => 'Message',
            'max_attempts' => 'Max Attempts',
            'attempts' => 'Attempts',
            'success' => 'Success',
            'date_published' => 'Date Published',
            'last_attempt' => 'Last Attempt',
            'date_sent' => 'Date Sent',
        ];
    }
}
