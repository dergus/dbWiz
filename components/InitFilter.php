<?php

namespace app\components;

use Yii;
use yii\base\ActionFilter;

class InitFilter extends ActionFilter
{
    public function beforeAction($action)
    {
        $db       = Yii::$app->db;
        $identity = Yii::$app->user->identity;
        $database = Yii::$app->request->get('db', '');

        Yii::configure($db, [
            'dsn'      => "{$identity->driverName}:host={$identity->host};dbname={$database}",
            'username' => $identity->username,
            'password' => $identity->password,
        ]);

        return parent::beforeAction($action);
    }
}
