<?php
/**
 * Created by PhpStorm.
 * User: chenl
 * Date: 2017/3/7
 * Time: 14:18
 */

namespace app\controllers;

use yii\web\Controller;
use app\component\CvsComponent;
use Yii;
class CvsController extends Controller
{
    //导出excel表格（为cvs格式）
    public function actionExport(){
        $this->layout=false;
        //Excel列名
        $head = array('序号', '用户名','编码', '注册时间', '新登陆时间', '旧登录时间','新地址','旧地址');
        //$sql语句
        $sql='select member_id,member_name,member_passwd,member_time,member_login_time,member_old_login_time,member_login_ip,member_old_login_ip
              from shopnc_member
              order by member_id asc';
        //输出Excel表
        CvsComponent::importCvs($head,$sql);
        exit;
    }

    // excel导入数据库
    public function actionImport(){

        // 获取数据库链接对象
        $link = mysqli_connect("192.168.0.200", "root", "Dfs@168", "dfs168", '56000');
        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit('数据库链接失败!');
        }
        //读取文件内容
        $temp = file("E:/software/xampp/htdocs/sim/web/document/shopnc_freight_template.csv");//连接EXCEL文件,格式为了.csv
        //组织字段
        $title=explode(",", $temp[0]);
        $feilds='';
        foreach ($title as $k=> $v){
            if($k==0) continue;
            if($k==count($title)-1){
                $feilds.=$v;
            }else{
                $feilds.=$v.',';
            }
        }
        //组织要插入数据库的值
        for ($i = 1; $i <=count($temp)-1; $i++) {
            //通过循环得到EXCEL文件中每行记录的值
            $string = explode(",", $temp[$i]);
            $values='';
            foreach ($string as $k=> $v){
                if($k==0) continue;
                if($k==count($title)-1){
                    $values.='\''.$v.'\'';
                }else{
                    $values.='\''.$v.'\',';
                }
            }
            //将EXCEL文件中每行记录的值插入到数据库中
            $sql = "insert into shopnc_freight_template (".$feilds.") values(".$values.");";
            mysqli_query($link,$sql) or die (mysqli_error($link));

            if (!mysqli_error($link)) ;
            {
                echo " 成功导入数据!";
            }
            unset($string);
        }
    }

}