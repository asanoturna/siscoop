<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\modules\campaign\models\Recovery;
use yii\helpers\ArrayHelper;
use app\models\Location;
use app\models\User;

$this->title = 'Regulamento da Campanha Recupere e Ganhe';
?>
<div class="recovery-index">

    <div class="row">
      <div class="col-md-6"><h1><?= Html::encode($this->title) ?></h1></div>
      <div class="col-md-6"><span class="pull-right" style="top: 15px;position: relative;"><?php  echo $this->render('_menu'); ?></span></div>
    </div>
    <hr/>

    <div class="panel panel-default">
    <div class="panel-body">

<div class="media">
  <div class="media-left media-middle">
    <a href="#">
      <img src="<?php echo Yii::$app->request->baseUrl;?>/images/logo-recovery.png" class="media-object">
    </a>
  </div>
  <div class="media-body">
<h3>Objetivo</h3> Impactar positivamente o resultado dos recebimentos da carteira de inadimplência da cooperativa de tal forma a possibilitar o alcance das metas de 2016 e premiar os funcionários e agências envolvidos   

<h3>Vigência</h3> 
01/09/2016  31/12/2016

<h3>Associados Envolvidos</h3>  
Participarão da campaha a base de associados direcionada pelo setor de recuperação e disponibilizada na intranet. 
  </div>
</div>

<h3>Participação</h3>	
Todos os funcionários que atuarem ativa e efetivamente na negociação da dívida.													
O Setor de recuperação de crédito.													
														
<h3>Forma de distribuição dos valores</h3>
60 % destinado ao (s) funcionário (s) envolvido na negociação													
40 % destinado para a equipe da agência relacionada.													
Para o setor de recuperação os valores destinados serão rateados de forma proporcional a todos envolvidos no setor.																										
<h3>Condições</h3>

<ul>
  <li>Só será considerada válida como ação ativa e efetiva os registros realizados no período da campanha no sistema SisBr 2.0 no módulo de cobrança administrativa</li>
  <li>Ações como: confecção de contrato, registro da proposta, cálculo da dívida, não são consideradas como ativas e efetivas, portante inirentes ao trabalho</li>
  <li>Acordos realizados pelos escritórios terceirizados não serão considerados, desde que possuam ações ativas e efetivas na negociação demonstradas no sistema de cobrança administrativa e aprovados pelo comitê de recuperação.</li>
  <li>A parte destinada ao pagamento do funcionário (poderá ser rateada em até 3 funcionários 20 % para cada parte), porém desde que registradas as ações no sistema e avaliadas pelo comitê</li>
  <li>A parte destinada à agência (equipe) poderá ser rateada com o setor de recuperação, caso seja demonstrada a participação efetiva do mesmo na negociação, avaliado pelo comitê de ercuperação</li>
  <li>Nos casos quando as ações ativas e efetivas forem realizadas pelo setor de recuperação e demonstradas no sistema de cobrança administrativa apenas, o setor receberá a comissão</li>
  <li>Nos casos quando as ações ativas e efetivas forem realizadas em conjunto entre agência e setor de recuperação, a comissão será destinada ao funcionário e à agência em 50 % do valor valor devido e o restante destinado ao setor, portante sendo 30 % ao funcionário e 30 % ao setor; 20 % para à agência e 20 % ao setor</li>
  <li>Será considera como equipe da agência sede a segmentação PF como uma equipe e PJ outra equipe</li>
  <li>Serão consideradas ações como: ligação efetiva de contato com o associado, avalistas e relacionados, visitas comprovadas e reuniões</li>
  <li>Ao final da campanha a agência destaque no resultado acumulado em 1º lugar receberá uma premiação no mês subsequente de R$ 1.000,00; em 2º lugar de R$ 700,00 e em 3º lugar de 500,00</li>
</ul>

<div class="alert alert-danger">
  <i class="fa fa-exclamation-triangle fa-lg" aria-hidden="true"> </i> As ações serão julgadas pelo comitê de recuperação, principalemente os casos com envolvimento do setor Crédito, Cadastro e Cobrança</div>

    </div>
    </div>
</div>