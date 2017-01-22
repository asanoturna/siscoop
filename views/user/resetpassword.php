<?php
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\widgets\DetailView;

$this->title = 'Alterar Senha';
?>
<div class="site-profile">

    <div class="row">
    <div class="col-sm-2">
    <?php  echo $this->render('//site/_menu'); ?>
    </div>

    <div class="col-sm-10">
    <div class="row">
      <div class="col-md-6"><h1><?= Html::encode($this->title) ?></h1></div>
      <div class="col-md-6"><span class="pull-right" style="top: 15px;position: relative;"><?php  echo $this->render('_menu'); ?></span></div>
    </div>
    <hr/>

    <div class="panel panel-default">
        <div class="panel-body">    
        <div class="col-md-5">
        <?php $form = ActiveForm::begin(); ?>
                    <?php echo $form->field($resetPasswordForm, 'password')->passwordInput(); ?>
                    <?php echo $form->field($resetPasswordForm, 'confirmPassword')->passwordInput(); ?>
                    <div class="form-group">
                        <?php echo Html::resetButton('Cancelar', ['class' => 'btn btn-default']) ?>
                        <?php echo Html::submitButton('Alterar', ['class' => 'btn btn-success']) ?>
                    </div>
        <?php ActiveForm::end(); ?>
        </div>
        </div>
    </div>
    
    </div>
    </div>
</div>