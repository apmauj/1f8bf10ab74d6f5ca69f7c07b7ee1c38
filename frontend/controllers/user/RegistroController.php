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

class RegistroController extends RegistrationController
{

    public function actionRegister()
    {

        $model = Yii::createObject(RegistrationForm::className());

        $this->performAjaxValidation($model);

        if ($model->load(Yii::$app->request->post()) && $model->register()) {
            return $this->render('/message', [
                'title' => Yii::t('user', 'Your account has been created'),
                'module' => $this->module,
            ]);
        }

        return $this->render('register', [
            'model' => $model,
            'module' => $this->module,
        ]);
    }

}