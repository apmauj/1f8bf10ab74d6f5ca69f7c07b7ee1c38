<?php
/**
 * Created by PhpStorm.
 * User: Cacho
 * Date: 22/11/2015
 * Time: 20:40
 */

namespace frontend\models;

use dektrium\user\models\RegistrationForm as BaseRegistrationForm;

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

        return $rules;
    }

    public function attributeLabels()
    {
        $labels = parent::attributeLabels();
        $labels['direccion'] = \Yii::t('app', 'Direccion');

        return $labels;
    }



}