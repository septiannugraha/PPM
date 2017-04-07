<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ref_pegawai".
 *
 * @property integer $id
 * @property string $name
 * @property string $nip
 * @property string $pangkat
 * @property string $gol
 * @property string $ruang
 * @property string $jabatan
 * @property string $satker
 * @property integer $bidang_id
 * @property integer $subbidang_id
 * @property string $karpeg
 * @property string $sex
 * @property string $agama
 * @property string $tmt
 * @property string $peran
 * @property string $reg_ak
 * @property string $pendidikan_p
 * @property string $pendidikan
 * @property string $stat
 * @property string $tgl_lahir
 */
class RefPegawai extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ref_pegawai';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bidang_id', 'subbidang_id'], 'integer'],
            [['tmt', 'tgl_lahir'], 'safe'],
            [['name', 'pangkat', 'jabatan', 'satker'], 'string', 'max' => 50],
            [['nip'], 'string', 'max' => 18],
            [['gol'], 'string', 'max' => 3],
            [['ruang', 'sex'], 'string', 'max' => 1],
            [['karpeg', 'agama', 'reg_ak', 'pendidikan_p', 'pendidikan'], 'string', 'max' => 20],
            [['peran'], 'string', 'max' => 30],
            [['stat'], 'string', 'max' => 5],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'nip' => 'Nip',
            'pangkat' => 'Pangkat',
            'gol' => 'Gol',
            'ruang' => 'Ruang',
            'jabatan' => 'Jabatan',
            'satker' => 'Satker',
            'bidang_id' => 'Bidang ID',
            'subbidang_id' => 'Subbidang ID',
            'karpeg' => 'Karpeg',
            'sex' => 'Sex',
            'agama' => 'Agama',
            'tmt' => 'Tmt',
            'peran' => 'Peran',
            'reg_ak' => 'Reg Ak',
            'pendidikan_p' => 'Pendidikan P',
            'pendidikan' => 'Pendidikan',
            'stat' => 'Stat',
            'tgl_lahir' => 'Tgl Lahir',
        ];
    }
}
