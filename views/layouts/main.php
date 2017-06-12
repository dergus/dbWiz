<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) . ' | dbWiz' ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    $items = [];
    if (Yii::$app->user->isGuest) {
        $items[] = ['label' => Yii::t('app', 'Login'), 'url' => ['/site/login']];
    } else {
        $items[] =
            ['label' => Yii::t('app', 'Query'), 'url' => ['/query/index', 'db' => Yii::$app->request->get('db', '')]];
        $items[] =
            '<li>' .
            Html::beginForm(['/site/logout'], 'post') .
            Html::submitButton('Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']) .
            Html::endForm() .
            '</li>';
    }
    NavBar::begin([
        'brandLabel' => 'dbWiz',
        'brandUrl'   => Yii::$app->homeUrl,
        'options'    => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items'   => $items
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<!--some common html elements-->
<div class="app-alert app-alert-success">
    <i class="glyphicon glyphicon-ok"></i>
    <span class="alert-msg msg-successful">
        <?= Yii::t('app', 'Update query was successful') ?>
    </span>
</div>

<div class="app-alert app-alert-fail">
    <i class="glyphicon glyphicon-alert"></i>
    <span class="alert-msg msg-successful">
        <?= Yii::t('app', 'Update query failed') ?>
    </span>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
