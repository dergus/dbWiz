<?php

namespace app\controllers;

use Yii;
use app\components\Controller;
use yii\data\ArrayDataProvider;

class DatabasesController extends Controller
{
    public function actionIndex()
    {
        $databases = Yii::$app->db->getSchema()->getSchemaNames();
        $dataProvider = new ArrayDataProvider([
            'allModels'  => $databases,
            'pagination' => false,
            'sort'       => false
        ]);

        return $this->render('index', compact('dataProvider'));
    }

    public function actionShow(string $db)
    {
        return $db;
    }
}
