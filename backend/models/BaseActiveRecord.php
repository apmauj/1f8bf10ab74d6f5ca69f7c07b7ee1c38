<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "country".
 *
 * @property string $code
 * @property string $name
 * @property integer $population
 */
class BaseActiveRecord extends ActiveRecord
{

	public function behaviors()
    {

        return ArrayHelper::merge(parent::behaviors(),        
            [
                TimestampBehavior::className(),
            ]
        );
    }
}