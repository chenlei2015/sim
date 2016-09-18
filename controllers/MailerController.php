<?php
/**
 * Created by PhpStorm.
 * User: chenl
 * Date: 2016/8/18
 * Time: 19:34
 */

namespace app\controllers;
use Yii;
use yii\web\Controller;
use yii\swiftmailer\Mailer;

class MailerController extends Controller{

       public function actionIndex(){
           $mail= Yii::$app->mailer->compose();
           $mail->setTo('958711974@qq.com'); //要发送给那个人的邮箱
           $mail->setSubject("邮件主题"); //邮件主题
           $mail->setHtmlBody("测试html text"); //发送的消息内容
           if($mail->send()){
               echo "发送邮件成功！";
           }
       }

       public function actionSendAll(){

       }

}