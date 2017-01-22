<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\modules\campaign\models\Recovery;
use yii\helpers\ArrayHelper;
use app\models\Location;
use app\models\User;

$this->title = 'Regulamento do Portal de Idéias';
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
      <img src="<?php echo Yii::$app->request->baseUrl;?>/images/logo-idea.png" class="media-object">
    </a>
  </div>
  <div class="media-body">
<h3>REGULAMENTO</h3> O Projeto de Incentivo à Boas Ideias é uma iniciativa da Cooperativa Sicoob Crediriodoce com o objetivo de incentivar, transformar e aplicar as boas ideias propostas e desenvolvidas por seus empregados.

O programa irá oferecer prêmios como forma de reconhecimento e incentivo à inteligência organizacional bem como a busca da excelência operacional através da participação ativa e direta de seus empregados
  

<h3>1. DAS BOAS IDEIAS</h3> 
Boas ideias são todas as sugestões que contribuem para melhorar, alterar, criar e inovar os processos, os métodos, os produtos e os serviços, trazendo benefícios para a cooperativa, corpo de empregados, quadro de associados e comunidade.

Podendo ser descritas também como sugestões de melhoria que trazem aumento de rentabilidade, agilidade de processo, diminuição de tempo ou diminuição de custo na operação do atendimento, processo, TI, comercial e financeiro.


<h3>2. DAS INSCRIÇÕES </h3>  
As ideias deverão seguir os critérios supracitados e devidamente cadastradas no “Portal de Ideias” localizado na intranet Crediriodoce.   
  </div>
</div>

<h3>3. DA AVALIAÇÃO</h3>	
As ideias serão avaliadas e classificadas conforme segue:

O Comitê de Incentivo a Inovação, através do Portal, será informado sobre as ideias cadastradas pelos empregados, as quais serão incluídas na pauta das reuniões, conforme ordem de cadastramento.

Após isto, serão tomadas as seguintes ações:

I.  Aprovação ou Reprovação da ideia pelo comitê respeitando quórum de 5 integrantes;
II. A ideia é apresentada à Diretoria Executiva;
III.  O comitê em conjunto com a área afim elabora o projeto da ideia aprovada.  
IV. A ideia será colocada em prática respeitando a sua viabilidade;
V.  Uma vez implantada, a ideia será acompanhada pelo comitê. 


Cabe ao Comitê dar retorno a todas as propostas em até 2 dias úteis, após a ideia ser apresentada em reunião. 
													
														
<h3>Forma de distribuição dos valores</h3>
60 % destinado ao (s) funcionário (s) envolvido na negociação													
40 % destinado para a equipe da agência relacionada.													
Para o setor de recuperação os valores destinados serão rateados de forma proporcional a todos envolvidos no setor.																										
<h3>4. DA PREMIAÇÃO</h3>
A premiação será prestada em 2 modalidades, a saber:

• Premiação por pontos;
• Premiação por Ranking de Melhores Ideias. 

    </div>
    </div>
</div>