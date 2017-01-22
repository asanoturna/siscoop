<?php

namespace app\modules\visits\models;

use Yii;
use yii\web\UploadedFile;

class Visitsimages extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'visits_images';
    }

    public $file;
    public $filename;      

    public function rules()
    {
        return [
            [['name', 'business_visits_id'], 'required'],
            [['business_visits_id'], 'integer'],
            [['name'], 'safe'],
            [['file'], 'file', 'extensions'=>'jpg, png, jpeg', 'maxSize' => 1024 * 1024 * 4],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Imagem',
            'file' => '',
            'business_visits_id' => 'Nº da Visita',
        ];
    }

    public function getBusinessVisits()
    {
        return $this->hasOne(BusinessVisits::className(), ['id' => 'business_visits_id']);
    }

    public function getImageFile()
    {
        return isset($this->name) ? \Yii::$app->getModule('visits')->params['visitImages'] . $this->business_visits_id.'/'. $this->name : null;
    }

    public function getImageUrl()
    {
        // return a default image placeholder if your source name is not found
        $name = isset($this->name) ? $this->name : 'default-img.png';
        return \Yii::$app->getModule('visits')->params['visitImages'] . $this->business_visits_id.'/'. $name;
    }

    public function uploadImage() {
        // get the uploaded file instance. for multiple file uploads
        // the following data will return an array (you may need to use
        // getInstances method)
        $file = UploadedFile::getInstance($this, 'file');
 
        // if no image was uploaded abort the upload
        if (empty($file)) {
            return false;
        }
 
        // store the source file name
        $this->filename = $file->name;
        $ext = end((explode(".", $file->name)));
 
        // generate a unique file name
        $this->name = Yii::$app->security->generateRandomString().".{$ext}";
 
        // the uploaded image instance
        return $file;
    }
    public function deleteImage() {
        $file = $this->getImageFile();
 
        // check if file exists on server
        if (empty($file) || !file_exists($file)) {
            return false;
        }
 
        // check if uploaded file can be deleted on server
        if (!unlink($file)) {
            return false;
        }
 
        // if deletion successful, reset your file attributes
        $this->attachment = null;
        $this->filename = null;
 
        return true;
    }      
}