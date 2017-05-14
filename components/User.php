<?php

namespace app\components;

use yii\web\User as BaseUser;

class User extends BaseUser
{
    public $userDataSessionKey = 'user_data';

    /**
     * stores user auth data in session
     * @param array $data
     */
    public function storeData(array $data)
    {
        \Yii::$app->session->set($this->userDataSessionKey, $data);
    }

    /**
     * get user auth data stored in session
     * @return mixed
     */
    public function getData()
    {
        return \Yii::$app->session->get($this->userDataSessionKey);
    }
}
