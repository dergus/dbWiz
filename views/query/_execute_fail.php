<?php
/** @var \yii\web\View $this */
/** @var string $errorMessage */
?>

<div class="alert alert-danger">
    <strong><?= Yii::t('app', 'Query failed!') ?></strong>
    <br>
    <?= $errorMessage ?>
</div>
