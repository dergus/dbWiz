<?php


namespace app\controllers;


use app\components\Controller;
use app\data\Sort;
use yii\data\ArrayDataProvider;

class QueryController extends Controller
{
    public function actionIndex(string $db = '')
    {
        return $this->render('index', compact('db'));
    }

    public function actionExecute(string $db = '')
    {
        $query        = \Yii::$app->request->post('query', '');
        $cmd          = \Yii::$app->db->createCommand($query);
        $affectedRows = $data = null;
        try {
            $affectedRows = $cmd->execute();
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();

            return $this->renderPartial('_execute_fail', compact('errorMessage'));
        }

        try {
            $data = $cmd->pdoStatement->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\Exception $e) {
            return $this->renderPartial('_execute_success', compact('affectedRows'));
        }

        $dataProvider = new ArrayDataProvider([
            'allModels' => $data,
            'sort'      => new Sort([
                'attributes' => array_keys($data[0])
            ])
        ]);

        return $this->renderPartial('_execute_success_with_data', compact('dataProvider', 'query'));
    }

}
