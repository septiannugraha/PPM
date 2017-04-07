<?php

namespace app\modules\parameter\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\RefPegawai;

/**
 * RefPegawaiSearch represents the model behind the search form about `app\models\RefPegawai`.
 */
class RefPegawaiSearch extends RefPegawai
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'bidang_id', 'subbidang_id'], 'integer'],
            [['name', 'nip', 'pangkat', 'gol', 'ruang', 'jabatan', 'satker', 'karpeg', 'sex', 'agama', 'tmt', 'peran', 'reg_ak', 'pendidikan_p', 'pendidikan', 'stat', 'tgl_lahir'], 'safe'],
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
        $query = RefPegawai::find();

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
            'subbidang_id' => $this->subbidang_id,
            'tmt' => $this->tmt,
            'tgl_lahir' => $this->tgl_lahir,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'nip', $this->nip])
            ->andFilterWhere(['like', 'pangkat', $this->pangkat])
            ->andFilterWhere(['like', 'gol', $this->gol])
            ->andFilterWhere(['like', 'ruang', $this->ruang])
            ->andFilterWhere(['like', 'jabatan', $this->jabatan])
            ->andFilterWhere(['like', 'satker', $this->satker])
            ->andFilterWhere(['like', 'karpeg', $this->karpeg])
            ->andFilterWhere(['like', 'sex', $this->sex])
            ->andFilterWhere(['like', 'agama', $this->agama])
            ->andFilterWhere(['like', 'peran', $this->peran])
            ->andFilterWhere(['like', 'reg_ak', $this->reg_ak])
            ->andFilterWhere(['like', 'pendidikan_p', $this->pendidikan_p])
            ->andFilterWhere(['like', 'pendidikan', $this->pendidikan])
            ->andFilterWhere(['like', 'stat', $this->stat]);

        return $dataProvider;
    }
}
