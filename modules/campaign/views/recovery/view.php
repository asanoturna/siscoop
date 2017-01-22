<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = 'Campanha Recupere e Ganhe - #' . $model->id;
?>
<div class="recovery-view">

    <div class="row">
      <div class="col-md-6"><h1><?= Html::encode($this->title) ?></h1></div>
      <div class="col-md-6"><span class="pull-right" style="top: 15px;position: relative;"><?php  echo $this->render('_menu'); ?></span></div>
    </div>
    <hr/>

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Alterar', ['update', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
        <?php
        // Html::a('Excluir', ['delete', 'id' => $model->id], [
        //     'class' => 'btn btn-danger',
        //     'data' => [
        //         'confirm' => 'Confirma exclusão?',
        //         'method' => 'post',
        //     ],
        // ]) 
        ?>
    </p>

    <div class="row">
      <div class="col-md-5">

    <div class="panel panel-default">
    <div class="panel-heading"><b>Informações</b></div>
    <div class="panel-body">    

    <?= DetailView::widget([
        'model' => $model,
        'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => '<span class="not-set"><em>não informado</em></span>'],
        'attributes' => [
            'id',
            [ 
                'attribute' => 'typeofdebt',  
                'format' => 'raw',
                'value' => $model->Typeofdebt,
            ],  
            'location.fullname',  
            'clientname',
            'clientdoc',
            'contracts',
            'referencevalue',
            'value_input',
            'value_traded',
            [ 
                'attribute' => 'typeproposed',  
                'format' => 'raw',
                'value' => $model->Typeproposed ? '<span class="label label-default">'.$model->Typeproposed.'</span>' : null,
            ],              
            'commission',  
            [ 
                'attribute' => 'negotiator_id',
                'format' => 'raw',
                'value' => $model->user ? $model->user->username : null,
            ],
            [ 
                'attribute' => 'date',
                'format' => 'raw',
                'value' => $model->date == NULL ? null : date("d/m/Y",  strtotime($model->date)),
            ],            
        ],
    ]) ?>
        <?= DetailView::widget([
        'model' => $model,
        'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => '<span class="not-set"><em>não informado</em></span>'],
        'attributes' => [
            [ 
                'attribute' => 'status',  
                'format' => 'raw',
                'value' => $model->status == 1 ? '<span class="label label-success">APROVADO</span>' : '<span class="label label-warning">PENDENTE</span>',
            ],
            'approvedby',
            [ 
                'attribute' => 'approvedin',
                'format' => 'raw',
                'value' => $model->approvedin == NULL ? null : date("d/m/Y",  strtotime($model->approvedin)),
            ],             
        ],
    ]) ?>

    </div>
    </div>  

      </div>
      <div class="col-md-7">

    <div class="panel panel-default">
    <div class="panel-heading"><strong>Legenda</strong></div>
    <div class="panel-body">
    <?php
        //CALCULO DAS PROPOSTAS
        $diff = strtotime(date('Y-m-d')) - strtotime($model->expirationdate);
        $days = intval($diff / 60 / 60 / 24);

        // FATOR DE MULTIPLICAÇÃO BASEADO NO TIPO DE DEBITO
        if ($model->typeofdebt == 0) {
            $factor = 1;
        } elseif ($model->typeofdebt == 1) {
            $factor = 1.2;
        } elseif ($model->typeofdebt == 2) {
            $factor = 1.1;
        } elseif ($model->typeofdebt == 3) {
            $factor = 1.1;
        }

        // FORMULAS
        $formula1 = $model->referencevalue*(pow((1+0.018),($days/30)));
        $formula2 = $model->referencevalue*(pow((1+0.01),($days/30)));
        $formula3 = ($formula1 + $formula2) * 0.02;
        $proposal = $formula1+$formula2+$formula3;

        // PROPOSTA A
        $proposal_A = $proposal;
        $proposal_A = "R$ " . round((($proposal_A*$factor)), 2);
        // PROPOSTA B
        $proposal_B = $formula1;
        $proposal_B = "R$ " . round((($proposal_B*$factor)), 2);
        // PROPOSTA C
        $proposal_C = ($model->referencevalue*(pow((1+0.015),($days/30))));
        $proposal_C = "R$ " . round((($proposal_C*$factor)), 2);
        // PROPOSTA D
        $proposal_D = ($model->referencevalue*(pow((1+0.013),($days/30))));
        $proposal_D = "R$ " . round((($proposal_D*$factor)), 2);
        // PROPOSTA E
        $proposal_E = ($model->referencevalue*(pow((1+0.011),($days/30))));
        $proposal_E = "R$ " . round((($proposal_E*$factor)), 2);
        // PROPOSTA F
        $proposal_F = ($model->referencevalue*(pow((1+0.0067),($days/30))));
        $proposal_F = "R$ " . round((($proposal_F*$factor)), 2);
        // PROPOSTA G
        $proposal_G = $model->referencevalue*(pow((1+0.01),($days/30)));
        $proposal_G = "R$ " . round((($proposal_G*0.7)), 2);
        // PROPOSTA H
        $proposal_H = $model->referencevalue*(pow((1+0.01),($days/30)));
        $proposal_H = "R$ " . round((($proposal_H*0.5)), 2);

        // DISTRIBUIÇÃO COMISSÃO
        $comission_f = "R$ " . round(($model->commission*0.60), 2);
        $comission_e = "R$ " . round(($model->commission*0.40), 2);
    ?>
    
        <table class="table">
            <tr class="active">
                <td>PROPOSTA</td>
                <td>ALÇADA</td>
                <td>PISO NEGOCIAL</td>
                <td>COMISSÃO</td>
            </tr>
            <tr>
                <td><span class="label label-default">A</span> <small>atualização a juros de 1,8 % a.m com multa e mora</small></td>
                <td>Agência</td>
                <td><?=$proposal_A;?></td>
                <td><span class="label label-primary">5%</span></td>
            </tr>
            <tr>
                <td><span class="label label-default">B</span> <small>atualização a juros de 1,8 % a.m sem multa e sem mora</small></td>
                <td>Agência</td>
                <td><?=$proposal_B;?></td>
                <td><span class="label label-primary">3%</span></td>
            </tr>
            <tr>
                <td><span class="label label-default">C</span> <small>atualização a juros de 1,5 % a.m sem multa e sem mora</small></td>
                <td>Agência</td>
                <td><?=$proposal_C;?></td>
                <td><span class="label label-primary">2%</span></td>
            </tr>   
            <tr>
                <td><span class="label label-default">D</span> <small>atualização a juros de 1,3 % a.m sem multa e sem mora</small></td>
                <td>Supervisor</td>
                <td><?=$proposal_D;?></td>
                <td><span class="label label-success">1%</span></td>
            </tr>
            <tr>
                <td><span class="label label-default">E</span> <small>atualização a juros de 1,1 % a.m sem multa e sem mora</small></td>
                <td>Diretor</td>
                <td><?=$proposal_E;?></td>
                <td><span class="label label-success">0,50%</span></td>
            </tr>
            <tr>
                <td><span class="label label-default">F</span> <small>atualização a juros de 0,6677 % a.m sem multa e sem mora</small></td>
                <td>Diretor</td>
                <td><?=$proposal_F;?></td>
                <td><span class="label label-success">0,30%</span></td>
            </tr>
            <tr>
                <td><span class="label label-default">G</span> <small>atualização a juros de 1 % a.m (s/mora e s/multa) e desconto de <b>30%</b></small></td>
                <td>Diretor</td>
                <td><?=$proposal_G;?></td>
                <td><span class="label label-default">0%</span></td>
            </tr>
            <tr>
                <td><span class="label label-default">H</span> <small>atualização a juros de 1 % a.m (s/mora e s/multa) e desconto de <b>50%</b></small></td>
                <td>Diretor</td>
                <td><?=$proposal_H;?></td>
                <td><span class="label label-default">0%</span></td>
            </tr>
        </table>
        <p class="text-warning"><i class="fa fa-info-circle" aria-hidden="true"></i> Propostas A, B e C são aprovadas automaticamente!</p> 
        <p class="text-warning"><i class="fa fa-info-circle" aria-hidden="true"></i> Propostas G e H são para pagamento à vista</p>
        </div></div>

    <div class="panel panel-default">
    <div class="panel-heading"><strong>Distribuição da Comissão</strong></div>
    <div class="panel-body">
        <table class="table">
            <tr>
                <td>FUNCIONÁRIOS</td>
                <td><?=$comission_f;?></td>
            </tr>
            <tr>
                <td>EQUIPE</td>
                <td><?=$comission_e;?></td>
            </tr>                                    
          </table>
          <p class="text-warning"><i class="fa fa-info-circle" aria-hidden="true"></i> Se o valor da entrada for inferior a 10% do valor negociado, a comissão é zerada!</p>
        </div>
    </div>

      </div>
    </div>



</div>