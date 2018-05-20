<?php

namespace app\modules\visits\models;

use app\models\User;
use app\models\Location;
use app\models\Person;
use Yii;
use yii\web\UploadedFile;


class Visits extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'visits';
    }

    public $file;
    public $filename;  

    public static $Static_approved = [
        'NÃO', 
        'SIM',
        ];   
    public function getApproved()
    {
        if ($this->approved === null) {
            return null;
        }
        return self::$Static_approved[$this->approved];
    }      

    public function rules()
    {
        return [
            [['date', 'company_person', 'visits_finality_id', 'visits_status_id', 'person_id', 'location_id', 'user_id','visits_status_id'], 'required', 'message' => 'Campo Obrigatório'],
            [['date', 'created', 'updated','attachment','approvedin'], 'safe'],
            [['value'], 'number'],
            [['num_proposal', 'visits_finality_id', 'visits_status_id', 'person_id', 'location_id', 'user_id', 'approved', 'approved_id'], 'integer'],
            [['observation'], 'string'],
            [['responsible', 'company_person', 'contact', 'email', 'phone'], 'string', 'max' => 45],
            [['ip'], 'string', 'max' => 20],
            [['localization_map'], 'string', 'max' => 100],
            [['file'], 'file', 'extensions'=>'doc, docx, xls, xlsx', 'maxSize' => 1024 * 1024 * 4],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Data',
            'responsible' => 'Responsável',
            'company_person' => 'Empresa / Pessoa',
            'contact' => 'Contato',
            'email' => 'E-mail',
            'phone' => 'Telefone',
            'value' => 'Valor',
            'num_proposal' => 'Nº Proposta',
            'observation' => 'Parecer',
            'created' => 'Criado em',
            'updated' => 'Alterado em',
            'ip' => 'IP',
            'attachment' => 'Anexo',
            'file' => 'Anexo (FE211)',
            'localization_map' => 'Localização No Mapa',
            'visits_finality_id' => 'Finalidade ',
            'visits_status_id' => 'Situação',
            'person_id' => 'Tipo',
            'location_id' => 'PA',
            'user_id' => 'Gerente',
            'approved'    => 'Aprovado?',
            'approved_id' => 'Aprovado por',
            'approvedin'  => 'Aprovado em',
        ];
    }

    public function getImageFile()
    {
        return isset($this->attachment) ? \Yii::$app->getModule('visits')->params['visitAttachment'] . $this->attachment : null;
    }
    public function getImageUrl()
    {
        // return a default image placeholder if your source attachment is not found
        $attachment = isset($this->attachment) ? $this->attachment : 'default-attachment.png';
        return \Yii::$app->getModule('visits')->params['visitAttachment'] . $attachment;
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
        $this->attachment = Yii::$app->security->generateRandomString().".{$ext}";
 
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

    public function getLocation()
    {
        return $this->hasOne(Location::className(), ['id' => 'location_id']);
    }

    public function getPerson()
    {
        return $this->hasOne(Person::className(), ['id' => 'person_id']);
    }

    public function getVisitsStatus()
    {
        return $this->hasOne(Visitsstatus::className(), ['id' => 'visits_status_id']);
    }

    public function getVisitsFinality()
    {
        return $this->hasOne(Visitsfinality::className(), ['id' => 'visits_finality_id']);
    }

    public function getVisitsImages()
    {
        return $this->hasMany(Visitsimages::className(), ['business_visits_id' => 'id']);
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getMannager()
    {
        return $this->hasOne(User::className(), ['id' => 'approved_id']);
    }       
}