<?php

namespace api\modules\v1\controllers;

use yii\rest\ActiveController;

/**
 * Categoria Controller API
 *
 * @author Budi Irawan <deerawan@gmail.com>
 */
class CategoriaController extends ActiveController
{
    public $modelClass = 'backend\models\Categoria';


	public function behaviors()
	{
	    $behaviors = parent::behaviors();
	    
	    return $behaviors;
	}

	
}


