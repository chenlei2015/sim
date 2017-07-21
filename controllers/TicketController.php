<?php
namespace app\controllers;
use Yii;
use yii\web\Controller;
use app\models\ticket\Code;

class TicketController extends Controller
{
       public  function actionIndex(){
           $src = 'http://kaijiang.500.com/static/public/ssc/xml/qihaoxml/20170710.xml?_A=ZLYTUPDA'.time().mt_rand(100,999);
           $xml=file_get_contents($src);
           $xml = simplexml_load_string($xml);
           $data=[];
           for ($i = 0; $i < count($xml->row); $i++) {
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
            $subject=[0,2,6,7,9];$field="ge";
            $codes = Code::find()->select($field)->limit(1000)->orderBy('id desc')->asArray()->all();
            $count=0;
            foreach($codes as $key=>$code){
                if(in_array($code[$field],$subject)){
                      $count++;
                }else{
                    if($count>0){
                        echo $count."<br>";
                        $count=0;
                    }
    //              $model=new Count();
    //              $model->wan=$count;
    //              if($model->save()){
    //                  unset($model);
    //              }
                }
            }
        }


























       public function actionShow(){
               $data=Yii::$app->request->get();
               $query=Code::find();
               if(!empty($data['begin'])){
                  $query->andWhere(['between','time',$data['begin'],$data['end']]);
               }else{
                   $query->andWhere(['between','time',strtotime(date('Y-m-d',time())),time()]);
               }
               if(!empty($data['num'])){
                   $query->limit($data['num']);
               }
               $condition=$query;
               $query=clone $condition;
               $codes=$query->asArray()->all();
               unset($query);
               $query=clone $condition;
               $nei[] =$query->andWehere(['wan_type'=>1])->count();
               unset($query);
               $query=clone $condition;
               $nei[] =$query->andWehere(['qian_type'=>1])->count();
               unset($query);
               $query=clone $condition;
               $nei[] =$query->andWehere(['bai_type'=>1])->count();
               unset($query);
               $query=clone $condition;
               $nei[] =$query->andWehere(['shi_type'=>1])->count();
               unset($query);
               $query=clone $condition;
               $nei[] =$query->andWehere(['ge_type'=>1])->count();
               unset($query);

               $query=clone $condition;
               $wai[] =$query->andWehere(['wan_type'=>0])->count();
               unset($query);
               $query=clone $condition;
               $wai[] =$query->andWehere(['qian_type'=>0])->count();
               unset($query);
               $query=clone $condition;
               $wai[] =$query->andWehere(['bai_type'=>0])->count();
               unset($query);
               $query=clone $condition;
               $wai[] =$query->andWehere(['shi_type'=>0])->count();
               unset($query);
               $query=clone $condition;
               $wai[] =$query->andWehere(['ge_type'=>0])->count();
               unset($query);

               $wan_count_nei=0;
               $wan_count_wai=0;
               $wan_count_nei_arr=[];
               $wan_count_wai_arr=[];
               foreach ($codes as $code ){
                     if($code['wan_type']){
                         array_push($wan_count_wai_arr,$wan_count_wai);
                         $wan_count_nei++;
                         $wan_count_wai=0;
                     }else{
                         array_push($wan_count_nei_arr,$wan_count_nei);
                         $wan_count_wai++;
                         $wan_count_nei=0;
                     }
               }
               $wan_value_nei_count=array_count_values ($wan_count_nei_arr);
               $wan_value_wai_count=array_count_values ($wan_count_wai_arr);
               $wan_nei_count=[
                   $wan_value_nei_count[1]?:0,$wan_value_nei_count[2]?:0,$wan_value_nei_count[3]?:0,$wan_value_nei_count[4]?:0,
                   $wan_value_nei_count[5]?:0,$wan_value_nei_count[6]?:0,$wan_value_nei_count[7]?:0,$wan_value_nei_count[8]?:0,
                   $wan_value_nei_count[9]?:0,$wan_value_nei_count[10]?:0,$wan_value_nei_count[11]?:0,$wan_value_nei_count[12]?:0,
                   $wan_value_nei_count[13]?:0,$wan_value_nei_count[14]?:0,$wan_value_nei_count[15]?:0,$wan_value_nei_count[16]?:0,
               ];
              $wan_wai_count=[
                   $wan_value_wai_count[1]?:0,$wan_value_wai_count[2]?:0,$wan_value_wai_count[3]?:0,$wan_value_wai_count[4]?:0,
                   $wan_value_wai_count[5]?:0,$wan_value_wai_count[6]?:0,$wan_value_wai_count[7]?:0,$wan_value_wai_count[8]?:0,
                   $wan_value_wai_count[9]?:0,$wan_value_wai_count[10]?:0,$wan_value_wai_count[11]?:0,$wan_value_wai_count[12]?:0,
                   $wan_value_wai_count[13]?:0,$wan_value_wai_count[14]?:0,$wan_value_wai_count[15]?:0,$wan_value_wai_count[16]?:0,
               ];
               return $this->render('show',[
                   'nei'=>$nei,
                   'wai'=>$wai,
                   'codes'=>$codes,
                   'wan_nei_count'=>$wan_nei_count,
                   'wan_wai_count'=>$wan_wai_count,
               ]);
       }
}