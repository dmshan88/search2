<?php

namespace app\models;

use Yii;

/**
 * This is the model class for collection "panel_result".
 *
 * @property \MongoDB\BSON\ObjectID|string $_id
 * @property mixed $chkdatetime
 * @property mixed $errcode
 * @property mixed $hardware1version
 * @property mixed $hardware2version
 * @property mixed $hardware3version
 * @property mixed $machineid
 * @property mixed $panelid
 * @property mixed $panelindex
 * @property mixed $panellot
 * @property mixed $patientinfo
 * @property mixed $sampletype
 * @property mixed $softversion
 * @property mixed $testresults
 */
class PanelResult extends \yii\mongodb\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function collectionName()
    {
        // return ['Pointcare', 'panel_result'];
        return 'panel_result';
    }

    /**
     * {@inheritdoc}
     */
    public function attributes()
    {
        return [
            '_id',
            'chkdatetime',
            'errcode',
            'hardware1version',
            'hardware2version',
            'hardware3version',
            'machineid',
            'panelid',
            'panelindex',
            'panellot',
            'patientinfo',
            'sampletype',
            'softversion',
            'testresults',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['chkdatetime', 'errcode', 'hardware1version', 'hardware2version', 'hardware3version', 'machineid', 'panelid', 'panelindex', 'panellot', 'patientinfo', 'sampletype', 'softversion', 'testresults'], 'safe']
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
            'errcode' => '错误码',
            'hardware1version' => '硬件1',
            'hardware2version' => '硬件2',
            'hardware3version' => '硬件3',
            'machineid' => '设备编号',
            'panelid' => '盘片',
            'panelindex' => '唯一码',
            'panellot' => '批号',
            'patientinfo' => '病人信息',
            'sampletype' => '样本类型',
            'softversion' => '软件',
            'testresults' => '检测结果',
        ];
    }
}
