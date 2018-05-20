<?php

namespace app\modules\ideas\models;

use Yii;

/**
 * This is the model class for table "ideas_attachment".
 *
 * @property integer $id
 * @property integer $ideas_id
 * @property string $name
 */
class Attachment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ideas_attachment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ideas_id', 'name'], 'required'],
            [['ideas_id'], 'integer'],
            [['name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ideas_id' => 'Ideas ID',
            'name' => 'Name',
        ];
    }
}
