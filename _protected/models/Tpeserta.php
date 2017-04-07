<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tpeserta".
 *
 * @property integer $id
 * @property integer $ppm_id
 * @property integer $pegawai_id
 * @property integer $peran_id
 * @property string $keterangan
 *
 * @property RperanPpm $peran
 * @property RefPegawai $pegawai
 */
class Tpeserta extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tpeserta';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ppm_id', 'peran_id'], 'integer'],
            [['keterangan', 'pegawai_id'], 'string', 'max' => 255],
            // [['peran_id'], 'exist', 'skipOnError' => true, 'targetClass' => RperanPpm::className(), 'targetAttribute' => ['peran_id' => 'id']],
            // [['pegawai_id'], 'exist', 'skipOnError' => true, 'targetClass' => RefPegawai::className(), 'targetAttribute' => ['pegawai_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ppm_id' => 'Ppm ID',
            'pegawai_id' => 'Pegawai ID',
            'peran_id' => 'Peran ID',
            'keterangan' => 'Keterangan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPeran()
    {
        return $this->hasOne(RperanPpm::className(), ['id' => 'peran_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPegawai()
    {
        return $this->hasOne(Pegawai::className(), ['niplama' => 'pegawai_id']);
    }

    public function getPpm()
    {
        return $this->hasOne(\app\models\Ppud::className(), ['id' => 'ppm_id']);
    }    
}
