<?php

namespace app\models;
use Yii;

class CPanelResultSearch extends PanelResultSearch
{
    public static function getDb()
    {
        return Yii::$app->get('mongodb_c');
    }
}
