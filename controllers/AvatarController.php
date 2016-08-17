<?php
/**
 * Created by PhpStorm.
 * User: chenl
 * Date: 2016/8/12
 * Time: 14:13
 */

namespace app\controllers;
use Yii;
use yii\imagine\Image;//图片压缩 剪切 水印 文字水印
use yii\web\UploadedFile;// 文件上传类
use yii\web\Controller;

class AvatarController extends Controller
{
    //头像上传独立操作
    public function actions()
    {
        return [
            'crop'=>[
                'class' => 'hyii2\avatar\CropAction',
                'config'=>[
                    'bigImageWidth' => '200',     //大图默认宽度
                    'bigImageHeight' => '200',    //大图默认高度
                    'middleImageWidth'=> '100',   //中图默认宽度
                    'middleImageHeight'=> '100',  //中图图默认高度
                    'smallImageWidth' => '50',    //小图默认宽度
                    'smallImageHeight' => '50',   //小图默认高度
                    'uploadPath' => 'uploads', //头像上传目录（注：目录前不能加"/"）
                ]
            ]
        ];
    }
    /**
     * 头像上传页面
     */
    public function actionIndex(){

        if(Yii::$app->request->isPost){
            //获取上传图片对象
            $file=UploadedFile::getInstanceByName('avatar_file');
            if($file){
                //上传图片名称
                $name=time().mt_rand(1000,9999) .'.'.$file->extension;
                //保存上传图片
                $result=$file->saveAs('E:/software/xampp/htdocs/sim/web/uploads/'.$name);
                if($result){
                    //剪切图片
                    $data=json_decode(Yii::$app->request->post('avatar_data'),true);
                    $result =  Image::crop('@webroot/uploads/'.$name,$data['width'], $data['height'],[$data['x'],$data['y']])->save(Yii::getAlias('@webroot/uploads/thumb-test-crop.jpg'));
                    if($result){
                        //头像保存成功后 状态一定要设置为'state'=>200
                        $data=array('state'=>200,"message"=>"头像上传成功!");
                        return json_encode($data);
                    }
                }
            }
            return $this->render('index',['name'=>$name]);
        }
        return $this->render('index');
    }
}