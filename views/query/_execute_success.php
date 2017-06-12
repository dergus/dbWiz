<?php
/** @var \yii\web\View $this */
/** @var string $affectedRows */
?>

<div class="alert alert-success">
    <strong><?= Yii::t('app', 'Query was successful!') ?></strong>
    <br>
    <?= Yii::t('app', 'Number of rows affected: {rows}', [
        'rows' => $affectedRows
    ]) ?>
</div>
