<?php
use yii\grid\GridView;
use yii\helpers\Html;
use app\grid\DataColumn;

/* @var $this yii\web\View */

$this->title = join(" → ", [Yii::t('app', 'Databases'), $db]);
$this->params['breadcrumbs'][] = ['url' => ['/databases/index/'], 'label' => Yii::t('app', 'Databases')];
$this->params['breadcrumbs'][] = $db;
?>

<?=GridView::widget([
    'dataProvider' => $dataProvider,
    'dataColumnClass' => DataColumn::class,
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
