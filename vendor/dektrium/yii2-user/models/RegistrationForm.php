<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace dektrium\user\models;

use dektrium\user\Module;
use yii\base\Model;

/**
 * Registration form collects user input on registration process, validates it and creates new User model.
 *
 * @author Dmitry Erofeev <dmeroff@gmail.com>
 */
class RegistrationForm extends Model
{
    /** @var string */
    public $email;

    /** @var string */
    public $username;

    /** @var string */
    public $password;

    /**new @var string */
    public $role;
    
    /**new @var string */
    public $phone;
    
    /** @var User */
    protected $user;

    /** @var Module */
    protected $module;
    
    
    /** @inheritdoc */
    public function init()
    {
        $this->user = \Yii::createObject([
            'class'    => User::className(),
            'scenario' => 'register'
        ]);
        $this->module = \Yii::$app->getModule('user');
        
     }

    /** @inheritdoc */
    public function rules()
    {
        return [
            'usernameTrim' => ['username', 'filter', 'filter' => 'trim'],
            'usernamePattern' => ['username', 'match', 'pattern' => '/^[-a-zA-Z0-9_\.@]+$/'],
            'usernameRequired' => ['username', 'required'],
            'usernameUnique' => ['username', 'unique', 'targetClass' => $this->module->modelMap['User'],
                'message' => \Yii::t('user', 'This username has already been taken')],
            'usernameLength' => ['username', 'string', 'min' => 3, 'max' => 100],

            'emailTrim' => ['email', 'filter', 'filter' => 'trim'],
            'emailRequired' => ['email', 'required'],
            'emailPattern' => ['email', 'email'],
            'emailUnique' => ['email', 'unique', 'targetClass' => $this->module->modelMap['User'],
                'message' => \Yii::t('user', 'This email address has already been taken')],

            'passwordRequired' => ['password', 'required', 'skipOnEmpty' => $this->module->enableGeneratingPassword],
            'passwordLength' => ['password', 'string', 'min' => 6],
            //[['phone','role'], 'string'],   // new
            [['phone','role'], 'required'],    //new   

              ['phone', function ($attribute, $params) {
                if (!ctype_digit($this->$attribute)) {
                    $this->addError($attribute, 'The phone must contain only digits.');
                }
            }]         
        ];
    }

    /** @inheritdoc */
    public function attributeLabels()
    {
        return [
            'email'    => \Yii::t('user', 'Email'),
            'username' => \Yii::t('user', 'Username'),
            'password' => \Yii::t('user', 'Password'),
            'phone'    => \Yii::t('user', 'Phone'),  //new
            'role'     => \Yii::t('user', 'Role'),  //new
        ];
    }

    /** @inheritdoc */
    public function formName()
    {
        return 'register-form';
    }

    /**
     * Registers a new user account.
     * @return bool
     */
    public function register()
    {
        
        if (!$this->validate()) {
            return false;
        }
        
        $this->user->setAttributes([
            'email'    => $this->email,
            'username' => $this->username,
            'password' => $this->password,
            'phone'    => $this->phone,        //new
            'role'     => $this->role,         //new
        ]);
               
        /*******************new***********************/
       
      // var_dump($this->user->attributes);
        
       // return $this->user->register();          // old
       $usersuccess= $this->user->register();
       if($usersuccess)
            $usersuccess.='-'.$this->user->id;
       return $usersuccess; 
       
    }
}