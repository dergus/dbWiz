<?php

namespace app\controllers;

use Yii;
use app\components\Controller;
use yii\data\SqlDataProvider;
use yii\web\BadRequestHttpException;

class DataController extends Controller
{
    public function actionIndex(string $db, string $table)
    {
        $db     = Yii::$app->db;
        $tables = $db->getSchema()->getTableNames();
        if (!in_array($table, $tables)) {
            throw new BadRequestHttpException(Yii::t('app', 'no such table'));
        }

        $totalCount   = $db->createCommand("SELECT COUNT(*) FROM {$table}")->queryScalar();
        $dataProvider = new SqlDataProvider([
            'sql'        => "SELECT * FROM {$table}",
            'totalCount' => $totalCount
        ]);

        return $this->render('index', compact('dataProvider'));
    }
}
