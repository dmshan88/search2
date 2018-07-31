<?php

namespace app\models;
use Yii;

class CPanelQcresultSearch extends PanelQcresultSearch
{
    public static function getDb()
    {
        return Yii::$app->get('mongodb_c');
    }
}
