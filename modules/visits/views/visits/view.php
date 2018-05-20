<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\data\SqlDataProvider;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\helpers\Url;

$this->title = "Detalhes da visita #" . $model->id;
?>
<div class="visits-view">

    <div class="row">
      <div class="col-md-6"><h1><?= Html::encode($this->title) ?></h1></div>
      <div class="col-md-6"><span class="pull-right" style="top: 15px;position: relative;"><?php  echo $this->render('_menu'); ?></span></div>
    </div>
    <hr/>

    <div class="row">
        <div class="col-md-6">    
    <?php foreach (Yii::$app->session->getAllFlashes() as $key=>$message):?>
        <?php $alertClass = substr($key,strpos($key,'-')+1); ?>
        <div class="alert alert-dismissible alert-<?=$alertClass?>" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <p><?=$message?></p>
        </div>
    <?php endforeach ?>
    </div>
        <div class="col-md-6">
        <?php
        if ($model->user_id === Yii::$app->user->id){ ?>
                    <p class="pull-right">
                    <?= Html::a('<span class="glyphicon glyphicon-print" aria-hidden="true"></span> Imprimir', '#', ['onclick'=>"myFunction()",'class' => 'btn btn-success']) ?>
                    <?= Html::a('<span class="glyphicon glyphicon-camera" aria-hidden="true"></span> Imagens', ['visitsimages/create', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
                    <?= Html::a('<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Alterar', ['update', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
                    <?= Html::a('<span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Excluir', ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Tem certeza que deseja excluir?',
                            'method' => 'post',
                        ],
                    ]) ?>
                </p>

        <?php } ;?>
      

        </div>
    
    </div>

    <div class="row container-fluid">
    <div class="panel panel-default">
    <div class="panel-heading"><span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span> <strong>Informações da Visita</strong></div>
    <div class="panel-body">
        <div class="col-md-6">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    [ 
                        'label' => 'Data',
                        'format' => 'raw',
                        'value' => date("d/m/Y",  strtotime($model->date))
                    ],
                    'company_person',
                    'responsible',
                    
                    'contact',
                    'email:email',
                    'phone',
                    [ 
                        'label' => 'Valor',
                        'format' => 'raw',
                        'value' => "R$ ".$model->value,
                    ],   
                ],
            ]) ?>
        </div>
        <div class="col-md-6">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [ 
                    [ 
                    'label' => 'Usuário',
                    'format' => 'raw',
                    'value' => $model->user->username,
                    ],  
                    'location.fullname',                     
                    'visitsFinality.name',
                    'person.name', 
                    'num_proposal',
                    [
                   'attribute'=>'attachment',
                   'format' => 'raw',
                   'value' => $model->attachment == null ? "<span class=\"not-set\">(sem anexo)</span>" : '<span class="glyphicon glyphicon-paperclip"></span> '.Html::a('Visualizar Anexo', \Yii::$app->getModule('visits')->params['visitAttachment'].$model->attachment, ['target' => '_blank']),
                    ], 
                    [ 
                    'label' => 'Situação',
                    'format' => 'raw',
                    'value' => "<strong style=\"color:".$model->visitsStatus->hexcolor."\">" . $model->visitsStatus->name . "</strong>",
                    ],                                         
                ],
            ]) ?>
        </div>
    </div>
    </div>
    </div>

    <div class="row container-fluid">
        <div class="panel panel-default">
          <div class="panel-heading"><span class="glyphicon glyphicon-comment" aria-hidden="true"></span> <strong>Parecer do Gerente</strong></div>
          <div class="panel-body">
            <?php echo $model->observation;?>
          </div>
        </div>
    </div> 

    <div class="row container-fluid">
        <div class="panel panel-default">
          <div class="panel-heading"><a name="img"></a><span class="glyphicon glyphicon-picture" aria-hidden="true"></span> <strong>Imagens da Visita</strong></div>
          <div class="panel-body">
            <?php
            $cod = $model->id;
            $dataProvider = new SqlDataProvider([
                'sql' => "SELECT i.name as img
                FROM visits_images i
                WHERE i.business_visits_id = $cod",
                'totalCount' => 200,
                'sort' =>false,
                'key'  => 'img',
                'pagination' => [
                    'pageSize' => 200,
                ],
            ]);
            ?>
            <?php             
            // echo "<div class=\"thumbnail\">";
            // echo "<div class=\"img-wrapper\">";
            //     $prov = $models = $dataProvider->getModels();
            //     if(!empty($prov))
            //         {
            //             foreach($prov as $row)
            //             {
            //                 echo Html::a(Html::img(\Yii::$app->getModule('visits')->params['visitImages'].$cod.'/'.$row["img"],
            //                  ['width' => '50px']), \Yii::$app->getModule('visits')->params['visitImages'].$cod.'/'.$row["img"], ['target' => '_blank', 'class' => 'img-thumbnail']);
            //             }   
            //         } else {
            //             echo "<span class=\"not-set\">(não possui imagens)</span>";
            //         }
            // echo "</div>";                
            // echo "</div>";   
            ?>
            <?php         
            $items = array();
                $prov = $models = $dataProvider->getModels();
                if(!empty($prov))
                    {
                        foreach($prov as $row)
                        {
                            // $items[] = [
                            //     'url' => \Yii::$app->getModule('visits')->params['visitImages'].$cod.'/'.$row["img"],
                            //     'options' => array('class' => 'img-thumbnail', ['width' => '50px']),
                            //     'src' => \Yii::$app->getModule('visits')->params['visitImages'].$cod.'/'.$row["img"],
                            //     ];
                            echo Html::a(Html::img(\Yii::$app->getModule('visits')->params['visitImages'].$cod.'/'.$row["img"],
                             ['width' => '50px']), \Yii::$app->getModule('visits')->params['visitImages'].$cod.'/'.$row["img"], ['target' => '_blank', 'class' => 'img-thumbnail']);
                        }   
                    } else {
                        echo "<span class=\"not-set\">(não possui imagens)</span>";
                    }

                    //var_dump($items);
            ?>
          </div>
        </div>
    </div>

    <div class="row container-fluid">
        <div class="panel panel-default">
          <div class="panel-heading"><a name="map"></a><span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span> <strong>Mapa da Localização</strong> <?php echo $model->localization_map;?></div>
          <div class="panel-body">
                <?php
                use tugmaks\GoogleMaps\Map;
                if($model->localization_map <> ''){  
                    echo Map::widget([
                        'apiKey'=> 'AIzaSyDu0tafuRLYW1BW7OgMe7CuFIDAwCXS4A0',
                        'zoom' => 16,
                        'center'=> $model->localization_map,
                        'width' => 900,
                        'height' => 400,
                        'mapType' => Map::MAP_TYPE_ROADMAP,
                        'markers' => [
                            ['position' => 'Governador Valadares, MG '.$model->localization_map,],
                            ['position' => 'Governador Valadares, rua belo horizonte, 761 '],
                        ]
                    ]);
                }else{
                    echo "<span class=\"not-set\">(endereço não informado)</span>";
                }
                
                ?>
          </div>
        </div>
    </div>  

    <div class="row container-fluid">
        <div class="panel panel-default">
          <div class="panel-heading"><span class="glyphicon glyphicon-hdd" aria-hidden="true"></span> <strong>Informações do Sistema</strong></div>
          <div class="panel-body">
    <div class="row">
      <div class="col-md-6">
        <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    [ 
                        'attribute' => 'id',
                        'label' => 'ID (Número da visita)',
                        'format' => 'raw',
                        'value' => $model->id,
                    ],  
                    [ 
                        'attribute' => 'created',
                        'format' => 'raw',
                        'value' => date("d/m/Y",  strtotime($model->created))
                    ],           
                    [ 
                        'attribute' => 'updated',
                        'format' => 'raw',
                        'value' => date("d/m/Y",  strtotime($model->updated))
                    ],  
                    [ 
                        'attribute' => 'ip',
                        'label' => 'IP (Terminal de origem)',
                        'format' => 'raw',
                        'value' => $model->ip,
                    ],
                ],
            ]) ?>
      </div>
      <div class="col-md-6">
        <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    [ 
                        'attribute' => 'approved',
                        'format' => 'raw',
                        'value' => $model->approved == 1 ? '<b style="color:#6CAF3F">SIM</b>' : '<b style="color:#d43f3a">NÃO</b>',
                    ],  
                    [ 
                        'attribute' => 'approved_id',
                        'format' => 'raw',
                        //'value' => $model->approved_id,
                        'value' => $model->approved_id == null ? "<span class=\"not-set\">(nenhum)</span>" : $model->user->username,
                    ],           
                    [ 
                        'attribute' => 'approvedin',
                        'format' => 'raw',
                        'value' => date("d/m/Y",  strtotime($model->approvedin))
                    ],  
                ],
            ]) ?>
      </div>
    </div>
          </div>
        </div>
    </div>  

<script>
function myFunction() {
    window.print();
}
</script>
</div>