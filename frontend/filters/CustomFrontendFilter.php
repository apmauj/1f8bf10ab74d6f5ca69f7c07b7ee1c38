<?php
/**
 * Created by PhpStorm.
 * User: Cacho
 * Date: 21/11/2015
 * Time: 22:08
 */

namespace frontend\filters;


class CustomFrontendFilter  extends \yii\base\ActionFilter
{

    private $loginUrl = '/frontend/web/user/login';

    /**
     * @inheritdoc
     */
    public function beforeAction($action)
    {
        if (\Yii::$app->user->isGuest) {
            return $this->login();
        }else{
            return true;
        }
    }

    private function login(){
        return \Yii::$app->getResponse()->redirect($this->loginUrl);
    }


}