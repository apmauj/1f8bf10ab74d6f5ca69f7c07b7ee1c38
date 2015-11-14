<?php

use yii\db\Schema;
use yii\db\Migration;

class m151114_014406_add_column_direccion_to_comercio extends Migration
{
    public function up()
    {
        $this->addColumn('comercio','direccion', Schema::TYPE_STRING.' NOT NULL');
    }

    public function down()
    {
        $this->dropColumn('country','direccion');
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
