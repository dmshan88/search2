<?php

namespace app\models;
use Yii;

class PPanelErrSearch extends PanelErrSearch
{
    public static function getDb()
    {
        return Yii::$app->get('mongodb_p');
    }
}
