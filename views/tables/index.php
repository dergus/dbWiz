<?php
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */

?>

<?=GridView::widget([
    'dataProvider' => $dataProvider,
    'columns'      => [
        [
            'header' => Yii::t('app', 'Table'),
            'value' => function($data) use($db) {
                return Html::a($data, ['/data/index/', 'table' => $data, 'db' => $db]);
            },
            'format'  => 'raw'
        ]
    ]
]);?>
