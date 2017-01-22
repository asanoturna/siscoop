<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Department;
use app\modules\task\models\Category;
use app\modules\task\models\Priority;
use app\modules\task\models\Todolist;
use app\modules\task\models\Status;
use app\models\User;
use yii\widgets\MaskedInput;
use yii\helpers\ArrayHelper;

$this->title = 'Alterar Situação da Atividade #' . $model->id;
?>
<div class="todolist-responsible">

    <div class="row">
      <div class="col-md-6"><h1><?= Html::encode($this->title) ?></h1></div>
      <div class="col-md-6"><span class="pull-right" style="top: 15px;position: relative;"><?php  echo $this->render('_menu'); ?></span></div>
    </div>
    <hr/>

    <div class="panel panel-default">
    <div class="panel-body"> 

    <?php $form = ActiveForm::begin([
        'id' => 'visitsform',
        'options' => [
            'enctype'=>'multipart/form-data',
            //'class' => 'form-horizontal',
            ],
    ]); ?>

    <div class="row">
      <div class="col-md-6">

        <?= $form->field($model, 'status_id')->dropDownList(ArrayHelper::map(Status::find()->orderBy("name ASC")->all(), 'id', 'name'))  ?>

        <?= $form->field($model, 'responsible_note')->widget(\yii\redactor\widgets\Redactor::className(), [
            'clientOptions' => [
                'minHeight' => 230,
                'lang' => 'pt_br',
                'buttons'=> ['bold', 'italic', 'deleted','unorderedlist', 'orderedlist', 'link', 'alignment'],
            ]
        ])?> 

      </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Gravar' : 'Gravar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>


    </div>
    </div>

</div>
