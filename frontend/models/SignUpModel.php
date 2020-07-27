<?php

namespace frontend\models;

use taskForce\user\domain\Contact;
use yii\db\ActiveRecord;
use taskForce\user\domain\User;
use frontend\models\User as modelUser;

class SignUpModel extends ActiveRecord
{
    private $_user;
    public $email;
    public $userName;
    public $password;
    public $city;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['userName'], 'required', 'message' => 'Введите имя'],
            [['email'], 'required', 'message' => 'Введите адрес почты'],
            [['password'], 'required', 'message' => 'Это поле обязательно к заполнению'],
            ['email', 'email','message' => "Неправильный формат почтового адреса"],
            [['email','password','userName'], 'trim'],
            [['email','password','city'], 'required'],
            ['password', 'string', 'min' => 8,'tooShort' => 'Пароль не менее 8 символов, будьте внимательней'],
            ['email','unique', 'targetClass' => modelUser::class, 'targetAttribute' => 'email',
                'message' => 'Данный адрес уже используется'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'email' => 'Электронная почта',
            'userName' => 'Ваше имя',
            'city' => 'Город проживания',
            'password' => 'Пароль',
        ];
    }

    public function makeUser()
    {
        $user = new User();
        $user->name = $this->userName;
        $hash = password_hash($this->password, PASSWORD_DEFAULT);
        $user->setPassword($hash);
        $user->cityId = $this->city;
        $contacts = new Contact($this->email);
        $user->contacts = $contacts;

        return $user;
    }

    public function getUser()
    {
        if($this->_user === null) {
            $this->_user = modelUser::findOne(['email' => $this->email]);
        }

        return $this->_user;
    }
}
