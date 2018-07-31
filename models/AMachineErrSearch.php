<?php

namespace app\models;
use Yii;

class AMachineErrSearch extends MachineErrSearch
{
    public static function getDb()
    {
        return Yii::$app->get('mongodb_a');
    }
}
