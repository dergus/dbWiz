<?php

namespace app\controllers;

use app\data\Sort;
use Yii;
use app\components\Controller;
use yii\data\SqlDataProvider;
use yii\web\BadRequestHttpException;
use app\db\mysql\Schema;

class DataController extends Controller
{
    public function actionIndex(string $db, string $table)
    {
        $dbCon = Yii::$app->db;
        /* @var $schema Schema */
        $schema = $dbCon->getSchema();
        $tables = $schema->getTableNames();
        if (!in_array($table, $tables)) {
            throw new BadRequestHttpException(Yii::t('app', 'no such table'));
        }

        $tableSchema = $schema->getTableSchema($table);
        $columnNames = $tableSchema->getColumnNames();
        $operators   = $schema->getOperators();
        $where       = '';
        $params      = [];
        $searches    = [[]];
        if (isset($_GET['Search'])) {
            //normalizing http array
            foreach ($_GET['Search'] as $key => $values) {
                foreach ($values as $i => $value) {
                    $searches[$i][$key] = $value;
                }
            }
            list($where, $params) = $this->makeSearchCriteria($searches, $columnNames, $operators);
        }

        $totalCount = $dbCon->createCommand("SELECT COUNT(*) FROM {$table} {$where}", $params)->queryScalar();

        $dataProvider = new SqlDataProvider([
            'sql'        => "SELECT * FROM {$table} {$where}",
            'totalCount' => $totalCount,
            'params'     => $params,
            'sort'       => new Sort([
                'attributes' => $columnNames
            ])
        ]);

        return $this->render('index', compact('dataProvider', 'db', 'columnNames', 'operators', 'searches', 'table'));
    }

    protected function makeSearchCriteria(array $searches, array $columnNames, array $operators): array
    {
        $where  = '';
        $params = '';
        foreach ($searches as $search) {
            if (isset($search['column'], $search['operator'], $search['value']) &&
                in_array($search['column'], $columnNames) &&
                in_array($search['operator'], $operators)
            ) {
                $paramAliases = [];
                if (!in_array($search['operator'], ['IS NULL', 'IS NOT NULL'])) {
                    $paramAlias          = ':search_' . $search['column'];
                    $paramAliases[]      = $paramAlias;
                    $params[$paramAlias] = $search['value'];
                }

                $where .= ' ' .
                    join(' ',
                        array_merge([$where ? 'AND' : 'WHERE', $search['column'], $search['operator']], $paramAliases));


            }
        }

        return [$where, $params];
    }
}
