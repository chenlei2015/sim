<?php
/**
 * Created by PhpStorm.
 * User: chenl
 * Date: 2017/8/16
 * Time: 12:16
 */

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\ticket\Buy;
class WinController  extends Controller
{

    public $layout="layout_new";
    public function actionIndex(){
        $data=Buy::find()->all();
        return $this->render('index',['data'=>$data]);
    }

    public function actionSave()
    {
         $params=Yii::$app->request->post();
         $model= new Buy();
         if($model->load('',$params) && $model->save()){
              echo json_encode(['status'=>1,'message'=>'成功']);
         }else{
             echo json_encode(['status'=>0,'message'=>'失败']);
         }
    }
}