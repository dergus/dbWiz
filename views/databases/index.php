<?php
use yii\grid\GridView;
/* @var $this yii\web\View */

?>

<?=GridView::widget([
    'dataProvider' => $dataProvider,
]);?>
