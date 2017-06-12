<?php

use app\grid\DataColumn;
use app\grid\GridView;

/** @var \yii\web\View $this */
/** @var yii\data\ArrayDataProvider $dataProvider */
/** @var string $query */

?>
<input type="hidden" class="executed_query" value="<?= $query ?>">
<?= GridView::widget([
    'dataProvider' => $dataProvider,
]) ?>
