<?php

namespace app\models;

use Yii;

/**
 * This is the model class for collection "machine_err".
 *
 * @property \MongoDB\BSON\ObjectID|string $_id
 * @property mixed $errcode
 * @property mixed $errdatetime
 * @property mixed $hardware1version
 * @property mixed $hardware2version
 * @property mixed $machineid
 * @property mixed $softversion
 * @property mixed $summary
 */
class MachineErr extends \yii\mongodb\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function collectionName()
    {
        return 'machine_err';
    }

    /**
     * {@inheritdoc}
     */
    public function attributes()
    {
        return [
            '_id',
            'errcode',
            'errdatetime',
            'hardware1version',
            'hardware2version',
            'machineid',
            'softversion',
            'summary',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['errcode', 'errdatetime', 'hardware1version', 'hardware2version', 'machineid', 'softversion', 'summary'], 'safe']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            '_id' => 'ID',
            'errcode' => '错误码',
            'errdatetime' => '时间',
            'hardware1version' => '硬件1',
            'hardware2version' => '硬件2',
            'machineid' => '设备编号',
            'softversion' => '软件',
            'summary' => '报错信息',
        ];
    }
}
