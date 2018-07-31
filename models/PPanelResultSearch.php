<?php

namespace app\models;
use Yii;

class PPanelResultSearch extends PanelResultSearch
{
    public static function getDb()
    {
        return Yii::$app->get('mongodb_p');
    }
}
