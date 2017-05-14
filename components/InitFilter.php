<?php

namespace app\components;

use Yii;
use yii\base\ActionFilter;

class InitFilter extends ActionFilter
{
    public function beforeAction($action)
    {
        $db = Yii::$app->db;
        $identity = Yii::$app->user->identity;
        $database = '';
        $requestedRoute = Yii::$app->requestedRoute;
        if (preg_match('/^databases\/(?<db>[\w\-_]+)/', $requestedRoute, $matches)) {
            $database = $matches['db'];
        }

        Yii::configure($db, [
            'dsn'      => "{$identity->driverName}:{$identity->host};{$database}",
            'username' => $identity->username,
            'password' => $identity->password,
        ]);
        return parent::beforeAction($action);
    }
}
