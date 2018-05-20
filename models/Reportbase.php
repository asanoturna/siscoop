<?php

namespace app\models;
use yii\web\UploadedFile;

use Yii;

class Reportbase extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'report_base';
    }

    public $file;
    public $filename;
    public $spreadsheetname;

    public function rules()
    {
        return [
            //[['file'], 'required'],
            [['updated'], 'safe'],
            [['downloads','user_id'], 'integer'],
            [['attachment', 'spreadsheetname'], 'string', 'max' => 255],
            [['file'], 'file', 'extensions'=>'zip', 'maxSize' => 1024 * 1024 * 15],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'spreadsheetname' => 'Nome para o arquivo',
            'attachment' => 'Arquivo',
            'file' => 'Planilha',
            'updated' => 'Publicação',
            'user_id' => 'Responsável',
            'downloads' => 'Downloads',
        ];
    }

    public function getImageFile()
    {
        return isset($this->attachment) ? Yii::$app->params['reportbasePath'] . $this->attachment : null;
    }
    public function getImageUrl()
    {
        $attachment = isset($this->attachment) ? $this->attachment : 'no-reportbase.png';
        return Yii::$app->params['reportbasePath'] . $attachment;
    }
    public function uploadImage() {
        $file = UploadedFile::getInstance($this, 'file');
 
        if (empty($file)) {
            return false;
        }

        $this->filename = $file->name;
        $ext = end((explode(".", $file->name)));

        $this->attachment = $this->spreadsheetname.".{$ext}";


        return $file;
    }  

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }        
}
