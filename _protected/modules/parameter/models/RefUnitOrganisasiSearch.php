<?php

namespace app\modules\parameter\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\RefUnitOrganisasi;

/**
 * RefUnitOrganisasiSearch represents the model behind the search form about `app\models\RefUnitOrganisasi`.
 */
class RefUnitOrganisasiSearch extends RefUnitOrganisasi
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kode_unit', 'nama_unit'], 'safe'],
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
        $query = RefUnitOrganisasi::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'kode_unit', $this->kode_unit])
            ->andFilterWhere(['like', 'nama_unit', $this->nama_unit]);

        return $dataProvider;
    }
}
