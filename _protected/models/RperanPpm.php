<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rperan_ppm".
 *
 * @property integer $id
 * @property string $name
 * @property string $bobot_kredit
 *
 * @property Tpeserta[] $tpesertas
 */
class RperanPpm extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rperan_ppm';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['bobot_kredit'], 'number'],
            [['name'], 'string', 'max' => 255],
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
            'bobot_kredit' => 'Bobot Kredit',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTpesertas()
    {
        return $this->hasMany(Tpeserta::className(), ['peran_id' => 'id']);
    }
}
