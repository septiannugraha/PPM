<?php

namespace app\modules\transaksi\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Ppud;

/**
 * PpudSearch represents the model behind the search form about `app\models\Ppud`.
 */
class PpudSearch extends Ppud
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'puud', 'puuddetail', 'tetap_province', 'user_id'], 'integer'],
            [['no', 'tentang', 'tag', 'files', 'tetap_kabkot', 'tetap_tanggal', 'created', 'updated'], 'safe'],
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
        $query = Ppud::find();

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
            'puud' => $this->puud,
            'puuddetail' => $this->puuddetail,
            'tahun' => $this->tahun,
            'tetap_province' => $this->tetap_province,
            'tetap_tanggal' => $this->tetap_tanggal,
            'user_id' => $this->user_id,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'no', $this->no])
            ->andFilterWhere(['like', 'tentang', $this->tentang])
            ->andFilterWhere(['like', 'tag', $this->tag])
            ->andFilterWhere(['like', 'files', $this->files])
            ->andFilterWhere(['like', 'tetap_kabkot', $this->tetap_kabkot]);

        return $dataProvider;
    }
}
