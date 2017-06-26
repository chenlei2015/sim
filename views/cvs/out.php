<?php
//date_default_timezone_set('PRC');//设置时区
///*设置head头信息*/
//Header("Content-Type:application/vnd.ms-excel;charset=UTF-8");
//Header("Accept-Ranges:bytes");
//Header("Content-Disposition:attachment;filename=".date('YmdHis').".xls");
//Header("Pragma:no-cache");
//Header("Expires:0");

$orders=[
        [
            'order_sn'=>'888888889',
            'order_amount'=>'99.00',
             'goods'=>[
                     ['goods_name'=>'皮包11', 'y_price'=>'99.00', 'x_price'=>'100.00'],
                     ['goods_name'=>'大衣11', 'y_price'=>'95.00', 'x_price'=>'55.00'],
                     ['goods_name'=>'帽子11', 'y_price'=>'88.00', 'x_price'=>'69.00'],
             ],
             'remark'=>[
                    ['person'=>'小明11', 'content'=>'已完成'],
                    ['person'=>'小与22', 'content'=>'未完22成']
             ]
        ],
//        [
//            'order_sn'=>'888888889',
//            'order_amount'=>'99.00',
//            'goods'=>[
//                ['goods_name'=>'皮包22', 'y_price'=>'99.00', 'x_price'=>'100.00'],
//                ['goods_name'=>'大衣22', 'y_price'=>'95.00', 'x_price'=>'55.00'],
//                ['goods_name'=>'帽子22', 'y_price'=>'88.00', 'x_price'=>'69.00'],
//            ],
//            'remark'=>[
//                ['person'=>'小明11', 'content'=>'已完成'],
//                ['person'=>'小与11', 'content'=>'未完成']
//            ]
//        ],
];

/**
 * 将一个数值切成N份且每份的值为整数
 * @param  int $number    被切的数值
 * @param  int $avgNumber 份数 当$avgNumber=0时；强制赋值为1
 * @return array
 */
function numberAvg($number, $avgNumber)
{
    if($number == 0) {
        $array = array_fill(0, $avgNumber, 0);
    } else {
        if(!$avgNumber) $avgNumber++;
        $avg     = floor($number / $avgNumber);
        $ceilSum = $avg * $avgNumber;
        $array   = array();
        for($i = 0; $i < $avgNumber; $i++) {
            if($i < $number - $ceilSum) {
                array_push($array, $avg + 1);
            } else {
                array_push($array, $avg);
            }
        }
    }
    return $array;
}
?>
<table  border="1" cellspacing="0">
    <tr>
        <td colspan="7" align="center">客服备注信息</td>
    </tr>
    <tr>
        <td>订单号</td>
        <td>订单总价</td>
        <td>商品名称</td>
        <td>商品原价</td>
        <td>商品现价</td>
        <td>备注人</td>
        <td>备注内容</td>
    </tr>
    <tr>
        <td rowspan="3">888888888</td>
        <td rowspan="3">99.00</td>
        <td>皮包11</td>
        <td>150.00</td>
        <td>88.00</td>
        <td>小明</td>
        <td rowspan="2">已完成</td>
    </tr>
    <tr>
        <td>大衣11</td>
        <td>150.00</td>
        <td>88.00</td>
        <td>小明</td>
    </tr>
    <tr>
        <td>帽子11</td>
        <td>150.00</td>
        <td>88.00</td>
        <td>小明</td>
        <td>已完成</td>
    </tr>

    <tr>
        <td rowspan="3">888888888</td>
        <td rowspan="3">99.00</td>
        <td>帽子22</td>
        <td>150.00</td>
        <td>88.00</td>
        <td>小明</td>
        <td rowspan="2">已完成</td>
    </tr>
    <tr>
        <td>皮草22</td>
        <td>150.00</td>
        <td>88.00</td>
        <td>小明</td>
    </tr>
    <tr>
        <td>荷包22</td>
        <td>150.00</td>
        <td>88.00</td>
        <td>小明</td>
        <td>已完成</td>
    </tr>
</table>

<table  border="1" cellspacing="0">
    <tr>
        <td colspan="7" align="center">客服备注信息</td>
    </tr>
    <tr>
        <td>订单号</td>
        <td>订单总价</td>
        <td>商品名称</td>
        <td>商品原价</td>
        <td>商品现价</td>
        <td>备注人</td>
        <td>备注内容</td>
    </tr>
    <?php foreach($orders as $order) { ?>

        <?php
        $goods_count=count($order['goods']);
        $remark_count=count($order['remark']);
        $flag=false;
        if($goods_count>=$remark_count){
            $flag=true;
            $first=$order['goods'];
            $second=$order['remark'];
        }elseif($goods_count<$remark_count){
            $first=$order['remark'];
            $second=$order['goods'];
        }
        //如何合并行
        if($flag){
            $rows= numberAvg($goods_count,$remark_count);
        }else{
            $rows= numberAvg($remark_count,$goods_count);
        }

        ?>

        <?php $count=0; $rows_index=0; $show=true;?>
        <?php foreach ($first as $x=>$v){ ?>
            <?php $count++; ?>
            <tr>
                <?php if($x==0){ ?>
                <td rowspan="<?=count($first)?>"><?=$order['order_sn']?></td>
                <td rowspan="<?=count($first)?>"><?=$order['order_amount']?></td>
                <?php } ?>
                <?php if($rows[$rows_index]==$count) $show=true; ?>
                <?php if(!empty($order['goods'][$x])){ ?>
                    <td rowspan="<?=$flag?1:$rows[$key]?>"><?=$order['goods'][$x]['goods_name']?></td>
                    <td rowspan="<?=$flag?1:$rows[$key]?>"><?=$order['goods'][$x]['y_price']?></td>
                    <td rowspan="<?=$flag?1:$rows[$key]?>"><?=$order['goods'][$x]['x_price']?></td>
                <?php } ?>
                <?php if(!empty($order['remark'][$rows_index])){?>
                    <?php if($show){ ?>
                        <td rowspan="<?=$flag?$rows[$rows_index]:1?>"><?=$order['remark'][$rows_index]['person']?></td>
                        <td rowspan="<?=$flag?$rows[$rows_index]:1?>"><?=$order['remark'][$rows_index]['content']?></td>
                        <?php $rows_index++;$show=false?>
                    <?php }?>

                <?php } ?>
            </tr>
        <?php } ?>


    <?php } ?>

</table>

