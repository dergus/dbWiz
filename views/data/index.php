<?php
use yii\grid\GridView;
use yii\helpers\Html;
use app\grid\DataColumn;

/* @var $this yii\web\View */

$this->title = join(" → ", [Yii::t('app', 'Databases'), $db, Yii::t('app', 'Data')]);
$this->params['breadcrumbs'][] = ['url' => ['/databases/index/'], 'label' => Yii::t('app', 'Databases')];
$this->params['breadcrumbs'][] = ['url' => ['/tables/index/', 'db' => $db], 'label' => $db];
$this->params['breadcrumbs'][] = Yii::t('app', 'Data');
?>

<?=GridView::widget([
    'dataProvider'    => $dataProvider,
    'dataColumnClass' => DataColumn::class
]);?>

