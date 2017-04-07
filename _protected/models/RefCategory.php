<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ref_category".
 *
 * @property integer $id
 * @property integer $bidang_id
 * @property integer $no_urut
 * @property string $name
 */
class RefCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ref_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bidang_id', 'no_urut'], 'integer'],
            [['name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'bidang_id' => 'Bidang ID',
            'no_urut' => 'No Urut',
            'name' => 'Name',
        ];
    }
}
