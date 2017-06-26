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
use yii\web\UploadedFile;// 文件上传�?
use dosamigos\qrcode\QrCode;//引入生成二维码的�?
use app\models\Member;

class IndexController extends Controller
{
    /**
     * 上传图片并压�?
     * @return string
     */

     public function actionIndex(){
         //$this->layout="layout_new";
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
     *生成二维�?
     * @return string
     */

    public function actionQrcode(){
        return QrCode::png('http://www.yii-china.com');//调用二维码生成方�?
    }

    /**
     * 显示二维码页�?
     */
    public function actionCode(){
        return $this->render("code");
    }


    /**
     * 文件上传
     */
    public function actionFile(){
        if(Yii::$app->request->isPost){
            //获取上传图片对象
            $file=UploadedFile::getInstanceByName('pictrue');
            if($file){
                //上传图片名称
                $name=time().mt_rand(1000,9999) .'.'.$file->extension;
                //保存上传图片
                $result=$file->saveAs('E:/software/xampp/htdocs/sim/web/uploads/'.$name);
                if($result){
                    return \yii\helpers\Json::encode([]);
                }
            }
        }
        return $this->render('index');
    }

    /**
     * 忽略验证
     * save()传入false 忽略model类的rules的验证
     */
    public function actionIgnone(){
        $member=Member::find()->where(['member_id'=>1])->one();
        $member->member_qq=44;
        if($member->save(false)){
            echo 88888888888;die;
        }
        print_r($member->getErrors());die;
    }
    /**
     * 改变布局
     */
    public function actionLay(){
           //echo 77777777;die;
            $this->layout="layout_new";
            return $this->render('niu');
    }
}