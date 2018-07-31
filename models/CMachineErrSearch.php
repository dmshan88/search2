<?php

namespace app\models;
use Yii;

class CMachineErrSearch extends MachineErrSearch
{
    public static function getDb()
    {
        return Yii::$app->get('mongodb_c');
    }
}
