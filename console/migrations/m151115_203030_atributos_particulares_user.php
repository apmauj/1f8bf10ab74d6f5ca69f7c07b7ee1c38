<?php

use yii\db\Migration;
use yii\db\Schema;

class m151115_203030_atributos_particulares_user extends Migration
{
    public function up()
    {
        $this->addColumn('user','latitud', 'float(8,6)');
        $this->addColumn('user','longitud', 'float(8,6)');
        $this->addColumn('user','direccion', Schema::TYPE_STRING);
        $this->addColumn('user','esActivo',Schema::TYPE_BOOLEAN.' NOT NULL');

    }

    public function down()
    {
        $this->dropColumn('user','latitud');
        $this->dropColumn('user','longitud');
        $this->dropColumn('user','direccion');
        $this->dropColumn('user','esActivo');
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
