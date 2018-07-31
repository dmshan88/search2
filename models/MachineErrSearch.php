<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MachineErr;

/**
 * MachineErrSearch represents the model behind the search form of `app\models\MachineErr`.
 */
class MachineErrSearch extends MachineErr
{
    public $createdFrom;
    public $createdTo;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['_id', 'errcode', 'errdatetime', 'hardware1version', 'hardware2version', 'machineid', 'softversion', 'summary','createdFrom','createdTo'], 'safe'],
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
            // ->andFilterWhere(['like', 'errcode', $this->errcode])
            // ->andFilterWhere(['like', 'errdatetime', $this->errdatetime])
            // ->andFilterWhere(['like', 'hardware1version', $this->hardware1version])
            // ->andFilterWhere(['like', 'hardware2version', $this->hardware2version])
            ->andFilterWhere(['like', 'machineid', $this->machineid])
            ->andFilterWhere(['like', 'softversion', $this->softversion])
            // ->andFilterWhere(['like', 'summary', $this->summary])
            ;
        if (!empty($this->createdFrom)) {
            $query->andFilterWhere(['>=', 'errdatetime', strtotime($this->createdFrom)]);
        }
        if (!empty($this->createdTo)) {
            $query->andFilterWhere(['<', 'errdatetime', strtotime($this->createdTo)+24*3600]);
        }
        $query->addOrderBy(['_id' => SORT_DESC]);
        return $dataProvider;
    }
}
