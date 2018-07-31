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
            'chkdatetime' => 'Chkdatetime',
            'errcode' => 'Errcode',
            'hardware1version' => 'Hardware1version',
            'hardware2version' => 'Hardware2version',
            'hardware3version' => 'Hardware3version',
            'machineid' => 'Machineid',
            'panelid' => 'Panelid',
            'panelindex' => 'Panelindex',
            'panellot' => 'Panellot',
            'patientinfo' => 'Patientinfo',
            'sampletype' => 'Sampletype',
            'softversion' => 'Softversion',
            'testresults' => 'Testresults',
        ];
    }
}
