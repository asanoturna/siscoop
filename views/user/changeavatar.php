<?php
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\widgets\DetailView;

$this->title = 'Alterar Imagem';
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

    <?php foreach (Yii::$app->session->getAllFlashes() as $key=>$message):?>
        <?php $alertClass = substr($key,strpos($key,'-')+1); ?>
        <div class="alert alert-dismissible alert-<?=$alertClass?>" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <p><?=$message?></p>
        </div>
    <?php endforeach ?>     

    <div class="panel panel-default">
      	<div class="panel-body">    

		<?php
        use bupy7\cropbox\Cropbox;

        $form = ActiveForm::begin([
            'options' => ['enctype'=>'multipart/form-data'],
        ]);

        echo $form->field($model, 'image')->widget(Cropbox::className(), [
            'attributeCropInfo' => 'crop_info',
        ]);
        ?>
        <hr/>
        <div class="form-group">
            <?= Html::submitButton('Gravar', ['class' => 'btn btn-success', 'name' => 'signup-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>         

		</div>
	</div>
  
    </div>
    </div>
</div>
