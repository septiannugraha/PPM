<?php

namespace app\modules\transaksi\controllers;

use Yii;
use app\models\Ppud;
use app\modules\transaksi\models\PpudSearch;
use app\models\Tpeserta;
use app\modules\transaksi\models\TpesertaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use yii\web\UploadedFile;

/**
 * PpmController implements the CRUD actions for Ppud model.
 */
class PpmController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'bulk-delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Ppud models.
     * @return mixed
     */
    public function actionIndex()
    {    
        if(!$this->cekAkses()){          
            throw new NotFoundHttpException('You don\'t have access.');
        }
        $searchModel = new PpudSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        // $dataProvider->query->andWhere(['puud' => Yii::$app->params['id_ppm']]);
        if(Yii::$app->user->identity->id && $user_id = Yii::$app->user->identity->id){
            $dataProvider->query->andWhere(['user_id' => $user_id ]);
        }
        $dataProvider->query->orderBy('id DESC');

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionPeserta($id)
    {   
        if(!$this->cekAkses()){          
            throw new NotFoundHttpException('You don\'t have access.');
        }
        $model = $this->findModel($id);
        $searchModel = new TpesertaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['ppm_id' => $id]);
        $dataProvider->query->orderBy('peran_id ASC, id DESC');

        if ($model && $model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('kv-detail-success', 'Perubahan disimpan');
            return $this->redirect(['index']);
        } else {
            return $this->render('peserta', [
                'model' => $model,
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
    }

    public function actionView($id)
    {   
        if(!$this->cekAkses()){          
            throw new NotFoundHttpException('You don\'t have access.');
        }
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "Ppud #".$id,
                    'content'=>$this->renderAjax('view', [
                        'model' => $this->findModel($id),
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
        }else{
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }
    }

    /**
     * Creates a new Ppud model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(!$this->cekAkses()){          
            throw new NotFoundHttpException('You don\'t have access.');
        }
        $request = Yii::$app->request;
        $model = new Ppud();  
        // $model->puud = Yii::$app->params['id_ppm'];
        $model->tahun = date('Y');
        $model->user_id = Yii::$app->user->identity->id;
        $model->kode_unit = Yii::$app->user->identity->kode_unit;

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Create new Ppud",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else if($model->load($request->post())){
                $upload = UploadedFile::getInstance($model, 'upload');
                IF($upload){
                    // $ext = explode(".", $upload->name);
                    // $ext = end($ext);
                    $model->files = $upload->name;
                    $path = Yii::getAlias('@upload') . '/' . $model->puud.'/'.$model->files;
                }                
                if($model->save()){
                    IF($upload) $upload->saveAs($path);
                    return [
                        'forceReload'=>'#crud-datatable-pjax',
                        'title'=> "Create new Ppud",
                        'content'=>'<span class="text-success">Create Ppud success</span>',
                        'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::a('Create More',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
            
                    ];
                }   
            }else{           
                return [
                    'title'=> "Create new Ppud",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }
        }else{
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post())) {
                $upload = UploadedFile::getInstance($model, 'upload');
                IF($upload){
                    // $ext = explode(".", $upload->name);
                    // $ext = end($ext);
                    $model->files = $upload->name;
                    $path = Yii::getAlias('@upload') . '/' . $model->puud.'/'.$model->files;
                }                  
                if($model->save()){
                    IF($upload) $upload->saveAs($path);
                }
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }
       
    }

    /**
     * Updates an existing Ppud model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if(!$this->cekAkses()){          
            throw new NotFoundHttpException('You don\'t have access.');
        }
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        $model->user_id = Yii::$app->user->identity->id;

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Update Ppud #".$id,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post())){
                IF($model->files) $oldFile = Yii::getAlias('@upload') . '/' . $model->puud.'/'.$model->files;
                $upload = UploadedFile::getInstance($model, 'upload');
                IF($upload){
                    // $ext = explode(".", $upload->name);
                    // $ext = end($ext);
                    $model->files = $upload->name;
                    $path = Yii::getAlias('@upload') . '/' . $model->puud.'/'.$model->files;
                    IF($oldFile) {
                        if($path != $oldFile) unlink($oldFile);
                    }
                }  
                IF($model->save()){
                    IF($upload) $upload->saveAs($path);
                    return [
                        'forceReload'=>'#crud-datatable-pjax',
                        'title'=> "Ppud #".$id,
                        'content'=>$this->renderAjax('view', [
                            'model' => $model,
                        ]),
                        'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::a('Edit',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                    ];
                }
            }else{
                 return [
                    'title'=> "Update Ppud #".$id,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                ];        
            }
        }else{
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post())) {
                IF($model->files) $oldFile = Yii::getAlias('@upload') . '/' . $model->puud.'/'.$model->files;
                $upload = UploadedFile::getInstance($model, 'upload');
                IF($upload){
                    // $ext = explode(".", $upload->name);
                    // $ext = end($ext);
                    $model->files = $upload->name;
                    $path = Yii::getAlias('@upload') . '/' . $model->puud.'/'.$model->files;
                    IF($oldFile) {
                        if($path != $oldFile) unlink($oldFile);
                    }
                }  
                if($model->save()){
                    IF($upload) $upload->saveAs($path);
                }
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * Delete an existing Ppud model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if(!$this->cekAkses()){          
            throw new NotFoundHttpException('You don\'t have access.');
        }
        $request = Yii::$app->request;
        $model = $this->findModel($id); 
        $path = Yii::getAlias('@upload') . '/' . $model->puud.'/'.$model->files;
        $model->delete();
        IF(!@unlink($path)){
            die('Couldn\'t delete file. It didnt exist!');
        }

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }


    }

     /**
     * Delete multiple existing Ppud model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionBulkDelete()
    {    
        if(!$this->cekAkses()){          
            throw new NotFoundHttpException('You don\'t have access.');
        }    
        $request = Yii::$app->request;
        $pks = explode(',', $request->post( 'pks' )); // Array or selected records primary keys
        foreach ( $pks as $pk ) {
            $model = $this->findModel($pk);
            $model->delete();
            $path = Yii::getAlias('@upload') . '/' . $model->puud.'/'.$model->files;
            unlink($path);
        }

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }
       
    }

    /**
     * Finds the Ppud model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Ppud the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Ppud::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    // cek akses user
    protected function cekAkses(){
        if(!Yii::$app->user->isGuest && Yii::$app->user->identity->group_id <= 4){
            return true;
        }ELSE{
            return false;
        }
    }    
}
