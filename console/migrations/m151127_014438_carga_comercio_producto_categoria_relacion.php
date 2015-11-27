<?php

use yii\db\Schema;
use yii\db\Migration;

class m151127_014438_carga_comercio_producto_categoria_relacion extends Migration
{
    public function up()
    {
        /*************
         *-*-*-*-*-*-*
         * Comercios *
         *-*-*-*-*-*-*
         *************/
        $this->insert('comercio',['nombre'=>'Avenida','latitud'=>'-34.897554','longitud'=>'-56.171570','dia'=>'1','prioridad'=>'1','esActivo'=>'1','direccion'=>'Eduardo Victor Haedo 2110']);
        $this->insert('comercio',['nombre'=>'Lo del Nano','latitud'=>'-34.893497','longitud'=>'-56.173464','dia'=>'2','prioridad'=>'5','esActivo'=>'0','direccion'=>'Goes']);
        $this->insert('comercio',['nombre'=>'Los Molles','latitud'=>'-34.881630','longitud'=>'-56.115858','dia'=>'1','prioridad'=>'3','esActivo'=>'1','direccion'=>'Igua 5']);
        $this->insert('comercio',['nombre'=>'Parada 7','latitud'=>'-34.903301','longitud'=>'-56.130118','dia'=>'6','prioridad'=>'2','esActivo'=>'1','direccion'=>'Miguel Grau 3779']);
        $this->insert('comercio',['nombre'=>'Lo de Juan','latitud'=>'34.911666','longitud'=>'-56.152045','dia'=>'4','prioridad'=>'2','esActivo'=>'1','direccion'=>'26 de Marzo 999']);
        $this->insert('comercio',['nombre'=>'Nosotros','latitud'=>'-34.914201','longitud'=>'-56.185908','dia'=>'5','prioridad'=>'2','esActivo'=>'0','direccion'=>'Ejido 852-900']);
        $this->insert('comercio',['nombre'=>'Lo de Edi','latitud'=>'-34.886320','longitud'=>'-56.187477','dia'=>'6','prioridad'=>'1','esActivo'=>'1','direccion'=>'Martín Garcia 1428']);
        $this->insert('comercio',['nombre'=>'Popi','latitud'=>'-34.891504','longitud'=>'-56.172532','dia'=>'3','prioridad'=>'2','esActivo'=>'1','direccion'=>'Nicaragua 2060']);
        $this->insert('comercio',['nombre'=>'Tambarú','latitud'=>'-34.890092','longitud'=>'-56.170821','dia'=>'1','prioridad'=>'4','esActivo'=>'1','direccion'=>'General Pagola 2185']);
        $this->insert('comercio',['nombre'=>'Casa América','latitud'=>'-34.890972','longitud'=>'-56.170731','dia'=>'6','prioridad'=>'2','esActivo'=>'0','direccion'=>'Juan Paullier 1681 bis']);
        $this->insert('comercio',['nombre'=>'El Hornito','latitud'=>'-34.891747','longitud'=>'-56.162865','dia'=>'1','prioridad'=>'5','esActivo'=>'1','direccion'=>'Presidente Berro 2586']);
        $this->insert('comercio',['nombre'=>'Peteco','latitud'=>'-34.891263','longitud'=>'-56.161531','dia'=>'7','prioridad'=>'1','esActivo'=>'1','direccion'=>'Av. 8 de Octubre 2662']);
        $this->insert('comercio',['nombre'=>'El Navio','latitud'=>'-34.894009','longitud'=>'-56.169674','dia'=>'4','prioridad'=>'1','esActivo'=>'1','direccion'=>'La Paz 2285']);
        $this->insert('comercio',['nombre'=>'La Pasiva','latitud'=>'-34.859704','longitud'=>'-56.181688','dia'=>'4','prioridad'=>'3','esActivo'=>'0','direccion'=>'Doctor Pablo Ehrlich 3974']);
        $this->insert('comercio',['nombre'=>'Trocadero','latitud'=>'-34.853213','longitud'=>'-56.203650','dia'=>'2','prioridad'=>'3','esActivo'=>'0','direccion'=>'Avenida Islas Canarias 4283']);
        $this->insert('comercio',['nombre'=>'Tirrenia','latitud'=>'-34.865408','longitud'=>'-56.192640','dia'=>'1','prioridad'=>'2','esActivo'=>'1','direccion'=>'Avenida Millán 3404']);
        $this->insert('comercio',['nombre'=>'Lo de Dalcho','latitud'=>'-34.867983','longitud'=>'-56.191975','dia'=>'2','prioridad'=>'2','esActivo'=>'1','direccion'=>'Avenida Millán 3134']);
        $this->insert('comercio',['nombre'=>'Granja Cactus','latitud'=>'-34.870565','longitud'=>'-56.190753','dia'=>'3','prioridad'=>'5','esActivo'=>'1','direccion'=>'Avenida Millán 4396']);
        $this->insert('comercio',['nombre'=>'Don Dante','latitud'=>'-34.865384','longitud'=>'-56.235593','dia'=>'4','prioridad'=>'2','esActivo'=>'1','direccion'=>'Av Dr Carlos María Ramírez 840']);
        $this->insert('comercio',['nombre'=>'La Familia','latitud'=>'-34.873914','longitud'=>'-56.177342','dia'=>'5','prioridad'=>'2','esActivo'=>'1','direccion'=>'Avenida General Flores 2926']);
        $this->insert('comercio',['nombre'=>'El Puestito','latitud'=>'-34.876784','longitud'=>'-56.177945','dia'=>'6','prioridad'=>'1','esActivo'=>'1','direccion'=>'Avenida General Garibaldi 1938']);

        //Categorías
        $this->insert('categoria',['nombre'=>'Alimentos','descripcion'=>'Categoria que engloba los alimentos, sin las bebidas','esActivo'=>'1']);
        $cat1 = Yii::$app->db->getLastInsertID();
        $this->insert('categoria',['nombre'=>'Bebidas','descripcion'=>'Categoria que engloba todas las bebidas','esActivo'=>'1']);
        $cat2 = Yii::$app->db->getLastInsertID();
        $this->insert('categoria',['nombre'=>'Bartulos Varios','descripcion'=>'Muchas cosas varias','esActivo'=>'0']);
        $cat3 = Yii::$app->db->getLastInsertID();
        $this->insert('categoria',['nombre'=>'Cosmeticos','descripcion'=>'Todas las cremas para las doñas y metrosexuales','esActivo'=>'1']);
        $cat4 = Yii::$app->db->getLastInsertID();
        $this->insert('categoria',['nombre'=>'Camping','descripcion'=>'Todos los articulos necesarios para el camping','esActivo'=>'1']);
        $cat5 = Yii::$app->db->getLastInsertID();
        $this->insert('categoria',['nombre'=>'Bijouterie','descripcion'=>'Todas las cosas baratas para sacarle platita a las mujeres','esActivo'=>'1']);
        $cat6 = Yii::$app->db->getLastInsertID();

        //Productos
        $this->insert('producto',['nombre'=>'Lata Pepsi','imagen'=>'','id_categoria'=>$cat2 ,'esActivo'=>'1', 'precio'=>'30']);
        $prod1 = Yii::$app->db->getLastInsertID();
        $this->insert('producto',['nombre'=>'Lampazo','imagen'=>'','id_categoria'=>$cat3 ,'esActivo'=>'1', 'precio'=>'120']);
        $prod2 = Yii::$app->db->getLastInsertID();
        $this->insert('producto',['nombre'=>'Linterna halogena','imagen'=>'','id_categoria'=>$cat5 ,'esActivo'=>'1', 'precio'=>'420']);
        $prod3 = Yii::$app->db->getLastInsertID();
        $this->insert('producto',['nombre'=>'Avon Anti Arrugas','imagen'=>'','id_categoria'=>$cat4 ,'esActivo'=>'1', 'precio'=>'300']);
        $prod4 = Yii::$app->db->getLastInsertID();
        $this->insert('producto',['nombre'=>'Papas Chips 180gr','imagen'=>'','id_categoria'=>$cat1 ,'esActivo'=>'1', 'precio'=>'90']);
        $prod5 = Yii::$app->db->getLastInsertID();
        $this->insert('producto',['nombre'=>'Paloquitos','imagen'=>'','id_categoria'=>$cat1 ,'esActivo'=>'1', 'precio'=>'30']);
        $prod6 = Yii::$app->db->getLastInsertID();
        $this->insert('producto',['nombre'=>'Pulseras plateadas','imagen'=>'','id_categoria'=>$cat6 ,'esActivo'=>'1', 'precio'=>'20']);
        $prod7 = Yii::$app->db->getLastInsertID();
        $this->insert('producto',['nombre'=>'Pulseras de plastico','imagen'=>'','id_categoria'=>$cat6 ,'esActivo'=>'1', 'precio'=>'12']);
        $prod8 = Yii::$app->db->getLastInsertID();
        $this->insert('producto',['nombre'=>'Armadura medieval','imagen'=>'','id_categoria'=>$cat3 ,'esActivo'=>'1', 'precio'=>'5000']);
        $prod9 = Yii::$app->db->getLastInsertID();
        $this->insert('producto',['nombre'=>'Chiclets','imagen'=>'','id_categoria'=>$cat1 ,'esActivo'=>'1', 'precio'=>'2']);
        $prod10 = Yii::$app->db->getLastInsertID();
        $this->insert('producto',['nombre'=>'Sidra','imagen'=>'','id_categoria'=>$cat2 ,'esActivo'=>'1', 'precio'=>'15']);
        $prod11 = Yii::$app->db->getLastInsertID();
        $this->insert('producto',['nombre'=>'Vino en Tetra','imagen'=>'','id_categoria'=>$cat2 ,'esActivo'=>'1', 'precio'=>'90']);
        $prod12 = Yii::$app->db->getLastInsertID();
        $this->insert('producto',['nombre'=>'Carpa Igloo 2p','imagen'=>'','id_categoria'=>$cat5 ,'esActivo'=>'1', 'precio'=>'1500']);
        $prod13 = Yii::$app->db->getLastInsertID();
        $this->insert('producto',['nombre'=>'Rastas postizas','imagen'=>'','id_categoria'=>$cat6 ,'esActivo'=>'1', 'precio'=>'450']);
        $prod14 = Yii::$app->db->getLastInsertID();
        $this->insert('producto',['nombre'=>'Tinta Rubio Susana','imagen'=>'','id_categoria'=>$cat4 ,'esActivo'=>'1', 'precio'=>'120']);
        $prod15 = Yii::$app->db->getLastInsertID();

        //Comercio-Producto-Relacion
        //1
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'1', 'id_producto'=>$prod4]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'1', 'id_producto'=>$prod5]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'1', 'id_producto'=>$prod6]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'1', 'id_producto'=>$prod7]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'1', 'id_producto'=>$prod8]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'1', 'id_producto'=>$prod9]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'1', 'id_producto'=>$prod10]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'1', 'id_producto'=>$prod11]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'1', 'id_producto'=>$prod12]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'1', 'id_producto'=>$prod13]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'1', 'id_producto'=>$prod14]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'1', 'id_producto'=>$prod15]);
        //2
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'2', 'id_producto'=>$prod1]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'2', 'id_producto'=>$prod2]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'2', 'id_producto'=>$prod3]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'2', 'id_producto'=>$prod4]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'2', 'id_producto'=>$prod6]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'2', 'id_producto'=>$prod7]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'2', 'id_producto'=>$prod8]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'2', 'id_producto'=>$prod9]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'2', 'id_producto'=>$prod11]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'2', 'id_producto'=>$prod12]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'2', 'id_producto'=>$prod13]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'2', 'id_producto'=>$prod15]);
        //3
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'3', 'id_producto'=>$prod1]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'3', 'id_producto'=>$prod2]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'3', 'id_producto'=>$prod3]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'3', 'id_producto'=>$prod4]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'3', 'id_producto'=>$prod5]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'3', 'id_producto'=>$prod7]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'3', 'id_producto'=>$prod8]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'3', 'id_producto'=>$prod9]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'3', 'id_producto'=>$prod12]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'3', 'id_producto'=>$prod13]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'3', 'id_producto'=>$prod14]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'3', 'id_producto'=>$prod15]);
        //4
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'4', 'id_producto'=>$prod1]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'4', 'id_producto'=>$prod2]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'4', 'id_producto'=>$prod9]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'4', 'id_producto'=>$prod10]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'4', 'id_producto'=>$prod11]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'4', 'id_producto'=>$prod12]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'4', 'id_producto'=>$prod13]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'4', 'id_producto'=>$prod14]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'4', 'id_producto'=>$prod15]);
        //5
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'5', 'id_producto'=>$prod1]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'5', 'id_producto'=>$prod2]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'5', 'id_producto'=>$prod4]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'5', 'id_producto'=>$prod6]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'5', 'id_producto'=>$prod7]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'5', 'id_producto'=>$prod11]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'5', 'id_producto'=>$prod12]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'5', 'id_producto'=>$prod13]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'5', 'id_producto'=>$prod14]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'5', 'id_producto'=>$prod15]);
        //6
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'6', 'id_producto'=>$prod1]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'6', 'id_producto'=>$prod2]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'6', 'id_producto'=>$prod3]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'6', 'id_producto'=>$prod4]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'6', 'id_producto'=>$prod5]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'6', 'id_producto'=>$prod6]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'6', 'id_producto'=>$prod7]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'6', 'id_producto'=>$prod9]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'6', 'id_producto'=>$prod10]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'6', 'id_producto'=>$prod11]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'6', 'id_producto'=>$prod14]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'6', 'id_producto'=>$prod15]);
        //7
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'7', 'id_producto'=>$prod1]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'7', 'id_producto'=>$prod2]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'7', 'id_producto'=>$prod3]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'7', 'id_producto'=>$prod4]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'7', 'id_producto'=>$prod5]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'7', 'id_producto'=>$prod6]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'7', 'id_producto'=>$prod9]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'7', 'id_producto'=>$prod10]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'7', 'id_producto'=>$prod13]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'7', 'id_producto'=>$prod14]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'7', 'id_producto'=>$prod15]);
        //8
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'8', 'id_producto'=>$prod1]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'8', 'id_producto'=>$prod2]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'8', 'id_producto'=>$prod3]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'8', 'id_producto'=>$prod4]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'8', 'id_producto'=>$prod5]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'8', 'id_producto'=>$prod6]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'8', 'id_producto'=>$prod7]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'8', 'id_producto'=>$prod8]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'8', 'id_producto'=>$prod9]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'8', 'id_producto'=>$prod10]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'8', 'id_producto'=>$prod11]);
        //9
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'9', 'id_producto'=>$prod1]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'9', 'id_producto'=>$prod2]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'9', 'id_producto'=>$prod14]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'9', 'id_producto'=>$prod15]);
        //10
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'10', 'id_producto'=>$prod1]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'10', 'id_producto'=>$prod2]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'10', 'id_producto'=>$prod3]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'10', 'id_producto'=>$prod4]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'10', 'id_producto'=>$prod5]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'10', 'id_producto'=>$prod6]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'10', 'id_producto'=>$prod9]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'10', 'id_producto'=>$prod11]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'10', 'id_producto'=>$prod12]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'10', 'id_producto'=>$prod13]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'10', 'id_producto'=>$prod14]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'10', 'id_producto'=>$prod15]);
        //11
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'11', 'id_producto'=>$prod1]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'11', 'id_producto'=>$prod2]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'11', 'id_producto'=>$prod3]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'11', 'id_producto'=>$prod4]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'11', 'id_producto'=>$prod6]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'11', 'id_producto'=>$prod7]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'11', 'id_producto'=>$prod8]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'11', 'id_producto'=>$prod10]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'11', 'id_producto'=>$prod12]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'11', 'id_producto'=>$prod13]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'11', 'id_producto'=>$prod14]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'11', 'id_producto'=>$prod15]);
        //12
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'12', 'id_producto'=>$prod1]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'12', 'id_producto'=>$prod2]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'12', 'id_producto'=>$prod3]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'12', 'id_producto'=>$prod6]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'12', 'id_producto'=>$prod7]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'12', 'id_producto'=>$prod10]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'12', 'id_producto'=>$prod11]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'12', 'id_producto'=>$prod14]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'12', 'id_producto'=>$prod15]);
        //13
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'13', 'id_producto'=>$prod1]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'13', 'id_producto'=>$prod2]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'13', 'id_producto'=>$prod4]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'13', 'id_producto'=>$prod6]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'13', 'id_producto'=>$prod7]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'13', 'id_producto'=>$prod8]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'13', 'id_producto'=>$prod9]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'13', 'id_producto'=>$prod11]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'13', 'id_producto'=>$prod12]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'13', 'id_producto'=>$prod14]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'13', 'id_producto'=>$prod15]);
        //14
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'14', 'id_producto'=>$prod1]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'14', 'id_producto'=>$prod2]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'14', 'id_producto'=>$prod6]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'14', 'id_producto'=>$prod7]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'14', 'id_producto'=>$prod8]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'14', 'id_producto'=>$prod9]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'14', 'id_producto'=>$prod10]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'14', 'id_producto'=>$prod13]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'14', 'id_producto'=>$prod14]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'14', 'id_producto'=>$prod15]);//1
        //15
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'15', 'id_producto'=>$prod1]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'15', 'id_producto'=>$prod2]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'15', 'id_producto'=>$prod3]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'15', 'id_producto'=>$prod4]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'15', 'id_producto'=>$prod5]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'15', 'id_producto'=>$prod6]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'15', 'id_producto'=>$prod7]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'15', 'id_producto'=>$prod10]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'15', 'id_producto'=>$prod11]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'15', 'id_producto'=>$prod12]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'15', 'id_producto'=>$prod13]);
        //16
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'16', 'id_producto'=>$prod1]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'16', 'id_producto'=>$prod2]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'16', 'id_producto'=>$prod14]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'16', 'id_producto'=>$prod15]);
        //17
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'17', 'id_producto'=>$prod1]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'17', 'id_producto'=>$prod2]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'17', 'id_producto'=>$prod3]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'17', 'id_producto'=>$prod4]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'17', 'id_producto'=>$prod8]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'17', 'id_producto'=>$prod9]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'17', 'id_producto'=>$prod10]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'17', 'id_producto'=>$prod14]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'17', 'id_producto'=>$prod15]);
        //18
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'18', 'id_producto'=>$prod1]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'18', 'id_producto'=>$prod2]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'18', 'id_producto'=>$prod3]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'18', 'id_producto'=>$prod4]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'18', 'id_producto'=>$prod7]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'18', 'id_producto'=>$prod8]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'18', 'id_producto'=>$prod9]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'18', 'id_producto'=>$prod10]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'18', 'id_producto'=>$prod13]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'18', 'id_producto'=>$prod15]);
        //19
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'19', 'id_producto'=>$prod1]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'19', 'id_producto'=>$prod2]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'19', 'id_producto'=>$prod3]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'19', 'id_producto'=>$prod6]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'19', 'id_producto'=>$prod7]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'19', 'id_producto'=>$prod8]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'19', 'id_producto'=>$prod11]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'19', 'id_producto'=>$prod15]);
        //20
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'20', 'id_producto'=>$prod1]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'20', 'id_producto'=>$prod3]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'20', 'id_producto'=>$prod4]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'20', 'id_producto'=>$prod6]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'20', 'id_producto'=>$prod9]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'20', 'id_producto'=>$prod10]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'20', 'id_producto'=>$prod13]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'20', 'id_producto'=>$prod14]);
        $this->insert('comercio_productos_relacionados',['id_comercio'=>'20', 'id_producto'=>$prod15]);
    }

    public function down()
    {
        echo "m151127_014438_carga_comercio_producto_categoria_relacion cannot be reverted.\n";

        return false;
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
