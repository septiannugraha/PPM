<?php

namespace app\modules\transaksi\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Tpeserta;

/**
 * TpesertaSearch represents the model behind the search form about `app\models\Tpeserta`.
 */
class TpesertaSearch extends Tpeserta
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'ppm_id', 'pegawai_id', 'peran_id'], 'integer'],
            [['keterangan'], 'safe'],
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
        $query = Tpeserta::find();

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
            'ppm_id' => $this->ppm_id,
            'pegawai_id' => $this->pegawai_id,
            'peran_id' => $this->peran_id,
        ]);

        $query->andFilterWhere(['like', 'keterangan', $this->keterangan]);

        return $dataProvider;
    }
}
