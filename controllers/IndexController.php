<?php
/**
 * Created by PhpStorm.
 * User: chenl
 * Date: 2016/8/10
 * Time: 15:36
 */

namespace app\controllers;
use Yii;
use yii\web\Controller;
use yii\imagine\Image;//ѹ��,����,��ת,ˮӡ,����ˮӡ
use yii\web\UploadedFile;//ͼƬ�ϴ���

class IndexController extends Controller
{
    /**
     * ��ҳ
     * @return string
     */

     public function actionIndex(){
         if(Yii::$app->request->isPost){
             //��ȡͼƬ�ϴ�����
             $file=UploadedFile::getInstanceByName('pictrue');
             if($file){
                 $name=time().mt_rand(1000,9999) .'.'.$file->extension;
                 //�����ϴ���ͼƬ
                 $result=$file->saveAs('E:/software/xampp/htdocs/simple/web/uploads/'.$name);
                 if($result){
                     Image::thumbnail('@webroot/uploads/'.$name, 120, 120)->save(Yii::getAlias('@webroot/uploads/thumb-test-image.jpg'), ['quality' => 100]);
                 }
             }

         }
         return $this->render('index',['name'=>$name]);
     }

    /**
     * �ϴ�ͼƬ
     */
    public function upload(){

    }
}