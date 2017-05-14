<?php

namespace app\components;

use yii\web\Controller as BaseController;
use yii\filters\AccessControl;

class Controller extends BaseController
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'init'  => [
                'class' => InitFilter::className()
            ]
        ];
    }

}
