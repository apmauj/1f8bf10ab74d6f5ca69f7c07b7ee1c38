<?php
/**
 * Created by PhpStorm.
 * User: Cacho
 * Date: 23/11/2015
 * Time: 20:40
 */

namespace backend\models;


use dektrium\user\Mailer;

class CustomMailer extends Mailer
{

    //Mensaje de bienvenida admin
    /**
     * Sends an email to a user after registration.
     *
     * @param User  $user
     * @param Token $token
     * @param bool  $showPassword
     *
     * @return bool
     */
    public function sendMensajeCreacionAdministrador(User $user, $showPassword = false,$esActivo = false)
    {
        return $this->sendMessage($user->email,
            $this->getWelcomeSubject(),
            'welcome',
            ['user' => $user, 'esActivo' => $esActivo, 'module' => $this->module, 'showPassword' => $showPassword]
        );
    }


    //Mensaje de bienvenida Registro

    //Mensaje de activacion para Relevador

}