<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ref_sub_bidang".
 *
 * @property integer $id
 * @property integer $bidang_id
 * @property string $name
 */
class RefSubBidang extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ref_sub_bidang';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bidang_id'], 'integer'],
            [['name'], 'string', 'max' => 20],
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
            'name' => 'Name',
        ];
    }
}
