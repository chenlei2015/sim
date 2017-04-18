<?php
namespace app\controllers;
use yii\web\Controller;
use app\models\fund\Fund;
class FundController extends Controller
{
    public $model;
    /**
     *
     */
    public function beforeAction($action)
    {
        if( parent::beforeAction($action)){
            $this->model=Fund::find()->all();
        }
    }

    public function actionIndex(){
           return $this->render('index');
    }

    public function actionFund(){

        $oneWeekCode=$this->oneWeek($date[0]);
        $oneMonthCode=$this->oneMonth($date[0]);
        $threeMonthCode=$this->threeMonth($date[0]);
        $sixMonthCode=$this->sixMonth($date[0]);
        $oneYearCode=$this->oneYear($date[0]);
        $towYearCode=$this->towYear($date[0]);
        $threeYearCode=$this->threeYear($date[0]);
        //三个月以内
        $threeMonth_in = array_intersect($oneWeekCode, $oneMonthCode, $threeMonthCode);
        //六个月以上
        $sixMonth_up = array_intersect($sixMonthCode, $oneYearCode, $towYearCode,$threeYearCode);
        return $this->render('index',[
            'threeMonth_in'=>$threeMonth_in,
            'sixMonth_up'=>$sixMonth_up
        ]);
    }

    public function actionOneWeek(){
        $date_arr=explode(' ',date('Y-m-d H:i:s',time()));
        $date=$date_arr[0];
        $url="http://fund.eastmoney.com/data/rankhandler.aspx?op=ph&dt=kf&ft=gp&rs=&gs=0&sc=zzf&st=asc&sd=".$date."&ed=".$date."&qdii=&tabSubtype=,,,,,&pi=1&pn=50&dx=1&v=0.09171128598973155";
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
        $date_arr=explode(' ',date('Y-m-d H:i:s',time()));
        $date=$date_arr[0];
        $url="http://fund.eastmoney.com/data/rankhandler.aspx?op=ph&dt=kf&ft=gp&rs=&gs=0&sc=1yzf&st=desc&sd=".$date."&ed=".$date."&qdii=&tabSubtype=,,,,,&pi=1&pn=50&dx=1&v=0.6298212257679552";
        $data=file_get_contents($url);
        $str=$this->getNeedBetween($data,'[',']');
        $str=substr($str,1,(strlen($str)-2));
        $funds=explode('","',$str);
        foreach ($funds as $fund){
            $fund_arr=explode(',',$fund);
            $this->model->one_month=$fund_arr[0];
            $this->model->save(false);
        }
        echo json_encode(['state'=>1,'message'=>'ok']);die;

    }
    public function actionThreeMonth(){
        $date_arr=explode(' ',date('Y-m-d H:i:s',time()));
        $date=$date_arr[0];
        $url="http://fund.eastmoney.com/data/rankhandler.aspx?op=ph&dt=kf&ft=gp&rs=&gs=0&sc=3yzf&st=desc&sd=".$date."&ed=".$date."&qdii=&tabSubtype=,,,,,&pi=1&pn=50=1&v=0.5718787629157305";
        $data=file_get_contents($url);
        $str=$this->getNeedBetween($data,'[',']');
        $str=substr($str,1,(strlen($str)-2));
        $funds=explode('","',$str);
        foreach ($funds as $fund){
            $fund_arr=explode(',',$fund);
            $this->model->three_month=$fund_arr[0];
            $this->model->save(false);
        }
        echo json_encode(['state'=>1,'message'=>'ok']);die;
    }
    public function actionSixMonth(){
        $date_arr=explode(' ',date('Y-m-d H:i:s',time()));
        $date=$date_arr[0];
        $url="http://fund.eastmoney.com/data/rankhandler.aspx?op=ph&dt=kf&ft=gp&rs=&gs=0&sc=6yzf&st=desc&sd=".$date."&ed=".$date."&qdii=&tabSubtype=,,,,,&pi=1&pn=50&dx=1&v=0.9694814663380384";
        $data=file_get_contents($url);
        $str=$this->getNeedBetween($data,'[',']');
        $str=substr($str,1,(strlen($str)-2));
        $funds=explode('","',$str);
        foreach ($funds as $fund){
            $fund_arr=explode(',',$fund);
            $this->model->six_month=$fund_arr[0];
            $this->model->save(false);
        }
        echo json_encode(['state'=>1,'message'=>'ok']);die;
    }
    public function actionOneYear(){
        $date_arr=explode(' ',date('Y-m-d H:i:s',time()));
        $date=$date_arr[0];
        $url="http://fund.eastmoney.com/data/rankhandler.aspx?op=ph&dt=kf&ft=gp&rs=&gs=0&sc=1nzf&st=desc&sd=".$date."&ed=".$date."&qdii=&tabSubtype=,,,,,&pi=1&pn=50&dx=1&v=0.6502729710191488";
        $data=file_get_contents($url);
        $str=$this->getNeedBetween($data,'[',']');
        $str=substr($str,1,(strlen($str)-2));
        $funds=explode('","',$str);
        foreach ($funds as $fund){
            $fund_arr=explode(',',$fund);
            $this->model->one_year=$fund_arr[0];
            $this->model->save(false);
        }
        echo json_encode(['state'=>1,'message'=>'ok']);die;
    }
    public function actionTowYear(){
        $date_arr=explode(' ',date('Y-m-d H:i:s',time()));
        $date=$date_arr[0];
        $url="http://fund.eastmoney.com/data/rankhandler.aspx?op=ph&dt=kf&ft=gp&rs=&gs=0&sc=2nzf&st=desc&sd=".$date."&ed=".$date."&qdii=&tabSubtype=,,,,,&pi=1&pn=50&dx=1&v=0.6087557799182832";
        $data=file_get_contents($url);
        $str=$this->getNeedBetween($data,'[',']');
        $str=substr($str,1,(strlen($str)-2));
        $funds=explode('","',$str);
        foreach ($funds as $fund){
            $fund_arr=explode(',',$fund);
            $this->model->two_year=$fund_arr[0];
            $this->model->save(false);
        }
        echo json_encode(['state'=>1,'message'=>'ok']);die;
    }
    public function actionThreeYear(){
        $date_arr=explode(' ',date('Y-m-d H:i:s',time()));
        $date=$date_arr[0];
        $url="http://fund.eastmoney.com/data/rankhandler.aspx?op=ph&dt=kf&ft=gp&rs=&gs=0&sc=3nzf&st=desc&sd=".$date."&ed=".$date."&qdii=&tabSubtype=,,,,,&pi=1&pn=50&dx=1&v=0.9303972092457116";
        $data=file_get_contents($url);
        $str=$this->getNeedBetween($data,'[',']');
        $str=substr($str,1,(strlen($str)-2));
        $funds=explode('","',$str);
        foreach ($funds as $fund){
            $fund_arr=explode(',',$fund);
            $this->model->three_year=$fund_arr[0];
            $this->model->save(false);
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