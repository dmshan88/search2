<?php

namespace app\models;
use Yii;

class APanelResultSearch extends PanelResultSearch
{
    public static function getDb()
    {
        return Yii::$app->get('mongodb_a');
    }
}
