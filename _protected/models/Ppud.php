<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "ppud".
 *
 * @property string $id
 * @property string $puud
 * @property integer $puuddetail
 * @property string $no
 * @property string $tahun
 * @property string $tentang
 * @property string $tag
 * @property string $files
 * @property string $tetap_province
 * @property string $tetap_kabkot
 * @property string $tetap_tanggal
 * @property string $user_id
 * @property string $created
 * @property string $updated
 *
 * @property Puus $puud0
 */
class Ppud extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ppud';
    }

    public $upload;

    public function rules()
    {
        return [
            [['puud', 'no', 'tahun', 'tentang'], 'required'],
            [['puud', 'puuddetail', 'tetap_province', 'user_id'], 'integer'],
            [['tahun'], 'number'],
            [['tetap_tanggal', 'created', 'updated'], 'safe'],
            [['no'], 'string', 'max' => 100],
            [['tentang', 'kode_unit','tag', 'files'], 'string', 'max' => 500],
            [['tetap_kabkot'], 'string', 'max' => 20],
            [['puud', 'tahun', 'no'], 'unique', 'targetAttribute' => ['puud', 'tahun', 'no'], 'message' => 'The combination of Puud, No and Tahun has already been taken.'],
            [['puud'], 'exist', 'skipOnError' => true, 'targetClass' => Puus::className(), 'targetAttribute' => ['puud' => 'id']],
            [['upload'], 'safe'],
            [['upload'], 'file', 'extensions'=>'jpg, gif, png, pdf, ppt, pptx, doc, docx, xls, xlsx, avi, mp4', 'maxFiles' => 1, 'maxSize' => 5000000],
            [['upload'], 'unique', 'targetAttribute' => 'files'
                // , 'message' => 'File with this name already exist. Change filename or choose another file!'
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'puud' => 'Kategori Peraturan',
            'puuddetail' => 'Detail Kategori',
            'no' => 'No PPM/Peraturan',
            'tahun' => 'Tahun',
            'tentang' => 'Tentang',
            'tag' => 'Tag',
            'files' => 'Files',
            'upload' => 'Files',
            'tetap_province' => 'Ditetapkan di Provinsi',
            'tetap_kabkot' => 'Kab/Kota',
            'tetap_tanggal' => 'Tanggal',
            'user_id' => 'User ID',
            'created' => 'Created',
            'updated' => 'Updated',
            'kode_unit' => 'Unit',
        ];
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'createdAtAttribute' => 'created',
                'updatedAtAttribute' => 'updated',
                'value' => new \yii\db\Expression('NOW()'),
            ],
        ];
    }    

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPuud0()
    {
        return $this->hasOne(Puus::className(), ['id' => 'puud']);
    }


    public function getUnit()
    {
        return $this->hasOne(\app\models\RefUnitOrganisasi::className(), ['kode_unit' => 'kode_unit']);
    }      
}
