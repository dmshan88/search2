<?php

namespace app\models;

use Yii;

/**
 * This is the model class for collection "panel_qcresult".
 *
 * @property \MongoDB\BSON\ObjectID|string $_id
 * @property mixed $machineid
 * @property mixed $panelid
 * @property mixed $panellot
 * @property mixed $panelindex
 * @property mixed $chkdatetime
 * @property mixed $softversion
 * @property mixed $hardware1version
 * @property mixed $hardware2version
 * @property mixed $name
 * @property mixed $lot
 * @property mixed $result
 * @property mixed $unit
 */
class PanelQcresult extends \yii\mongodb\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function collectionName()
    {
        return 'panel_qcresult';
    }

    /**
     * {@inheritdoc}
     */
    public function attributes()
    {
        return [
            '_id',
            'machineid',
            'panelid',
            'panellot',
            'panelindex',
            'chkdatetime',
            'softversion',
            'hardware1version',
            'hardware2version',
            'name',
            'lot',
            'result',
            'unit',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['machineid', 'panelid', 'panellot', 'panelindex', 'chkdatetime', 'softversion', 'hardware1version', 'hardware2version', 'name', 'lot', 'result', 'unit'], 'safe']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            '_id' => 'ID',
            'machineid' => 'Machineid',
            'panelid' => 'Panelid',
            'panellot' => 'Panellot',
            'panelindex' => 'Panelindex',
            'chkdatetime' => 'Chkdatetime',
            'softversion' => 'Softversion',
            'hardware1version' => 'Hardware1version',
            'hardware2version' => 'Hardware2version',
            'name' => 'Name',
            'lot' => 'Lot',
            'result' => 'Result',
            'unit' => 'Unit',
        ];
    }
}
