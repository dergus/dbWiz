<?php

namespace app\models;

use app\db\Connection;

class User extends \yii\base\Object implements \yii\web\IdentityInterface
{
    public $username;
    public $password;
    public $driverName;
    public $host;
    public $authKey;
    public $accessToken;

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        $data = \Yii::$app->user->getData();
        if ($data) {
            $config = $data;
            $config['class'] = static::className();
            return \Yii::createObject($config);
        }

        return null;
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findIdentity($username);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->username;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        try {
            $config['dsn']      = "{$this->driverName}:host={$this->host}";
            $config['username'] = $this->username;
            $config['password'] = $this->password;
            $config['class']    = Connection::className();
            $conn = \Yii::createObject($config);
            $conn->open();
        } catch (\Exception $e) {
            return false;
        }

        return true;
    }
}
