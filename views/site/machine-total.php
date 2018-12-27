<?php
use yii;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\bootstrap\Tabs;
/* @var $this yii\web\View */
/* @var $searchModel app\models\PanelResultSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = ' Machine Total';
// $this->title = $modelflag.' Machine Total';
// $this->params['breadcrumbs'][] = $this->title;
?>
<div>
<?php 
    echo Tabs::widget(
    [
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
<div class="machine-total-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php echo $this->render('_search_total_machine', ['model' => $searchModel,'modelflag'=>$modelflag,'action'=>'machine-total']) ?>
    <?php echo "total:" . count($data); ?>
    <table border="1"> 
    <?php
     // var_dump($data) 
        echo "<tr>";
        echo "<td> machineid </td>";
        echo "<td> type </td>";
        echo "<td> result </td>";
        echo "<td> error </td>";
        echo "<td> soft </td>";
        echo "<td> last </td>";
        echo "</tr>";
    foreach ($data as  $value) {
        echo "<tr>";
        echo "<td>".$value['machineid']."</td>";
        echo "<td>".$value['type']."</td>";
        echo "<td>".$value['result']."</td>";
        echo "<td>".$value['error']."</td>";
        echo "<td>".$value['soft']."</td>";
        echo "<td>".$value['last']."</td>";
        echo "</tr>";
    }
        
    ?>
    </table>
</div>
