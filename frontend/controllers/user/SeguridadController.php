<?php
/**
 * Created by PhpStorm.
 * User: Cacho
 * Date: 21/11/2015
 * Time: 22:35
 */

namespace frontend\controllers\user;


use dektrium\user\controllers\SecurityController;
use Yii;
use dektrium\user\clients\ClientInterface;
use dektrium\user\models\Account;
use backend\models\User;

class SeguridadController extends SecurityController
{

    /**
     * Tries to authenticate user via social network. If user has already used
     * this network's account, he will be logged in. Otherwise, it will try
     * to create new user account.
     *
     * @param ClientInterface $client
     */
    public function authenticate(ClientInterface $client)
    {

        $account = $this->finder->findAccount()->byClient($client)->one();

        if ($account === null) {
            $account = Account::create($client);
        }

        if ($account->user instanceof User) {

            if ($account->user->isBlocked) {
                Yii::$app->session->setFlash('danger', Yii::t('user', 'Your account has been blocked.'));
                $this->action->successUrl = Url::to(['/user/security/login']);
            } else {
                if($account->user->esActivo){
                    Yii::$app->user->login($account->user, $this->module->rememberFor);
                    $this->action->successUrl = Yii::$app->getUser()->getReturnUrl();
                }
            }
        } else {
            $this->action->successUrl = $account->getConnectUrl();
        }
    }


}