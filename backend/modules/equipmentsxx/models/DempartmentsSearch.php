<?php

namespace backend\modules\equipments\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Departments;

/**
 * DempartmentsSearch represents the model behind the search form about `common\models\Departments`.
 */
class DempartmentsSearch extends Departments
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dep_id'], 'integer'],
            [['dep_name'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Departments::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'dep_id' => $this->dep_id,
        ]);

        $query->andFilterWhere(['like', 'dep_name', $this->dep_name]);

        return $dataProvider;
    }
}
