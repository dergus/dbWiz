<?php

namespace app\controllers;

use app\components\Controller;
use yii\data\ArrayDataProvider;

class TablesController extends Controller
{
    public function actionIndex(string $db)
    {

        $tables       = \Yii::$app->db->getSchema()->getTableNames();
        $dataProvider = new ArrayDataProvider([
            'allModels'  => $tables,
            'pagination' => false,
            'sort'       => false
        ]);

        return $this->render('index', compact('dataProvider', 'tables'));
    }
}
