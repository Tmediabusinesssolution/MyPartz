<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Searchhistory;

/**
 * SearchhistorySearch represents the model behind the search form about `backend\models\Searchhistory`.
 */
class SearchhistorySearch extends Searchhistory
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['SearchId', 'TotalCount'], 'integer'],
            [['SearchKey', 'LastSearchTime'], 'safe'],
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
        $query = Searchhistory::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
			'sort'=> ['defaultOrder' => ['TotalCount'=>SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'SearchId' => $this->SearchId,
            'TotalCount' => $this->TotalCount,
            'LastSearchTime' => $this->LastSearchTime,
        ]);

        $query->andFilterWhere(['like', 'SearchKey', $this->SearchKey]);

        return $dataProvider;
    }
}
