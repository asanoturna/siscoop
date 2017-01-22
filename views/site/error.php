<?php
use yii\helpers\Html;

$this->title = $name;
?>
<div class="site-error">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

    <p>
    Ocorreu um erro no sistema ao tentar processar sua solicitação
    </p>
    <p>
    Entre em contato com administrador caso necessário
    </p>

</div>