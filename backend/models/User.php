<?php
/**
 * Created by PhpStorm.
 * User: Cacho
 * Date: 15/11/2015
 * Time: 16:47
 */
namespace backend\models;

use dektrium\user\models\User as BaseUser;
use OAuth2\Storage\UserCredentialsInterface;
use Yii;
use yii\db\Expression;
use filsh\yii2\oauth2server\models\OauthAccessTokens;

class User extends BaseUser implements UserCredentialsInterface{

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
        $scenarios['connect'][] = 'direccion';
        $scenarios['connect'][] = 'latitud';
        $scenarios['connect'][] = 'longitud';

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
        $labels['direccion'] = Yii::t('app', 'Adress');
        $labels['esActivo'] = Yii::t('app', 'Active?');

        return $labels;
    }

    public function getMailer(){
        return $this->mailer;
    }

    public function tieneRutaDiariaActiva(){
        $countRutaDiaria = $this->getRutasDiarias()->count();
        if($countRutaDiaria>0){
            $rutaDiaria = $this->getRutasDiarias()->where(['fecha'=>date("Y-m-d")])->one();
            return $rutaDiaria != null;
        }
        return false;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRutasDiarias()
    {
        return $this->hasMany(RutaDiaria::className(), ['id_usuario' => 'id']);
    }


    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'blocked_at' => NULL]);
    }


    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        // Get token
        $oauthToken = OauthAccessTokens::find()
            ->andWhere('expires > NOW()')
            ->andWhere(['access_token' => $token])
            ->one();
        if (!$oauthToken) {
            return null;
        }

        return User::findOne($oauthToken->user_id);
    }
    /**
     * @inheritdoc
     */
    public function checkUserCredentials($username, $password)
    {
        $user = User::find()->where(['AND', ['username' => $username], new Expression('blocked_at IS NULL'), new Expression('confirmed_at IS NOT NULL')])->one();

        if ($user)
            return Yii::$app->getSecurity()->validatePassword($password, $user->password_hash);
        else
            return false;
    }

    /**
     * @inheritdoc
     */
    public function getUserDetails($username)
    {
        $user = User::findOne([
            'username' => $username,
            'blocked_at' => NULL,
        ]);

        // Update last login flag
        //$user->last_login = new Expression('NOW()');
        //$user->save(true, ["last_login"]);

        $userData = [
            'id' => $user->id,
            'user_id' => $user->id,
            'username' => $user->username,
            'email' => $user->email,
            'registration_ip' => $user->registration_ip,
        ];
        return $userData;
    }

}

?>