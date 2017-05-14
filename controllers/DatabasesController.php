<?php

namespace app\controllers;

use Yii;
use app\components\Controller;
use yii\data\ArrayDataProvider;

class DatabasesController extends  Controller
{
    public function actionIndex()
    {
        $db = Yii::$app->db;
        $cmd = $db->createCommand('SHOW DATABASES');
        $dataProvider = new ArrayDataProvider([
            'allModels' => $cmd->queryAll(),
            'key' => 'Database'
        ]);
        return $this->render('index', compact('dataProvider'));
    }
}
