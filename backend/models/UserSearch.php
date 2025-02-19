<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\User;

/**
 * SellerSearch represents the model behind the search form about `backend\models\Seller`.
 */
class UserSearch extends Seller
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['UserId'], 'integer'],
            [['UserName', 'Email', 'Password', 'Mobile', 'ProfilePic', 'FirstName', 'LastName', 'Gender', 'LogInStatus', 'LastLogin', 'ResetToken', 'AccessToken', 'Status', 'CreatedOn', 'UpdatedOn'], 'safe'],
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
        $query = Seller::find();
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
				
		$query->andFilterWhere(['like', 'UserName', $this->UserName])
            ->andFilterWhere(['like', 'Email', $this->Email])
            ->andFilterWhere(['like', 'Mobile', $this->Mobile])
            ->andFilterWhere(['like', 'Status', $this->Status]);
			
		$query->groupBy(['seller.UserId']);
		//echo $query->createCommand()->sql;		
		return $dataProvider;
    }
}
