<?php

namespace app\models;
use Yii;

class PMachineErrSearch extends MachineErrSearch
{
    public static function getDb()
    {
        return Yii::$app->get('mongodb_p');
    }
}
