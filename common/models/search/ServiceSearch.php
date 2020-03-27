<?php

namespace common\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Service;


/**
 * ServiceSearch represents the model behind the search form of `common\models\Service`.
 */
class ServiceSearch extends Service
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id',  'title'], 'safe'],
            [['status_id'], 'integer'],
        ];
    }

    /*
     *
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
        $query = Service::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        // grid filtering conditions
        if (777 != $this->status_id) {
            $query->andFilterWhere(
                [
                    'status_id' => $this->status_id,
                ]
            );
        }

        if ('all' != $this->category_id) {
            $query->andFilterWhere([
               'category_id' => $this->category_id,
            ]);
        }

        $query->andFilterWhere(['ilike', 'title', $this->title]);

        return $dataProvider;
    }
}
