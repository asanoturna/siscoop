<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Yii::$app->params['appname'] . ' > Autenticação';
?>
<div class="user-default-login">
    <div class="container">
        <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">
            <div class="panel panel-default">
              <div class="panel-heading"><h1 class="text-center login-title"><i class="fa fa-lock pull-left" aria-hidden="true"></i>
 Autenticação</h1></div>
              <div class="panel-body">
                    <div class="account-wall">
                    <?php $form = ActiveForm::begin([
                        'id' => 'login-form',
                        'options' => ['class' => 'form-signin'],
                    ]); ?>

                    <?= $form->field($model, 'username')->label('Usuário',['class'=>'label-class'])->textInput(['autofocus' => true]) ?>
                    <?= $form->field($model, 'password')->label('Senha',['class'=>'label-class'])->passwordInput() ?>
                    <?php // $form->field($model, 'rememberMe')->checkbox() ?>

                    <?= Html::submitButton('Entrar', ['class' => 'btn btn-lg btn-success btn-block']) ?>
                    </p>
                    <?php // Html::a('Esqueceu sua senha' . "?", ["site/request-password-reset"], array('class' => 'text-center new-account')) ?>

                    <?php ActiveForm::end(); ?>
                    </br>
                    <p class="text-muted">(Senha inicial de todos usuários: <b>123456</b>)</p>
                    </div>
              </div>
            </div>      
        
        </div>
        </div>
    </div> 
</div>