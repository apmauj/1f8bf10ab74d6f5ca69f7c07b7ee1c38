<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace backend\filters;


use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;

/**
 * HttpBearerAuth is an action filter that supports the authentication method based on HTTP Bearer token.
 *
 * You may use HttpBearerAuth by attaching it as a behavior to a controller or module, like the following:
 *
 * ```php
 * public function behaviors()
 * {
 *     return [
 *         'roleFilter' => [
 *             'class' => \api\filters\RoleFilter::className(),
 *         ],
 *     ];
 * }
 * ```
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class CustomFilter extends \yii\base\ActionFilter
{
    /**
     * @var string the HTTP authentication realm
     */
    public $usuarios = ['admin'];

    private $loginUrl = 'user/login';

    /**
     * @inheritdoc
     */
    public function beforeAction($action)
    {
        if (!\Yii::$app->user->isGuest) {
            $user = \Yii::$app->user->identity;
            if (in_array($user->username, $this->usuarios))
                return true;

            return $this->logout();

                
        }else{
            return $this->login();
        }

    }

    private function logout(){
        \Yii::$app->getUser()->logout();
        return \Yii::$app->getResponse()->redirect($this->loginUrl);
    }

    private function login(){
        return \Yii::$app->getResponse()->redirect($this->loginUrl);
    }

}