<?php

namespace app\models;

use Yii;

class PAbsbFile extends AbsbFile
{
	protected $modelflag = 'Pointcare';
    public static function getDb()
    {
        return Yii::$app->get('mongodb_p');
    }
}
