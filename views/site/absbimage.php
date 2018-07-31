<?php 
use yii;
use yii\grid\GridView;
use yii\helpers\Html;
?>

<?php
echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        // 'id',
        'name',
        [
            'attribute' => 'content',
            'format' => 'html',
            'content' => function ($model,$key, $index, $column) {
                return str_replace(["\r\n", "\n", "\r"], '<br>', $model['content']); 
            },
            'contentOptions' => function ($model,$key, $index, $column) 
            use($imagepath) {
                return ['style' =>sprintf('
                			background-image: url(%s/%s.jpg);
            				background-repeat: no-repeat;
            				background-position: right;
            				background-size: %s;
                			',
                	$imagepath,
                	$model['name'],
                	'25% 95%'
            	)]; 
            }
        ],
    ],
])
?>