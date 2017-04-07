<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Tfiles;

/**
 * TfilesSearch represents the model behind the search form about `app\models\Tfiles`.
 */
class TfilesSearch extends Tfiles
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'bidang_id', 'category_id', 'user_dest', 'user_id', 'created_at', 'updated_at'], 'integer'],
            [['no', 'tentang', 'tag', 'files'], 'safe'],
            [['tahun'], 'number'],
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
        $query = Tfiles::find();

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
            'id' => $this->id,
            'bidang_id' => $this->bidang_id,
            'category_id' => $this->category_id,
            'user_dest' => $this->user_dest,
            'tahun' => $this->tahun,
            'user_id' => $this->user_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'no', $this->no])
            ->andFilterWhere(['like', 'tentang', $this->tentang])
            ->andFilterWhere(['like', 'tag', $this->tag])
            ->andFilterWhere(['like', 'files', $this->files]);

        return $dataProvider;
    }
}
