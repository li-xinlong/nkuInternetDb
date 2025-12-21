<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Guestbook;

/**
 * GuestbookSearch represents the model behind the search form of `common\models\Guestbook`.
 */
class GuestbookSearch extends Guestbook
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'related_id', 'is_public', 'status', 'replied_at', 'created_at'], 'integer'],
            [['name', 'email', 'content', 'category', 'related_model', 'reply', 'ip'], 'safe'],
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
        $query = Guestbook::find()->where(['status' => 0]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['status' => SORT_ASC, 'id' => SORT_DESC]],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'related_id' => $this->related_id,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['=', 'related_model', $this->related_model]);

        return $dataProvider;
    }
}


