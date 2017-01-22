<?php

namespace app\modules\task\models;
use app\models\Department;
use app\models\User;
use yii\web\UploadedFile;
use Yii;

class Todolist extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'mod_task_list';
    }

    public function rules()
    {
        return [
            [['name', 'department_id', 'category_id', 'status_id', 'deadline', 'priority_id', 'owner_id', 'responsible_id', 'co_responsible_id', 'created', 'updated'], 'required'],
            [['description','responsible_note'], 'string'],
            [['department_id', 'category_id', 'status_id', 'priority_id', 'owner_id', 'responsible_id', 'co_responsible_id', 'is_done'], 'integer'],
            [['attachment', 'file', 'filename', 'deadline', 'created', 'updated'], 'safe'],
            [['file'], 'file', 'extensions'=>'jpg, png, pdf, doc, docx, xls, xlsx', 'maxSize' => 1024 * 1024 * 4],
            [['name','attachment'], 'string', 'max' => 200],
            // [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => ModTaskStatus::className(), 'targetAttribute' => ['status_id' => 'id']],
            // [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => ModTaskCategory::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    public $file;
    public $filename;

    public function getImageFile()
    {
        return isset($this->attachment) ? \Yii::$app->getModule('task')->params['taskAttachment'] . $this->attachment : null;
    }
    public function getImageUrl()
    {
        $attachment = isset($this->attachment) ? $this->attachment : 'default-attachment.png';
        return \Yii::$app->getModule('task')->params['taskAttachment'] . $attachment;
    }
    public function uploadImage()
    {
        $file = UploadedFile::getInstance($this, 'file');
 
        if (empty($file)) {
            return false;
        }
 
        $this->filename = $file->name;
        $ext = @end((explode(".", $file->name)));
 
        $this->attachment = Yii::$app->security->generateRandomString().".{$ext}";
 
        return $file;
    }
    public function deleteImage()
    {
        $file = $this->getImageFile();
 
        if (empty($file) || !file_exists($file)) {
            return false;
        }
 
        if (!unlink($file)) {
            return false;
        }
 
        $this->attachment = null;
        $this->filename = null;
 
        return true;
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Nome da Atividade',
            'description' => 'Descrição da Atividade',
            'department_id' => 'Departamento',
            'category_id' => 'Periodicidade',
            'status_id' => 'Situação',
            'deadline' => 'Prazo para Atividade',
            'priority_id' => 'Prioridade',
            'owner_id' => 'Criado por',
            'responsible_id' => 'Responsável',
            'co_responsible_id' => 'Co-responsável',
            'is_done' => 'Feito?',
            'created' => 'Criado em',
            'updated' => 'Alterado em',
            'flag_remember_task' => 'Lembrar Responsável por e-mail',
            'flag_report_responsible' => 'Notificar Responsável por e-mail',
            'responsible_note' => 'Observação Responsável',
            'attachment' => 'Passo a passo',
            'file' => 'Anexo',
            'notification_created' => 'Notificação Nova Atividade',
            'notification_deadline' => 'Notificação de Lembrete'
        ];
    }

    public function getPriority()
    {
        return $this->hasOne(Priority::className(), ['id' => 'priority_id']);
    }

    public function getStatus()
    {
        return $this->hasOne(Status::className(), ['id' => 'status_id']);
    }

    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    public function getDepartment()
    {
        return $this->hasOne(Department::className(), ['id' => 'department_id']);
    }

    public function getOwner()
    {
        return $this->hasOne(User::className(), ['id' => 'owner_id']);
    }

    public function getResponsible()
    {
        return $this->hasOne(User::className(), ['id' => 'responsible_id']);
    }

    public function getCoresponsible()
    {
        return $this->hasOne(User::className(), ['id' => 'co_responsible_id']);
    }
}
