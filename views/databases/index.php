<?php
use app\grid\GridView;
use yii\helpers\Html;
use app\grid\DataColumn;

/* @var $this yii\web\View */

$this->title = Yii::t('app', 'Databases');
$this->params['breadcrumbs'][] = $this->title;
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
