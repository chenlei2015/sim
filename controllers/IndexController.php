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
use yii\imagine\Image;//图片压缩 剪切 水印 文字水印
use yii\web\UploadedFile;// 文件上传类
use dosamigos\qrcode\QrCode;//引入生成二维码的类

class IndexController extends Controller
{
    /**
     * 上传图片并压缩
     * @return string
     */

     public function actionIndex(){
         if(Yii::$app->request->isPost){
             //获取上传图片对象
             $file=UploadedFile::getInstanceByName('pictrue');
             if($file){
                 //上传图片名称
                 $name=time().mt_rand(1000,9999) .'.'.$file->extension;
                 //保存上传图片
                 $result=$file->saveAs('E:/software/xampp/htdocs/sim/web/uploads/'.$name);
                 if($result){
                     //压缩图片
                     Image::thumbnail('@webroot/uploads/'.$name, 120, 120)->save(Yii::getAlias('@webroot/uploads/thumb-test-image.jpg'), ['quality' => 100]);
                 }
             }
             return $this->render('index',['name'=>$name]);
         }
         return $this->render('index');
     }

    /**
     *生成二维码
     * @return string
     */

    public function actionQrcode(){
        return QrCode::png('http://www.yii-china.com');//调用二维码生成方法
    }

    /**
     * 显示二维码页面
     */
    public function actionCode(){
        return $this->render("code");
    }
}