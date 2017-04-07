<?php

/* (C) Copyright 2017 Heru Arief Wijaya (http://belajararief.com/) untuk Renbang Biro Kepegawaian BPKP.*/

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class Laporan extends Model
{
    public $Kd_Laporan;
    public $Kd_Sumber;
    public $Kd_Unit;
    public $Tgl_1;
    public $Tgl_2;
    public $Tgl_Laporan;
    public $kode_pegawai;
    public $kota_ttd;
    public $jabatan_ttd;
    public $nama_ttd;
    public $nip_ttd;

    public function rules()
    {
        return [
            [['Kd_Laporan'], 'integer'],
            [['Kd_Laporan', 'Kd_Unit', 'kode_pegawai'], 'string'],
            [['Tgl_1', 'Tgl_2', 'Tgl_Laporan', 'nama_ttd', 'jabatan_ttd', 'nip_ttd', 'kota_ttd'], 'safe'],
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
}
