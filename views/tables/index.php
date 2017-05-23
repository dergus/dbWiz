<?php
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */

?>

<?=GridView::widget([
    'dataProvider' => $dataProvider,
    'columns'      => [
        ['class' => 'yii\grid\CheckboxColumn'],
        ['class' => 'yii\grid\ActionColumn',],
        [
            'value' => function($data) {
                return Html::a($data, ['/databases/show/', 'db' => $data]);
            },
            'format'  => 'html'
        ]
    ]
]);?>
