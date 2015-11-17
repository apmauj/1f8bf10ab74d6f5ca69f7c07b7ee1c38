<?php

namespace api\modules\v2\controllers;

use yii\rest\ActiveController;

/**
 * Comercio Controller API
 *
 * @author Budi Irawan <deerawan@gmail.com>
 */
class ComercioController extends ActiveController
{
    public $modelClass = 'backend\models\Comercio';


	public function behaviors()
	{
	    $behaviors = parent::behaviors();
	    
	    return $behaviors;
	}

	
}


