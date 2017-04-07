<?php

namespace app\models;

use Yii;

class Pegawai extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ren_peg_last';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('dbsispedap');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'usia', 'lamath_kp', 'lamabl_bl', 'lamath_jab', 'lamabl_jab', 'lamath_unit', 'lamabl_unit', 'total_pak'], 'number'],
            [['d_tgl_lahir', 'tmt_pensiun', 'd_tmt_sk', 'tmt_jab', 'tmt_unit', 'd_tgl_lulus', 'd_tgl_awal', 'd_tgl_akhir', 'd_tmt_kgb', 'd_tglser_diklatfung', 'd_tglser_diklatstruk', 'tgl_update'], 'safe'],
            [['i_maker_th_kgb', 'i_maker_bl_kgb'], 'integer'],
            [['s_alamat', 'sert_profesi', 'kel_jab', 'status'], 'string'],
            [['niplama'], 'string', 'max' => 60],
            [['nipbaru', 's_kd_jabdetail'], 'string', 'max' => 63],
            [['s_nama_lengkap', 'carinama_nip', 'jabatan', 's_nmjabdetailskt'], 'string', 'max' => 1500],
            [['s_tempat_lahir', 's_no_sk_kgb'], 'string', 'max' => 180],
            [['jenis_kelamin'], 'string', 'max' => 27],
            [['s_nama_agama', 's_skt_instansiunitorg', 'namaunit', 's_skt_pendidikan', 's_nosert_diklatfung', 's_nosert_diklatstruk', 'unit_pasangan'], 'string', 'max' => 450],
            [['golruang'], 'string', 'max' => 153],
            [['s_nama_pangkat', 's_nama_jurusan'], 'string', 'max' => 300],
            [['jenis_jab', 's_nama_fakultasbidang'], 'string', 'max' => 150],
            [['jenis_jab_group', 's_nama_instansiunitorg', 'namaunit_lengkap', 's_nama_diklatfung', 'diklat_struk', 'sert_jfa'], 'string', 'max' => 765],
            [['peran'], 'string', 'max' => 9],
            [['s_skt_instansi', 'nama_pasangan'], 'string', 'max' => 465],
            [['s_kd_instansiunitorg'], 'string', 'max' => 42],
            [['s_kd_instansiunitkerjal1', 'key_sort_unit'], 'string', 'max' => 51],
            [['s_nama_strata_skt'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'niplama' => 'Niplama',
            'nipbaru' => 'Nipbaru',
            's_nama_lengkap' => 'S Nama Lengkap',
            'carinama_nip' => 'Carinama Nip',
            's_tempat_lahir' => 'S Tempat Lahir',
            'd_tgl_lahir' => 'D Tgl Lahir',
            'jenis_kelamin' => 'Jenis Kelamin',
            's_nama_agama' => 'S Nama Agama',
            'usia' => 'Usia',
            'tmt_pensiun' => 'Tmt Pensiun',
            'golruang' => 'Golruang',
            's_nama_pangkat' => 'S Nama Pangkat',
            'd_tmt_sk' => 'D Tmt Sk',
            'lamath_kp' => 'Lamath Kp',
            'lamabl_bl' => 'Lamabl Bl',
            'jabatan' => 'Jabatan',
            's_nmjabdetailskt' => 'S Nmjabdetailskt',
            'tmt_jab' => 'Tmt Jab',
            's_kd_jabdetail' => 'S Kd Jabdetail',
            'jenis_jab' => 'Jenis Jab',
            'jenis_jab_group' => 'Jenis Jab Group',
            'lamath_jab' => 'Lamath Jab',
            'lamabl_jab' => 'Lamabl Jab',
            'peran' => 'Peran',
            's_nama_instansiunitorg' => 'S Nama Instansiunitorg',
            's_skt_instansiunitorg' => 'S Skt Instansiunitorg',
            'namaunit_lengkap' => 'Namaunit Lengkap',
            's_skt_instansi' => 'S Skt Instansi',
            'tmt_unit' => 'Tmt Unit',
            's_kd_instansiunitorg' => 'S Kd Instansiunitorg',
            's_kd_instansiunitkerjal1' => 'S Kd Instansiunitkerjal1',
            'lamath_unit' => 'Lamath Unit',
            'lamabl_unit' => 'Lamabl Unit',
            'namaunit' => 'Namaunit',
            'key_sort_unit' => 'Key Sort Unit',
            's_skt_pendidikan' => 'S Skt Pendidikan',
            's_nama_strata_skt' => 'S Nama Strata Skt',
            's_nama_fakultasbidang' => 'S Nama Fakultasbidang',
            's_nama_jurusan' => 'S Nama Jurusan',
            'd_tgl_lulus' => 'D Tgl Lulus',
            'total_pak' => 'Total Pak',
            'd_tgl_awal' => 'D Tgl Awal',
            'd_tgl_akhir' => 'D Tgl Akhir',
            's_no_sk_kgb' => 'S No Sk Kgb',
            'i_maker_th_kgb' => 'I Maker Th Kgb',
            'i_maker_bl_kgb' => 'I Maker Bl Kgb',
            'd_tmt_kgb' => 'D Tmt Kgb',
            's_nama_diklatfung' => 'S Nama Diklatfung',
            's_nosert_diklatfung' => 'S Nosert Diklatfung',
            'd_tglser_diklatfung' => 'D Tglser Diklatfung',
            'diklat_struk' => 'Diklat Struk',
            's_nosert_diklatstruk' => 'S Nosert Diklatstruk',
            'd_tglser_diklatstruk' => 'D Tglser Diklatstruk',
            'sert_jfa' => 'Sert Jfa',
            'nama_pasangan' => 'Nama Pasangan',
            'unit_pasangan' => 'Unit Pasangan',
            's_alamat' => 'S Alamat',
            'sert_profesi' => 'Sert Profesi',
            'kel_jab' => 'Kel Jab',
            'tgl_update' => 'Tgl Update',
            'status' => 'Status',
        ];
    }

    public function getNamaNip(){
        return $this->nipbaru . '  ' . $this->s_nama_lengkap;
    }
}
