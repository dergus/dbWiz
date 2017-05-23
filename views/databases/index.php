<?php
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */

?>

<table class="table table-striped">
    <thead>
    <tr>
        <th></th>
        <th></th>
        <th>Table</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($databases as $data): ?>
        <tr>
            <td>checkbox</td>
            <td>actions</td>
            <td><a href="/databases/<?=$data?>/tables/"><?=$data?></a> </td>
        </tr>
    <?php endforeach;?>
    </tbody>
</table>
