<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ref_unit_organisasi".
 *
 * @property string $kode_unit
 * @property string $nama_unit
 */
class RefUnitOrganisasi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ref_unit_organisasi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kode_unit'], 'required'],
            [['kode_unit'], 'string', 'max' => 51],
            [['nama_unit'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'kode_unit' => 'Kode Unit',
            'nama_unit' => 'Nama Unit',
        ];
    }
}
