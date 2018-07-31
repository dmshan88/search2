<?php
use yii;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
/* @var $this yii\web\View */
/* @var $model app\models\PanelResultSearch */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="panel-result-search">

    <?php $form = ActiveForm::begin([
        'action' => [$action,'modelflag'=>$modelflag],
        'method' => 'get',
    ]); ?>




    <?php // echo $form->field($model, 'hardware3version') ?>

    <?php  echo $form->field($model, 'machineid') ?>

    <?php 
    //echo $form->field($model, 'panelid')
     //       ->dropDownList(Yii::$app->params['PANEL_NAME'] ,['prompt'=>'Select...']); 
    ?>
    <?php // echo $form->field($model, 'panellot') ?>
    <?php 
    //echo $form->field($model, 'errname')
    //        ->dropDownList(Yii::$app->params['ERROR_NAME'] ,['prompt'=>'Select...']); 
    ?>

    <?php // echo $form->field($model, 'panelindex') ?>

    <?php // echo $form->field($model, 'patientinfo') ?>

    <?php // echo $form->field($model, 'sampletype') ?>

    <?php  echo $form->field($model, 'softversion') ?>

    <?php // echo $form->field($model, 'testresults') ?>
    <?php echo $form->field($model, 'createdFrom')->widget(yii\jui\DatePicker::className()); ?> 
    <?php echo $form->field($model, 'createdTo')->widget(yii\jui\DatePicker::className()); ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
