<?php
/**
 * Created by PhpStorm.
 * User: Cacho
 * Date: 15/11/2015
 * Time: 16:47
 */
namespace backend\models;

use dektrium\user\models\User as BaseUser;
use Yii;


class User extends BaseUser{

    public function init()
    {
        parent::init();
        $this->mailer = Yii::$container->get(CustomMailer::className());

    }



    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRutas()
    {
        return $this->hasMany(Ruta::className(), ['id_usuario' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRutasDiarias()
    {
        return $this->hasMany(RutaDiaria::className(), ['id_usuario' => 'id']);
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        // add field to scenarios
        $scenarios['create'][] = 'direccion';
        $scenarios['create'][] = 'esActivo';
        $scenarios['create'][] = 'latitud';
        $scenarios['create'][] = 'longitud';
        $scenarios['update'][] = 'direccion';
        $scenarios['update'][] = 'esActivo';
        $scenarios['update'][] = 'latitud';
        $scenarios['update'][] = 'longitud';
        $scenarios['register'][] = 'direccion';
        $scenarios['register'][] = 'latitud';
        $scenarios['register'][] = 'longitud';
        return $scenarios;

    }

    public function rules(){
        $rules = parent::rules();
        $rules['direccionRequired'] = ['direccion', 'required', 'on' => ['register', 'create', 'connect', 'update']];
        $rules['direccionLength']   = ['direccion', 'string', 'max' => 255];
        $rules['esActivoRequired'] = ['esActivo', 'required'];
        return $rules;
    }

    public function attributeLabels()
    {
        $labels = parent::attributeLabels();
        $labels['direccion'] = Yii::t('app', 'Direccion');
        $labels['esActivo'] = Yii::t('app', 'Es Activo');

        return $labels;
    }

    public function getMailer(){
        return $this->mailer;
    }

}

?>