<?php
/**
 * Created by PhpStorm.
 * User: Cacho
 * Date: 21/11/2015
 * Time: 23:31
 */

namespace frontend\models;


class LoginForm extends \dektrium\user\models\LoginForm
{
    public function rules()
    {
        $rules = parent::rules();
        $rules['activationValidate'] = ['login',
                function ($attribute) {
                    if ($this->user !== null) {
                        if (!$this->user->esActivo) {
                            $this->addError($attribute, \Yii::t('app', 'Admin must activate your account '));
                        }
                    }
                }
            ];
        return $rules;
    }


}