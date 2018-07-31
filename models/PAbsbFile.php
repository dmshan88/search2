<?php

namespace app\models;

use Yii;

class PAbsbFile extends AbsbFile
{
	private $modelflag = 'Pointcare';
    public static function getDb()
    {
        return Yii::$app->get('mongodb_p');
    }
}
