<?php
namespace app\controllers;
use Yii;
use yii\web\Controller;

class TicketController extends Controller
{
       public  function actionIndex(){
           $src = 'http://kaijiang.500.com/static/public/ssc/xml/qihaoxml/20170626.xml?_A=ZLYTUPDA'.time().mt_rand(100,999);
           $xml=file_get_contents($src);
           $xml = simplexml_load_string($xml);
           $data=[];
           for ($i = 0; $i < count($xml->row); $i++) {
               $p = $xml ->row[$i]->attributes()->expect;
               $data[$i]['no']=substr($p,0,8).'-'.substr($p,-3,3);//开奖期号
               $code=(array)$xml ->row[$i]->attributes()->opencode;//开奖号码
               $data[$i]['code']=$code[0];
               $time= (array)$xml ->row[$i]->attributes()->opentime;//开奖时间
               $data[$i]['time']=strtotime($time[0]);
           }

       }
}