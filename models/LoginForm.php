<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;
    public $driverName = 'mysql';
    public $host       = 'localhost';

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password', 'driverName', 'host'], 'required'],
            ['driverName', 'in', 'range' => Yii::$app->db->getSupportedDriverNames()],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            $login = Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
            if ($login) {
                \Yii::$app->user->storeData($this->getUserData());
                return true;
            }
        }
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $config = $this->getUserData();
            $config['class'] = User::className();
            $this->_user = Yii::createObject($config);
        }

        return $this->_user;
    }

    public function getUserData()
    {
        return [
            'username'   => $this->username,
            'password'   => $this->password,
            'driverName' => $this->driverName,
            'host'       => $this->host
        ];
    }
}
