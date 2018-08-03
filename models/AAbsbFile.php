<?php

namespace app\models;

use Yii;

class AAbsbFile extends AbsbFile
{
	protected $modelflag = 'APP';
    public static function getDb()
    {
        return Yii::$app->get('mongodb_a');
    }
}
