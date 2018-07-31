<?php

namespace app\models;
use Yii;

class PPanelQcresultSearch extends PanelQcresultSearch
{
    public static function getDb()
    {
        return Yii::$app->get('mongodb_p');
    }
}
