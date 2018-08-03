<?php
use yii;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\bootstrap\Tabs;
/* @var $this yii\web\View */
/* @var $searchModel app\models\PanelResultSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $modelflag.' MACHINE ERRORS';
// $this->params['breadcrumbs'][] = $this->title;
?>
<div>
<?php 
    echo Tabs::widget([
    'items' => [
        [
            'label' => 'Pointcare',
            // 'content' => 'Anim pariatur cliche...',
            'url' => Url::toRoute(['', 'modelflag' => 'Pointcare']),
            'active' => $modelflag == 'Pointcare'
        ],
        [
            'label' => 'Celercare',
            'url' => Url::toRoute(['', 'modelflag' => 'Celercare']),
            'active' => $modelflag == 'Celercare'
            // 'content' => 'Anim pariatur cliche...',
            // 'headerOptions' => [...],
            // 'options' => ['id' => 'myveryownID'],
        ],
        [
            'label' => 'APP',
            'url' => Url::toRoute(['', 'modelflag' => 'APP']),
            'active' => $modelflag == 'APP'
        ],
    ],
]);
 ?>
</div>
<div class="panel-result-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?= $this->render('_search_machine-err', ['model' => $searchModel,'modelflag'=>$modelflag,'action'=>'machine-err']) ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

            // '_id',
            [
                'attribute' => 'errdatetime',
                'format' => 'text',
                'content' => function ($model,$key, $index, $column) {
                    return date('y-m-d H:i', $model->errdatetime); 
                }
            ],
            // 'hardware1version',
            // 'hardware2version',
            //'hardware3version',
            'machineid',
            'errcode',
            //'patientinfo',
            //'sampletype',
            'softversion',
			'summary',
        ],
    ]); ?>
</div>
