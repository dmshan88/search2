<?php
use yii;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\bootstrap\Tabs;
/* @var $this yii\web\View */
/* @var $searchModel app\models\PanelResultSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Infomation';
// $this->params['breadcrumbs'][] = $this->title;
?>
<div>
<p>为了兼容APP设备及降低服务器负载，旧版查询系统预计将于2018-9-1停用。</p>
<p>新版查询系统需求变更请联系 软件部 单金龙</p>

<?php echo Html::a('旧版入口',Yii::$app->params['URL_OLD_SEARCH']) ?>

</div>
