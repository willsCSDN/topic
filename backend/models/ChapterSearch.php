<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Chapter;

/**
 * ChapterSearch represents the model behind the search form about `common\models\Chapter`.
 */
class ChapterSearch extends Chapter
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'book_id', 'num', 'is_free', 'words_num'], 'integer'],
            [['name', 'desc', 'path', 'created', 'updated'], 'safe'],
            [['price'], 'number'],
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
        $query = Chapter::find();

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
            'id' => $this->id,
            'book_id' => $this->book_id,
            'num' => $this->num,
            'price' => $this->price,
            'is_free' => $this->is_free,
            'words_num' => $this->words_num,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'desc', $this->desc])
            ->andFilterWhere(['like', 'path', $this->path]);

        return $dataProvider;
    }
}
