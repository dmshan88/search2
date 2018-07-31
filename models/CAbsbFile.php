<?php

namespace app\models;

use Yii;

class CAbsbFile extends AbsbFile
{
	private $modelflag = 'Celercare';
    public static function getDb()
    {
        return Yii::$app->get('mongodb_c');
    }
}
