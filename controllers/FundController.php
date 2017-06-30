<?php
namespace app\controllers;
use yii\web\Controller;
use app\models\fund\Fund;
class FundController extends Controller
{
    public function actionIndex(){
           return $this->render('index');
    }

    public function actionFund(){
        $this->layout=false;
        $oneWeekCode=Fund::find()->select(['one_week'])->asArray()->indexBy('one_week')->all();
        $oneMonthCode=Fund::find()->select(['one_month'])->asArray()->indexBy('one_month')->all();
        $threeMonthCode=Fund::find()->select(['three_month'])->asArray()->indexBy('three_month')->all();
        $sixMonthCode=Fund::find()->select(['six_month'])->asArray()->indexBy('six_month')->all();
        $oneYearCode=Fund::find()->select(['one_year'])->asArray()->indexBy('one_year')->all();
        $towYearCode=Fund::find()->select(['two_year'])->asArray()->indexBy('two_year')->all();
        $threeYearCode=Fund::find()->select(['three_year'])->asArray()->indexBy('three_year')->all();
        //三个月以内
        $threeMonth_in = array_intersect(array_keys($oneWeekCode), array_keys($oneMonthCode), array_keys($threeMonthCode));
        //六个月以上
        $sixMonth_up = array_intersect(array_keys($sixMonthCode), array_keys($oneYearCode), array_keys($towYearCode),array_keys($threeYearCode));
        return $this->render('fund',[
            'threeMonth_in'=>$threeMonth_in,
            'sixMonth_up'=>$sixMonth_up
        ]);
    }

    public function actionOneWeek(){
        $date_arr=explode(' ',date('Y-m-d H:i:s',time()));
        $date=$date_arr[0];
        $url="http://fund.eastmoney.com/data/rankhandler.aspx?op=ph&dt=kf&ft=gp&rs=&gs=0&sc=zzf&st=desc&sd=".$date."&ed=".$date."&qdii=&tabSubtype=,,,,,&pi=1&pn=50&dx=1&v=0.09171128598973155";
        $data=file_get_contents($url);
        $str=$this->getNeedBetween($data,'[',']');
        $str=substr($str,1,(strlen($str)-2));
        $funds=explode('","',$str);
        foreach ($funds as $fund){
            $fundModel= new Fund();
            $fund_arr=explode(',',$fund);
            $fundModel->one_week=$fund_arr[0];
            $fundModel->save(false);
        }
        echo json_encode(['state'=>1,'message'=>'ok']);die;
    }

    public function actionOneMonth(){
        $model=Fund::find()->all();
        $date_arr=explode(' ',date('Y-m-d H:i:s',time()));
        $date=$date_arr[0];
        $url="http://fund.eastmoney.com/data/rankhandler.aspx?op=ph&dt=kf&ft=gp&rs=&gs=0&sc=1yzf&st=desc&sd=".$date."&ed=".$date."&qdii=&tabSubtype=,,,,,&pi=1&pn=50&dx=1&v=0.6298212257679552";
        $data=file_get_contents($url);
        $str=$this->getNeedBetween($data,'[',']');
        $str=substr($str,1,(strlen($str)-2));
        $funds=explode('","',$str);
        foreach ($funds as $k=>$fund){
            $fund_arr=explode(',',$fund);
            $model[$k]->one_month=$fund_arr[0];
            $model[$k]->save(false);
        }
        echo json_encode(['state'=>1,'message'=>'ok']);die;

    }
    public function actionThreeMonth(){
        $model=Fund::find()->all();
        $date_arr=explode(' ',date('Y-m-d H:i:s',time()));
        $date=$date_arr[0];
        $url="http://fund.eastmoney.com/data/rankhandler.aspx?op=ph&dt=kf&ft=gp&rs=&gs=0&sc=3yzf&st=desc&sd=".$date."&ed=".$date."&qdii=&tabSubtype=,,,,,&pi=1&pn=50&dx=1&v=0.29813583265058696";
        $data=file_get_contents($url);
        $str=$this->getNeedBetween($data,'[',']');
        $str=substr($str,1,(strlen($str)-2));
        $funds=explode('","',$str);
        foreach ($funds as $k=>$fund){
            $fund_arr=explode(',',$fund);
            $model[$k]->three_month=$fund_arr[0];
            $model[$k]->save(false);
        }
        echo json_encode(['state'=>1,'message'=>'ok']);die;
    }
    public function actionSixMonth(){
        $model=Fund::find()->all();
        $date_arr=explode(' ',date('Y-m-d H:i:s',time()));
        $date=$date_arr[0];
        $url="http://fund.eastmoney.com/data/rankhandler.aspx?op=ph&dt=kf&ft=gp&rs=&gs=0&sc=6yzf&st=desc&sd=".$date."&ed=".$date."&qdii=&tabSubtype=,,,,,&pi=1&pn=50&dx=1&v=0.9694814663380384";
        $data=file_get_contents($url);
        $str=$this->getNeedBetween($data,'[',']');
        $str=substr($str,1,(strlen($str)-2));
        $funds=explode('","',$str);
        foreach ($funds as $k=>$fund){
            $fund_arr=explode(',',$fund);
            $model[$k]->six_month=$fund_arr[0];
            $model[$k]->save(false);
        }
        echo json_encode(['state'=>1,'message'=>'ok']);die;
    }
    public function actionOneYear(){
        $model=Fund::find()->all();
        $date_arr=explode(' ',date('Y-m-d H:i:s',time()));
        $date=$date_arr[0];
        $url="http://fund.eastmoney.com/data/rankhandler.aspx?op=ph&dt=kf&ft=gp&rs=&gs=0&sc=1nzf&st=desc&sd=".$date."&ed=".$date."&qdii=&tabSubtype=,,,,,&pi=1&pn=50&dx=1&v=0.6502729710191488";
        $data=file_get_contents($url);
        $str=$this->getNeedBetween($data,'[',']');
        $str=substr($str,1,(strlen($str)-2));
        $funds=explode('","',$str);
        foreach ($funds as $k=>$fund){
            $fund_arr=explode(',',$fund);
            $model[$k]->one_year=$fund_arr[0];
            $model[$k]->save(false);
        }
        echo json_encode(['state'=>1,'message'=>'ok']);die;
    }
    public function actionTwoYear(){
        $model=Fund::find()->all();
        $date_arr=explode(' ',date('Y-m-d H:i:s',time()));
        $date=$date_arr[0];
        $url="http://fund.eastmoney.com/data/rankhandler.aspx?op=ph&dt=kf&ft=gp&rs=&gs=0&sc=2nzf&st=desc&sd=".$date."&ed=".$date."&qdii=&tabSubtype=,,,,,&pi=1&pn=50&dx=1&v=0.0019726459868252277";
        $data=file_get_contents($url);
        $str=$this->getNeedBetween($data,'[',']');
        $str=substr($str,1,(strlen($str)-2));
        $funds=explode('","',$str);
        foreach ($funds as $k=>$fund){
            $fund_arr=explode(',',$fund);
            $model[$k]->two_year=$fund_arr[0];
            $model[$k]->save(false);
        }
        echo json_encode(['state'=>1,'message'=>'ok']);die;
    }
    public function actionThreeYear(){
        $model=Fund::find()->all();
        $date_arr=explode(' ',date('Y-m-d H:i:s',time()));
        $date=$date_arr[0];
        $url="http://fund.eastmoney.com/data/rankhandler.aspx?op=ph&dt=kf&ft=gp&rs=&gs=0&sc=3nzf&st=desc&sd=".$date."&ed=".$date."&qdii=&tabSubtype=,,,,,&pi=1&pn=50&dx=1&v=0.9303972092457116";
        $data=file_get_contents($url);
        $str=$this->getNeedBetween($data,'[',']');
        $str=substr($str,1,(strlen($str)-2));
        $funds=explode('","',$str);
        foreach ($funds as $k=>$fund){
            $fund_arr=explode(',',$fund);
            $model[$k]->three_year=$fund_arr[0];
            $model[$k]->save(false);
        }
        echo json_encode(['state'=>1,'message'=>'ok']);die;
    }

    function getNeedBetween($kw1,$mark1,$mark2){
        $kw=$kw1;
        $kw='123'.$kw.'123';
        $st =stripos($kw,$mark1);
        $ed =stripos($kw,$mark2);
        if(($st==false||$ed==false)||$st>=$ed)
            return 0;
        $kw=substr($kw,($st+1),($ed-$st-1));
        return $kw;
}

}