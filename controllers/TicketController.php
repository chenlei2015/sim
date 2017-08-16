<?php
namespace app\controllers;
use Yii;
use yii\web\Controller;
use app\models\ticket\Code;

class TicketController extends Controller
{
       public  function actionIndex(){
               $src = 'http://kaijiang.500.com/static/public/ssc/xml/qihaoxml/20170727.xml?_A=ZLYTUPDA'.time().mt_rand(100,999);
               $xml=file_get_contents($src);
               $xml = simplexml_load_string($xml);
               $data=[];
               for ($i = (count($xml->row)-1); $i>=0; $i--) {
                   $code = new code();
                   $p = $xml->row[$i]->attributes()->expect;
                   $code->no = substr($p, 0, 8) . '-' . substr($p, -3, 3);
                   $code_str = (array)$xml->row[$i]->attributes()->opencode;
                   $codes = explode(',', $code_str[0]);
                   $code->wan = intval($codes[0]);
                   $code->wan_type=in_array(intval($codes[0]),[3,4,5,6,7])?1:0;
                   $code->qian = intval($codes[1]);
                   $code->qian_type=in_array(intval($codes[1]),[3,4,5,6,7])?1:0;
                   $code->bai = intval($codes[2]);
                   $code->bai_type=in_array(intval($codes[2]),[3,4,5,6,7])?1:0;
                   $code->shi = intval($codes[3]);
                   $code->shi_type=in_array(intval($codes[3]),[3,4,5,6,7])?1:0;
                   $code->ge = intval($codes[4]);
                   $code->ge_type=in_array(intval($codes[4]),[3,4,5,6,7])?1:0;
                   $time = (array)$xml->row[$i]->attributes()->opentime;
                   $add_time = $data[$i]['time'] = strtotime($time[0]);
                   $code->time = $add_time;
                   $code->save();
               }

       }

        public function actionShower(){
            $subject=[0,2,6,7,9];$field="wan";
            $codes = Code::find()->select($field)->limit(10500)->asArray()->all();
            $count=0;
            $arr=[];
            foreach($codes as $key=>$code){
                if(in_array($code[$field],$subject)){
                      $count++;
                }else{
                    if($count>0){
                        array_push($arr,$count);
                        $count=0;
                    }
                }
            }
            $statistics=array_count_values ($arr);
            ksort($statistics);
            print_r($statistics);die;
        }


    /**
     * 单个订单信息的调出
     */
    public  function actionOrderRemark(){
        $params=Yii::$app->request->get();
        $marks=OrderRemark::find()->where(['order_id'=>$params['order_id']])->orderBy('remark_time desc')->asArray()->all();
        foreach ($marks as &$mark){
            $mark['remark_status']=OrderRemark::getRemarkStatus($mark['remark_status']);
            $mark['remark_time']=date('Y-m-d H:i:s',$mark['remark_time']);
        }
        return $this->returnJsonSuccess('success',$marks);
    }

    /**
     *
     */
    public function actionSpace(){
        $field="ge";
        //$codes = Code::find()->select(['wan','qian','bai','shi','ge'])->limit(120)->orderBy('id desc')->asArray()->all();
        //$codes=array_reverse($codes);

        $codes = Code::find()->select(['wan','qian','bai','shi','ge'])->limit(10500)->orderBy('id desc')->asArray()->all();
        $count=0;
        $arr=[];
        $subject=[];
        foreach($codes as $key=>$code){
            if($key!=0){
                if(!in_array($code[$field],$subject)){
                    $count++;
                }else{
                    if($count>0){
                        array_push($arr,$count);
                        $count=0;
                    }
                }
            }

            $subject=array_unique(array_values($code));
        }
        $statistics=array_count_values ($arr);
        ksort($statistics);
        print_r($statistics);
        die;
    }

    public function actionFollow(){
        $field="wan";
        $codes = Code::find()->select(['wan','qian','bai','shi','ge'])->limit(10500)->orderBy('id desc')->asArray()->all();
        $codes=array_reverse($codes);
        //print_r($codes);die;
        //$codes = Code::find()->select(['wan','qian','bai','shi','ge'])->limit(10500)->orderBy('id desc')->asArray()->all();
        $count=0;
        $arr=[];
        $subject=[];
        $quota=[1,3,4,5,8];
        $opposite=[0,2,6,7,9];
        foreach($codes as $key=>$code){
            if($key!=0){
                if(!in_array($code[$field],$subject)){
                    $count++;
                }else{
                    //if($count>0){
                        array_push($arr,$count);
                        $count=0;
                    //}
                }
            }

            if(in_array($code[$field],$quota)){
                $subject =$quota;
            }elseif(in_array($code[$field],$opposite)){
                $subject = $opposite;
            }
        }
        $statistics=array_count_values ($arr);
        ksort($statistics);
        print_r($statistics);
        die;
    }

    public function actionShowery(){
        // $subjectx=[0,2,6,7,9];  $subjecty=[1,3,4,5,8];$field="wan";
        $subjectx=[0,2,4,6,8];  $subjecty=[1,3,5,7,9];$field="bai";
        $codes = Code::find()->select($field)->limit(10500)->asArray()->all();
        $countx=0;
        $county=0;
        $arr_x=[];
        $arr_y=[];
        foreach($codes as $key=>$code){
            if(in_array($code[$field],$subjectx)){
                $countx++;
                if($county>0){
                    array_push($arr_y,$county);
                    $county=0;
                }
            }elseif(in_array($code[$field],$subjecty)){
                $county++;
                if($countx>0){
                    array_push($arr_x,$countx);
                    $countx=0;
                }
            }
        }
        $min=min(count($arr_x),count($arr_x));
        for($i=0;$i<$min;$i++){
            echo $arr_x[$i].'-'.$arr_y[$i].'<br>';
        }
    }


    public function actionShowerx(){
        //$subjectx=[0,2,6,7,9];  $subjecty=[1,3,4,5,8];$field="shi";
        $subjectx=[0,2,4,6,8];  $subjecty=[1,3,5,7,9];$field="qian";
        $codes = Code::find()->select($field)->limit(10500)->asArray()->all();
        $countx=0;
        $county=0;
        $arr_x=[];
        foreach($codes as $key=>$code){
            if(in_array($code[$field],$subjectx)){
                $countx++;
                if($county>0){
                    array_push($arr_x,$county);
                    $county=0;
                }
            }elseif(in_array($code[$field],$subjecty)){
                $county++;
                if($countx>0){
                    array_push($arr_x,$countx);
                    $countx=0;
                }
            }
        }
        echo  implode('',$arr_x);die;
    }


}