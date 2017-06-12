<?php
/** @var \yii\web\View $this */
/** @var string $db */

use app\assets\QueryAsset;
use app\grid\GridView;

QueryAsset::register($this);
$this->title = Yii::t('app', 'Query');
$this->params['breadcrumbs'][] = ['url' => ['/databases/index/'], 'label' => Yii::t('app', 'Databases')];
if ($db) {
    $this->params['breadcrumbs'][] = ['url' => ['/tables/index/', 'db' => $db], 'label' => $db];
}
$this->params['breadcrumbs'][] = Yii::t('app', 'Query');
?>
<div class="row">
    <div class="col-md-8">
        <div class="editor_container">
            <div id="editor"></div>
        </div>
    </div>
    <div class="col-md-4">
        <button class="btn btn-primary execute_query">
            <?=Yii::t('app', 'execute')?>
        </button>
    </div>
</div>

<br>
<div class="query_result">

</div>


