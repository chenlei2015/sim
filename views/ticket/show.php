<?php

?>
<script src="/js/echarts.min.js"></script>
<style>
    table{
        border-collapse: collapse;
    }
    table th{
        text-align: center;
        height: 20px;
    }
    table td{
        text-align: center;
        height: 20px;
    }
</style>
<div class="btn-group btn-group-lg" style="margin-bottom: 10px;">
    <button type="button" class="btn btn-default" begin="<?=strtotime(date('Y-m-d',time()))?>" end="<?=time()?>" >今天</button>
    <button type="button" class="btn btn-default" begin="<?=strtotime(date('Y-m-d',strtotime("-1 day")))?>" end="<?=strtotime(date('Y-m-d',time()))?>" >昨天</button>
    <button type="button" class="btn btn-default" begin="<?=strtotime(date('Y-m-d',strtotime("-1 day")))?>" end="<?=time()?>" >2天</button>
    <button type="button" class="btn btn-default" begin="<?=strtotime(date('Y-m-d',strtotime("-2 day")))?>" end="<?=time()?>" >3天</button>
    <button type="button" class="btn btn-default">按钮 2</button>
    <button type="button" class="btn btn-default">按钮 3</button>
    <button type="button" class="btn btn-default">按钮 1</button>
    <button type="button" class="btn btn-default">按钮 2</button>
    <button type="button" class="btn btn-default">按钮 3</button>
    <button type="button" class="btn btn-default">按钮 3</button>
    <button type="button" class="btn btn-default">按钮 3</button>
    <button type="button" class="btn btn-default">按钮 3</button>
    <button type="button" class="btn btn-default">按钮 3</button>
</div>
<div class="row">
    <div class="col-md-3">
        <p>
            <button type="button" class="btn btn-primary">原始按钮</button>
            <button type="button" class="btn btn-primary">原始按钮</button>
            <button type="button" class="btn btn-primary">原始按钮</button>
        </p>
        <div class="pre-scrollable" style="max-height:750px">
            <table border="1" style="text-align:center">
                    <tr>
                        <th style="width:40%">呼看叫</th>
                        <th style="width:12%">名</th>
                        <th style="width:12%">名</th>
                        <th style="width:12%">名</th>
                        <th style="width:12%">名</th>
                        <th style="width:12%">名</th>
                    </tr>
                <?php  for ($i=0;$i<100;$i++){?>
                    <tr>
                        <td>20170627-028</td>
                        <td>4</td>
                        <td>5</td>
                        <td>5</td>
                        <td>4</td>
                        <td>4</td>
                    </tr>
                <?php  } ?>
            </table>
        </div>
    </div>
    <div class="col-md-9">
        <h6>走势图</h6>
        <div id="mainy" style="width: 800px;height: 800px">

        </div>
    </div>
</div>
<script type="text/javascript">
    $(function () {
        // 基于准备好的dom，初始化echarts实例
        var myChart = echarts.init(document.getElementById('mainy'));
        // 指定图表的配置项和数据
        option = {
            tooltip: {
                trigger: 'axis',
                axisPointer: {
                    type: 'cross',
                    crossStyle: {
                        color: '#999'
                    }
                }
            },
            toolbox: {
                feature: {
                    dataView: {show: true, readOnly: false},
                    magicType: {show: true, type: ['line', 'bar']},
                    restore: {show: true},
                    saveAsImage: {show: true}
                }
            },
            legend: {
                data:['蒸发量','降水量','平均温度']
            },
            xAxis: [
                {
                    type: 'category',
                    data: ['1月','2月','3月','4月','5月','6月','7月','8月','9月','10月','11月','12月'],
                    axisPointer: {
                        type: 'shadow'
                    }
                }
            ],
            yAxis: [
                {
                    type: 'value',
                    name: '水量',
                    min: 0,
                    max: 250,
                    interval: 50,
                    axisLabel: {
                        formatter: '{value} ml'
                    }
                },

            ],
            series: [
                {
                    name:'蒸发量',
                    type:'bar',
                    data:[2.0, 4.9, 7.0, 23.2, 25.6, 76.7, 135.6, 162.2, 32.6, 20.0, 6.4, 3.3]
                },
                {
                    name:'降水量',
                    type:'bar',
                    data:[2.6, 5.9, 9.0, 26.4, 28.7, 70.7, 175.6, 182.2, 48.7, 18.8, 6.0, 2.3]
                },

            ]
        };
        // 使用刚指定的配置项和数据显示图表。
        myChart.setOption(option);
    })
</script>
