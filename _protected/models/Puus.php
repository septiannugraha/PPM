<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "puus".
 *
 * @property string $id
 * @property string $name
 *
 * @property Ppud[] $ppuds
 */
class Puus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'puus';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 45],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPpuds()
    {
        return $this->hasMany(Ppud::className(), ['puud' => 'id']);
    }
}
