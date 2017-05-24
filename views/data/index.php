<?php
use yii\grid\GridView;
use yii\helpers\Html;
use app\grid\DataColumn;

/* @var $this yii\web\View */

?>

<?=GridView::widget([
    'dataProvider'    => $dataProvider,
    'dataColumnClass' => DataColumn::class
]);?>

