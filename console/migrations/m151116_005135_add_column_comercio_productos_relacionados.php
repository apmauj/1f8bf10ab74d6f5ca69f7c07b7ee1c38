<?php

use yii\db\Schema;
use yii\db\Migration;

class m151116_005135_add_column_comercio_productos_relacionados extends Migration
{
    public function up()
    {
        $this->createTable('comercio_productos_relacionados', [
            'id_comercio' =>'int NOT NULL',
            'id_producto' =>'int NOT NULL',
            'PRIMARY KEY (id_comercio,id_producto)'
        ]);

        $this->addForeignKey('fk_comercio','comercio_productos_relacionados','id_comercio','comercio','id','RESTRICT','RESTRICT');
        $this->addForeignKey('fk_producto','comercio_productos_relacionados','id_producto','producto','id','RESTRICT','RESTRICT');
    }

    public function down()
    {
        $this->dropForeignKey('fk_comercio','comercio_productos_relacionados');
        $this->dropForeignKey('fk_producto','comercio_productos_relacionados');
        $this->dropTable('{{%comercio_productos_relacionados}}');

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
