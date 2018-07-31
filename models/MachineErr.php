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
            'errcode' => 'Errcode',
            'errdatetime' => 'Errdatetime',
            'hardware1version' => 'Hardware1version',
            'hardware2version' => 'Hardware2version',
            'machineid' => 'Machineid',
            'softversion' => 'Softversion',
            'summary' => 'Summary',
        ];
    }
}
