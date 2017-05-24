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
        $dbCon = Yii::$app->db;
        $schema = $dbCon->getSchema();
        $tables = $schema->getTableNames();
        if (!in_array($table, $tables)) {
            throw new BadRequestHttpException(Yii::t('app', 'no such table'));
        }

        $tableSchema  = $schema->getTableSchema($table);
        $totalCount   = $dbCon->createCommand("SELECT COUNT(*) FROM {$table}")->queryScalar();
        $dataProvider = new SqlDataProvider([
            'sql'        => "SELECT * FROM {$table}",
            'totalCount' => $totalCount,
            'sort'       => new Sort([
                'attributes' => $tableSchema->getColumnNames()
            ])
        ]);

        return $this->render('index', compact('dataProvider', 'db'));
    }
}
