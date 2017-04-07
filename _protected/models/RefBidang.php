<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ref_bidang".
 *
 * @property integer $id
 * @property string $name
 * @property string $keterangan
 */
class RefBidang extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ref_bidang';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 25],
            [['keterangan'], 'string', 'max' => 50],
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
            'keterangan' => 'Keterangan',
        ];
    }
}
