<?php
use yii\helpers\Html;
use app\assets\AppAsset;
use yii\widgets\Breadcrumbs;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
/* @var $this yii\web\View */
/* @var $content string */
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<header>
    <div class="container">
    <?php
    NavBar::begin(['brandLabel' => 'HOME']);
    echo Nav::widget([
        'items' => [
            // ['label' => 'HOME', 'url' => ['/site/index']],
            ['label' => 'PANEL RESULT', 'url' => ['/site/result']],
            ['label' => 'PANEL ERROR', 'url' => ['/site/error']],
            ['label' => 'MACHINE ERROR', 'url' => ['/site/machine-err']],
            ['label' => 'QC RESULT', 'url' => ['/site/qcresult']],
            ['label' => 'ONLINE / POSITION', 'url' => Yii::$app->params['URL_MQTT']],
            // ['label' => 'About', 'url' => ['/site/about']],
        ],
        'options' => ['class' => 'navbar-nav'],
    ]);
    NavBar::end();
     ?>
    </div>
</header>
<!-- <div class="wrap"> -->

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
<!-- </div> -->
<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; COMPANY <?= date('Y') ?></p>

        <p class="pull-right">version 1.0</p>
    </div>
</footer>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
