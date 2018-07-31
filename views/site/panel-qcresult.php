<?php
use yii;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\bootstrap\Tabs;
/* @var $this yii\web\View */
/* @var $searchModel app\models\PanelResultSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $modelflag.' Panel QC Results';
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

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?= $this->render('_search_qcresult', ['model' => $searchModel,'modelflag'=>$modelflag,'action'=>'qcresult']) ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

            // '_id',
            [
                'attribute' => 'chkdatetime',
                'format' => 'text',
                'content' => function ($model,$key, $index, $column) {
                    return date('y-m-d H:i', $model->chkdatetime); 
                }
            ],
            // 'hardware1version',
            // 'hardware2version',
            //'hardware3version',
            'machineid',
            // 'errcode',
            [
                'attribute' => 'panelid',
                'format' => 'text',
                'content' => function ($model,$key, $index, $column) {
                    $array = Yii::$app->params['PANEL_NAME']; 
                    return $array[$model->panelid]; 
                }
            ],
            'panellot',
            'panelindex',
            'name',
            'result',
            'softversion',
            [
                'attribute' => 'file',
                'format' => 'html',
                'content' => function ($model,$key, $index, $column) 
                use($modelflag) {
                    $name = sprintf("%s%s%s",
                        substr($model->machineid, -5, 5), 
                        str_pad($model->panelid, 2, '0', STR_PAD_LEFT),
                        $model->chkdatetime
                    );
                    return Html::a($name, ['absbimage', 'modelflag' => $modelflag, 'name' => $name], ['target'=>'_blank']); 
                }
            ],
        ],
    ]); ?>
</div>
