<?php

namespace app\modules\laporan\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\data\ActiveDataProvider;
use yii\data\SqlDataProvider;

class PelaporanunitController extends Controller
{

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    // 'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all TaValidasiPembayaran models.
     * @return mixed
     */
    public function actionIndex()
    {
        $Tahun = date('Y');
        $get = new \app\models\Laporan();
        $Kd_Laporan = NULL;
        $data = NULL;
        $data1 = NULL;
        $data2 = NULL;
        $data3 = NULL;
        $data4 = NULL;
        $data5 = NULL;
        $data6 = NULL;
        $render = NULL;
        $getparam = NULL;
        IF(Yii::$app->request->queryParams){
            $getparam = Yii::$app->request->queryParams;
            IF($getparam['Laporan']['Kd_Laporan']){
                $Kd_Laporan = Yii::$app->request->queryParams['Laporan']['Kd_Laporan'];
                switch ($Kd_Laporan) {
                    case 1:
                        $query = \app\models\Tpeserta::find();

                        $data = new ActiveDataProvider([
                            'query' => $query,
                        ]);
                        IF($getparam['Laporan']['kode_pegawai']){
                            $data->query->andWhere(['pegawai_id' => $getparam['Laporan']['kode_pegawai']]);
                        }
                        IF($getparam['Laporan']['Tgl_1']){
                            $ppm = \app\models\Ppud::find()->andWhere('tetap_tanggal >= "'.$getparam['Laporan']['Tgl_1'].'" AND tetap_tanggal <= "'.$getparam['Laporan']['Tgl_2'].'"')->all();
                            // $listPpm = [];
                            // var_dump($ppm);
                            foreach($ppm as $ppm){
                                $listPpm[] = $ppm->id;
                                $inPpm = '('.implode(',', $listPpm).')';
                            }
                            if(isset($listPpm) && $listPpm != NULL){
                                $data->query->andWhere("ppm_id IN $inPpm");
                            }
                        }
                        $render = 'laporan1';
                        break;
                      case 2:
                        $query = \app\models\Ppud::find();

                        $data = new ActiveDataProvider([
                            'query' => $query,
                        ]);
                        if(Yii::$app->user->identity->kode_unit != NULL){
                            $data->query->andWhere(['kode_unit' =>Yii::$app->user->identity->kode_unit]);
                        }
                        IF($getparam['Laporan']['Tgl_1']){
                            $data->query->andWhere('tetap_tanggal >= "'.$getparam['Laporan']['Tgl_1'].'" AND tetap_tanggal <= "'.$getparam['Laporan']['Tgl_2'].'"');
                        }
                        $render = 'laporan2';
                        break;
  
                    default:
                        # code...
                        break;
                }
            }

        }

        return $this->render('index', [
            'get' => $get,
            'Kd_Laporan' => $Kd_Laporan,
            'data' => $data,
            'data1' => $data1,
            'data2' => $data2,
            'data3' => $data3,
            'data4' => $data4,
            'data5' => $data5,
            'data6' => $data6,
            'render' => $render,
            'getparam' => $getparam,
            'Tahun' => $Tahun,
        ]);
    }


//dari index kita cetak. Code below
//---------------------------------------------------------------------------------------------------------------------------------------------------
    public function actionCetak()
    {
        $get = new \app\models\Laporan();
        $Kd_Laporan = NULL;
        $data = NULL;
        $data1 = NULL;
        $data2 = NULL;
        $data3 = NULL;
        $data4 = NULL;
        $data5 = NULL;
        $data6 = NULL;
        $render = NULL;
        $getparam = NULL;
        IF(Yii::$app->request->queryParams){
            $getparam = Yii::$app->request->queryParams;
            IF($getparam['Laporan']['Kd_Laporan']){
                $Kd_Laporan = Yii::$app->request->queryParams['Laporan']['Kd_Laporan'];
                switch ($Kd_Laporan) {
                    case 1:
                        $data1 = \app\models\Pegawai::findOne(['niplama' => $getparam['Laporan']['kode_pegawai']]);
                        if(isset(Yii::$app->user->identity->kode_unit)) $data2 = \app\models\RefUnitOrganisasi::findOne(['kode_unit' => Yii::$app->user->identity->kode_unit]);
                        $query = \app\models\Tpeserta::find();
                        IF($getparam['Laporan']['kode_pegawai']){
                            $query->andWhere(['pegawai_id' => $getparam['Laporan']['kode_pegawai']]);
                        }
                        IF($getparam['Laporan']['Tgl_1']){
                            $ppm = \app\models\Ppud::find()->andWhere('tetap_tanggal >= "'.$getparam['Laporan']['Tgl_1'].'" AND tetap_tanggal <= "'.$getparam['Laporan']['Tgl_2'].'"')->all();
                            // $listPpm = [];
                            // var_dump($ppm);
                            foreach($ppm as $ppm){
                                $listPpm[] = $ppm->id;
                                $inPpm = '('.implode(',', $listPpm).')';
                            }
                            IF(isset($listPpm) && $listPpm != NULL){
                                $query->andWhere("ppm_id IN $inPpm");
                            }
                        }
                        $data = $query->all();
                        $render = 'cetaklaporan1';
                        break;
                      case 2:
                        $query = \app\models\Ppud::find();
                        IF($getparam['Laporan']['Tgl_1']){
                            $query->andWhere('tetap_tanggal >= "'.$getparam['Laporan']['Tgl_1'].'" AND tetap_tanggal <= "'.$getparam['Laporan']['Tgl_2'].'"');
                        }
                        $data = $query->all();
                        $render = 'cetaklaporan2';
                        break;                    
                    default:
                        # code...
                        break;
                }
            }

        }
        return $this->render($render, [
            'get' => $get,
            'Kd_Laporan' => $Kd_Laporan,
            'data' => $data,
            'data1' => $data1,
            'data2' => $data2,
            'data3' => $data3,
            'data4' => $data4,
            'data5' => $data5,
            'data6' => $data6,
            'render' => $render,
            'getparam' => $getparam,
        ]);
    }  
}
