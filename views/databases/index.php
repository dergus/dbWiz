<?php
use yii\grid\GridView;
use yii\helpers\Html;
use app\grid\DataColumn;

/* @var $this yii\web\View */

?>

<?=GridView::widget([
    'dataProvider' => $dataProvider,
    'dataColumnClass' => DataColumn::class,
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
