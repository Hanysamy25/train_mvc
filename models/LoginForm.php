<?php

namespace app\models;

use app\core\Application;
use app\core\Model;

class LoginForm extends Model
{

    public string $email = '';
    public string $password = '';

    public function rules(): array
    {
        return [
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'password' => [self::RULE_REQUIRED]
        ];
    }

    public function label(): array
    {
        return ['email' => 'You Email', 'password' => 'MY Password'];
    }

    public function login()
    {
        $user = User::findOne(['email' => $this->email]);
        
        if (!$user) {
            $this->addError('email', 'user Dosnt Exist');
            return false;
        }

        if (!password_verify($this->password, $user->password)) {
            $this->addError('email', 'password Is Incorreect');
            return false;
        }


        // echo '<pre>';
        // var_dump($user);
        // echo '</pre>';
        // exit;

        return Application::$app->login($user);
    }
}
