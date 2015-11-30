<?php

use dektrium\user\helpers\Password;
use yii\db\Migration;

class m151116_200653_insert_admin_user extends Migration
{
    public function up()
    {
        $this->insert('user',['id'=>'1','username'=>'admin','email'=>'jrozada@gmail.com','password_hash'=>Password::hash('admin'),'auth_key'=>Yii::$app->security->generateRandomString(),'created_at'=>time(),'updated_at'=>time(),'esActivo'=>'1']);
        $this->insert('profile',['user_id'=>'1']);
        $this->insert('token',['user_id'=>'1','code'=>Yii::$app->security->generateRandomString(),'created_at'=>time(),'type'=>'0']);
    }

    public function down()
    {
        $this->delete('token','user_id = 1');
        $this->delete('profile','user_id = 1');
        $this->delete('user','id = 1');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
