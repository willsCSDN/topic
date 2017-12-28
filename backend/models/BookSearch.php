<?php

namespace backend\models;

use common\models\BookAgent;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Book;

/**
 * BookSearch represents the model behind the search form about `common\models\Book`.
 */
class BookSearch extends Book
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'is_shelve', 'chapter_num', 'sale_model', 'subcribe_num', 'click_num', 'collection_num', 'is_agent', 'type', 'category'], 'integer'],
            [['name', 'cover', 'desc', 'author', 'chapter_name', 'created', 'updated'], 'safe'],
            [['words_num', 'price'], 'number'],
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
        $query = Book::find();

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
        $query->andFilterWhere([
//            'id' => $this->id,
            'status' => $this->status,
            'chapter_num' => $this->chapter_num,
            'words_num' => $this->words_num,
            'price' => $this->price,
            'sale_model' => $this->sale_model,
            'subcribe_num' => $this->subcribe_num,
            'click_num' => $this->click_num,
            'collection_num' => $this->collection_num,
            'is_agent' => $this->is_agent,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->orFilterWhere(['like', 'author', $this->name])
            ->orFilterWhere(['like', 'id', $this->name])
            ->andFilterWhere(['like', 'cover', $this->cover])
            ->andFilterWhere(['like', 'desc', $this->desc])
            ->andFilterWhere(['like', 'chapter_name', $this->chapter_name])
            ->andFilterWhere(['<>', 'is_shelve', 3]);

        return $dataProvider;
    }

    /**
     * @param $params
     * @return ActiveDataProvider
     */
    public function searchAgent($params)
    {
        $query = Book::find();
        $query->joinWith(['bookAgent']);
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
        $query->andFilterWhere([
//            'id' => $this->id,
            'book_agent.status' => $this->status,
            'chapter_num' => $this->chapter_num,
            'words_num' => $this->words_num,
            'price' => $this->price,
            'sale_model' => $this->sale_model,
            'subcribe_num' => $this->subcribe_num,
            'click_num' => $this->click_num,
            'collection_num' => $this->collection_num,
            'is_agent' => $this->is_agent,
            'category' => $this->category,
            'book_agent.created' => $this->created,
            'book_agent.updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->orFilterWhere(['like', 'author', $this->name])
            ->orFilterWhere(['like', 'id', $this->name])
            ->andFilterWhere(['like', 'cover', $this->cover])
            ->andFilterWhere(['like', 'desc', $this->desc])
            ->andFilterWhere(['like', 'chapter_name', $this->chapter_name])
            ->andFilterWhere(['<>', 'is_shelve', 3])
            ->andFilterWhere(['<>', 'book_agent.status', 3]);

        return $dataProvider;
    }
}
