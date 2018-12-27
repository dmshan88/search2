<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ArrayDataProvider;

/**
 */
class TotalSearch extends Model
{
    public $createdFrom;
    public $createdTo;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['createdFrom','createdTo'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($connection, $params)
    {
        // $dataProvider = new ArrayDataProvider([
        // ]);

        $this->load($params);

        if (!$this->validate()) {
            return [];
            // return $dataProvider;
        }
        $starttime = empty($this->createdFrom) ? time() - 30 * 24 *3600 : strtotime($this->createdFrom);
        $endtime = empty($this->createdTo) ? time() : strtotime($this->createdTo) + 24 *3600;
        $pipeline = [
            [
                '$match' => [
                    'machineid' => [
                        '$ne' => 'unset',
                        '$ne' => '',
                    ],
                    'chkdatetime' => [
                        '$gt' => $starttime,
                        '$lt' => $endtime,
                    ],
                ],
            ], [
                '$group' => [
                    '_id' => '$machineid',
                    'result' => ['$sum' => 1],
                    'soft' => ['$max' => '$softversion'],
                    'type' => ['$first' => '$panelid'], 
                    'last' => ['$max' => '$chkdatetime'], 
                ],
            ],
        ];
        // echo "<br>start 1:".time();
        $resultarr = $connection->createCommand()            
            ->aggregate('panel_result', $pipeline, [ 'allowDiskUse' => true ]);

        $errorarr = $connection->createCommand()            
            ->aggregate('panel_err', $pipeline, [ 'allowDiskUse' => true ]);
        $retarr = [];
        // echo "<br>start 3".time();
        foreach ($resultarr as $resultvalue) {
            $machineid = $resultvalue['_id'];
            $retarr[$machineid] = [
                'machineid' => $machineid,
                'error' => 0,
                'result' => $resultvalue['result'],
                'soft' => $resultvalue['soft'],
                'type' => $resultvalue['type'] < 50 ? 'M' : 'V',
                'last' => date('y-m-d' ,$resultvalue['last']),
            ];
        }
        unset($resultarr);
        // echo "<br>start 4".time();
        foreach ($errorarr as $errorvalue) {
            $machineid = $errorvalue['_id'];
            if (array_key_exists($machineid, $retarr)) {
                $retarr[$machineid]['error'] = $errorvalue['result'];
                $retarr[$machineid]['last'] = max($retarr[$machineid]['last'], date('y-m-d' ,$resultvalue['last']));
            } else {
                $retarr[$machineid] = [
                    'machineid' => $machineid,
                    'error' => $errorvalue['result'],
                    'result' => 0,
                    'soft' => $errorvalue['soft'],
                    'type' => $errorvalue['type'] < 50 ? 'M' : 'V',
                    'last' => date('y-m-d' ,$resultvalue['last']),
                ];
            }
        }
        // echo "<br>start 5".time();
        unset($errorarr);
        ksort($retarr);
        // echo "<br>start 6".time();
        return array_values($retarr);
    }
    public function attributeLabels()
    {
        return [
                'createdFrom' => '开始时间',
                'createdTo' => '结束时间',
            ];
    }
}
