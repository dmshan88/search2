<?php

namespace app\models;
use Yii;

class APanelQcresultSearch extends PanelQcresultSearch
{
    public static function getDb()
    {
        return Yii::$app->get('mongodb_a');
    }
}
