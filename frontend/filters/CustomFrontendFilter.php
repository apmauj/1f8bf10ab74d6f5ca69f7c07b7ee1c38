<?php
/**
 * Created by PhpStorm.
 * User: Cacho
 * Date: 21/11/2015
 * Time: 22:08
 */

namespace frontend\filters;
use Yii;

class CustomFrontendFilter  extends \yii\base\ActionFilter
{

    private $loginUrl = '/frontend/web/user/login';
    private $loginMobile = '/frontend/web/mobile/login';

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
        $modo = Yii::$app->params['devicedetect'];

        if ($modo["isMobile"]){
//            if (Yii::$app->controller->action->id === 'login') {
//                return true;
//            }
//            //return true;
//            return \Yii::$app->getResponse()->redirect($this->loginMobile);
            return true;
        }else{
            return \Yii::$app->getResponse()->redirect($this->loginUrl);
        }
    }


}