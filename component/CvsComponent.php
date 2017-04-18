<?php
/**
 * Created by PhpStorm.
 * User: chenl
 * Date: 2017/3/7
 * Time: 14:31
 */
namespace app\component;
use yii\base\component;
class CvsComponent extends component
{

    public static function importCvs($head,$sql){

        //设置头部
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="user.csv"');
        header('Cache-Control: max-age=0');

        // 获取数据库链接对象
        $link = mysqli_connect("192.168.0.200", "root", "Dfs@168", "dfs168",'56000');
        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit('数据库链接失败!');
        }

        // 打开PHP文件句柄，php://output 表示直接输出到浏览器
        $fp = fopen('php://output', 'a');

        // 输出Excel列名信息
        foreach ($head as $i => $v) {
            // CSV的Excel支持GBK编码，一定要转换，否则乱码
            $head[$i] = iconv('utf-8', 'gbk', $v);
            //$row[$i] = mb_convert_encoding( $v,'gbk','utf-8');
        }

        // 将数据通过fputcsv写到文件句柄
        fputcsv($fp, $head);

        // 计数器
        $cnt = 0;

        // 每隔$limit行，刷新一下输出buffer，不要太大，也不要太小
        $limit = 100000;

        // 逐行取出数据，不浪费内存(从数据库中获取数据，为了节省内存，不要把数据一次性读到内存，从句柄中一行一行读即可)
        if($result = mysqli_query($link,$sql,MYSQLI_USE_RESULT)){
            while ($row=mysqli_fetch_assoc($result)) {
                $cnt ++;
                if ($limit == $cnt) { //刷新一下输出buffer，防止由于数据过多造成问题
                    ob_flush();
                    flush();
                    $cnt = 0;
                }
                foreach ($row as $i => $v) {
                     // CSV的Excel支持GBK编码，一定要转换，否则乱码
                    //注意iconv 与mb_convert_encoding的区别；iconv 不能转换特殊字符如 “-”，
                    //// $row[$i] = iconv('utf-8', 'gbk', $v);

                   $row[$i] = mb_convert_encoding( $v,'gbk','utf-8');
                }
                fputcsv($fp, $row);
            }
            //释放结果集
            mysqli_free_result($result);
            //关闭文件句柄
            fclose($fp);
            //关闭数据库连接对象
        }
        mysqli_close($link);
        return ob_get_clean();
    }

}