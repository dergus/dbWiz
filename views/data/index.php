<?php
use yii\data\SqlDataProvider;
use app\grid\GridView;
use yii\helpers\Html;
use app\grid\DataColumn;
use yii\helpers\Url;

/* @var $this yii\web\View
 * @var $searches array
 * @var $columnNames array
 * @var $operators array
 * @var $dataProvider SqlDataProvider
 * @var $db string
 * @var $table string
 * @var $primaryKey string
 */

$this->title                   = join(" → ", [Yii::t('app', 'Databases'), $db, Yii::t('app', 'Data')]);
$this->params['breadcrumbs'][] = ['url' => ['/databases/index/'], 'label' => Yii::t('app', 'Databases')];
$this->params['breadcrumbs'][] = ['url' => ['/tables/index/', 'db' => $db], 'label' => $db];
$this->params['breadcrumbs'][] =
    ['url' => Url::to(['/data/index/', 'db' => $db, 'table' => $table]), 'label' => Yii::t('app', 'Data')];
?>
<div class="data_search">
    <form>
        <?php
        $countSearches   = count($searches);
        $columnNamesList = array_combine($columnNames, $columnNames);
        $operatorsList   = array_combine($operators, $operators);
        ?>
        <?php foreach ($searches as $i => $search): ?>
            <div class="row search_row js_search_row">
                <div class="col-md-1 search_row_label js_search_row_label <?= $i === 0 ? 'visible' : 'invisible' ?>">
                    <?= Yii::t('app', 'Search:') ?>
                </div>

                <div class="col-md-2">
                    <?= Html::dropDownList("Search[column][]", $search['column'] ?? null, $columnNamesList,
                        ['class' => 'form-control']) ?>
                </div>
                <div class="col-md-2">
                    <?= Html::dropDownList("Search[operator][]", $search['operator'] ?? null, $operatorsList,
                        ['class' => 'form-control']) ?>
                </div>
                <div class="col-md-2">
                    <?= Html::textInput("Search[value][]", $search['value'] ?? null, ['class' => 'form-control']) ?>
                </div>
                <?php if ($i === ($countSearches - 1)): ?>
                    <i class="glyphicon glyphicon-plus add_search_row js_add_search_row"
                       title="<?= Yii::t('app', 'add search row') ?>"></i>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
        <?= Html::submitButton('submit') ?>
    </form>
</div>

<?= GridView::widget([
    'dataProvider'    => $dataProvider,
    'dataColumnClass' => DataColumn::class,
    'editable'        => (bool) $primaryKey,
    'primaryKey'      => $primaryKey
]); ?>

