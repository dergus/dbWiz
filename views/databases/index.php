<?php
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */

?>

<?=GridView::widget([
    'dataProvider' => $dataProvider,
    'columns'      => [
        [
            'header' => Yii::t('app', 'Database'),
            'value' => function($db) {
                return Html::a($db, ['/tables/index/', 'db' => $db]);
            },
            'format'  => 'raw'
        ]
    ]
]);?>
