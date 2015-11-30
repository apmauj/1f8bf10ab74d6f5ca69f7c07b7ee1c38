<?php
/**
 * Created by PhpStorm.
 * User: Cacho
 * Date: 21/11/2015
 * Time: 23:29
 */

namespace frontend\controllers\user;


use dektrium\user\controllers\RegistrationController;
use frontend\models\RegistrationForm;
use Yii;
use yii\web\NotFoundHttpException;
use backend\models\User;
class RegistroController extends RegistrationController
{

    public function actionRegister()
    {

        $model = Yii::createObject(RegistrationForm::className());

        $this->performAjaxValidation($model);
        if ($model->load(Yii::$app->request->post())) {
            if ($model->register()) {
                return $this->render('/message', [
                    'title' => Yii::t('user', 'Your account has been created'),
                    'module' => $this->module,
                ]);
            }
        }

        return $this->render('register', [
            'model' => $model,
            'module' => $this->module,
        ]);
    }

    /**
     * Displays page where user can create new account that will be connected to social account.
     *
     * @param string $code
     *
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionConnect($code)
    {
        $account = $this->finder->findAccount()->byCode($code)->one();
        if ($account === null || $account->getIsConnected()) {
            throw new NotFoundHttpException();
        }

        /** @var User $user */
        $user = Yii::createObject([
            'class'    => User::className(),
            'scenario' => 'connect',
            'username' => $account->username,
            'email'    => $account->email,
        ]);

        if ($user->load(Yii::$app->request->post()) && $user->create()) {
            $account->connect($user);
            return $this->render('/message', [
                'title' => Yii::t('user', 'Your account has been created'),
                'module' => $this->module,
            ]);

//            Yii::$app->user->login($user, $this->module->rememberFor);
//            return $this->goBack();
        }

        return $this->render('connect', [
            'model'   => $user,
            'account' => $account,
        ]);
    }


}