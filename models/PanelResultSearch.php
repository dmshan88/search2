<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PanelResult;

/**
 * PanelResultSearch represents the model behind the search form of `app\models\PanelResult`.
 */
class PanelResultSearch extends PanelResult
{
        /**
     * @var string
     */
    public $createdFrom;

    /**
     * @var string
     */
    public $createdTo;
    public $errname;
    public $itemname;
    public $leftvalue;
    public $rightvalue;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['_id', 'chkdatetime', 'errcode', 'hardware1version', 'hardware2version', 'hardware3version', 'machineid', 'panelid', 'panelindex', 'panellot', 'patientinfo', 'sampletype', 'softversion', 'testresults','createdFrom','createdTo','errname','itemname','leftvalue','rightvalue'], 'safe'],
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
    public function search($params)
    {
        $query = self::find();
        // var_dump($query);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere(['like', '_id', $this->_id])
            // ->andFilterWhere(['like', 'chkdatetime', $this->chkdatetime])
            // ->andFilterWhere(['like', 'errcode', $this->errcode])
            // ->andFilterWhere(['like', 'hardware1version', $this->hardware1version])
            // ->andFilterWhere(['like', 'hardware2version', $this->hardware2version])
            // ->andFilterWhere(['like', 'hardware3version', $this->hardware3version])
            ->andFilterWhere(['like', 'machineid', $this->machineid])
            // ->andFilterWhere(['like', 'panelindex', $this->panelindex])
            ->andFilterWhere(['like', 'panellot', $this->panellot])
            // ->andFilterWhere(['like', 'patientinfo', $this->patientinfo])
            // ->andFilterWhere(['like', 'sampletype', $this->sampletype])
            ->andFilterWhere(['=', 'softversion', $this->softversion])
            // ->andFilterWhere(['like', 'testresults', $this->testresults])
            ;
        if (strlen($this->panelid)) {
            $query->andFilterWhere(['=', 'panelid', intval($this->panelid)]);
        }
        if (!empty($this->createdFrom)) {
            $query->andFilterWhere(['>=', 'chkdatetime', strtotime($this->createdFrom)]);
        }
        if (!empty($this->createdTo)) {
            $query->andFilterWhere(['<', 'chkdatetime', strtotime($this->createdTo)+24*3600]);
        }
        if (!empty($this->itemname)) {
            $itemname = $this->itemname;
            if (!empty($this->leftvalue)) {
                $query->andFilterWhere(['>=', "testresults.$itemname.1", floatval($this->leftvalue)]);
            }
            if (!empty($this->rightvalue)) {
                $query->andFilterWhere(['<=', "testresults.$itemname.1", floatval($this->rightvalue)]);
            }
        }
        if (strlen($this->errname)) {
            switch ($this->errname) {
                case 'no'://无报错
                    $condition['errcode'] = ['errcode'=>0];
                    break;
                case '02101'://0210  or 0211           
                    $condition['errcode'] = ['$where'=>'function(){if((this.errcode & 0x60)>>5 >= 1){return true;}return false;}'];
                    break;
                case '02101e'://0210  or 0211 排除黄疸溶血脂血          
                    $condition['errcode'] = ['$where'=>'function(){if((this.errcode & 0x60)>>5 >= 1 && (this.errcode & 0x07)==0){return true;}return false;}'];
                    break;
                case '02146'://0214 0215 0216           
                    $condition['errcode'] = ['$where'=>'function(){if((this.errcode & 0x10700)>>8 >= 1){return true;}return false;}'];
                    break;
                default://其他，errorcode对应位为1
                    $errbit=intval($this->errname);
                    $condition['errcode'] = ['$where'=>'function(){if((this.errcode & '.decbin(pow(2, $errbit)).')>>'.$errbit.' == 1){return true;}return false;}'];
                    break;
            }
            $query->andFilterWhere($condition['errcode']);
        }
        $query->addOrderBy(['_id' => SORT_DESC]);
        return $dataProvider;
    }
    
    public function attributeLabels()
    {
        return array_merge(
            PanelResult::attributeLabels(),
            [
                'itemname' => '项目',
                'leftvalue' => '左值',
                'rightvalue' => '右值',
                'errname' => '报错',
                'createdFrom' => '开始时间',
                'createdTo' => '结束时间',
            ]
            );
    }
}
