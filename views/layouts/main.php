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


    NavBar::begin(['brandLabel' => '主页']);
    $menuItems = [
        ['label' => '生化', 'url' => ['/site/result']],
        ['label' => '盘片报错', 'url' => ['/site/error']],
        ['label' => '设备报错', 'url' => ['/site/machine-err']],
        ['label' => '质控', 'url' => ['/site/qcresult']],
        ['label' => '在线状态', 'url' => Yii::$app->params['URL_MQTT']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => '登录', 'url' => ['/site/login']];
    } else {
        // if (condition) {
           // $menuItems[] = ['label' => '注册', 'url' => ['/site/signup']];
        // }
        $menuItems[] = ['label' => '重置', 'url' => ['/site/reset-password']];
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                '退出 (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'items' => $menuItems,
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
