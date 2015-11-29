<?php
/**
 * Created by PhpStorm.
 * User: Cacho
 * Date: 22/11/2015
 * Time: 20:40
 */

namespace frontend\models;

use dektrium\user\models\RegistrationForm as BaseRegistrationForm;
use Yii;
use backend\models\User;

class RegistrationForm extends BaseRegistrationForm
{

    public $direccion;

    public $latitud;

    public $longitud;

    public function rules()
    {
        $rules = parent::rules();
        $rules['direccionRequired'] = ['direccion', 'required'];
        $rules['direccionLength']   = ['direccion', 'string', 'max' => 255];
        $rules['latitudRequired'] = ['latitud', 'required'];
        $rules['longitudRequired'] = ['longitud', 'required'];

        return $rules;
    }

    public function attributeLabels()
    {
        $labels = parent::attributeLabels();
        $labels['direccion'] = \Yii::t('app', 'Direccion');

        return $labels;
    }

    /**
     * Registers a new user account. If registration was successful it will set flash message.
     *
     * @return bool
     */
    public function register()
    {
        if (!$this->validate()) {
            return false;
        }
        /** @var User $user */
        $user = Yii::createObject(User::className());
        $user->setScenario('register');
        $this->loadAttributes($user);

        if (!$user->register()) {
            return false;
        }

        Yii::$app->session->setFlash(
            'info',
            Yii::t('user', 'Your account has been created and a message with further instructions has been sent to your email')
        );

        return true;
    }


}