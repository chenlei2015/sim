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
use yii\imagine\Image;//压缩,剪切,旋转,水印,文字水印
use yii\web\UploadedFile;//图片上传类

class IndexController extends Controller
{
    /**
     * 首页
     * @return string
     */

     public function actionIndex(){
         if(Yii::$app->request->isPost){
             //获取图片上传对象
             $file=UploadedFile::getInstanceByName('pictrue');
             if($file){
                 $name=time().mt_rand(1000,9999) .'.'.$file->extension;
                 //保存上传的图片
                 $result=$file->saveAs('E:/software/xampp/htdocs/simple/web/uploads/'.$name);
                 if($result){
                     Image::thumbnail('@webroot/uploads/'.$name, 120, 120)->save(Yii::getAlias('@webroot/uploads/thumb-test-image.jpg'), ['quality' => 100]);
                 }
             }

         }
         return $this->render('index',['name'=>$name]);
     }

    /**
     * 上传图片
     */
    public function upload(){

    }
}