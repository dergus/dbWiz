<?php

namespace app\controllers;

use app\data\Sort;
use Yii;
use app\components\Controller;
use yii\data\SqlDataProvider;
use yii\web\BadRequestHttpException;
use app\db\mysql\Schema;
use yii\web\HttpException;

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

        $primaryKey = $tableSchema->primaryKey;

        return $this->render('index',
            compact('dataProvider', 'db', 'columnNames', 'operators', 'searches', 'table', 'primaryKey'));
    }

    protected function makeSearchCriteria(array $searches, array $columnNames, array $operators): array
    {
        // TODO: rewrite with \yii\db\Query
        $where  = '';
        $params = '';
        foreach ($searches as $i => $search) {
            if (isset($search['column'], $search['operator'], $search['value']) &&
                in_array($search['column'], $columnNames) &&
                in_array($search['operator'], $operators)
            ) {
                $paramAliases = [];
                if (!in_array($search['operator'], ['IS NULL', 'IS NOT NULL'])) {
                    $paramAlias          = ':search_' . $search['column'] . $i;
                    $paramAliases[]      = $paramAlias;
                    $params[$paramAlias] = $search['value'];
                }

                $where .= ' ' .
                    join(' ',
                        array_merge([$where ? 'AND' : 'WHERE', "`{$search['column']}`", $search['operator']], $paramAliases));


            }
        }

        return [$where, $params];
    }

    /**
     * update record
     * @param string $db
     * @param string $table
     * @return string
     */
    public function actionUpdate(string $db, string $table)
    {
        $request = Yii::$app->request;
        $db      = Yii::$app->db;
        $params  = $request->bodyParams;
        $resp    = ['ok' => false, 'affected_rows' => 0];

        if (isset($params['condition'], $params['columns'])) {
            $cmd = $db->createCommand();
            try {
                $resp['affected_rows'] = $cmd->update($table, $params['columns'], $params['condition'])->execute();
                if ($resp['affected_rows']) {
                    $resp['ok'] = true;
                }
            } catch (\Exception $e) {
                $resp['error'] = $e->getMessage();
            }
        }

        return json_encode($resp);
    }
}
