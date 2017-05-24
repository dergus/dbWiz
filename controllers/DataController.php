<?php

namespace app\controllers;

use app\data\Sort;
use Yii;
use app\components\Controller;
use yii\data\SqlDataProvider;
use yii\web\BadRequestHttpException;

class DataController extends Controller
{
    public function actionIndex(string $db, string $table)
    {
        $db     = Yii::$app->db;
        $schema = $db->getSchema();
        $tables = $schema->getTableNames();
        if (!in_array($table, $tables)) {
            throw new BadRequestHttpException(Yii::t('app', 'no such table'));
        }

        $tableSchema  = $schema->getTableSchema($table);
        $totalCount   = $db->createCommand("SELECT COUNT(*) FROM {$table}")->queryScalar();
        $dataProvider = new SqlDataProvider([
            'sql'        => "SELECT * FROM {$table}",
            'totalCount' => $totalCount,
            'sort'       => new Sort([
                'attributes' => $tableSchema->getColumnNames()
            ])
        ]);

        return $this->render('index', compact('dataProvider'));
    }
}
