<?php
use app\grid\GridView;
use yii\helpers\Html;
use app\grid\DataColumn;

/* @var $this yii\web\View */

$this->title = join(" → ", [Yii::t('app', 'Databases'), $db]);
$this->params['breadcrumbs'][] = ['url' => ['/databases/index/'], 'label' => Yii::t('app', 'Databases')];
$this->params['breadcrumbs'][] = $db;
?>
<div class="row filter-tables">
    <div class="col-md-2">
        <?= Yii::t('app', 'filter tables:') ?>
    </div>
    <div class="col-md-2">
        <?= Html::textInput('filter_tables', '', ['class' => 'form-control js_filter_tables_input']) ?>
    </div>
</div>

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
