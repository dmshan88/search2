<?php

namespace app\models;

use Yii;

class CAbsbFile extends AbsbFile
{
	protected $modelflag = 'Celercare';
    public static function getDb()
    {
        return Yii::$app->get('mongodb_c');
    }
}
