<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tfiles".
 *
 * @property string $id
 * @property integer $bidang_id
 * @property integer $category_id
 * @property integer $user_dest
 * @property string $no
 * @property string $tahun
 * @property string $tentang
 * @property string $tag
 * @property string $files
 * @property integer $user_id
 * @property integer $created_at
 * @property integer $updated_at
 */
class Tfiles extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tfiles';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bidang_id', 'category_id', 'user_dest', 'user_id', 'created_at', 'updated_at'], 'integer'],
            [['tahun'], 'number'],
            [['no'], 'string', 'max' => 100],
            [['tentang', 'tag', 'files'], 'string', 'max' => 500],
            [['category_id', 'tahun', 'no'], 'unique', 'targetAttribute' => ['category_id', 'tahun', 'no'], 'message' => 'The combination of Category ID, No and Tahun has already been taken.'],
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
            'category_id' => 'Category ID',
            'user_dest' => 'User Dest',
            'no' => 'No',
            'tahun' => 'Tahun',
            'tentang' => 'Tentang',
            'tag' => 'Tag',
            'files' => 'Files',
            'user_id' => 'User ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
