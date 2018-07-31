<?php

namespace app\models;
use Yii;

class APanelErrSearch extends PanelErrSearch
{
    public static function getDb()
    {
        return Yii::$app->get('mongodb_a');
    }
}
