<?php
?>
<style>
    ul li {
        width: 200px;
        height: 30px;
        margin: 20px 0;
    }
    .geli{
        height: 30px;
        background-color: #761c19;
    }
</style>
<ul>
        <li hr="http://www.fund.com/index.php/fund/one-week">一周</li>
        <li hr="http://www.fund.com/index.php/fund/one-month">一个月</li>
        <li hr="http://www.fund.com/index.php/fund/three-month">三个月</li>
        <li hr="http://www.fund.com/index.php/fund/six-month">六个月</li>
        <li hr="http://www.fund.com/index.php/fund/one-year">一年</li>
        <li hr="http://www.fund.com/index.php/fund/two-year">二年</li>
        <li hr="http://www.fund.com/index.php/fund/three-year">三年</li>
</ul>

<div class="geli"></div>

<div class="data">

</div>

<button>获取数据</button>

<script>
    $(function () {
        $('ul li').click(function () {
            var url =$(this).attr('hr');
            $.ajax({
                url: url,
                type: 'get',
                dataType:'json',
                success: function (data) {
                    if(data.state == 1 ){
                        alert(data.message);
                    }else{
                        alert('失败');
                    }
                }
            })
        })

        $('button').click(function () {
            $.ajax({
                url: "http://www.fund.com/index.php/fund/fund",
                type: 'get',
                dataType:'html',
                success: function (data) {
                    $('.data').html(data);
                }
            })
        })

    })
</script>
