<?php
use yii\helpers\Html;

?>
    <h3>Calendário de Atividades - Lembrete</h3> 
    <br/>
    Essa mensagem é um lembrete de atividade registrada no sistema destinada a você. 
    <p style="color:red;">O prazo máximo é até hoje!</p>
    <p>Clique no link abaixo para acessar o registro da atividade e após concluída altere a situação para o tipo correspondente.
    </p>
    <?= Html::a('Clique aqui para acessar', ['/task/todolist/view', 'id' => $model]) ?>
    <br/>
    <p>
    <br/>
    Mensagem enviada automaticamente por <?= Yii::$app->name ?>
    </p>