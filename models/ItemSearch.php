<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Items;

/**
 * ItemSearch represents the model behind the search form about `app\models\Items`.
 */
class ItemSearch extends Items
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'create_by', 'update_by'], 'integer'],
            [['title', 'content', 'create_at', 'update_at','status'], 'safe'],
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
        $query = Items::find();

        // add conditions that should always apply here
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'defaultOrder' => [
                    'create_at' => SORT_DESC,
//                    'title' => SORT_ASC,
                ]
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
//            'create_by' => $this->create_by,
//            'update_by' => $this->update_by,
//            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'create_at', $this->create_at])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'update_at', $this->update_at]);

        return $dataProvider;
    }
}
