<?php
use yii\helpers\Html;

?>
    <h3>Calendário de Atividades - Nova Atividade</h3> 
    <br/>
    Foi registrado no módulo Calendário de Atividades, uma atividade destinada a você.
    <p>Clique no link abaixo para acessar o registro da atividade e após concluída altere a situação para o tipo correspondente.
    </p>
    <?= Html::a('Clique aqui para acessar', ['/task/todolist/view', 'id' => $model]) ?>
    <br/>
    <p>
    <br/>
    Mensagem enviada automaticamente por <?= Yii::$app->name ?>
    </p>