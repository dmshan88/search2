<?php

namespace app\models;
use Yii;

class CPanelErrSearch extends PanelErrSearch
{
    public static function getDb()
    {
        return Yii::$app->get('mongodb_c');
    }
}
