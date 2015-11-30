<?php

use yii\db\Migration;
use yii\db\Schema;

class m151114_195905_relaciones_usuario extends Migration
{
    public function up()
    {
        $this->addColumn('ruta','id_usuario', Schema::TYPE_INTEGER.' NOT NULL');
        $this->addColumn('ruta_diaria','id_usuario', Schema::TYPE_INTEGER.' NOT NULL');
        $this->addForeignKey('fk_ruta_usuario','ruta','id_usuario','user','id','RESTRICT','RESTRICT');
        $this->addForeignKey('fk_ruta_dia_usuario','ruta_diaria','id_usuario','user','id','RESTRICT','RESTRICT');
    }

    public function down()
    {
        echo "m151114_195905_relaciones_usuario cannot be reverted.\n";

        $this->dropForeignKey('fk_ruta_usuario','ruta');
        $this->dropForeignKey('fk_ruta_dia_usuario','ruta_diaria');
        $this->dropColumn('ruta','id_usuario');
        $this->dropColumn('ruta_diaria','id_usuario');
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
