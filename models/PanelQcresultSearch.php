<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PanelQcresult;

/**
 * PanelQcresultSearch represents the model behind the search form of `app\models\PanelQcresult`.
 */
class PanelQcresultSearch extends PanelQcresult
{
    public $createdFrom;
    public $createdTo;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['_id', 'machineid', 'panelid', 'panellot', 'panelindex', 'chkdatetime', 'softversion', 'hardware1version', 'hardware2version', 'name', 'lot', 'result', 'unit','createdFrom','createdTo'], 'safe'],
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
            ->andFilterWhere(['like', 'machineid', $this->machineid])
            // ->andFilterWhere(['like', 'panelid', $this->panelid])
            ->andFilterWhere(['like', 'panellot', $this->panellot])
            // ->andFilterWhere(['like', 'panelindex', $this->panelindex])
            // ->andFilterWhere(['like', 'chkdatetime', $this->chkdatetime])
            ->andFilterWhere(['like', 'softversion', $this->softversion])
            // ->andFilterWhere(['like', 'hardware1version', $this->hardware1version])
            // ->andFilterWhere(['like', 'hardware2version', $this->hardware2version])
            // ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'lot', $this->lot])
            // ->andFilterWhere(['like', 'result', $this->result])
            // ->andFilterWhere(['like', 'unit', $this->unit])
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
        $query->addOrderBy(['_id' => SORT_DESC]);
        return $dataProvider;
    }
}
