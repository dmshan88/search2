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
            'chkdatetime' => '检测时间',
            'machineid' => '设备编号',
            'panelid' => '盘片',
            'panellot' => '批号',
            'panelindex' => '唯一码',
            'softversion' => '软件',
            'hardware1version' => '硬件1',
            'hardware2version' => '硬件2',
            // 'hardware3version' => '硬件3',
            'name' => '项目',
            'lot' => 'Lot',
            'result' => '结果',
            'unit' => '单位',
        ];
    }
}
